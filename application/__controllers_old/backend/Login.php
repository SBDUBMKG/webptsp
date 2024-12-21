<?php
//file: application\controllers\backend\Login.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model(['backend/login_model', 'global_model']);
    $this->load->helper(['form', 'url', 'captcha']);
    $this->load->library(['session', 'form_validation']);
	}

	public function index() {
    $username = $this->session->userdata('username');
    $id_role = $this->session->userdata('id_role');
    $vals = [
      'word'          => random_word(5, false, true,true),
      'img_path'      => './captcha/',
      'img_url'       => base_url().'captcha/',
      'font_path'     => './system/fonts/texb.ttf',
      'img_width'     => '150',
      'img_height'    => 33,
      'expiration'    => 7200,
      'word_length'   => 5,
      'font_size'     => 16,
      'colors'        => [
        'background' => array(200, 200, 200),
        'border' => array(0, 0, 0),
        'text' => array(0, 0, 0),
        'grid' => array(255, 255, 20)
        ]
    ];

    $cap = create_captcha($vals);
    $err = $this->session->flashdata('login_message');

    $data = [
      'captcha_image' => $cap['image'],
      'err'           => $err
    ];

		if(!empty($username) && !empty($id_role) ){
      redirect(site_url('backend/home'));
      die();
		}

    if ( $_POST ) {
      $current_captcha = $this->session->userdata('mycaptcha');
      $this->validation($current_captcha);
    } else {
      $this->session->set_userdata('mycaptcha', $cap['word']);
      $this->load->view('backend/login/login_view', $data);
    }
	}

	private function validation($mycaptcha){
    $username = $this->input->post('txt_username');
    $password = $this->input->post('txt_password');
    $captcha  = $this->input->post('txt_captcha');

    $this->form_validation->set_rules('txt_username','username','required');
    $this->form_validation->set_rules('txt_password','password','required');

		if($this->form_validation->run() === FALSE) {
      $msg = "Username atau Password tidak valid";
      $this->session->set_flashdata('login_message', $msg);
      redirect(base_url().'backend/login');
      die();
    } else if ($mycaptcha <> $captcha) {
      $msg = "Kode captcha tidak valid";
      $this->session->set_flashdata('login_message', $msg);
      redirect(base_url().'backend/login');
      die();
    } else {
			$result = $this->login_model->validation($username, $password);
			if($result) {
        $this->session->set_userdata('id_admin', $result->id_admin);
        $this->session->set_userdata('username', $result->username);
        $this->session->set_userdata('nama', $result->nama);
        $this->session->set_userdata('id_role', $result->id_role);
        $this->session->set_userdata('role', $result->role);
        $this->session->set_userdata('is_super_admin', $result->is_super_admin);
        $this->session->set_userdata('email', $result->email);
        $last_page = $this->session->userdata('last_page'); 
        if ( !empty($last_page) ) {
          $this->session->unset_userdata('last_page');
          redirect($last_page);
          die();
        } else {
          if($username == 'admin'){
            redirect(site_url('backend/home'));
          } else
          redirect(site_url('backend/edit_profil/edit_profil'));
          die();
        }
			} else {
        $msg = "Username atau Password tidak valid";
        $this->session->set_flashdata('login_message', $msg);
        redirect(site_url('backend/login'));
        die();
			}
		}
	}

	function logout(){
    $this->session->sess_destroy();
    redirect(base_url());
    die();
	}

  public function cek_login(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $arr_result = array('msg'=>'','url_next'=>'');
    $result = $this->login_model->validation($username, $password);
      if($result) {
        $this->session->set_userdata('id_admin', $result->id_admin);
        $this->session->set_userdata('username', $result->username);
        $this->session->set_userdata('nama', $result->nama);
        $this->session->set_userdata('id_role', $result->id_role);
        $this->session->set_userdata('role', $result->role);
        $this->session->set_userdata('is_super_admin', $result->is_super_admin);
        $this->session->set_userdata('email', $result->email);
        $last_page = $this->session->userdata('last_page'); 

          if($username == 'admin'){
            $arr_result['url_next'] = site_url('backend/home');
          } else
          $arr_result['url_next'] = site_url('backend/edit_profil/edit_profil');

      } else {
        $arr_result['msg'] = 'No';
      

      }
     echo json_encode($arr_result);
  }
}
