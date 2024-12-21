<?php
//filepath: application\controllers\backend\edit_profil\Edit_profil.php
defined('BASEPATH') OR exit('No direct script access allowed');


class Edit_profil extends MY_Controller {
    var $page_title       = 'Edit Profil';
    var $folder           = 'backend/edit_profil';
    var $module           = '';

    function __construct() {
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'edit_profil_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    function index() {
        $id = $this->session->userdata('id_admin');
        $curr_lang = $this->session->userdata('language');
        $this->lang->load('backend/profile/edit', $curr_lang);
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail'] = $this->app_model->get_by_id($id);


        if ( !$data['detail'] ) {
            show_404();
            return;
        }
        $id_perusahaan  = $data['detail']['id_perusahaan'];
        $data['detail_perusahaan'] = $this->app_model->get_perusahaan_by_id($id_perusahaan);
        $data['title'] = $this->page_title;
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";

        $errMsg = NULL;

        if($_POST) {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;
            $simpan         = true;

            $this->valid_form('edit');
            $check_username = $this->app_model->check_username_exists($data_post['username'], $id);

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            } else if ( $check_username ) {
                $simpan = false;
                $errMsg = 'Username '.$data_post['username'].' tidak tersedia.';
            } else if ( !empty($data_post['password']) && $data_post['password'] != $data_post['r_password'] ) {
                $errMsg = $this->lang->line('form.msg.error.password');
                $simpan = false;
            }

            if ( $simpan ) {
            // upload foto

            $foto = '';
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

            // baris awal penambahan kolom foto ktp (Nurhayati Rahayu 07/02/2023)
            // upload foto ktp

            $foto_ktp = '';
            $this->load->library('upload');
            $this->load->library('image_lib');
            $tmp_name = $_FILES['foto_ktp']['tmp_name'];
            if ( !empty($tmp_name) ) {
                $extension_expl = explode('.', $_FILES['foto_ktp']['name']);
                $extension = $extension_expl[count($extension_expl)-1];
                $file_name = date("YmdHis");

                $upload_conf = array(
                    'upload_path'       => './upload/profil/foto_identitas/',
                    'allowed_types'     => 'gif|jpg|jpeg|png',
                    'max_size'          => '30000',
                    'file_name'         => $file_name.'.'.$extension,
                );
                $this->upload->initialize($upload_conf);

                if ( !$this->upload->do_upload('foto_ktp') ) {
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
                    $foto_ktp = $upload_conf['file_name'];
                }
            }
            // baris akhir penambahan kolom foto ktp (Nurhayati Rahayu 07/02/2023)

		// tanggal lahir
                $tahun          = substr($this->input->post('tanggal_lahir'), 6, 4);
                $bulan          = substr($this->input->post('tanggal_lahir'), 0, 2);
                $tanggal        = substr($this->input->post('tanggal_lahir'), 3, 2);
                $tanggal_lahir  = $tahun.'-'.$bulan.'-'.$tanggal;

                $data_update = array(
                    'username'      => strip_tags($this->input->post('username')),
                    'nama'          => strip_tags($this->input->post('nama')),
                    'email'         => strip_tags($this->input->post('email')),
                    'npwp'          => strip_tags($this->input->post('npwp')),
                    'no_ktp'        => strip_tags($this->input->post('no_ktp')),
                    'tempat_lahir'  => strip_tags($this->input->post('tempat_lahir')),
                    'tanggal_lahir' => $tanggal_lahir,
                    'jenis_kelamin' => strip_tags($this->input->post('jenis_kelamin')),
                    'pekerjaan'     => strip_tags($this->input->post('pekerjaan')),
                    'id_pendidikan' => strip_tags($this->input->post('id_pendidikan')), // Script yang ditambahkan Rahmat, 10 Agustus 2020
                    'alamat'        => strip_tags($this->input->post('alamat')),
                    'id_kelurahan'  => strip_tags($this->input->post('id_kelurahan')),
                    'id_kecamatan'  => strip_tags($this->input->post('id_kecamatan')),
                    'id_kabupaten'  => strip_tags($this->input->post('id_kabupaten')),
                    'id_provinsi'   => strip_tags($this->input->post('id_provinsi')), // Script yang ditambahkan Rahmat, 29/07/2020
                    'kode_pos'      => strip_tags($this->input->post('kode_pos')),
                    'no_telepon'    => strip_tags($this->input->post('no_telepon')),
                    'no_hp'         => strip_tags($this->input->post('no_hp')),
                );

                if ( !empty($data_post['password']) ) {
                    $data_update['password'] = strip_tags(strrev(md5($this->input->post('password'))));
                }
                if(!empty($foto)){
                    $data_update['foto'] = $foto;
                }

                if(!empty($foto_ktp)){
                    $data_update['foto_ktp'] = $foto_ktp;
                }

                $update = $this->app_model->update_data($id, $data_update);

                if($id_perusahaan != NULL){
                    $data_update_perusahaan = array(
			// Baris awal perbaikan
			// Mengubah nama kolom 'nama' menjadi 'perusahaan'
			// 'nama'    => strip_tags($this->input->post('nama_perusahaan')),
                        'perusahaan'    => strip_tags($this->input->post('nama_perusahaan')),
			// baris terakhir perbaikan
			// Perbaikan oleh : Nurhayati Rahayu (09/07/2020)
                        'alamat'        => strip_tags($this->input->post('alamat_perusahaan')),
                        'id_provinsi'   => strip_tags($this->input->post('provinsi_perusahaan')),
                        'id_kabupaten'  => strip_tags($this->input->post('kabupaten_perusahaan')),
                        'id_kecamatan'  => strip_tags($this->input->post('kecamatan_perusahaan')),
                        'id_kelurahan'  => strip_tags($this->input->post('kelurahan_perusahaan')),
                        'kode_pos'      => strip_tags($this->input->post('kode_pos_perusahaan')),
                        'no_telepon'    => strip_tags($this->input->post('no_telepon_perusahaan')),
                        'fax'           => strip_tags($this->input->post('fax')),
                        'email'         => strip_tags($this->input->post('email_perusahaan')),
                    );
                    $update_perusahaan = $this->app_model->update_data_perusahaan($id_perusahaan, $data_update_perusahaan);
                }
                // script akhir yang diedit Rahmat 14 Oktober 2019

                if ( $update) {
                    insert_log('Edit user <em>'.$data_update['username'].(empty($data_update['nama']) ? NULL : ' ('.$data_update['nama'].')').'</em>');
                    $this->session->set_flashdata('sucMsg', $this->lang->line('form.msg.success'));
                    redirect(base_url().'backend/edit_profil/edit_profil');
                } else {
                    $errMsg = $this->lang->line('form.msg.error');
                }
            }
        }

