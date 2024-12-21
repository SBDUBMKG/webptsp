<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('frontend/pengumuman_model');
    }

	public function index()
	{
        $data['title']  = "Pengumuman";
        $data['bahasa'] = $this->session->userdata('bahasa');

        //paging pengumuman
        $config = array();
        $config["base_url"] = base_url() . "berita_agenda/pengumuman/index";
        $config["total_rows"] = $this->pengumuman_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $where = "is_publish = 1 AND expired_date >= NOW()";
        $data["list_pengumuman"] = $this->pengumuman_model->fetch_pengumuman($config["per_page"], $page, $where);
        $data["links"] = $this->pagination->create_links();

        $row['content'] = $this->load->view('berita_agenda/v_pengumuman', $data, TRUE);
        $this->load->view('template', $row);
	}

    public function detil_pengumuman($id)
    {
        $data['title'] = "Detil pengumuman";
        $data['bahasa'] = $this->session->userdata('bahasa');

        $data['detil_pengumuman'] = $this->pengumuman_model->detil_pengumuman($id);

        $row['content'] = $this->load->view('berita_agenda/v_detil_pengumuman', $data, TRUE);
        $this->load->view('template', $row);
    }
}