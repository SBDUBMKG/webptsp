<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upt extends MY_Controller {
    var $page_title = 'Unit Pelaksana Teknis';
    var $column_datatable = array('id_upt', 'upt','id_wmo','alamat','provinsi','kabkot','kecamatan','lintang','bujur','telepon_upt','email_upt','is_active');
    var $folder         = 'backend/master';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->helper('general_helper'); // Script yang ditambahkan Rahmat, 3 Juli 2020
        $this->load->model($this->folder.'/'.'upt_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $module =$this->module;
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)
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
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)

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
        $this->template->write_view('content', $this->folder.'/upt/datatable', $data, true);
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
                        'field' => 'upt',
                        'label' => 'Upt',
                        'rules' => 'required|max_length[255]'
                    ),

                    array(
                        'field' => 'id_wmo',
                        'label' => 'Id Wmo',
                        'rules' => 'max_length[30]|integer'
                    ),

                    array(
                        'field' => 'alamat',
                        'label' => 'Alamat',
                        'rules' => 'max_length[255]'
                    ),

                    array(
                        'field' => 'id_provinsi',
                        'label' => 'Id Provinsi',
                        'rules' => 'integer'
                    ),

                    array(
                        'field' => 'id_kabkot',
                        'label' => 'Id Kabkot',
                        'rules' => 'integer'
                    ),

                    array(
                        'field' => 'id_kecamatan',
                        'label' => 'Id Kecamatan',
                        'rules' => 'integer'
                    ),

                    array(
                        'field' => 'lintang',
                        'label' => 'Lintang',
                        'rules' => 'max_length[15]'
                    ),

                    array(
                        'field' => 'bujur',
                        'label' => 'Bujur',
                        'rules' => 'max_length[15]'
                    ),

                    array(
                        'field' => 'telepon_upt',
                        'label' => 'Telepon Upt',
                        'rules' => 'max_length[40]'
                    ),

                    array(
                        'field' => 'email_upt',
                        'label' => 'Email Upt',
                        'rules' => 'max_length[50]|valid_email'
                    ),
                );
        $this->form_validation->set_rules($config);
    }
    function add() {
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail']     = array();
        $data['title']      = "Tambah Data";
        $data['url_back']   = "window.location.href='".base_url().$module."'";
        $errMsg = NULL;

        if($_POST)
        {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;
            $data_insert    = array();
            $simpan         = true;
            $this->valid_form(strtolower(__FUNCTION__));

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            if ( $simpan ) {
                $data_update = array(    'upt' => strip_tags($this->input->post('upt')),
                'id_wmo' => strip_tags($this->input->post('id_wmo')),
                'alamat' => strip_tags($this->input->post('alamat')),
                'id_provinsi' => $this->input->post('id_provinsi'),
                'id_kabkot' => $this->input->post('id_kabkot'),
                'id_kecamatan' => $this->input->post('id_kecamatan'),
                'lintang' => strip_tags($this->input->post('lintang')),
                'bujur' => strip_tags($this->input->post('bujur')),
                'telepon_upt' => strip_tags($this->input->post('telepon_upt')),
                'email_upt' => strip_tags($this->input->post('email_upt')),
                'is_active' => strip_tags($this->input->post('is_active')),
            );
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
                    redirect(base_url().$module);
                } else {
                //    Menghiangkan pesan error. Perubahan oeh Nurhayati Rahayu(28.04.2021)
                //    $errMsg = 'Data gagal disimpan';
                // Baris terakhir perubahan
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
        $this->template->write_view('content', $this->folder.'/upt/form', $data, true);
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
        $data['title'] = "Edit Data";
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
                $data_update = array(    'upt' => strip_tags($this->input->post('upt')),
                'id_wmo' => strip_tags($this->input->post('id_wmo')),
                'alamat' => strip_tags($this->input->post('alamat')),
                'id_provinsi' => $this->input->post('id_provinsi'),
                'id_kabkot' => $this->input->post('id_kabkot'),
                'id_kecamatan' => $this->input->post('id_kecamatan'),
                'lintang' => strip_tags($this->input->post('lintang')),
                'bujur' => strip_tags($this->input->post('bujur')),
                'telepon_upt' => strip_tags($this->input->post('telepon_upt')),
                'email_upt' => strip_tags($this->input->post('email_upt')),
                'is_active' => strip_tags($this->input->post('is_active')),
            );
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
                    redirect(base_url().$module);
                } else {
                    $errMsg = 'Data gagal disimpan';
                }
            }
        }
        $data['page_title'] = $this->page_title;
        $data['id'] = $id;
        $data['errMsg'] = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/upt/form', $data, true);
        $this->template->render();
    }
    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
