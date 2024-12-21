<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peraturan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('frontend/berita_model');
        $this->load->model('global_model');
    }

	public function index()
	{
        $data['title']  = "Home";
        $data['bahasa']   = $this->session->userdata('bahasa');

        $row['content'] = $this->load->view('v_peraturan', $data, TRUE);
        $this->load->view('template', $row);
	}
}