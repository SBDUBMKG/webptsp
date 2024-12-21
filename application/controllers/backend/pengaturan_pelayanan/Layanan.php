<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends MY_Controller {
    var $page_title         = 'Layanan';
    var $column_datatable   = array('id_layanan', 'layanan','layanan_en', 'is_produk', 'icon');
    var $folder             = 'backend/pengaturan_pelayanan';
    var $module             = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->helper('general_helper');
        $this->load->model($this->folder.'/'.'Layanan_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index() {
        $module =$this->module;

        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (21 Mei 2024)
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
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (21 Mei 2024)
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
        $this->template->write_view('content', $this->folder.'/layanan/datatable', $data, true);
        $this->template->render();
    }

    function getDataTable() {
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
                        'field' => 'layanan',
                        'label' => 'Jenis Layanan',
                        'rules' => 'required|max_length[200]'
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
                $data_insert = array(
                    'layanan'           => strip_tags($this->input->post('layanan')),
                    'layanan_en'           => strip_tags($this->input->post('layanan_en')),
                    // 'level'             => strip_tags($this->input->post('level')),
                    'id_jenis_layanan'  => strip_tags($this->input->post('id_jenis_layanan')),
                    'id_parent'         => strip_tags($this->input->post('id_parent')),
                    'is_produk'         => strip_tags($this->input->post('is_produk')),
                );

                $this->load->library('upload');
                $tmp_name = $_FILES['icon']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['icon']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = time();

                    $upload_conf = array(
                        'upload_path'       => 'upload/icon/',
                        'allowed_types'     => 'png|jpg|gif',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('icon') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $data_insert['icon'] = $upload_conf['file_name'];
                    }
                }

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {
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
        $this->template->write_view('content', $this->folder.'/layanan/form', $data, true);
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
                $data_update = array(
                    'layanan'           => strip_tags($this->input->post('layanan')),
                    'layanan_en'           => strip_tags($this->input->post('layanan_en')),
                    // 'level'             => strip_tags($this->input->post('level')),
                    'id_jenis_layanan'  => strip_tags($this->input->post('id_jenis_layanan')),
                    'id_parent'         => strip_tags($this->input->post('id_parent')),
                    'is_produk'         => strip_tags($this->input->post('is_produk')),
                );
                $this->load->library('upload');
                $tmp_name = $_FILES['icon']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['icon']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = time();

                    $upload_conf = array(
                        'upload_path'       => 'upload/icon/',
                        'allowed_types'     => 'png|jpg|gif',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('icon') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $data_update['icon'] = $upload_conf['file_name'];
                    }
                }

                $update = $this->app_model->update_data($id, $data_update);
               // echo $this->db->last_query();
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
        $this->template->write_view('content', $this->folder.'/layanan/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
