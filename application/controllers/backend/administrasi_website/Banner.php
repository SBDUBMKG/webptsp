<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Controller {
    var $page_title = 'Kelola Banner';
    //Penambahan variable pencarian tanpa menggunakan tabel id. perubahan oleh : Nurhayati Rahayu (15/11/2019)
    var $column_datatable_search = array('tema','is_active');
    // baris terakhir perubahan
    var $column_datatable = array('id_banner', 'tema','banner','banner_en','is_active');
    var $folder         = 'backend/administrasi_website';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'banner_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
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
        $this->template->write_view('content', $this->folder.'/banner/datatable', $data, true);
        $this->template->render();
    }
    function getDataTable()
    {
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $sSearch = $this->input->get_post('search', true);

        //Merubah variable pencarian. perubahan oleh : Nurhayati Rahayu (15/11/2019)
	//$view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch);
	$view = $this->app_model->show_datatable($this->column_datatable_search, $iDisplayStart,$iDisplayLength,$order,$sSearch);
	//baris terakhir perubahan
        echo $view;
    }
    private function valid_form($act = 'add') {
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'tema',
                        'label' => 'Tema',
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
                    'tema' => strip_tags($this->input->post('tema')),
                    'is_active' => strip_tags($this->input->post('is_active')),
                );

                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['banner']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['banner']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './resources/frontend/images/',
                        'allowed_types'     => 'gif|jpg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('banner') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 1079;
                        $maxHeight = 120;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 1079,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_insert['banner'] = $upload_conf['file_name'];
                    }
                }

                $tmp_name_en = $_FILES['banner_en']['tmp_name'];
                if ( !empty($tmp_name_en) ) {
                    $extension_expl = explode('.', $_FILES['banner_en']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './resources/frontend/images/',
                        'allowed_types'     => 'gif|jpg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('banner_en') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 1079;
                        $maxHeight = 120;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 1079,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_insert['banner_en'] = $upload_conf['file_name'];
                    }
                }

                if($data_insert['is_active']==1){
                    $unset_data = array(
                        'is_active' => 0
                    );
                    $unset = $this->db->update('tbl_banner', $unset_data);
                }

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {
                    insert_log('Tambah banner');
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
        $this->template->write_view('content', $this->folder.'/banner/form', $data, true);
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
                    'tema' => strip_tags($this->input->post('tema')),
                    'is_active' => strip_tags($this->input->post('is_active')),
                );
                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['banner']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['banner']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './resources/frontend/images/',
                        'allowed_types'     => 'gif|jpg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('banner') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 1079;
                        $maxHeight = 120;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 1079,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_update['banner'] = $upload_conf['file_name'];
                    }
                }

                $tmp_name_en = $_FILES['banner_en']['tmp_name'];
                if ( !empty($tmp_name_en) ) {
                    $extension_expl = explode('.', $_FILES['banner_en']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis")."_en";

                    $upload_conf = array(
                        'upload_path'       => './resources/frontend/images/',
                        'allowed_types'     => 'gif|jpg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('banner_en') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 1079;
                        $maxHeight = 120;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 1079,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_update['banner_en'] = $upload_conf['file_name'];
                    }
                }

                if($data_update['is_active']==1){
                    $unset_data = array(
                        'is_active' => 0
                    );
                    $unset = $this->db->update('tbl_banner', $unset_data);
                }

                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
                    insert_log('Ubah banner');
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
        $this->template->write_view('content', $this->folder.'/banner/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {				insert_log('Hapus banner');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

    function active($id=''){				insert_log('Ubah status banner');
        $unset = $this->app_model->active_banner($id);
        redirect(base_url().$this->module);
    }
}
