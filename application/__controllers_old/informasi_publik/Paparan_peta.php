<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paparan_peta extends CI_Controller {

    var $folder = 'informasi_publik';
    var $module = '';

    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'paparan_peta_model', 'app_model');
        $this->module = $module;
    }

	public function index()
	{
        $this->load->model('global_model');

        $data['title']  = "Paparan Peta";
        $data['bahasa'] = $this->session->userdata('bahasa');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_paparan_peta', $data, true);
        $this->template->render();
	}
}