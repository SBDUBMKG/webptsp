<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_katalog extends CI_Controller {

	var $folder         = '';

    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend_ptsp');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
        $this->load->library('cart');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0',false);
        header('Pragma: no-cache');

    }

	public function index() {
    	$keyword = $this->input->post('search_katalog',true);
        $keyword = $this->db->escape_like_str($keyword);

        $data['title']  = "Pencarian Katalog";
        $data['bahasa'] = $this->session->userdata('bahasa');

        //paging search
        $config                       = array();
        $config["base_url"]           = base_url().$this->module.'/index';
        $config["total_rows"]         = $this->global_model->record_count_katalog('m_layanan', $keyword);
        $config["per_page"]           = 12;
        $config["uri_segment"]        = 3;
        $config['use_page_number']    = false;
        $config['full_tag_open']      = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']     = '</ul></nav>';
        $config['num_tag_open']       = '<li class="page-item">';
        $config['num_tag_close']      = '</li>';
        $config['cur_tag_open']       = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']      = '</a></li>';
        $config['prev_link']          = 'Previous';
        $config['prev_tag_open']      = '<li class="page-item">';
        $config['prev_tag_close']     = '</li>';
        $config['next_link']          = 'Next';
        $config['next_tag_open']      = '<li class="page-item">';
        $config['next_tag_close']     = '</li>';
        $config['attributes']         = array('class' => 'page-link');
        $config['reuse_query_string'] = true; // add query string to each pagination lin


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["list_katalog"] = $this->global_model->search_katalog($config["per_page"], $page, 'm_layanan', $keyword);

        $data["links"] = $this->pagination->create_links();
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_search_katalog', $data, true);
        $this->template->render();
	}
}
