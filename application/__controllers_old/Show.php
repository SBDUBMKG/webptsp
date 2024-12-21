<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller {
	var $folder         = '';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('berita/minerba_model');
        $this->load->model('frontend/agenda_model');
        $this->load->model('galeri/galeri_foto_model');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

    public function show_pdf()
    {
        $file_menu = $this->input->get('link_file');
        $data['file'] = $this->global_model->get_by_id_array('tbl_file_menu', 'id', $file_menu);

        $data['title']  = $data['file']['nama_file'];
        $data['bahasa'] = $this->session->userdata('bahasa');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_show_pdf', $data, true);
        $this->template->render();
    }

    public function show_halaman()
    {
        $halaman = $this->input->get('halaman');
        $data['halaman'] = $this->global_model->get_by_id_array('tbl_halaman_menu', 'id', $halaman);

        $data['title']  = $data['halaman']['nama_halaman'];
        $data['bahasa'] = $this->session->userdata('bahasa');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_show_halaman', $data, true);
        $this->template->render();
    }
}