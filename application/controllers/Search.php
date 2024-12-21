<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class search extends CI_Controller {

	var $folder         = '';

    function __construct(){
        parent::__construct();
        // $this->template->set_template('frontend');
        $this->template->set_template('frontend_ptsp');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0',false);
        header('Pragma: no-cache');
    }

	public function index() {
    	$string = $this->input->post('search',true);
        $string = $this->db->escape_like_str($string);

        $data['title']  = "Pencarian";
        $data['bahasa'] = $this->session->userdata('bahasa');

        // deprecated, pagination would not be used at global search
        // paging search
        // $config                     = array();
        // $config["base_url"]         = base_url().$this->module.'/index';
        // $config["uri_segment"]      = 3;
        // $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
        // $config['full_tag_close'] = '</ul></nav>';
        // $config['num_tag_open'] = '<li class="page-item">';
        // $config['num_tag_close'] = '</li>';
        // $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        // $config['cur_tag_close'] = '</a></li>';
        // $config['prev_link'] = 'Previous';
        // $config['prev_tag_open'] = '<li class="page-item">';
        // $config['prev_tag_close'] = '</li>';
        // $config['next_link'] = 'Next';
        // $config['next_tag_open'] = '<li class="page-item">';
        // $config['next_tag_close'] = '</li>';
        // $config['attributes'] = array('class' => 'page-link');
        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["list_berita"] = $this->global_model->search(null, null, 'tbl_berita', $string, ['judul', 'isi']);
        $data['list_katalog'] = $this->global_model->search(null, null, 'm_layanan', $string, ['layanan']);

        $data["links"] = $this->pagination->create_links();
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_search', $data, true);
        $this->template->render();
	}
}
