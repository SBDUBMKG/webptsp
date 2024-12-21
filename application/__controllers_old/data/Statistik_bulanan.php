<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik_bulanan extends CI_Controller {
    var $folder         = 'data';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index()
	{
        $data['title']  = "Statistik Bulanan";
        $data['bahasa']   = $this->session->userdata('bahasa');
        $data['file'] = $this->global_model->get_by_id_array('tbl_file_menu', 'id','9');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_statistik_bulanan', $data, true);
        $this->template->render();
	}
}