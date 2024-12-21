<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_frontend extends MY_Controller {
    var $page_title = 'Kelola Menu Frontend';
    //Penambahan variable pencarian tanpa menggunakan tabel id. perubahan oleh : Nurhayati Rahayu (15/11/2019)
    var $column_datatable_search = array('kategori_menu','menu','menu_en','cname','A.uri','nama_file','A.urutan','lampiran');
    //baris terakhir perubahan
    var $column_datatable = array('A.id', 'kategori_menu','menu','menu_en','cname','A.uri','nama_file','A.urutan','lampiran');
    var $folder         = 'backend/administrasi_website';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'menu_frontend_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $module =$this->module;
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (17 Mei 2024)
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
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (17 Mei 2024)
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
        $this->template->write_view('content', $this->folder.'/menu_frontend/datatable', $data, true);
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
                        'field' => 'id_kategori_menu',
                        'label' => 'Id Kategori Menu',
                        'rules' => 'integer'
                    ),

                    array(
                        'field' => 'menu',
                        'label' => 'Menu',
                        'rules' => 'required|max_length[255]'
                    ),

                    array(
                        'field' => 'menu_en',
                        'label' => 'Menu En',
                        'rules' => 'required|max_length[255]'
                    ),

                    array(
                        'field' => 'cname',
                        'label' => 'Cname',
                        'rules' => 'required|max_length[100]'
                    ),

                    array(
                        'field' => 'uri',
                        'label' => 'Uri',
                        'rules' => 'required|max_length[255]'
                    ),

                    array(
                        'field' => 'urutan',
                        'label' => 'Urutan',
                        'rules' => 'required|integer'
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
        $max_rte_id = $this->app_model->get_max_rte_id();
        $new_rte_id = $max_rte_id+1;
        $data['new_rte_id'] = $new_rte_id;
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
                $data_insert_halaman = array(
                    'nama_halaman' => $this->input->post('nama_halaman'),
                    'text_rte'     => $this->input->post('rte'),
                    'text_rte_en'  => $this->input->post('rte_en'),
                 );
                $insert_halaman = $this->global_model->insert_data('tbl_halaman_menu', $data_insert_halaman);

                $data_insert = array(
                    'id_kategori_menu' => $this->input->post('id_kategori_menu'),
                    'menu'             => strip_tags($this->input->post('menu')),
                    'menu_en'          => strip_tags($this->input->post('menu_en')),
                    'cname'            => strip_tags($this->input->post('cname')),
                    'uri'              => strip_tags($this->input->post('uri')),
                    'link_file'        => strip_tags($this->input->post('link_file')),
                    'rte'              => $insert_halaman,
                    'urutan'           => $this->input->post('urutan'),
                    'tampilkan_menu'   => $this->input->post('tampilkan_menu')
                 );
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
        $this->template->add_css('resources/plugins/summernote/summernote.css');
        $this->template->add_js('resources/plugins/summernote/summernote.min.js');
        $this->template->write('title', 'Tambah '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/menu_frontend/form', $data, true);
        $this->template->render();
    }
    function edit($id = 0) {
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail'] = $this->app_model->get_by_id($id);
        // var_dump($data['detail']);

        if ( !$data['detail'] ) {
            show_404();
            return;
        }
        $new_rte_id = $data['detail']['rte'];
        $data['new_rte_id'] = $new_rte_id;
        $data['title'] = "Edit Data";
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;

        if($_POST)
        {
            $id_rte         = $data['detail']['rte'];
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;
            $simpan         = true;

            $this->valid_form('edit');

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            if ( $simpan ) {
                if(empty($id_rte) || $id_rte == 0){
                    // insert halaman
                    $data_insert_halaman = array(
                        'nama_halaman' => $this->input->post('nama_halaman'),
                        'text_rte'     => $this->input->post('rte'),
                        'text_rte_en'  => $this->input->post('rte_en'),
                     );
                    $insert_halaman = $this->global_model->insert_data('tbl_halaman_menu', $data_insert_halaman);

                    $idkategorimenu = $this->input->post('id_kategori_menu');
                    if(empty($idkategorimenu)){
                        $data_update = array(
                            'id_kategori_menu' => NULL,
                            'menu'             => strip_tags($this->input->post('menu')),
                            'menu_en'          => strip_tags($this->input->post('menu_en')),
                            'cname'            => strip_tags($this->input->post('cname')),
                            'uri'              => strip_tags($this->input->post('uri')),
                            'link_file'        => strip_tags($this->input->post('link_file')),
                            'rte'              => $insert_halaman,
                            'urutan'           => $this->input->post('urutan'),
                            'tampilkan_menu'   => $this->input->post('tampilkan_menu')
                        );
                    }else{
                        $data_update = array(
                            'id_kategori_menu' => $this->input->post('id_kategori_menu'),
                            'menu'             => strip_tags($this->input->post('menu')),
                            'menu_en'          => strip_tags($this->input->post('menu_en')),
                            'cname'            => strip_tags($this->input->post('cname')),
                            'uri'              => strip_tags($this->input->post('uri')),
                            'link_file'        => strip_tags($this->input->post('link_file')),
                            'rte'              => $insert_halaman,
                            'urutan'           => $this->input->post('urutan'),
                            'tampilkan_menu'   => $this->input->post('tampilkan_menu')
                        );
                    }
                }else{
                    // update halaman
                    $data_update_halaman = array(
                        'nama_halaman' => $this->input->post('nama_halaman'),
                        'text_rte'     => $this->input->post('rte'),
                        'text_rte_en'  => $this->input->post('rte_en'),
                     );
                    $update_halaman = $this->global_model->update_data('tbl_halaman_menu', 'id', $id_rte, $data_update_halaman);

                    $idkategorimenu = $this->input->post('id_kategori_menu');
                    if(empty($idkategorimenu)){
                        $data_update = array(
                            'id_kategori_menu' => NULL,
                            'menu'             => strip_tags($this->input->post('menu')),
                            'menu_en'          => strip_tags($this->input->post('menu_en')),
                            'cname'            => strip_tags($this->input->post('cname')),
                            'uri'              => strip_tags($this->input->post('uri')),
                            'link_file'        => strip_tags($this->input->post('link_file')),
                            'urutan'           => $this->input->post('urutan'),
                            'tampilkan_menu'   => $this->input->post('tampilkan_menu')
                        );
                    }else{
                        $data_update = array(
                            'id_kategori_menu' => $this->input->post('id_kategori_menu'),
                            'menu'             => strip_tags($this->input->post('menu')),
                            'menu_en'          => strip_tags($this->input->post('menu_en')),
                            'cname'            => strip_tags($this->input->post('cname')),
                            'uri'              => strip_tags($this->input->post('uri')),
                            'link_file'        => strip_tags($this->input->post('link_file')),
                            'urutan'           => $this->input->post('urutan'),
                            'tampilkan_menu'   => $this->input->post('tampilkan_menu')
                        );
                    }
                }

                $update = $this->app_model->update_data($id, $data_update);
                if ($update ) {
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
        $this->template->add_css('resources/plugins/summernote/summernote.css');
        $this->template->add_js('resources/plugins/summernote/summernote.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/menu_frontend/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
        $this->load->model('global_model');
        $module = $this->module;
        $detail = $this->app_model->get_by_id($id);

        $this->global_model->delete_data('tbl_halaman_menu', 'id', $detail['rte']);
        $this->app_model->delete_data($id);

        redirect(base_url().$this->module);
    }
}
