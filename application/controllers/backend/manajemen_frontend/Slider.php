<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Slider extends MY_Controller {
    var $page_title         = 'Kelola Slider';
    var $column_datatable   = array('id_slider', 'link','slider','slider_en','urutan','is_active');
    var $folder             = 'backend/manajemen_frontend';
    var $module             = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'slider_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index() {
        $module =$this->module;
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (16 Mei 2024)
        $script = '
			$(function () {
				$("#datatable").DataTable({
                    '.($this->is_write ? '"aoColumnDefs": [{"bSortable": false, "aTargets": [2]}],' : NULL).'
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    order:[],
                    "ajax" : "'.base_url().$this->module.'/getDataTable"
                });
			});
			';
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (16 Mei 2024)
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
        $this->template->write_view('content', $this->folder.'/slider/datatable', $data, true);
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
                        'field' => 'link',
                        'label' => 'Link',
                        'rules' => 'max_length[100]'
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
                    'title'=> strip_tags($this->input->post('title')),
                    'link' => strip_tags($this->input->post('link')),
                    'is_active' => strip_tags($this->input->post('is_active')),
                    'urutan'=>strip_tags($this->input->post('urutan'))
                );

                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['slider']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['slider']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './upload/slider/',
                        'allowed_types'     => 'gif|jpg|png|bmp|jpeg',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('slider') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 950;
                        $maxHeight = 530;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 950,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_insert['slider'] = $upload_conf['file_name'];
                    }
                }

                $tmp_name_en = $_FILES['slider_en']['tmp_name'];
                if ( !empty($tmp_name_en) ) {
                    $extension_expl = explode('.', $_FILES['slider_en']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
		    // baris pertama perbaikan
		    // $file_name = date("YmdHis");
                    $file_name = date("YmdHiss");
		    // baris terakhir perbaikan. Perbaikan dilakukan oleh : Nurhayati Rahayu (29072020)
                    $upload_conf = array(
                        'upload_path'       => './upload/slider/',
                        'allowed_types'     => 'gif|jpg|png|bmp|jpeg',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('slider_en') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 950;
                        $maxHeight = 530;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 950,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_insert['slider_en'] = $upload_conf['file_name'];
                    }
                }

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {					insert_log('Tambah slider');
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
        $this->template->write_view('content', $this->folder.'/slider/form', $data, true);
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
                    'title'=> strip_tags($this->input->post('title')),
                    'link' => strip_tags($this->input->post('link')),
                    'is_active' => strip_tags($this->input->post('is_active')),
                    'urutan'=>strip_tags($this->input->post('urutan'))
                );
                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['slider']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['slider']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './upload/slider/',
                        'allowed_types'     => 'gif|jpg|png|bmp|jpeg',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('slider') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 950;
                        $maxHeight = 530;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 950,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_update['slider'] = $upload_conf['file_name'];
                    }
                }

                $tmp_name_en = $_FILES['slider_en']['tmp_name'];
                if ( !empty($tmp_name_en) ) {
                    $extension_expl = explode('.', $_FILES['slider_en']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
		    // baris pertama perbaikan
		    // $file_name = date("YmdHis");
                    $file_name = date("YmdHiss");
		    // baris terakhir perbaikan. Perbaikan dilakukan oleh : Nurhayati Rahayu (29072020)

                    $upload_conf = array(
                        'upload_path'       => './upload/slider/',
                        'allowed_types'     => 'gif|jpg|png|bmp|jpeg',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('slider_en') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 950;
                        $maxHeight = 530;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 950,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_update['slider_en'] = $upload_conf['file_name'];
                    }
                }

                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {					insert_log('Edit slider');
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
        $this->template->write_view('content', $this->folder.'/slider/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
		$detail = $this->app_model->get_by_id($id);
		if ( $detail )
			insert_log('Hapus slider');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

    function active($id=''){
		insert_log('Ubah status slider');
        $unset = $this->app_model->active($id);
        redirect(base_url().$this->module);
    }
}
