<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('global_model');
    }

    public function index()
    {
    }

    public function list_layanan($id_layanan = '')
    {
        $data['title']               = "Layanan";
        $data['bahasa']              = $this->session->userdata('bahasa');

        $layanan = $this->global_model->get_by_id_array('tbl_layanan', 'id_layanan',$id_layanan);
        $data['layanan'] = $layanan['layanan'];
        $data['file'] = $layanan['lampiran'];
        $row['content'] = $this->load->view('v_layanan', $data, TRUE);
        
        $this->load->view('template', $row);
    }
}