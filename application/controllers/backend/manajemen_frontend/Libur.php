<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */

class Libur extends MY_Controller {
    var $page_title = 'Kelola Hari Libur';
    var $folder     = 'backend/manajemen_frontend';
    var $column_datatable = ['tgl_mulai','jml_hari','keterangan'];

    function __construct(){
        parent::__construct();
        $this->module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'Libur_model', 'app_model');
        $this->app_model->initialize($this->module);
    }

    function index() {
        $data['title'] = $this->page_title;
        $script = '
            $(function () {
                var active_id = \'\';
                $("#datatable").DataTable({
                    '.($this->is_write ? '"aoColumnDefs": [{"bSortable": false, "aTargets": [2]}],' : NULL).'
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : "'.base_url().$this->module.'/getDataTable"
                });
            });';
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
        $this->template->write_view('content', $this->module.'/datatable', $data, true);
        $this->template->render();
    }

    function getDataTable(){
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $sSearch = $this->input->get_post('search', true);
        $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch);
        echo $view;
    }

    private function valid_form() {
        $this->load->library('form_validation');
        $config = [
            ['field' => 'tgl_mulai', 'label' => 'Tanggal Mulai','rules' => 'required'],
            ['field' => 'tgl_akhir', 'label' => 'Tanggal Akhir','rules' => 'required'],
            ['field' => 'keterangan', 'label' => 'Keterangan Libur','rules' => 'required']
        ];
        $this->form_validation->set_rules($config);
    }

    function add() {
        $this->load->model('global_model');
        $data['detail']     = array();
        $data['title']      = "Tambah Data";
        $data['url_back']   = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;

        if($_POST)
        {
            $data_insert    = array();
            $simpan         = true;
            $this->valid_form(strtolower(__FUNCTION__));
            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            if ( $simpan ) {
                $data_insert = [
                    'tgl_mulai'=> strip_tags($this->input->post('tgl_mulai')),
                    'tgl_akhir' => strip_tags($this->input->post('tgl_akhir')),
                    'keterangan' => strip_tags($this->input->post('keterangan')),
                ];
                if ($this->app_model->insert_data($data_insert)) {
                    insert_log('Tambah data Kelola Hari Libur : '.json_encode(($data_insert)));
                    redirect(base_url().$this->module);
                } else {
                    $errMsg = 'Data gagal disimpan';
                }
            }
        }
        $data['page_title'] = $this->page_title;
        $data['errMsg']     = $errMsg;
        $this->template->write('title', 'Tambah '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/libur/form', $data, true);
        $this->template->render();
    }

    function edit($id) {
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
            $simpan         = true;
            $this->valid_form();
            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            if ( $simpan ) {
                $data_update = [
                    'tgl_mulai'=> strip_tags($this->input->post('tgl_mulai')),
                    'tgl_akhir' => strip_tags($this->input->post('tgl_akhir')),
                    'keterangan' => strip_tags($this->input->post('keterangan')),
                ];
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
                    insert_log('Edit Kelola Hari Libur : '.json_encode(($data_update)));
                    redirect(base_url().$this->module);
                } else {
                    $errMsg = 'Data gagal disimpan';
                }
            }
        }
        $data['page_title'] = $this->page_title;
        $data['id'] = $id;
        $data['errMsg'] = $errMsg;
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/libur/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
		$detail = $this->app_model->get_by_id($id);
		if ( $detail )
			insert_log('Hapus slider');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

}
