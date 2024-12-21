<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privasi extends CI_Controller {

    var $folder ='';

    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend_ptsp');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

    public function index() {
        $data['title']  = "Privasi";
        $data['bahasa'] = $this->session->userdata('bahasa');
        $errMsg         = NULL;

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_privasi', $data, true);
        $this->template->render();
    }
}