        $data['id'] = $id;
        $data['id_perusahaan'] = $id_perusahaan;
        $data['page_title'] = $this->page_title;
        $data['errMsg'] = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', $this->lang->line('title.page'));
        $this->template->write_view('content', $this->folder.'/edit_profil/form', $data, true);
        $this->template->render();
    }

    private function valid_form($act = 'add') {
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'username',
                        'label' => 'Username',
                        'rules' => 'required|max_length[60]'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'max_length[100]|valid_email'
                    ),
                    array(
                        'field' => 'nama',
                        'label' => 'Nama',
                        'rules' => 'max_length[255]'
                    )
                );

        if ( $act == 'add' ) {
            $config[] = array(
                            'field' => 'password',
                            'label' => 'Password',
                            'rules' => 'required|max_length[255]'
                        );
            $config[] = array(
                            'field' => 'r_password',
                            'label' => 'Ulangi Password',
                            'rules' => 'required|max_length[255]|matches[password]'
                        );
        } else if ( $act == 'edit' ) {
            $config[] = array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'max_length[255]'
            );
            $config[] = array(
                'field' => 'r_password',
                'label' => 'Ulangi Password',
                'rules' => 'max_length[255]|matches[password]'
            );
        }
        $this->form_validation->set_rules($config);
    }

    function check_username() {
        $id_admin = $this->input->get('iuser');
        $username = $this->input->get('uname');

        $check_usermame = $this->app_model->check_username_exists($username, $id_admin);
        if ( $check_usermame )
            echo '1';
        else
            echo '0';
    }
}
