<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alur_pelayanan_rpiit extends CI_Controller {
    var $folder         = 'perizinan';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index()
	{
        $data['title']  = "Alur Pelayanan RPIIT";
        $data['bahasa']   = $this->session->userdata('bahasa');
        $data['file'] = $this->global_model->get_by_id_array('tbl_file_menu', 'id','8');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_alur_pelayanan_rpiit', $data, true);
        $this->template->render();
	}
}