<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Artikel extends CI_Controller {

    var $folder         = 'berita';

    function __construct(){

        parent::__construct();

        $this->template->set_template('frontend');

        $this->load->model('global_model');

        $this->load->model('berita/artikel_model','app_model');

        $module = $this->folder.'/'.$this->router->fetch_class();

        $this->module = $module;

    }



	public function index()

	{

        $data['title']  = "Artikel";

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

            $config["base_url"] = base_url() .$this->module.'/index';

            $config["total_rows"] = $this->app_model->record_count($where);

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

            $data["list"] = $this->app_model->fetch($config["per_page"], $page, $where);

            $data["links"] = $this->pagination->create_links();

        }else{

            //paging berita

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

            $data["list"] = $this->app_model->fetch($config["per_page"], $page);

            $data["links"] = $this->pagination->create_links();

        }



        $this->template->write('title', $data['title']);

        $this->template->write_view('content', $this->module.'/v_artikel', $data, true);

        $this->template->render();

	}



    public function detil($id)

    {

        $data['title'] = "Detil Artikel";

        $data['bahasa']   = $this->session->userdata('bahasa');



        $data['detil'] = $this->app_model->detil($id);



        if(!isset($_SESSION['populer'])){

            $_SESSION['populer']           = array();

        }

        if(!in_array($id, $_SESSION['populer'])){

            $this->load->model('global_model');

            $data_update = array(

                    'is_read' => $data['detil']['is_read']+1

                );

            $this->global_model->update_data('tbl_berita','id',$id,$data_update);

            array_push($_SESSION['populer'] , $id);

       }    



        $this->template->write('title', $data['title']);

        $this->template->write_view('content', $this->module.'/v_detil_artikel', $data, true);

        $this->template->render();

    }

}