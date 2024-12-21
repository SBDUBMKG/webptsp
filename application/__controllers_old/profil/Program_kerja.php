<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_kerja extends CI_Controller {
    var $folder         = 'profil';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index()
	{
        $data['title']  = "Program Kerja";
        $data['bahasa'] = $this->session->userdata('bahasa');
        $this->load->model('global_model');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_program_kerja', $data, true);
        $this->template->render();
	}
}
