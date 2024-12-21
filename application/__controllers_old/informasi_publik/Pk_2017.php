<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pk_2017 extends CI_Controller {
    var $folder         = 'informasi_publik';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index()
	{
        $data['title']  = "Perjanjian Kinerja 2017";
        $data['bahasa']   = $this->session->userdata('bahasa');
        $data['file'] = $this->global_model->get_by_id_array('tbl_file_menu', 'id','18');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->folder.'/perjanjian_kinerja/v_perjanjian_kinerja', $data, true);
        $this->template->render();
	}
}