<?php
//filepath :  application\controllers\Registrasi.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

    var $folder ='';

    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model('frontend/registrasi_model', 'app_model');
        $this->module = $module;
    }

    public function index() {
        $data['title']  = "Registrasi";
        $data['bahasa'] = $this->session->userdata('bahasa');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_registrasi', $data, true);
        $this->template->render();
    }

    public function registrasi_perorangan() {
        $data['title']      = translate(43);
        $bahasa             = $this->session->userdata('bahasa');
        $data['bahasa']     = $bahasa;

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

        if($_POST) {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;

            $id_role        = 7;
            $username       = strip_tags($this->input->post('username'));
            $nama           = strip_tags($this->input->post('nama'));
            $pwd            = strip_tags($this->input->post('password'));
            $pwd2           = strip_tags($this->input->post('password2'));
            $password       = strrev(md5($pwd));
            $email          = strip_tags($this->input->post('email'));
            $npwp           = strip_tags($this->input->post('npwp'));
            $no_ktp         = strip_tags($this->input->post('no_ktp'));
            $tempat_lahir   = strip_tags($this->input->post('tempat_lahir'));
            $tanggal_lahir  = strip_tags($this->input->post('tanggal_lahir'));
            $bln            = substr($tanggal_lahir, 0,2);
            $tgl            = substr($tanggal_lahir, 3,2);
            $tahun          = substr($tanggal_lahir, 6,4);
            $tanggal_lahir  = $tahun.'-'.$bln.'-'.$tgl;
            $jenis_kelamin  = strip_tags($this->input->post('jenis_kelamin'));
            $pekerjaan      = strip_tags($this->input->post('pekerjaan'));
            $alamat         = strip_tags($this->input->post('alamat'));
            $kelurahan      = strip_tags($this->input->post('id_kelurahan'));
            $kecamatan      = strip_tags($this->input->post('id_kecamatan'));
            $kabupaten      = strip_tags($this->input->post('id_kabkot'));
            $provinsi       = strip_tags($this->input->post('id_provinsi'));
            $kode_pos       = strip_tags($this->input->post('kode_pos'));
            $no_telepon     = strip_tags($this->input->post('no_telepon'));
            $no_hp          = strip_tags($this->input->post('no_hp'));
            $foto           = null;
            $id_perusahaan  = null;
            $captcha        = $this->input->post('captcha');

            // upload foto
            $this->load->library('upload');
            $this->load->library('image_lib');
            $tmp_name = $_FILES['foto']['tmp_name'];
            if ( !empty($tmp_name) ) {
                $extension_expl = explode('.', $_FILES['foto']['name']);
                $extension = $extension_expl[count($extension_expl)-1];
                $file_name = date("YmdHis");

                $upload_conf = array(
                    'upload_path'       => './upload/profil/',
                    'allowed_types'     => 'gif|jpg|jpeg|png',
                    'max_size'          => '30000',
                    'file_name'         => $file_name.'.'.$extension,
                );
                $this->upload->initialize($upload_conf);

                if ( !$this->upload->do_upload('foto') ) {
                    $simpan = false;
                    $errMsg = $this->upload->display_errors('<li>','</li>');
                } else {
                    $upload_data = $this->upload->data();
                    $size = getimagesize($upload_data['full_path']);
                    $maxWidth = 306;
                    $maxHeight = 306;
                    if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                        $resize_real = array(
                        'source_image'  => $upload_data['full_path'], 
                        'width'         => 306,
                        );
                        $this->image_lib->initialize($resize_real);
                        if ( ! $this->image_lib->resize()){
                            $errMsg = $this->image_lib->display_errors('<li>','</li>');
                        }
                        else{
                            $errMsg = $upload_data;
                        }
                    }
                    $foto = $upload_conf['file_name'];
                }
            }

            $data_insert    = array();
            $simpan         = true;

            // cek username
            $c_username = $this->cek_username($username);
            $c_username = count($c_username);
            if($c_username > 0){
                $simpan = false;
                $this->session->set_flashdata('errMsg', 'Username sudah digunakan!');                
            }

            // cek password
            if($pwd != $pwd2) {
                $simpan = false;
                $this->session->set_flashdata('errMsg', 'Konfirmasi password tidak sama!');
            }

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
                    'img_width'     => 150,
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
                    'id_role'       => $id_role,
                    'username'      => $username,
                    'nama'          => $nama,
                    'password'      => $password,
                    'email'         => $email,
                    'npwp'          => $npwp,
                    'no_ktp'        => $no_ktp,
                    'tempat_lahir'  => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'jenis_kelamin' => $jenis_kelamin,
                    'pekerjaan'     => $pekerjaan,
                    'alamat'        => $alamat,
                    'id_kelurahan'  => $kelurahan,
                    'id_kecamatan'  => $kecamatan,
                    'id_kabupaten'  => $kabupaten,
                    'id_provinsi'   => $provinsi,
                    'kode_pos'      => $kode_pos,
                    'no_telepon'    => $no_telepon,
                    'no_hp'         => $no_hp,
                    'foto'          => $foto,
                    'id_perusahaan' => $id_perusahaan,
                );
                $insert = $this->app_model->insert_data($data_insert);

                if($insert) {
                    $this->session->set_flashdata('sucMsg', 'Pendaftaran Berhasil!');
                } 
                else {
                    $this->session->set_flashdata('errMsg', 'Pendaftaran Gagal!');
                }
                redirect(base_url().'backend/login');
            }
        }
        else {
            $this->session->set_userdata('mycaptcha', $cap['word']);
        }

        $this->template->add_css('resources/plugins/datepicker/datepicker3.css');
        $this->template->add_js('resources/plugins/datepicker/bootstrap-datepicker.js');

        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_registrasi_perorangan', $data, true);
        $this->template->render();
    }

    public function registrasi_perusahaan() {
        $data['title']      = translate(44);
        $data['bahasa']     = $this->session->userdata('bahasa');
        $data['provinsi']   = $this->app_model->get_list_provinsi();

        $script = "";

        $vals = [
            'word'          => random_word(5, false, true, true),
            'img_path'      => './captcha/',
            'img_url'       => site_url('captcha'),
            'font_path'     => './system/fonts/texb.ttf',
            'img_width'     => 200,
            'img_height'    => 40,
            'expiration'    => 600,
            'word_length'   => 5,
            'font_size'     => 16,
            'colors'        => [
                'background'    => array(200, 200, 200),
                'border'        => array(0, 0, 0),
                'text'          => array(0, 0, 0),
                'grid'          => array(255, 255, 20)
            ]
        ];
        $cap = create_captcha($vals);
        $data['captcha_image'] = $cap['image'];

        if($_POST) {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;

            // NPWP
            $npwp           = strip_tags($this->input->post('npwp'));
            
            // tbl_admin
            $id_role        = 7;
            $username       = strip_tags($this->input->post('username'));
            $nama           = strip_tags($this->input->post('nama'));
            $pwd            = strip_tags($this->input->post('password'));
            $pwd2           = strip_tags($this->input->post('password2'));
            $password       = strrev(md5($pwd));
            $email          = strip_tags($this->input->post('email'));
            $no_ktp         = strip_tags($this->input->post('no_ktp'));
            $tempat_lahir   = strip_tags($this->input->post('tempat_lahir'));
            $tanggal_lahir  = strip_tags($this->input->post('tanggal_lahir'));
            $bln            = substr($tanggal_lahir, 0,2);
            $tgl            = substr($tanggal_lahir, 3,2);
            $tahun          = substr($tanggal_lahir, 6,4);
            $tanggal_lahir  = $tahun.'-'.$bln.'-'.$tgl;
            $jenis_kelamin  = strip_tags($this->input->post('jenis_kelamin'));
            $pekerjaan      = strip_tags($this->input->post('pekerjaan'));
            $alamat         = strip_tags($this->input->post('alamat'));
            $kelurahan      = strip_tags($this->input->post('id_kelurahan'));
            $kecamatan      = strip_tags($this->input->post('id_kecamatan'));
            $kabupaten      = strip_tags($this->input->post('id_kabkot'));
            $provinsi       = strip_tags($this->input->post('id_provinsi'));
            $kode_pos       = strip_tags($this->input->post('kode_pos'));
            $no_telepon     = strip_tags($this->input->post('no_telepon'));
            $no_hp          = strip_tags($this->input->post('no_hp'));

            // tbl_perusahaan
            $nama_perusahaan        = strip_tags($this->input->post('nama_perusahaan'));
            $alamat_perusahaan      = strip_tags($this->input->post('alamat_perusahaan'));
            $kelurahan_perusahaan   = strip_tags($this->input->post('kelurahan_perusahaan'));
            $kecamatan_perusahaan   = strip_tags($this->input->post('kecamatan_perusahaan'));
            $kabupaten_perusahaan   = strip_tags($this->input->post('kabupaten_perusahaan'));
            $provinsi_perusahaan    = strip_tags($this->input->post('provinsi_perusahaan'));
            $kode_pos_perusahaan    = strip_tags($this->input->post('kode_pos_perusahaan'));
            $no_telepon_perusahaan  = strip_tags($this->input->post('no_telepon_perusahaan'));
            $fax                    = strip_tags($this->input->post('fax'));
            $email_perusahaan       = strip_tags($this->input->post('email_perusahaan'));

            // upload foto
            $this->load->library('upload');
            $this->load->library('image_lib');
            $tmp_name = $_FILES['foto']['tmp_name'];
            if ( !empty($tmp_name) ) {
                $extension_expl = explode('.', $_FILES['foto']['name']);
                $extension = $extension_expl[count($extension_expl)-1];
                $file_name = date("YmdHis");

                $upload_conf = array(
                    'upload_path'       => './upload/profil/',
                    'allowed_types'     => 'gif|jpg|jpeg|png',
                    'max_size'          => '30000',
                    'file_name'         => $file_name.'.'.$extension,
                );
                $this->upload->initialize($upload_conf);

                if ( !$this->upload->do_upload('foto') ) {
                    $simpan = false;
                    $errMsg = $this->upload->display_errors('<li>','</li>');
                } else {
                    $upload_data = $this->upload->data();
                    $size = getimagesize($upload_data['full_path']);
                    $maxWidth = 306;
                    $maxHeight = 306;
                    if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                        $resize_real = array(
                        'source_image'  => $upload_data['full_path'], 
                        'width'         => 306,
                        );
                        $this->image_lib->initialize($resize_real);
                        if ( ! $this->image_lib->resize()){
                            $errMsg = $this->image_lib->display_errors('<li>','</li>');
                        }
                        else{
                            $errMsg = $upload_data;
                        }
                    }
                    $foto = $upload_conf['file_name'];
                }
            }

            $data_insert    = array();
            $simpan         = true;

            // cek username
            $c_username = $this->cek_username($username);
            $c_username = count($c_username);
            if($c_username > 0){
                $simpan = false;
                $this->session->set_flashdata('errMsg', 'Username sudah digunakan!');                
            }

            // cek password
            if($pwd != $pwd2) {
                $simpan = false;
                $this->session->set_flashdata('errMsg', 'Konfirmasi password tidak sama!');
            }

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
                // insert tbl_perusahaan
                $data_insert = array(
                    'nama'          => $nama_perusahaan,
                    'alamat'        => $alamat_perusahaan,
                    'id_kelurahan'  => $kelurahan_perusahaan,
                    'id_kecamatan'  => $kecamatan_perusahaan,
                    'id_kabupaten'  => $kabupaten_perusahaan,
                    'id_provinsi'   => $provinsi_perusahaan,
                    'kode_pos'      => $kode_pos_perusahaan,
                    'no_telepon'    => $no_telepon_perusahaan,
                    'fax'           => $fax,
                    'email'         => $email_perusahaan,
                );
                $insert_perusahaan = $this->app_model->insert_data_perusahaan($data_insert);

                $id_perusahaan = $insert_perusahaan;

                // insert tbl_admin
                $data_insert = array(
                    'id_role'       => $id_role,
                    'username'      => $username,
                    'nama'          => $nama,
                    'password'      => $password,
                    'email'         => $email,
                    'npwp'          => $npwp,
                    'no_ktp'        => $no_ktp,
                    'tempat_lahir'  => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'jenis_kelamin' => $jenis_kelamin,
                    'pekerjaan'     => $pekerjaan,
                    'alamat'        => $alamat,
                    'id_kelurahan'  => $kelurahan,
                    'id_kecamatan'  => $kecamatan,
                    'id_kabupaten'  => $kabupaten,
                    'id_provinsi'   => $provinsi,
                    'kode_pos'      => $kode_pos,
                    'no_telepon'    => $no_telepon,
                    'no_hp'         => $no_hp,
                    'foto'          => $foto,
                    'id_perusahaan' => $id_perusahaan,
                );
                $insert_admin = $this->app_model->insert_data($data_insert);

                if ($insert_admin && $insert_perusahaan) {
                    $this->session->set_flashdata('sucMsg', 'Pendaftaran Berhasil!');
                } 
                else {
                    $this->session->set_flashdata('errMsg', 'Pendaftaran Gagal!');
                }
                redirect(base_url().'registrasi/registrasi_perusahaan');
            }
        }
        else {
            $this->session->set_userdata('mycaptcha', $cap['word']);
        }

        $this->template->add_css('resources/plugins/datepicker/datepicker3.css');
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');

        $this->template->add_js('resources/plugins/datepicker/bootstrap-datepicker.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js($script,'embed');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_registrasi_perusahaan', $data, true);
        $this->template->render();
    }

    public function validasi_captcha($current_captcha) {
        $captcha  = $this->input->post('captcha');
        if($captcha != $current_captcha) {
            return false;
        }
        else {
            return true;
        }
    }

    public function cek_username($username) {
        $this->db->from('tbl_admin');
        $this->db->where('username', $username);
        $query = $this->db->get();
        if ( is_object($query) ) {
            $result = $query->result_array();
            return $result;
        }
        return array();
    }
}