<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */

class Chat extends MY_Controller {
    var $page_title       = 'Chat';
    var $folder           = 'backend/chat';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'chat_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index(){
        $module =$this->module;
        
        $data['title'] = $this->page_title;

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->folder.'/chat', $data, true);
        $this->template->render();
    }
}
