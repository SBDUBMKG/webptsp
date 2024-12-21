<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller 
{
 	var $folder         = '';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    } 

 public function index() 
 { 
    $this->output->set_status_header('404'); 
    $data['title']  = "Error Page";
    $data['bahasa']   = $this->session->userdata('bahasa');

    $this->template->write('title', $data['title']);
    $this->template->write_view('content', 'v_404', $data, true);
    $this->template->render();
 } 
} 