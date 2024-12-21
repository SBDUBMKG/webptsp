<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('global_model');
        $this->load->model('frontend/informasi_model');
    }

    public function index()
    {
    }

    public function list_informasi($id_bidang = '')
    {
        $data['title']               = "Informasi";
        $data['bahasa']              = $this->session->userdata('bahasa');
        $data['id_bidang']           = $id_bidang;

        $row['content'] = $this->load->view('v_informasi', $data, TRUE);
        $this->load->view('template', $row);
    }

    public function detil_informasi($id)
    {
        $data['title'] = "Detil Informasi";
        $data['bahasa'] = $this->session->userdata('bahasa');

        $data['detil_informasi'] = $this->informasi_model->detil_informasi($id);

        $row['content'] = $this->load->view('v_detil_informasi', $data, TRUE);
        $this->load->view('template', $row);
    }
}