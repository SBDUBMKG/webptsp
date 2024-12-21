<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {
    var $folder ='';
    function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('id_role'))){
            redirect(base_url().'backend/login');
        }
        else if($this->session->userdata('id_role') != 7){
            redirect(base_url());
        }
        
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model('frontend/pengaduan_model', 'app_model');
        $this->module = $module;
    }

    public function index() {
        $this->load->helper('captcha');
        $vals = array(
            'word'          => random_word(5, false, true,true),
            'img_path'      => './captcha/',
            'img_url'       => base_url().'captcha/',
            'font_path'     => './system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 33,
            'expiration'    => 7200,
            'word_length'   => 5,
            'font_size'     => 16,
            'colors'        => array(
                                'background' => array(200, 200, 200),
                                'border' => array(0, 0, 0),
                                'text' => array(0, 0, 0),
                                'grid' => array(255, 255, 20)
                               )
        );

        $cap = create_captcha($vals);
        $err = $this->session->flashdata('login_message');

        $data = array(
            'captcha_image' => $cap['image'],
            'err'           => $err
        );

        $data['title']  = "Pengaduan";
        $data['bahasa'] = $this->session->userdata('bahasa');

        $total_pengaduan = $this->app_model->get_total_pengaduan();
        $pengaduan       = $this->app_model->get_list_pengaduan();
        $response        = $this->app_model->get_list_response();

        $data['total_pengaduan'] = $total_pengaduan;
        $data['list_pengaduan']  = $pengaduan;
        $data['list_response']   = $response;

        $errMsg = NULL;

        if($_POST) {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;

            $id_admin  = $this->session->userdata('id_admin');
            $nama      = strip_tags($this->input->post('nama'));
            $email     = strip_tags($this->input->post('email'));
            $pengaduan = strip_tags($this->input->post('pengaduan'));

            $data_insert    = array();
            $simpan         = true;

            // cek captcha
            $current_captcha = $this->session->userdata('mycaptcha');
            $val_capt = $this->validasi_captcha($current_captcha);
            if($val_capt == false) {
                $simpan = false;
                $this->session->set_flashdata('errMsg', 'Captcha tidak sesuai!');
        
                $vals = array(
                    'word'          => random_word(5, false, true,true),
                    'img_path'      => './captcha/',
                    'img_url'       => base_url().'captcha/',
                    'font_path'     => './system/fonts/texb.ttf',
                    'img_width'     => '150',
                    'img_height'    => 33,
                    'expiration'    => 7200,
                    'word_length'   => 5,
                    'font_size'     => 16,
                    'colors'        => array(
                                        'background' => array(200, 200, 200),
                                        'border' => array(0, 0, 0),
                                        'text' => array(0, 0, 0),
                                        'grid' => array(255, 255, 20)
                                       )
                );
                $cap = create_captcha($vals);
                $data['captcha_image'] = $cap['image'];
                $this->session->set_userdata('mycaptcha', $cap['word']);
            }

            if($simpan){
                $data_insert = array(
                    'id_admin'        => $id_admin,
                    'nama'            => $nama,
                    'email'           => $email,
                    'pengaduan'       => $pengaduan,
                    'waktu_pengaduan' => date('Y-m-d H:i:s'),
                );
                $insert = $this->app_model->insert_data( $data_insert);

                if ( $insert ) 
                {
                   $this->session->set_flashdata('sucMsg', 'Pesan anda telah dikirim..');
                } 
                else 
                {
                   $this->session->set_flashdata('errMsg', 'Pesan gagal dikirim!');
                }
                redirect(base_url().'pengaduan');
            }
        }
        else {
            $this->session->set_userdata('mycaptcha', $cap['word']);
        }

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_pengaduan', $data, true);
        $this->template->render();
    }

    public function validasi_captcha($current_captcha) {
        $captcha  = $this->input->post('captcha');

        if($captcha != $current_captcha) {
            return false;
        }
        else{
            return true;
        }
    }
}