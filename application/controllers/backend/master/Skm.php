<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skm extends MY_Controller {
    var $page_title       	= 'Master skm';
    var $column_datatable 	= array('id_skm', 'tahun', 'file');
    var $folder         	= 'backend/master';
    var $module         	= '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->helper('general_helper'); // Script yang ditambahkan Rahmat, 3 Juli 2020
        $this->load->model($this->folder.'/'.'skm_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
        $this->act = 'add';
    }

    public function index() {
        
        $module =$this->module;

        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)
        $script = '
			$(function () {
				$("#datatable").DataTable({
                    '.($this->is_write ? '"aoColumnDefs": [{"bSortable": false, "aTargets": [2]}],' : NULL).'
                    "processing": true,
                    "serverSide": true,
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
        $this->template->write_view('content', $this->folder.'/skm/datatable', $data, true);
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
        $this->act = $act;
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'tahun',
                        'label' => 'Tahun',
                        'rules' => 'required|max_length[200]|numeric'
                    ),
                              
                );

        if ($act == 'add') {
            $config[] = array(
                'field' => 'file',
                'label' => 'File',
                'rules' => 'callback_file_check'
            );
        }else {
            $config[] = array(
                'field' => 'file',
                'label' => 'File',
                'rules' => 'callback_file_check'
            );
        }
        $this->form_validation->set_rules($config);
    }

    function add() {
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail']     = array();
        $data['title']      = "Tambah Data";
        $data['url_back']   = "window.location.href='".base_url().$module."'";
        $errMsg = NULL;

        if($_POST) {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;
            $data_insert    = array();
            $simpan         = true;
            $this->valid_form(strtolower(__FUNCTION__));

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }


            $filename = $this->upload_file();
            

            if ( $simpan ) {
                $data_insert = array(
		            'tahun' => strip_tags($this->input->post('tahun')),
		            'file' => $filename,
        	    );
                $insert = $this->app_model->insert_data($data_insert);
                
                if ( $insert ) {
                	insert_log('Tambah Master skm <em>'.$data_insert['skm'].'</em>');
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
        $this->template->write_view('content', $this->folder.'/skm/form', $data, true);
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

        if($_POST) {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;
            $simpan         = true;

            $this->valid_form('edit');

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            $this->load->library('upload');

            if ( $_FILES['file']['name'] != '' ) {
                $upload = $this->upload_file();
                if (!$upload) {
                    $simpan = false;
                    $errMsg = $this->upload->display_errors();
                } 
            }



            if ( $simpan ) {
                $data_update = array(
                    'tahun' => strip_tags($this->input->post('tahun')),
	            );

                if ( $_FILES['file']['name'] != '' ) {
                    $data_update['file'] = $upload;
                }

                $update = $this->app_model->update_data($id, $data_update);

                if ( $update ) {
                	insert_log('Edit Master skm <em>'.$data_update['skm'].'</em>');
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
        $this->template->write_view('content', $this->folder.'/skm/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }


    function upload_file() {
        try {
            $this->load->library('upload');

            $namafile = md5(date('YmdHis') . '_'. rand(1000,9999));

            $config['upload_path']   = 'upload/skm';
            $config['allowed_types'] = 'pdf|xls|xlsx|doc|docx'; 
            $config['max_size']      = 2048; 
            $config['overwrite']     = FALSE;
            $config['file_name']     = $namafile; 

            $this->upload->initialize($config);
            if ( !empty($_FILES['file']['name']) ) {
                if ( $this->upload->do_upload('file') ) {
                    $upload_data = $this->upload->data();
                    return $config['upload_path'] . '/' . $upload_data['file_name']; 
                } else {
                    return '';
                }
            } 
        } catch (\Throwable $th) {
            //throw $th;
        }
        return ''; 
            
    }

    function file_check($str = false) {
        $allowed_mime_type_arr = array('application/pdf');
        $mime = $_FILES['file']['type'];

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('file_check', 'The {field} must be a PDF file.');
                return FALSE;
            }
        }else {
            if ($this->act == 'add') {
                $this->form_validation->set_message('file_check', 'The {field} is required.');
                return FALSE;
            }
            return TRUE;
        }
    }


}
