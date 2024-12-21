<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('global_model','app_data');
    }

    public function index(){
        $data['title']  = "Home";
        $data['bahasa']   = $this->session->userdata('bahasa');

        $row['content'] = $this->load->view('v_kontak', $data, TRUE);
        $this->load->view('template', $row);
    }

	// public function index()
	// {
 //        $data['title']  = "Home";
 //        $data['bahasa']   = $this->session->userdata('bahasa');

 //        $msg                   = '';
 //        if($this->session->flashdata('msg')){
 //          $msg = $this->session->flashdata('msg');
 //        }
 //        $data['msg']           = $msg;

 //        $data['nama']  = "";
 //        $data['email']  = "";
 //        $data['tlp']  = "";
 //        $data['pesan']  = "";

 //        $errMsg = NULL;

 //        if($_POST)
 //        {
 //            $icaptcha = strip_tags($this->input->post('captcha'));
 //            $captcha  = $this->session->userdata('kontakcaptcha');
 //            $data['nama']  = strip_tags($this->input->post('nama'));
 //            $data['email'] = strip_tags($this->input->post('email'));
 //            $data['telepon']   = strip_tags($this->input->post('telepon'));
 //            $data['pesan'] = strip_tags($this->input->post('pesan'));

 //            if($icaptcha == $captcha){
 //                $data_insert    = array();
 //                $simpan         = true;
 //                if($simpan){
 //                    $data_insert = array(
 //                        'nama'      => strip_tags($this->input->post('nama')),
 //                        'telepon'   => strip_tags($this->input->post('telepon')),
 //                        'email'     => strip_tags($this->input->post('email')),
 //                        'pesan'     => strip_tags($this->input->post('pesan')),
 //                        'tgl_kirim' => date('Y-m-d H:i:s'),
 //                    );
 //                    $insert = $this->app_data->insert_data('tbl_kontak', $data_insert);
 //                    if ( $insert ) {
 //                       $this->session->set_flashdata('msg', 'Pesan anda telah dikirim..');
 //                    } else {
 //                       $this->session->set_flashdata('msg', 'Pesan gagal dikirim!');
 //                    }
 //                    redirect(base_url().'kontak');
 //                }
 //            }else{
 //                $msg = "Kode captcha tidak valid";
 //                $this->session->set_flashdata('kontak_message', $msg);
 //                // redirect(base_url().'kontak');
 //            }
 //        }

 //        $vals = array(
 //            'word'          => random_word(5, false, true,true),
 //            'img_path'      => './captcha/',
 //            'img_url'       => base_url().'captcha/',
 //            'font_path'     => './system/fonts/texb.ttf',
 //            'img_width'     => '150',
 //            'img_height'    => 33,
 //            'expiration'    => 7200,
 //            'word_length'   => 5,
 //            'font_size'     => 16,
 //            'colors'        => array(
 //                'background' => array(200, 200, 200),
 //                'border' => array(0, 0, 0),
 //                'text' => array(0, 0, 0),
 //                'grid' => array(255, 255, 20)
 //            )
 //        );

 //        $cap = create_captcha($vals);
 //        $err = $this->session->flashdata('kontak_message');
 //        $data['captcha_image'] = $cap['image'];
 //        $data['err'] = $err;
 //        $this->session->set_userdata('kontakcaptcha', $cap['word']);

 //        $row['content'] = $this->load->view('v_kontak', $data, TRUE);
 //        $this->load->view('template', $row);
	// }
}