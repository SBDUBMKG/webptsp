<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class User extends MY_Controller {
    var $page_title = 'Kelola User';
    var $column_datatable = array('id_admin', 'role','username','nama');
    var $folder         = 'backend/manajemen_backend';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'user_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $module = $this->module;
        $script = '
			$(function () {
				$("#datatable").DataTable({
                    '.($this->is_write ? '"aoColumnDefs": [{"bSortable": false, "aTargets": [4]}],' : NULL).'
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : "'.base_url().$module.'/getDataTable"
                });
			});
			';
        $data['title'] = $this->page_title;
        $this->template->add_css('resources/plugins/datatables/dataTables.bootstrap.css');
        $this->template->add_css('resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css');
        $this->template->add_js('resources/plugins/datatables/jquery.dataTables.min.js');
        $this->template->add_js('resources/plugins/datatables/dataTables.bootstrap.min.js');
        $this->template->add_js('resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js');
        $this->template->add_js('resources/plugins/datatables/dataTables.buttons.min.js');
        $this->template->add_js('resources/plugins/datatables/buttons.flash.min.js');
        $this->template->add_js('resources/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js');

        $this->template->add_js($script,'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->folder.'/user/datatable', $data, true);
        $this->template->render();
    }
    function getDataTable()
    {
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $sSearch = $this->input->get_post('search', true);

        $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch);

        echo $view;
    }
    private function valid_form($act = 'add') {
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'id_role',
                        'label' => 'Id Role',
                        'rules' => 'required|integer'
                    ),
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
    function add() {
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail']     = array();
        $data['title']      = "Tambah ".$this->page_title;
        $data['url_back']   = "window.location.href='".base_url().$module."'";
        $errMsg = NULL;

        if($_POST)
        {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;
            $data_insert    = array();
            $simpan         = true;
            $this->valid_form(strtolower(__FUNCTION__));

            $check_username = $this->app_model->check_username_exists($data_post['username']);
            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            } else if ( $check_username ) {
                $simpan = false;
                $errMsg = 'Username '.$data_post['username'].' tidak tersedia.';
            }
            if ( $simpan ) {
                $data_insert = array(
                    'id_role' => $this->input->post('id_role'),
                    'username' => strip_tags($this->input->post('username')),
                    'password' => strip_tags(strrev(md5($this->input->post('password')))),
                    'email' => strip_tags($this->input->post('email')),
                    'nama' => strip_tags($this->input->post('nama'))
                );

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {					insert_log('Tambah user <em>'.$data_insert['username'].(empty($data_insert['nama']) ? NULL : ' ('.$data_insert['nama'].')').'</em>');
                    redirect(base_url().$module);
                } else {
                    $errMsg = 'Data gagal disimpan';
                }
            }
        }
        $data['page_title'] = $this->page_title;
        $data['errMsg']     = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Tambah '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/user/form', $data, true);
        $this->template->render();
    }
    function edit($id = 0) {
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail'] = $this->app_model->get_by_id($id);
        if ( !$data['detail'] ) {
            show_404();
            return;
        }
        $data['title'] = "Edit ".$this->page_title;
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;

        if($_POST)
        {
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
                $data_update = array(
                    'id_role' => $this->input->post('id_role'),
                    'username' => strip_tags($this->input->post('username')),
                    'email' => strip_tags($this->input->post('email')),
                    'nama' => strip_tags($this->input->post('nama'))
                );
                if ( !empty($data_post['password']) ) {
                    $data_update['password'] = strip_tags(strrev(md5($this->input->post('password'))));
                }
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {									insert_log('Edit user <em>'.$data_update['username'].(empty($data_update['nama']) ? NULL : ' ('.$data_update['nama'].')').'</em>');
                    redirect(base_url().$module);
                } else {
                    $errMsg = 'Data gagal disimpan';
                }
            }
        }
        $data['id'] = $id;
        $data['page_title'] = $this->page_title;
        $data['errMsg'] = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/user/form', $data, true);
        $this->template->render();
    }
    function delete($id = '') {		$detail = $this->app_model->get_by_id($id);		if ( $detail ) {			insert_log('Hapus user <em>'.$detail['username'].(empty($detail['nama']) ? NULL : ' ('.$detail['nama'].')').'</em>');		}
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
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
