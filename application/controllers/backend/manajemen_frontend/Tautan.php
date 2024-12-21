<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tautan extends MY_Controller {
    var $page_title = 'Kelola Tautan';
    //Penambahan variable pencarian tanpa menggunakan tabel id. perubahan oleh : Nurhayati Rahayu (15/11/2019)
    var $column_datatable_search = array('judul','jenis_tautan','link');
    // baris terakhir perubahan
    var $column_datatable = array('id_tautan', 'judul','jenis_tautan','link','gambar','urutan');
    var $folder         = 'backend/manajemen_frontend';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'tautan_model', 'app_model');
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
        $this->template->write_view('content', $module.'/datatable', $data, true);
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
                        'field' => 'judul',
                        'label' => 'Judul',
                        'rules' => 'max_length[100]'
                    ),

                    array(
                        'field' => 'link',
                        'label' => 'Link',
                        'rules' => 'max_length[250]'
                    ),

                    array(
                        'field' => 'gambar',
                        'label' => 'Gambar',
                        'rules' => 'max_length[65535]'
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
                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['gambar']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['gambar']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => 'upload/tautan/',
                        'allowed_types'     => 'gif|jpg|png|bmp|jpeg',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('gambar') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 300;
                        $maxHeight = 55;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 300,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                    }
                }

                $data_insert = array(
                    'judul' => strip_tags($this->input->post('judul')),
                    'id_jenis_tautan' => strip_tags($this->input->post('id_jenis_tautan')),
                    'link' => strip_tags($this->input->post('link')),
                    'gambar' => $upload_conf['file_name'],
                    'urutan' => strip_tags($this->input->post('urutan')),
                );

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {					insert_log('Tambah tautan<br/><p><em>'.$data_insert['judul'].'</em></p>');
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
        $this->template->write_view('content', $module.'/form', $data, true);
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
                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['gambar']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['gambar']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => 'upload/tautan/',
                        'allowed_types'     => 'gif|jpg|png|bmp|jpeg',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('gambar') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 300;
                        $maxHeight = 55;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 300,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                    }
                }

                if ( !empty($tmp_name) ) {
                    $data_update = array(
                        'judul' => strip_tags($this->input->post('judul')),
                        'id_jenis_tautan' => strip_tags($this->input->post('id_jenis_tautan')),
                        'link' => strip_tags($this->input->post('link')),
                        'gambar' => $upload_conf['file_name'],
                        'urutan' => strip_tags($this->input->post('urutan')),
                    );
                }
                else{
                    $data_update = array(
                        'judul' => strip_tags($this->input->post('judul')),
                        'id_jenis_tautan' => strip_tags($this->input->post('id_jenis_tautan')),
                        'link' => strip_tags($this->input->post('link')),
                        'urutan' => strip_tags($this->input->post('urutan')),
                    );
                }
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
					insert_log('Ubah tautan<br/><p><em>'.$data_update['judul'].'</em></p>');
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
        $this->template->write_view('content', $module.'/form', $data, true);
        $this->template->render();
    }
    function delete($id = '') {
		$detail = $this->app_model->get_by_id($id);
		if ( $detail )
			insert_log('Hapus tautan<br/><p><em>'.$detail['judul'].'</em></p>');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
