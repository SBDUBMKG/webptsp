<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {
    function __construct(){
        parent::__construct();
        // $this->template->set_template('frontend');
        $this->template->set_template('frontend_ptsp');
        $this->load->model('frontend/pengumuman_model');
    }

	public function index()
	{
        $data['title']  = "Pengumuman";
        $data['bahasa'] = $this->session->userdata('bahasa');

        //paging pengumuman
        $config = array();
        $config["base_url"] = base_url() . "pengumuman/index";
        $config["total_rows"] = $this->pengumuman_model->record_count();
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $where = "is_publish = 1";
        $data["list_pengumuman"] = $this->pengumuman_model->fetch_pengumuman($config["per_page"], $page, $where);
        $data["links"] = $this->pagination->create_links();

        // $row['content'] = $this->load->view('v_pengumuman', $data, TRUE);
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_pengumuman', $data, true);
        $this->template->render();
        // $this->load->view('template', $row);
	}

    public function detil_pengumuman($id)
    {
        $data['title'] = "Detil pengumuman";
        $data['bahasa'] = $this->session->userdata('bahasa');

        $data['detil_pengumuman'] = $this->pengumuman_model->detil_pengumuman($id);

		$this->template->write('title', $data['title']);
		$this->template->write_view('content', 'v_detil_pengumuman', $data, true);
		$this->template->render();
    }
}
