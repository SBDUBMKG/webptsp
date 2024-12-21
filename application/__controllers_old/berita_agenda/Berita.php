<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('frontend/berita_model');
    }

	public function index()
	{
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
            $config["base_url"] = base_url() . "berita_agenda/berita/index";
            $config["total_rows"] = $this->berita_model->record_count($where);
            $config["per_page"] = 5;
            $config["uri_segment"] = 4;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data["list_berita"] = $this->berita_model->fetch_berita($config["per_page"], $page, $where);
            $data["links"] = $this->pagination->create_links();
        }else{
            //paging berita
            $config = array();
            $config["base_url"] = base_url() . "berita_agenda/berita/index";
            $config["total_rows"] = $this->berita_model->record_count();
            $config["per_page"] = 5;
            $config["uri_segment"] = 4;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data["list_berita"] = $this->berita_model->fetch_berita($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
        }

        $row['content'] = $this->load->view('berita_agenda/v_berita', $data, TRUE);
        $this->load->view('template', $row);
	}

    public function detil_berita($id)
    {
        $data['title'] = "Detil Berita";
        $data['bahasa']   = $this->session->userdata('bahasa');

        $data['detil_berita'] = $this->berita_model->detil_berita($id);

        if(!isset($_SESSION['populer'])){
            $_SESSION['populer']           = array();
        }
        if(!in_array($id, $_SESSION['populer'])){
            $this->load->model('global_model');
            $data_update = array(
                    'is_read' => $data['detil_berita']['is_read']+1
                );
            $this->global_model->update_data('tbl_berita','id',$id,$data_update);
            array_push($_SESSION['populer'] , $id);
       }    

        $row['content'] = $this->load->view('berita_agenda/v_detil_berita', $data, TRUE);
        $this->load->view('template', $row);
    }
}