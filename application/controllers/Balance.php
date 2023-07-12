<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Balance extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('act');
	}
	public function index() {
		if ($this->session->userdata('id') != TRUE) {
			redirect('/');
		} else {
			$data['title'] = 'Informasi Kas';
			$data['user'] = $this->act->UseData()->row_array();
			$data['jan'] = $this->act->januari()->row_array();
			$data['feb'] = $this->act->februari()->row_array();
			$data['mar'] = $this->act->maret()->row_array();
			$data['apr'] = $this->act->april()->row_array();
			$data['mei'] = $this->act->mei()->row_array();
			$data['jun'] = $this->act->juni()->row_array();
			$data['jul'] = $this->act->juli()->row_array();
			$data['agu'] = $this->act->agustus()->row_array();
			$data['sep'] = $this->act->september()->row_array();
			$data['okt'] = $this->act->oktober()->row_array();
			$data['nov'] = $this->act->november()->row_array();
			$data['des'] = $this->act->desember()->row_array();

			$data['ejan'] = $this->act->ejanuari()->row_array();
			$data['efeb'] = $this->act->efebruari()->row_array();
			$data['emar'] = $this->act->emaret()->row_array();
			$data['eapr'] = $this->act->eapril()->row_array();
			$data['emei'] = $this->act->emei()->row_array();
			$data['ejun'] = $this->act->ejuni()->row_array();
			$data['ejul'] = $this->act->ejuli()->row_array();
			$data['eagu'] = $this->act->eagustus()->row_array();
			$data['esep'] = $this->act->eseptember()->row_array();
			$data['eokt'] = $this->act->eoktober()->row_array();
			$data['enov'] = $this->act->enovember()->row_array();
			$data['edes'] = $this->act->edesember()->row_array();

			$data['income'] = $this->act->income();
			$data['expense'] = $this->act->expense();
			$this->load->view('_partials/header', $data);
			$this->load->view('_partials/sidebar', $data);
			$this->load->view('_partials/topbar', $data);
			$this->load->view('pages/balance', $data);
			$this->load->view('_partials/footer');
			$this->load->view('chart/chart', $data);
		}
	}

	public function income(){

		if ($this->session->userdata('id') == TRUE) {

			$akses = $this->act->UseData()->row_array();
			$data['user'] = $akses;

			if ($akses['data_kas'] == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
				redirect('/dashboard');
			} else {

				$data['balance'] = $this->act->income();
				$data['jenis'] = $this->act->type();
				$data['siswa'] = $this->act->viewAll();

				$data['title'] = 'Data Pendapatan Kas';

				$this->load->view('_partials/header', $data);
				$this->load->view('_partials/sidebar', $data);
				$this->load->view('_partials/topbar', $data);
				$this->load->view('pages/income', $data);
				$this->load->view('_partials/footer');
				$this->load->view('_partials/js');
			}
		} else {
			redirect('/');
		}
	}

	public function expense(){
		if ($this->session->userdata('id') == TRUE) {

			$akses = $this->act->UseData()->row_array();
			$data['user'] = $akses;

			if ($akses['data_kas'] == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
				redirect('/dashboard');
			} else {

				$data['balance'] = $this->act->expense();
				$data['category'] = $this->act->category();

				$data['title'] = 'Data Pengeluaran Kas';

				$this->load->view('_partials/header', $data);
				$this->load->view('_partials/sidebar', $data);
				$this->load->view('_partials/topbar', $data);
				$this->load->view('pages/expense', $data);
				$this->load->view('_partials/footer');
				$this->load->view('_partials/js');
			}
		} else {
			redirect('/');
		}
	}

	public function type(){
		if ($this->session->userdata('id') == TRUE) {

			$akses = $this->act->UseData()->row_array();
			$data['user'] = $akses;

			if ($akses['data_kas'] == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
				redirect('/dashboard');
			} else {

				$data['balance'] = $this->act->type();

				$data['title'] = 'Jenis Pendapatan Kas';

				$this->load->view('_partials/header', $data);
				$this->load->view('_partials/sidebar', $data);
				$this->load->view('_partials/topbar', $data);
				$this->load->view('pages/type', $data);
				$this->load->view('_partials/footer');
				$this->load->view('_partials/js');
			}
		} else {
			redirect('/');
		}
	}

	public function category(){
		if ($this->session->userdata('role_id') == TRUE) {

			$akses = $this->act->UseData()->row_array();
			$data['user'] = $akses;

			if ($akses['data_kas'] == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
				redirect('/dashboard');
			} else {

				$data['balance'] = $this->act->category();

				$data['title'] = 'Kategori Pengeluaran Kas';

				$this->load->view('_partials/header', $data);
				$this->load->view('_partials/sidebar', $data);
				$this->load->view('_partials/topbar', $data);
				$this->load->view('pages/category', $data);
				$this->load->view('_partials/footer');
				$this->load->view('_partials/js');
			}
		} else {
			redirect('/');
		}
	}
}
