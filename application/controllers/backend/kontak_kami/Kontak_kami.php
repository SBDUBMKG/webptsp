<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_kami extends MY_Controller {
    var $page_title       = 'Kontak Kami';
    var $column_datatable = array('id_kontak_kami', 'nama','alamat','telepon','fax','email','map','is_publish');
    var $folder           = 'backend/kontak_kami';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'kontak_kami_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index() {
        $module =$this->module;
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (15 Mei 2024)
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
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (15 Mei 2024)
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
        $this->template->write_view('content', $this->folder.'/kontak_kami/datatable', $data, true);
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
                        'field' => 'nama',
                        'label' => 'Nama',
                        'rules' => 'required|max_length[225]'
                    ),

                    array(
                        'field' => 'alamat',
                        'label' => 'Alamat',
                        'rules' => 'required|max_length[65535]'
                    ),

                    array(
                        'field' => 'telepon',
                        'label' => 'Telepon',
                        'rules' => 'required|max_length[225]|integer'
                    ),

                    array(
                        'field' => 'fax',
                        'label' => 'Fax',
                        'rules' => 'required|max_length[225]'
                    ),

                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|max_length[225]|valid_email'
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
                // $map = $this->input->post('map');
                // $map = str_replace('width="600"','width="100%"',$map);
                // $map = str_replace('height="450"','height="123"',$map);

                $data_insert = array(
                    'nama'       => strip_tags($this->input->post('nama')),
                    'alamat'     => strip_tags($this->input->post('alamat')),
                    'telepon'    => strip_tags($this->input->post('telepon')),
                    'fax'        => strip_tags($this->input->post('fax')),
                    'email'      => strip_tags($this->input->post('email')),
                    // 'map'        => $map,
                    'is_publish' => strip_tags($this->input->post('is_publish')),
                );

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {
                    insert_log('Tambah menu <em>'.$data_insert['menu'].'</em>');
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
        $this->template->write_view('content', $this->folder.'/kontak_kami/form', $data, true);
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

        $data['title'] = "Tanggapi Saran";
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

            if ( $simpan ) {
                // $map = $this->input->post('map');
                // $map = str_replace('width="600"','width="100%"',$map);
                // $map = str_replace('height="450"','height="123"',$map);

                $data_update = array(
                    'nama'       => strip_tags($this->input->post('nama')),
                    'alamat'     => strip_tags($this->input->post('alamat')),
                    'telepon'    => strip_tags($this->input->post('telepon')),
                    'fax'        => strip_tags($this->input->post('fax')),
                    'email'      => strip_tags($this->input->post('email')),
                    // 'map'        => $map,
                    'is_publish' => strip_tags($this->input->post('is_publish')),
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
        $this->template->write('title', 'Tanggapi '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/kontak_kami/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
