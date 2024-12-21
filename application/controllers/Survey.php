<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

    var $folder ='';

    function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('id_role'))){
            redirect(base_url());
        }

        // $this->template->set_template('frontend');
        $this->template->set_template('frontend_ptsp');

        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model('frontend/survey_model', 'app_model');
        $this->module = $module;
    }

    public function index() {
        $err    = $this->session->flashdata('login_message');
        $errMsg = NULL;

        $data['title']                  = "Saran";
        $data['bahasa']                 = $this->session->userdata('bahasa');
        $data['list_kategori_survey']   = $this->global_model->get_list_array('m_kategori_survey');

        if($_POST) {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;

            $nama  = strip_tags($this->input->post('nama'));
            $email = strip_tags($this->input->post('email'));
            $saran = strip_tags($this->input->post('saran'));

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
                    'nama'      => strip_tags($nama),
                    'email'   => strip_tags($email),
                    'saran'   => strip_tags($saran),
                    'waktu_saran' => date('Y-m-d H:i:s'),
                );
                $insert = $this->app_model->insert_data( $data_insert);
                
                if ( $insert ) {
                   $this->session->set_flashdata('sucMsg', 'Pesan anda telah dikirim..');
                } 
                else {
                   $this->session->set_flashdata('errMsg', 'Pesan gagal dikirim!');
                }
                redirect(base_url().'saran');
            }
        }
        else {
            $this->session->set_userdata('mycaptcha', $cap['word']);
        }

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_survey', $data, true);
        $this->template->render();
    }
}