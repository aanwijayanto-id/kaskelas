<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Act');
	}
	public function index() {
		if ($this->session->userdata('role_id') == TRUE) {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {

			$data['title'] = 'Kas Kelas Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
            // validasi succes
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('db_users', ['email' => $email])->row_array();
        // user ada
		if ($user) {
            // jika usernya aktif
			if ($user['is_active'] == 1) {
                // cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'id' => $user['id'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					redirect('dashboard');

				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">this email
					has not been activated!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registed!</div>');
			redirect('auth');
		}
	}


	public function registrasi(){

		if ($this->session->userdata('role_id') == TRUE) {
			redirect('dashboard');
		}
		
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[db_users.email]', [
			'is_unique' => 'this email has already register'
		]);
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|min_length[3]|matches[password1]');

		if ($this->form_validation->run() == false) {

			$data['title'] = 'Kas Kelas Registasi';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registrasi');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 3

			];

			$this->db->insert('db_users', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your account has been success! please login</div>');
			redirect('/');
		}
	}

	public function logout(){

		$this->session->unset_userdata('id');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert
			alert-warning" role="alert"> You has been Logged Out! </div>');
		redirect('/');
	}

	public function edit_user(){

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');

		if ($this->form_validation->run() == TRUE){

			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$passwordold = $this->input->post('passwordold');

			$user = $this->db->get_where('db_users', ['email' => $email])->row_array();
			if (!empty($passwordold)) {
				if (password_verify($passwordold, $user['password'])) {
					$password =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
					$passwordx =  password_hash($this->input->post('passwordx'), PASSWORD_DEFAULT);

					if ($this->input->post('password') == $this->input->post('passwordx')) {

            // cek jika ada gambar yang akan diupload
						$upload_image = $_FILES['image']['name'];

						if ($upload_image) {
							$config['allowed_types'] = 'gif|jpg|png';
							$config['max_size']      = '2048';
							$config['upload_path']   = './assets/img/profile/';

							$this->load->library('upload', $config);

							if ($this->upload->do_upload('image')) {

								$old_image = $data['user']['image'];
								if ($old_image != 'default.jpg') {
									unlink(FCPATH . 'assets/img/profile/' . $old_image);
								}

								$new_image = $this->upload->data('file_name');
								$this->db->set('image', $new_image);
							} else {
								echo $this->upload->display_errors();
							}
						}

						$this->db->set('name', $name);
						$this->db->set('password', $password);
						$this->db->where('email', $email);
						$this->db->update('db_users');

						$this->session->set_flashdata('message', '<div class="alert
							alert-success" role="alert"> Profile has been updated!</div>');
						redirect('pengguna/edit/'.$user['id']);
					} else {
						$this->session->set_flashdata('message', '<div class="alert
							alert-success" role="alert"> Password tidak sama!</div>');
						redirect('pengguna/edit/'.$user['id']);
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert
						alert-success" role="alert"> Password lama salah!</div>');
					redirect('pengguna/edit/'.$user['id']);
				}
			} else {

            // cek jika ada gambar yang akan diupload
				$upload_image = $_FILES['image']['name'];

				if ($upload_image) {
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']      = '2048';
					$config['upload_path']   = './assets/img/profile/';

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('image')) {

						$old_image = $data['user']['image'];
						if ($old_image != 'default.jpg') {
							unlink(FCPATH . 'assets/img/profile/' . $old_image);
						}

						$new_image = $this->upload->data('file_name');
						$this->db->set('image', $new_image);
					} else {
						echo $this->upload->display_errors();
					}
				}

				$this->db->set('name', $name);
				$this->db->where('email', $email);
				$this->db->update('db_users');

				$this->session->set_flashdata('message', '<div class="alert
					alert-success" role="alert"> Profile has been updated!</div>');
				redirect('pengguna/edit/'.$user['id']);
			}
		}
	}

	public function del_user($id){
		$sekretaris = $this->act->userView($id)->row_array();
		if ($sekretaris['role_id'] == 2) {
			$direct = 'sekretaris';
		} else {
			$direct = 'siswa';
		}

		if($this->act->delUser($id) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert
				alert-success" role="alert"> Data pengguna berhasil di hapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert
				alert-danger" role="alert"> Data tidak dapat di proses !</div>');
		}
		redirect('pengguna/'.$direct);
	}

	public function add_sekretaris(){
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[db_users.email]', [
			'is_unique' => 'this email has already register'
		]);
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|min_length[3]|matches[password1]');

		if ($this->form_validation->run() == false) {

			$data['title'] = 'Kas Kelas Registasi';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registrasi');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1

			];

			$this->db->insert('db_users', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil di simpan</div>');
			redirect('pengguna/sekretaris');
		}
	}

	public function add_siswa(){
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[db_users.email]', [
			'is_unique' => 'this email has already register'
		]);
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|min_length[3]|matches[password1]');

		if ($this->form_validation->run() == false) {

			$data['title'] = 'Kas Kelas Registasi';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registrasi');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 3,
				'is_active' => 1

			];

			$this->db->insert('db_users', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil di simpan</div>');
			redirect('pengguna/siswa');
		}
	}

	public function add_income(){
		$data = [
			'type' => '1',
			'id_category' => $this->input->post('type', true),
			'nominal' => $this->input->post('nominal', true),
			'id_user' => $this->input->post('siswa', true),
			'keterangan' => $this->input->post('keterangan', true)
		];

		$this->db->insert('db_balance', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil di simpan</div>');
		redirect('balance/income');
	}

	public function add_expense(){
		$data = [
			'type' => '2',
			'id_category' => $this->input->post('type', true),
			'nominal' => $this->input->post('nominal', true),
			'keterangan' => $this->input->post('keterangan', true)
		];

		$this->db->insert('db_balance', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil di simpan</div>');
		redirect('balance/expense');
	}

	public function edit_balance($id){
		$get = $this->Act->balanceView($id)->row_array();
		if ($get['type'] == 1) {
			$direct = 'income';
		} else {
			$direct = 'expense';
		}

		$data = [
			'id_category' => $this->input->post('type', true),
			'nominal' => $this->input->post('nominal', true),
			'id_user' => $this->input->post('siswa', true),
			'keterangan' => $this->input->post('keterangan', true)
		];

		$this->db->where('id_balance', $id);
		$this->db->update('db_balance', $data);

		$this->session->set_flashdata('message', '<div class="alert
			alert-success" role="alert"> Data has been updated!</div>');
		redirect('balance/'.$direct);
		
	}

	public function del_balance($id){
		$get = $this->Act->balanceView($id)->row_array();
		if ($get['type'] == 1) {
			$direct = 'income';
		} else {
			$direct = 'expense';
		}

		if($this->Act->delBalance($id) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert
				alert-success" role="alert"> Data berhasil di hapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert
				alert-danger" role="alert"> Data tidak dapat di proses !</div>');
		}

		redirect('balance/'.$direct);
	}

	public function add_type(){

		$data = [
			'category' => $this->input->post('jenis', true),
			'ket_category' => $this->input->post('keterangan', true),
			'type_cat' => 1
		];

		$this->db->insert('db_category', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil di simpan</div>');
		redirect('balance/type');
	}

	public function edit_category($id){
		$get = $this->act->categoryView($id)->row_array();
		if ($get['type_cat'] == 1) {
			$direct = 'type';
		} else {
			$direct = 'category';
		}

		$data = [
			'category' => $this->input->post('jenis', true),
			'ket_category' => $this->input->post('keterangan', true)
		];

		$this->db->where('id_category', $id);
		$this->db->update('db_category', $data);

		$this->session->set_flashdata('message', '<div class="alert
			alert-success" role="alert"> Data has been updated!</div>');
		redirect('balance/'.$direct);
	}

	public function del_category($id){
		$get = $this->act->categoryView($id)->row_array();
		if ($get['type_cat'] == 1) {
			$direct = 'type';
		} else {
			$direct = 'category';
		}

		if($this->act->delCategory($id) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert
				alert-success" role="alert"> Data berhasil di hapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert
				alert-danger" role="alert"> Data tidak dapat di proses !</div>');
		}

		redirect('balance/'.$direct);
	}

	public function add_category(){

		$data = [
			'category' => $this->input->post('jenis', true),
			'ket_category' => $this->input->post('keterangan', true),
			'type_cat' => 2
		];

		$this->db->insert('db_category', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil di simpan</div>');
		redirect('balance/category');
	}
}
