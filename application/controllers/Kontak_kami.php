<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_kami extends CI_Controller {

    var $folder ='';

    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend_ptsp');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model('frontend/kontak_kami_model', 'app_model');
        $this->module = $module;
    }

    public function index() {
        $data['title']  = "Kontak Kami";
        $data['bahasa'] = $this->session->userdata('bahasa');

        $kontak              = $this->app_model->get_list_kontak();
        $data['list_kontak'] = $kontak;
        $errMsg              = NULL;

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_kontak_kami', $data, true);
        $this->template->render();
    }
}