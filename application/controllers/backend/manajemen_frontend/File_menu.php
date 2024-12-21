<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_menu extends MY_Controller {
    var $page_title = 'Kelola File Menu';
    var $column_datatable = array('id','nama_file','lampiran');
    var $folder         = 'backend/manajemen_frontend';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'file_menu_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $module =$this->module;
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
        $this->template->write_view('content', $this->module.'/datatable', $data, true);
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

    function add() {
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail']     = array();
        $data['title']      = "Tambah Data";
        $data['url_back']   = "window.location.href='".base_url().$module."'";
        $errMsg = NULL;

        if($_FILES)
        {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;
            $data_insert    = array();
            $simpan         = true;

            if ( $simpan ) {
                $this->load->library('upload');
                $tmp_name = $_FILES['lampiran']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['lampiran']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './upload/file_menu/',
                        'allowed_types'     => 'pdf|jpg|png|gif|doc|docx|xls|xlsx|ppt|pptx',
                        'max_size'          => '70000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('lampiran') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $data_insert['lampiran'] = $upload_conf['file_name'];
                        $data_insert['nama_file'] = strip_tags($this->input->post('nama_file'));
                        $insert = $this->app_model->insert_data($data_insert);
                        if ( $insert ) {                        														insert_log('Tambah file menu');
                            redirect(base_url().$module);
                        } else {
                            $errMsg = 'Data gagal disimpan';
                        }
                    }
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
        $this->template->write_view('content', $this->module.'/form', $data, true);
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

            if ( $simpan ) {
                $this->load->library('upload');
                $tmp_name = $_FILES['lampiran']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['lampiran']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './upload/file_menu/',
                        'allowed_types'     => 'pdf|jpg|png|gif|doc|docx|xls|xlsx|ppt|pptx',
                        'max_size'          => '70000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('lampiran') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $data_update['lampiran'] = $upload_conf['file_name'];
                        $data_update['nama_file'] = strip_tags($this->input->post('nama_file'));
                        $update = $this->app_model->update_data($id,$data_update);
                        if ( $update ) {														insert_log('Edit file menu');
                            redirect(base_url().$module);
                        } else {
                            $errMsg = 'Data gagal disimpan';
                        }
                    }
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
        $this->template->write_view('content', $this->module.'/form', $data, true);
        $this->template->render();
    }
    function delete($id = '') {
		$detail = $this->app_model->get_by_id($id);
		if ( $detail )
			insert_log('Hapus file menu');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
