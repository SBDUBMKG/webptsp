<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_video extends CI_Controller {
    var $folder ='galeri';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

    public function index()
    {
        $data['title']  = "Galeri Video";
        $data['bahasa'] = $this->session->userdata('bahasa');
        $data['list_video'] = $this->global_model->get_list_array('tbl_video','','id_video');

        $this->template->add_css('resources/plugins/fancybox/dist/jquery.fancybox.min.css');
        $this->template->add_js('resources/plugins/fancybox/dist/jquery.fancybox.min.js');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_galeri_video', $data, true);
        $this->template->render();
    }
}