<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('frontend/agenda_model');
    }

	public function index()
	{
        $data['title']  = "Agenda";
        $data['bahasa']   = $this->session->userdata('bahasa');
        
        //paging agenda
        $config = array();
        $config["base_url"] = base_url() . "berita_agenda/agenda/index";
        $config["total_rows"] = $this->agenda_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["list_agenda"] = $this->agenda_model->fetch_agenda($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $row['content'] = $this->load->view('berita_agenda/v_agenda', $data, TRUE);
        $this->load->view('template', $row);
	}

    public function detil_agenda($id)
    {
        $data['title'] = "Detil Berita";
        $data['bahasa']   = $this->session->userdata('bahasa');

        $data['detil_agenda'] = $this->agenda_model->detil_agenda($id);

        $row['content'] = $this->load->view('berita_agenda/v_detil_agenda', $data, TRUE);
        $this->load->view('template', $row);
    }
}