<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_ebook extends CI_Controller {
    var $folder='galeri';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
        $this->load->model('galeri/galeri_ebook_model','app_model');
    }

    public function index()
    {
        $data['title']  = "Galeri Ebook";
        $data['bahasa'] = $this->session->userdata('bahasa');
        $data['list_ebook'] = $this->global_model->get_list_array('tbl_galeri_ebook');

        $script = '
            $(document).ready(function() {
                $(".gallerypdf").fancybox({
                    openEffect: \'elastic\',
                    closeEffect: \'elastic\',
                    autoSize: true,
                    type: \'iframe\',
                    iframe: {
                    preload: false
                    }
                });
            });
        ';

        $this->template->add_css('resources/plugins/fancybox/dist/jquery.fancybox.min.css');
        $this->template->add_js('resources/plugins/fancybox/dist/jquery.fancybox.min.js');
        $this->template->add_js($script,'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_galeri_ebook', $data, true);
        $this->template->render();
    }
}