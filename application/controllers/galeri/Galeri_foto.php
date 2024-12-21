<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_foto extends CI_Controller {
    var $folder ='galeri';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
        $this->load->model('galeri/galeri_foto_model','app_model');
    }

    public function index()
    {
        $data['title']  = "Galeri Foto";
        $data['bahasa'] = $this->session->userdata('bahasa');
        $data['list_foto'] = $this->app_model->list_foto();

        $this->template->add_css('resources/plugins/fancybox/dist/jquery.fancybox.min.css');
        $this->template->add_js('resources/plugins/fancybox/dist/jquery.fancybox.min.js');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_galeri_foto', $data, true);
        $this->template->render();
    }

    public function detil_kegiatan($id)
    {
        $data['title'] = "Detil Kegiatan";
        $data['bahasa']   = $this->session->userdata('bahasa');

        $data['kegiatan'] = $this->app_model->detil_foto($id,'1');
        $data['detil_kegiatan'] = $this->app_model->detil_foto($id);

        $this->template->add_css('resources/plugins/fancybox/dist/jquery.fancybox.min.css');
        $this->template->add_js('resources/plugins/fancybox/dist/jquery.fancybox.min.js');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_detil_galeri_foto', $data, true);
        $this->template->render();
    }
}