<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ptsp extends CI_Controller {

    var $folder = 'berita';

    function __construct(){

        parent::__construct();

        // $this->template->set_template('frontend');
        $this->template->set_template('frontend_ptsp');

        $this->load->model('global_model');

        $this->load->model('berita/minerba_model','app_model');

        $module = $this->folder.'/'.$this->router->fetch_class();

        $this->module = $module;

    }



	public function index() {

        $data['title']  = "Berita";

        $data['bahasa']   = $this->session->userdata('bahasa');

        if($_POST){

            $bahasa = $this->session->userdata('bahasa');

            $search = strip_tags($this->input->post('search'));

            

            if($bahasa == '_en'){

                $where = "judul_en LIKE '%$search%' OR isi_en LIKE '%$search%'";

            }else{

                $where = "judul LIKE '%$search%' OR isi LIKE '%$search%'";

            }



            //paging berita

            $config = array();

            $config["base_url"]     = base_url().$this->module.'/index';

            $config["total_rows"]   = $this->app_model->record_count($where);

            $config["per_page"]     = 12;

            $config["uri_segment"]  = 4;

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



            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data["list_berita"] = $this->app_model->fetch_berita($config["per_page"], $page, $where);

            $data["links"] = $this->pagination->create_links();
        }else{

            //paging berita

            $config = array();

            $config["base_url"] = base_url().$this->module.'/index';

            $config["total_rows"] = $this->app_model->record_count();

            $config["per_page"] = 5;

            $config["uri_segment"] = 4;
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



            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data["list_berita"] = $this->app_model->fetch_berita($config["per_page"], $page);

            $data["links"] = $this->pagination->create_links();
        }

        $this->template->write('title', $data['title']);

        $this->template->write_view('content', $this->module.'/v_berita', $data, true);

        $this->template->render();

	}

    public function detil($id) {

        $data['title'] = "Detil Berita";

        $data['bahasa']   = $this->session->userdata('bahasa');

        $data['detil_berita'] = $this->app_model->detil_berita($id);

        if(!isset($_SESSION['populer'])) {

            $_SESSION['populer'] = array();

        }

        if(!in_array($id, $_SESSION['populer'])){

            $this->load->model('global_model');

            $data_update = array(

                    'is_read' => $data['detil_berita']['is_read']+1

                );

            $this->global_model->update_data('tbl_berita','id',$id,$data_update);

            array_push($_SESSION['populer'] , $id);
        }    

        $this->template->write('title', $data['title']);

        $this->template->write_view('content', $this->module.'/v_detil_berita', $data, true);

        $this->template->render();
    }

}