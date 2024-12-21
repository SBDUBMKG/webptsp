<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    var $folder ='';

    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend_ptsp');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model('frontend/faq_model', 'app_model');
        $this->module = $module;
    }

    public function index() {
        $data['title']  = "FAQ";
        $data['bahasa']   = $this->session->userdata('bahasa');
        $script = <<<EOD
$(document).ready(function () {
    //toggle the component with class accordion_body
    $(".accordion_head").click(function () {
        if ($('.accordion_body').is(':visible')) {
            $(".accordion_body").slideUp(300);
            $(".plusminus").text('+');
        }
        if ($(this).next(".accordion_body").is(':visible')) {
            $(this).next(".accordion_body").slideUp(300);
            $(this).children(".plusminus").text('+');
        } else {
            $(this).next(".accordion_body").slideDown(300);
            $(this).children(".plusminus").text('-');
        }
    });
});
EOD;

        
        $data['list_faq'] = $this->app_model->get_list_faq();
                $this->template->add_js($script,'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_faq', $data, true);
        $this->template->render();
    }
}