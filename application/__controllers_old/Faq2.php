<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('frontend/kontak_model');
        $this->load->model('global_model','app_data');
    }

	public function index()
	{
        $data['title']  = "FAQ";
        $data['bahasa']   = $this->session->userdata('bahasa');

        //paging faq
        $config = array();
        $config["base_url"] = base_url() . "faq/index";
        $config["total_rows"] = $this->kontak_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["list_tanya_jawab"] = $this->kontak_model->fetch_faq($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        // $data['list_tanya_jawab'] = $this->kontak_model->list_tanya_jawab();

        $row['content'] = $this->load->view('v_faq', $data, TRUE);
        $this->load->view('template', $row);
	}
}