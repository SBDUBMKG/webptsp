<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */

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
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail'] = $this->app_model->get_by_id($id);
        $id_perusahaan  = $data['detail']['id_perusahaan'];
        $data['detail_perusahaan'] = $this->app_model->get_perusahaan_by_id($id_perusahaan);

        if ( !$data['detail'] ) {
            show_404();
            return;
        }

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
                $errMsg = '<ul><li>Pengulangan Password Tidak Valid!</li></ul>';
                $simpan = false;
            }

            if ( $simpan ) {
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
                    'alamat'        => strip_tags($this->input->post('alamat')),
                    'id_kelurahan'     => strip_tags($this->input->post('id_kelurahan')),
                    'id_kecamatan'     => strip_tags($this->input->post('id_kecamatan')),
                    'id_kabupaten'     => strip_tags($this->input->post('id_kabupaten')),
		    'id_provinsi'     => strip_tags($this->input->post('id_provinsi')), 	
                    'kode_pos'      => strip_tags($this->input->post('kode_pos')),
                    'no_telepon'    => strip_tags($this->input->post('no_telepon')),
                    'no_hp'         => strip_tags($this->input->post('no_hp')),
                );
// var_dump($data_update);exit();

                if ( !empty($data_post['password']) ) {
                    $data_update['password'] = strip_tags(strrev(md5($this->input->post('password'))));
                }

                $update = $this->app_model->update_data($id, $data_update);

                if($id_perusahaan != NULL){
                    $data_update_perusahaan = array(
                        'nama'          => strip_tags($this->input->post('nama_perusahaan')),
                        'alamat'        => strip_tags($this->input->post('alamat_perusahaan')),
                        'id_kelurahan'     => strip_tags($this->input->post('id_kelurahan_perusahaan')),
                        'id_kecamatan'     => strip_tags($this->input->post('id_kecamatan_perusahaan')),
                        'id_kabupaten'     => strip_tags($this->input->post('id_kabupaten_perusahaan')),
			'id_provinsi'     => strip_tags($this->input->post('id_provinsi_perusahaan')),
                        'kode_pos'      => strip_tags($this->input->post('kode_pos_perusahaan')),
                        'no_telepon'    => strip_tags($this->input->post('no_telepon_perusahaan')),
                        'fax'           => strip_tags($this->input->post('fax')),
                        'email'         => strip_tags($this->input->post('email_perusahaan')),
                    );
                    $update_perusahaan = $this->app_model->update_data_perusahaan($id_perusahaan, $data_update_perusahaan);
                }

                if ( $update) {
                    insert_log('Edit user <em>'.$data_update['username'].(empty($data_update['nama']) ? NULL : ' ('.$data_update['nama'].')').'</em>');
                    $this->session->set_flashdata('sucMsg', 'Data berhasil disimpan!');
                    redirect(base_url().'backend/edit_profil/edit_profil');
                } else {
                    $errMsg = 'Data gagal disimpan';
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
        $this->template->write('title', 'Edit '.$this->page_title);
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
