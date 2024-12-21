<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends MY_Controller {
    var $page_title       = 'Pengaduan';
    var $column_datatable = array('id_pengaduan', 'nama','email','waktu_pengaduan','pengaduan', 'is_response','is_publish');
    var $folder           = 'backend/pengaduan_saran';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->helper('general_helper'); // Script yang ditambahkan Rahmat, 6 Juli 2020
        $this->load->model($this->folder.'/'.'pengaduan_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index() {
        $module =$this->module;

        $curr_lang = $this->session->userdata('language');
        $this->lang->load('backend/complaint/datatable', $curr_lang);

        $script = '
			$(function () {
				$("#datatable").DataTable({
                    '.($this->is_write ? '"aoColumnDefs": [{"bSortable": false, "aTargets": [2]}],' : NULL).'
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
		    "order": [ 0, "desc" ],
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
        $this->template->write('title', $this->lang->line('title.page'));
        $this->template->write_view('content', $this->folder.'/pengaduan/datatable', $data, true);
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
                        'field' => 'response',
                        'label' => 'Response',
                        'rules' => 'max_length[65535]'
                    ),
                );
        $this->form_validation->set_rules($config);
    }

    function add(){
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

            if ( $simpan ) {
                $data_insert = array(
                    'id_admin'          => $_SESSION['id_admin'],
                    'nama'              => $_SESSION['nama'],
                    'email'             => $_SESSION['email'],
                    'pengaduan'         => $this->input->post('pengaduan'),
                    'waktu_pengaduan'   => date('Y-m-d H:i:s'),
                );

                $data['link_action'] = site_url('backend/login');
                $data['nama'] = $_SESSION['nama'];
                $admin_ptsp = $this->global_model->get_by_id('tbl_admin','id_role',3);
                $to = $admin_ptsp->email;
                $subject = 'Pengaduan masuk baru';
                $message = $this->load->view('email/_header', '', true);
                $message .= $this->load->view('email/pengaduan_masuk_admin_ptsp',$data, true);
                $message .= $this->load->view('email/_footer', '', true);
                send_email($to,$subject,$message);

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
        $this->template->write_view('content', $this->folder.'/pengaduan/form_add', $data, true);
        $this->template->render();
    }

    function edit($id){
        $this->load->model('global_model');
        $data['detail'] = $this->app_model->get_by_id($id);
        if ( !$data['detail'] ) {
            show_404();
            return;
        }
        $module = $this->module;
        $data['title']      = "Edit Data";
        $data['url_back']   = "window.location.href='".base_url().$module."'";
        $errMsg = NULL;

        if($_POST)
        {
            $data_post      = $this->input->post();
            $data['detail'] = $data_post;
            $data_insert    = array();
            $simpan         = true;

            if ( $simpan ) {
                $data_update = array(
                    'id_admin'          => $_SESSION['id_admin'],
                    'nama'              => $_SESSION['nama'],
                    'email'             => $_SESSION['email'],
                    'pengaduan'         => $this->input->post('pengaduan'),
                    'waktu_pengaduan'   => date('Y-m-d H:i:s'),
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
        $data['errMsg']     = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->add_css('resources/plugins/summernote/summernote.css');
        $this->template->add_js('resources/plugins/summernote/summernote.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/pengaduan/form_add', $data, true);
        $this->template->render();
    }

    function response($id = 0) {
        $this->load->model('global_model');

        $current_lang = $this->session->userdata('language');
        $data['id_role'] = $this->session->userdata('id_role');

        $module = $this->module;

        $this->lang->load('backend/complaint/respond', $current_lang);

        $data['detail'] = $this->app_model->get_by_id($id);
        if ( !$data['detail'] ) {
            show_404();
            return;
        }

        $data['title'] = $this->lang->line('title.page');
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;

        if($_POST) {
            $simpan         = true;
            $send           = false;

            $this->valid_form('edit');

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            if ( $simpan ) {
                $data_update = array(
                    'response'   => $this->input->post('response'),
                    'is_publish' => $this->input->post('is_publish'),
                );

                if (($data['id_role'] == 1 || $data['id_role'] == 2 || $data['id_role'] == 3) && ($data['detail']['is_response'] == 0)  ) {
                    $data_update['is_response'] = 1; 
                    $send = true;
                }

                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
                    if ($send) {
                        $data['detail'] = $this->app_model->get_by_id($id);
                        $to = $data['detail']['email'];
                        $subject = 'Respon Pengaduan';
                        $message = $this->load->view('email/_header', '', true);
                        $message .= $this->load->view('email/pengaduan_masuk_pengadu_ptsp',$data['detail'], true);
                        $message .= $this->load->view('email/_footer', '', true);
                        send_email($to,$subject,$message);
                    }
                    redirect(base_url().$module);
                } else {
                    // $errMsg = $this->lang->line('form.msg.error');
                    $errMsg = 'Data gagal disimpan';
                }
            }
            
        }

        $data['page_title'] = $this->lang->line('title.page.parent');
        $data['id'] = $id;
        $data['errMsg'] = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->add_css('resources/plugins/summernote/summernote.css');
        $this->template->add_js('resources/plugins/summernote/summernote.min.js');
        $this->template->write('title', $this->lang->line('title.page'));
        $this->template->write_view('content', $this->folder.'/pengaduan/form', $data, true);
        $this->template->render();
    }

    function detail($id = 0) {
        $this->load->model('global_model');
        $module = $this->module;

        $data['detail'] = $this->app_model->get_by_id($id);
        if ( !$data['detail'] ) {
            show_404();
            return;
        }

        $data['title'] = "Respon Pengaduan";
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;

        $data['page_title'] = $this->page_title;
        $data['id'] = $id;
        $data['errMsg'] = $errMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->add_css('resources/plugins/summernote/summernote.css');
        $this->template->add_js('resources/plugins/summernote/summernote.min.js');
        $this->template->write('title', 'Respon '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/pengaduan/detail', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
