<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class Role extends MY_Controller {
    var $page_title = 'Role';
    var $column_datatable = array('id_role', 'role');
    var $folder         = 'backend/manajemen_backend';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'role_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $script = '
			$(function () {
				$("#datatable").DataTable({
                    '.($this->is_write ? '"aoColumnDefs": [{"bSortable": false, "aTargets": [2]}],' : NULL).'
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : "'.base_url().$this->module.'/getDataTable"
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
        $this->template->write_view('content', $this->folder.'/role/datatable', $data, true);
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
                        'field' => 'role',
                        'label' => 'Role',
                        'rules' => 'required|max_length[30]'
                    ),
                );
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
            $role = strip_tags($this->input->post('role'));
            $role_aktif = $this->global_model->get_by_id('tbl_role','role',$role);

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            if (!empty($role_aktif)) {
                $simpan = false;
                $errMsg = '<li>Role sudah ada, atau masukkan mana yang unik</li>';
            }

            if ( $simpan ) {
                $data_insert = array(
                    'role' => $role,
                );

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {					insert_log('Tambah role <em>'.$data_insert['role'].'</em>');
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
        $this->template->write_view('content', $this->folder.'/role/form', $data, true);
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

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            if ( $simpan ) {
                $data_update = array(    'role' => strip_tags($this->input->post('role')),
            );
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {					insert_log('Edit role <em>'.$data_update['role'].'</em>');
                    redirect(base_url().$module);
                } else {
                    $errMsg = 'Data gagal disimpan';
                }
            }
        }
        $data['page_title'] = $this->page_title;
        $data['errMsg'] = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/role/form', $data, true);
        $this->template->render();
    }
    function delete($id = '') {		$detil = $this->app_model->get_by_id($id);		if ( $detil )			insert_log('Hapus role <em>'.$detil['role'].'</em>');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
    function hak_akses($id = 0) {
        $module = $this->module;
        if ( !$this->is_write ) {
            redirect(base_url().$module);
            return;
        }
        $detail = $this->app_model->get_by_id($id);
        $data['detail'] = $detail;
        if ( !$data['detail'] ) {
            show_404();
            return;
        }

        $list_kategori_menu = $this->app_model->get_list_kategori_menu();
        $list_hak_akses = $this->app_model->get_list_hak_akses($id);
        $hak_akses = array();
        foreach ( $list_hak_akses as $item ) {
            $hak_akses[$item->id_menu] = array('id_hak_akses' => $item->id_hak_akses, 'is_write' => $item->is_write, 'is_read' => $item->is_read);
        }
        $data['title'] = "Edit ".$this->page_title;
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;

        if($_POST)
        {
            $id_menu = $this->input->post('id_menu');
            $cmb_read = $this->input->post('cmb_read');
            $cmb_write = $this->input->post('cmb_write');
            foreach ( $id_menu as $menu ) {
                if ( array_key_exists($menu, $hak_akses) ) {
                    $dupdate = array(
                        'is_read'   => is_array($cmb_read) && in_array($menu, $cmb_read) ? 1 : 0,
                        'is_write'  => is_array($cmb_write) && in_array($menu, $cmb_write) ? 1 : 0
                    );
                    $this->app_model->update_hak_akses($hak_akses[$menu]['id_hak_akses'], $dupdate);
                } else {
                    $dinsert = array(
                        'id_role'   => $id,
                        'id_menu'   => $menu,
                        'is_read'   => is_array($cmb_write) && in_array($menu, $cmb_read) ? 1 : 0,
                        'is_write'  => is_array($cmb_write) && in_array($menu, $cmb_write) ? 1 : 0
                    );
                    $this->app_model->insert_hak_akses($dinsert);
                }				insert_log('Edit hak akses role <em>'.$detail['role'].'</em>');
            }
            redirect(base_url().$module);
        }
        $data['list_kategori_menu'] = $list_kategori_menu;
        $data['hak_akses'] = $hak_akses;
        $data['id'] = $id;
        $data['page_title'] = $this->page_title;
        $data['errMsg'] = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/role/form_hak_akses', $data, true);
        $this->template->render();
    }

    function cek_role(){
        $this->load->model('global_model');
        $role = $this->input->post('role');
        $check = $this->global_model->get_by_id('tbl_role','role',$role);
        echo json_encode($check);
    }
}
