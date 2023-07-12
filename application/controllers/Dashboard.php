<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('act');
    }

    public function index(){
        if($this->session->userdata('role_id') != TRUE){
            redirect('/');
        }

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

        $data['title'] = 'Dashboard';
        $data['user'] = $this->act->UseData()->row_array();

        $data['income'] = $this->act->incomeMon()->row_array();
        $data['expense'] = $this->act->expenseMon()->row_array();
        $data['sisa'] = $this->act->sumIncome();
        $data['persentase'] = $this->act->persentase();

        $this->load->view('_partials/header', $data);
        $this->load->view('_partials/sidebar', $data);
        $this->load->view('_partials/topbar', $data);
        $this->load->view('pages/dashboard', $data);
        $this->load->view('_partials/footer');
        $this->load->view('chart/chart');
    }
}
