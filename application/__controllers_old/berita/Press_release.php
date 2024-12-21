<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Press_release extends CI_Controller {

    var $folder         = 'berita';

    function __construct(){

        parent::__construct();

        $this->template->set_template('frontend');

        $this->load->model('global_model');

        $this->load->model('berita/press_release_model','app_model');

        $module = $this->folder.'/'.$this->router->fetch_class();

        $this->module = $module;

    }



	public function index()

	{

        $data['title']  = "Press Release";

        $data['bahasa'] = $this->session->userdata('bahasa');



        //paging pengumuman

        $config = array();

        $config["base_url"] = base_url().$this->module.'/index';

        $config["total_rows"] = $this->app_model->record_count();

        $config["per_page"] = 5;

        $config["uri_segment"] = 4;

        $config['cur_tag_open'] = '<li class="paginate_button active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="paginate_button">';
        $config['num_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="paginate_button">';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="paginate_button">';
        $config['next_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li class="paginate_button">';
        $config['first_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="paginate_button">';
        $config['prev_tag_close'] = '</li>';        

        $this->pagination->initialize($config);



        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["list_press_release"] = $this->app_model->fetch_press_release($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();



        $this->template->write('title', $data['title']);

        $this->template->write_view('content', $this->module.'/v_press_release', $data, true);

        $this->template->render();

	}



    public function detil($id)

    {

        $data['title'] = "Detil Press Release";

        $data['bahasa'] = $this->session->userdata('bahasa');



        $data['detil_press_release'] = $this->app_model->detil_press_release($id);



        $this->template->write('title', $data['title']);

        $this->template->write_view('content', $this->module.'/v_detil_press_release', $data, true);

        $this->template->render();

    }

}