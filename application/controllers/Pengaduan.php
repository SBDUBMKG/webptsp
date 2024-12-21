<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {
    var $folder ='';
    function __construct(){
        parent::__construct();
        // if(empty($this->session->userdata('id_role'))){
        //     redirect(base_url().'backend/login');
        // }
        // else if($this->session->userdata('id_role') != 7){
        //     redirect(base_url());
        // }

        $this->template->set_template('frontend_ptsp');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model('frontend/Pengaduan_model', 'app_model');
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
        $recaptcha_v2 = false;
                if(isset($_SESSION['recaptcha_v2'])){
                  $recaptcha_v2 = $_SESSION['recaptcha_v2'];
                }

        $cap = create_captcha($vals);
        $err = $this->session->flashdata('login_message');

        $data = array(
            // 'captcha_image' => $cap['image'],
            'err'           => $err
        );

        $data['recaptcha_v2'] = $recaptcha_v2;
        $data['title']  = "Pengaduan";
        $data['bahasa'] = $this->session->userdata('bahasa');

        $total_pengaduan = $this->app_model->get_total_pengaduan();
        //pengaduan katanye gak perlu di tampilin 
        //$pengaduan       = $this->app_model->get_list_pengaduan();
        $response        = $this->app_model->get_list_response();

        $data['total_pengaduan'] = $total_pengaduan;
        //pengaduan katanye gak perlu di tampilin
        //$data['list_pengaduan']  = $pengaduan;
        $data['list_response']   = $response;

        $errMsg = NULL;

        if($_POST) {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;

            // $id_admin  = $this->session->userdata('id_admin');
            $id_admin  = isset($_SESSION['id_admin'])?$_SESSION['id_admin']:0;
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

                $lang = $this->session->userdata('bahasa');
                    $msg_berhasil = 'Pengaduan anda berhasil dikirim.. terima kasih';
                    $msg_gagal = 'Pengaduan gagal dikirim!';
                    if($lang == '_en'){
                        $msg_berhasil = 'Your suggestion has been submitted.Thank You';
                        $msg_gagal  = 'Failed to send suggestion.';
                    }

                if ( $insert )
                {
                    $admin_ptsp = $this->global_model->get_by_id('tbl_admin','id_role',3);
                    $to = $admin_ptsp->email;
                    $subject = '[Notif-PTSP] - Pengaduan Baru masuk';
                    $message = $this->load->view('email/_header', '', true);
                    $message .= $this->load->view('email/saran_masuk_admin_ptsp', '', true);
                    $message .= $this->load->view('email/_footer', '', true);
                    send_email($to,$subject,$message);
                    $this->session->set_flashdata('sucMsg', $msg_berhasil);
                }
                else
                {
                   $this->session->set_flashdata('errMsg', $msg_gagal);
                }
                redirect(base_url().'pengaduan');
            }
        }
        else {
            // $this->session->set_userdata('mycaptcha', $cap['word']);
        }

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_pengaduan', $data, true);
        $this->template->render();
    }

    public function validasi_captcha($current_captcha) {
        // $captcha  = $this->input->post('captcha');

        // if($captcha != $current_captcha) {
        //     return false;
        // }
        // else{
        //     return true;
        // }
        if (!$this->cek_recaptcha()) {
            $msg = "Verifikasi Recaptcha gagal";
            $_SESSION['recaptcha_v2'] = true;
            $this->session->set_flashdata('login_message', $msg);
            return false;
            redirect(base_url().'saran');
            die();
        } else {
            return true;
        }
    }

    public function email(){
        send_email('harmaji@gmail.com', 'registrasi_ptsp','selamat datang di aplikasi PTSP, coba kirim html');
    }
    public function cek_recaptcha() {

        if(isset($_SESSION['recaptcha_v2'])){
          $recaptcha_v2 = $_SESSION['recaptcha_v2'];
          if($recaptcha_v2){
            return $this->cek_recapthca_v2();
          }
        }

            $token = $this->input->post('g-recaptcha-response');

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array(
                'secret' => '6Ldg38IpAAAAAAG6dQrc1j8IdW19a_y_yz5zDCHN',
                'response' => $token
            );

            $options = array(
                'http' => array (
                    'method' => 'POST',
                    "header" => "Content-Type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen(http_build_query($data)) . "\r\n",
                    'content' => http_build_query($data)
                )
            );

            $context  = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
            $result = json_decode($response);

            log_message('error', $result->score);

            if (!$result->success || $result->score < 0.9) {
                return false;
            } else {
              return true;
            }
        }
    public function cek_recapthca_v2() {
          $captcha_response = $this->input->post('g-recaptcha-response');
          $url = 'https://www.google.com/recaptcha/api/siteverify';
          $data = array(
              'secret' => '6Lc2RcopAAAAAHjC5Cau6t3MABZa8oR_iDqlD1Fx',
              'response' => $captcha_response
          );

          $options = array(
              'http' => array (
                  'method' => 'POST',
                  "header"=>"Content-Type: application/x-www-form-urlencoded\r\n" .
                        "Content-Length: ".strlen(http_build_query($data))."\r\n",
                  'content' => http_build_query($data)
              )
          );

          $context  = stream_context_create($options);
          $response = file_get_contents($url, false, $context);
          $result = json_decode($response);

          if (!$result->success) {
              //echo "reCAPTCHA verification failed";
              return false;
          } else {
            return true;
          }
      }
}
