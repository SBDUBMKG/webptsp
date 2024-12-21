<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    var $folder ='';

    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model('frontend/faq_model', 'app_model');
        $this->module = $module;
    }

    public function index() {
        $data['title']  = "FAQ";
        $data['bahasa']   = $this->session->userdata('bahasa');

        $data['list_faq'] = $this->app_model->get_list_faq();
        
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_faq', $data, true);
        $this->template->render();
    }
}