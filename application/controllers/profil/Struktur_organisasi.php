<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Struktur_organisasi extends CI_Controller {
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
        $data['title']  = "Struktur Organisasi";

        $data['bahasa'] = $this->session->userdata('bahasa');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_struktur_organisasi', $data, true);
        $this->template->render();
	}
}
