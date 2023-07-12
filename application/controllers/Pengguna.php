<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('act');
    }

    public function index(){

        $data['title'] = 'Profil siswa';
        $data['user'] = $this->act->UseData()->row_array();
        $this->load->view('_partials/header', $data);
        $this->load->view('_partials/sidebar', $data);
        $this->load->view('_partials/topbar', $data);
        $this->load->view('pages/profil', $data);
        $this->load->view('_partials/footer');
        $this->load->view('_partials/js');
    }

    public function sekretaris(){
        if ($this->session->userdata('id') != TRUE) {
            redirect('/');
        } else {
            $akses = $this->act->UseData()->row_array();
            $data['user'] = $akses;

            $data['pengguna'] = $this->act->sekretarisAll();

            if ($akses['pengguna'] == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
                redirect('/dashboard');
            }

            $data['title'] = 'Data Sekretaris';
            $data['role'] = 'sekretaris';

            $this->load->view('_partials/header', $data);
            $this->load->view('_partials/sidebar', $data);
            $this->load->view('_partials/topbar', $data);
            $this->load->view('pages/list_users', $data);
            $this->load->view('_partials/footer');
            $this->load->view('_partials/js');
        }

    }

    public function edit($id){
        if ($this->session->userdata('id') != TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
            redirect('/');
        } else {
            $akses = $this->act->UseData()->row_array();
            $data['user'] = $akses;

            if ($akses['pengguna'] == 0) {
                if ($id != $akses['id']) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
                    redirect('/dashboard');
                }
            }

            $data['pengguna'] = $this->act->userView($id)->row();
            $data['title'] = 'Edit Pengguna';
            $this->load->view('_partials/header', $data);
            $this->load->view('_partials/sidebar', $data);
            $this->load->view('_partials/topbar', $data);
            $this->load->view('pages/edit_pengguna', $data);
            $this->load->view('_partials/footer');
            $this->load->view('_partials/js');
        }
    }

    public function profile(){
        if ($this->session->userdata('id') != TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
            redirect('/');
        } else {
            
            $data['user'] = $this->act->UseData()->row_array();

            $data['pengguna'] = $this->act->userView($this->session->userdata('id'))->row();
            $data['title'] = 'Edit Profil';
            $this->load->view('_partials/header', $data);
            $this->load->view('_partials/sidebar', $data);
            $this->load->view('_partials/topbar', $data);
            $this->load->view('pages/edit_pengguna', $data);
            $this->load->view('_partials/footer');
            $this->load->view('_partials/js');
        }
    }

    public function siswa(){
        if ($this->session->userdata('id') != TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
            redirect('/dashboard');
        } else {
            $akses = $this->act->UseData()->row_array();
            $data['user'] = $akses;

            $data['pengguna'] = $this->act->siswaAll();

            if ($akses['pengguna'] == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda tidak memiliki hak akses!</div>');
                redirect('/dashboard');
            }

            $data['title'] = 'Data Siswa';
            $data['role'] = 'siswa';

            $this->load->view('_partials/header', $data);
            $this->load->view('_partials/sidebar', $data);
            $this->load->view('_partials/topbar', $data);
            $this->load->view('pages/list_users', $data);
            $this->load->view('_partials/footer');
            $this->load->view('_partials/js');
        }
    }
}
