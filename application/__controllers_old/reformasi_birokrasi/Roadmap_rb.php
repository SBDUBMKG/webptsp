<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roadmap_rb extends CI_Controller {
    var $folder         = 'reformasi_birokrasi';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index()
	{
        $data['title']  = "Roadmap RB";
        $data['bahasa']   = $this->session->userdata('bahasa');
        $data['file'] = $this->global_model->get_by_id_array('tbl_file_menu', 'id','13');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_roadmap_rb', $data, true);
        $this->template->render();
	}
}