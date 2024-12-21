<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class search extends CI_Controller {

	var $folder         = '';

    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index() {
		$string = $this->input->post('search');

        $data['title']  = "Pencarian";
        $data['bahasa'] = $this->session->userdata('bahasa');

        //paging search
        $config                     = array();
        $config["base_url"]         = base_url().$this->module.'/index';
        $config["total_rows"]       = $this->global_model->record_count('tbl_berita', $string);
        $config["per_page"]         = 5;
        $config["uri_segment"]      = 4;
        $config['cur_tag_open']     = '<li class="paginate_button active"><a href="">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li class="paginate_button">';
        $config['num_tag_close']    = '</li>';
        $config['last_tag_open']    = '<li class="paginate_button">';
        $config['last_tag_close']   = '</li>';
        $config['next_tag_open']    = '<li class="paginate_button">';
        $config['next_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li class="paginate_button">';
        $config['first_tag_close']  = '</li>';
        $config['prev_tag_open']    = '<li class="paginate_button">';
        $config['prev_tag_close']   = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["list_berita"] = $this->global_model->search($config["per_page"], $page, 'tbl_berita', $string);

        $data["links"] = $this->pagination->create_links();
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_search', $data, true);
        $this->template->render();
	}
}