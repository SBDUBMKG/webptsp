<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends MY_Controller {
    var $page_title       = 'Kelola Berita Dan Artikel';
    var $column_datatable = array('id', 'judul','judul_en','tanggal_berita','isi_en','isi','thumbnail','jenis_konten', 'is_publish');
    var $folder           = 'backend/manajemen_frontend';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'berita_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index() {
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
        $this->template->write_view('content', $module.'/datatable', $data, true);
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
                        'field' => 'judul',
                        'label' => 'Judul',
                        'rules' => 'required|max_length[250]'
                    ),

                    array(
                        'field' => 'judul_en',
                        'label' => 'Judul En',
                        'rules' => 'required|max_length[250]'
                    ),

                    array(
                        'field' => 'tanggal_berita',
                        'label' => 'Tanggal Berita',
                        'rules' => 'required'
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

            if ( $simpan ) {
                $data_insert = array(
                    'judul' 			=> strip_tags($this->input->post('judul')),
                    'judul_en' 			=> strip_tags($this->input->post('judul_en')),
                    'tanggal_berita' 	=> $this->input->post('tanggal_berita'),
                    'isi_en' 			=> $this->input->post('isi_en'),
                    'isi' 				=> $this->input->post('isi'),
                    'sumber' 			=> $this->input->post('sumber'),
                    'id_jenis_konten' 	=> $this->input->post('id_jenis_konten'),
                    'is_publish' 		=> $this->input->post('is_publish'),
                );

                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['thumbnail']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['thumbnail']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './upload/thumbnail/',
                        'allowed_types'     => 'gif|jpg|jpeg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('thumbnail') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 306;
                        $maxHeight = 306;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 306,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data;
                            }
                        }
                        $data_insert['thumbnail'] = $upload_conf['file_name'];
                        // $data_insert['gambar'] = $_SESSION['berita'][0];
                    }
                }
                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {
                    insert_log('Tambah berita<br/><p><em>'.$data_insert['judul'].'</em></p>');
                    $this->session->unset_userdata('berita');
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
        $this->template->add_css('resources/plugins/summernote/summernote.css');;
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->add_js('resources/plugins/summernote/summernote.min.js');
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
                $data_update = array(
                    'judul'             => strip_tags($this->input->post('judul')),
                    'judul_en'          => strip_tags($this->input->post('judul_en')),
                    'tanggal_berita'    => $this->input->post('tanggal_berita'),
                    'isi_en'            => $this->input->post('isi_en'),
                    'isi'               => $this->input->post('isi'),
                    'sumber'            => $this->input->post('sumber'),
                    'id_jenis_konten'   => $this->input->post('id_jenis_konten'),
                    'is_publish' 		=> $this->input->post('is_publish'),
                );

                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['thumbnail']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['thumbnail']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './upload/thumbnail/',
                        'allowed_types'     => 'gif|jpg|jpeg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('thumbnail') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 306;
                        $maxHeight = 306;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'],
                            'width'         => 306,
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
                    $data_update['thumbnail'] = $upload_conf['file_name'];
                }

                $update = $this->app_model->update_data($id,$data_update);

                if ( $update ) {
                    insert_log('Edit berita<br/><p><em>'.$data_update['judul'].'</em></p>');
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
        $this->template->add_css('resources/plugins/summernote/summernote.css');;
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->add_js('resources/plugins/summernote/summernote.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $module.'/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
		$detail = $this->app_model->get_by_id($id);
		if ( $detail )
			insert_log('Hapus berita<br/><p><em>'.$detail['judul'].'</em></p>');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

    function save_image(){
        // var_dump($_FILES['file']['tmp_name']);exit();
        if(move_uploaded_file($_FILES['file']['tmp_name'],'upload/berita/'.$_FILES['file']['name'])){
            echo base_url().'upload/berita/'.$_FILES['file']['name'];
            if(!isset($_SESSION['berita'])){
                $_SESSION['berita'] = array();
            }
            array_push($_SESSION['berita'] , $_FILES['file']['name']);
        }
    }
}
