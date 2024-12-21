<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class Pelanggan extends MY_Controller {
    var $page_title       = 'Master Pelanggan';
    var $column_datatable = array('id_admin', 'npwp', 'nama', 'alamat', 'id_perusahaan', 'email', 'status');
    var $folder           = 'backend/master';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'pelanggan_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index(){
        $module =$this->module;
        $script = '
            var active_id = \'\';
            $(function () {
                var oTable = $("#datatable").DataTable({
                    responsive: {
                        details: {
                            type: "column",
                            target: -1
                        }
                    },
                     columnDefs: [ {
                        className: "control",
                        orderable: false,
                        targets:   -1
                    }],
                    "order": [[ 0, "desc" ]],
                    dom: "Bfrtip",
                    buttons: [
                        { text: "<span class=\'fa fa-file-o\'></span> Aktif", className: "btn btn-sm btn-success",
                         action: function ( e, dt, node, config ) {
                            go_aktif_pelanggan();
                        }},
                        { text: "<span class=\'fa fa-file-o\'></span> Non Aktif", className: "btn btn-sm btn-danger",
                         action: function ( e, dt, node, config ) {
                            go_arsip_pelanggan();
                        }}
                    ],
"processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : {
                        "url": "'.base_url().$module.'/getDataTable",
                        "type": "POST"
                    }
                });
                oTable.on( "click", "tr", function () {
                    var objcheck = $(this).children().find(".selectedrow");
                    selectrowtable(objcheck);
                } );
            });
            function selectrowtable(obj) {
                var parentrow = obj.parent().parent();
                if (  active_id != obj.val() ) {
                    $("#datatable tbody tr").removeClass("selected");
                    parentrow.addClass("selected");
                    active_id = obj.val();
                } else {
                        parentrow.removeClass("selected");
                        active_id = "";
                }
            }
            function go_arsip_pelanggan() {
                if ( active_id.length < 1 ) {
                    alert(\'Pilih baris data pada tabel yang ingin diarsipkan!\');
                } else {
                    document.location = "'.base_url().$this->module.'/arsip_pelanggan/" + active_id;
                }
            }
            function go_aktif_pelanggan() {
                if ( active_id.length < 1 ) {
                    alert(\'Pilih baris data pada tabel yang ingin diaktifkan!\');
                } else {
                    document.location = "'.base_url().$this->module.'/aktif_pelanggan/" + active_id;
                }
            }
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
        $this->template->write_view('content', $this->folder.'/pelanggan/datatable', $data, true);
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

    private function valid_form($act = 'add'){
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'id_pelanggan',
                        'label' => 'ID Pelanggan',
                        'rules' => 'integer'
                    ),
                
                    array(
                        'field' => 'no_pelanggan',
                        'label' => 'No Pelanggan',
                        'rules' => 'required|max_length[255]'
                    ),
                
                    array(
                        'field' => 'nama_pelanggan',
                        'label' => 'Nama Pelanggan',
                        'rules' => 'required|max_length[255]'
                    ),
                
                    array(
                        'field' => 'alamat',
                        'label' => 'Alamat',
                        'rules' => 'required|max_length[255]'
                    ),

                    array(
                        'field' => 'instansi',
                        'label' => 'Instansi',
                        'rules' => 'required|max_length[255]'
                    ),

                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|max_length[255]'
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
            $this->valid_form(strtolower(__FUNCTION__));

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            if ( $simpan ) {
                $data_insert = array(
                    'no_pelanggan'      => $this->input->post('no_pelanggan'),
                    'nama_pelanggan'    => strip_tags($this->input->post('nama_pelanggan')),
                    'alamat'            => strip_tags($this->input->post('alamat')),
                    'instansi'          => strip_tags($this->input->post('instansi')),
                    'email'             => $this->input->post('email'),
                    'status'            => 1
                );

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {
                    insert_log('Tambah Pelanggan <em>'.$data_insert['nama_pelanggan'].'</em>');
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
        $this->template->write_view('content', $this->folder.'/pelanggan/form', $data, true);
        $this->template->render();
    }

    function edit($id = 0){
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
                    'no_pelanggan'      => $this->input->post('no_pelanggan'),
                    'nama_pelanggan'    => strip_tags($this->input->post('nama_pelanggan')),
                    'alamat'            => strip_tags($this->input->post('alamat')),
                    'instansi'          => strip_tags($this->input->post('instansi')),
                    'email'             => $this->input->post('email'),
                    'status'            => strip_tags($this->input->post('status'))
                );

                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
                    insert_log('Edit Pelanggan <em>'.$data_update['nama_pelanggan'].'</em>');
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
        $this->template->write_view('content', $this->folder.'/pelanggan/form', $data, true);
        $this->template->render();
    }

    function arsip_pelanggan($id = 0){
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail'] = $this->app_model->get_by_id($id);

        $data_update = array(
            'status' => 0
        );
        $update = $this->app_model->update_data($id, $data_update);

        if ( $update ) {
            insert_log('Mengarsipkan Pelanggan <em>'.$data['detail']['nama_pelanggan'].'</em>');
            redirect(base_url().$module);
        } else {
            $errMsg = 'Data gagal diarsipkan';
        }
    }

    function aktif_pelanggan($id = 0) {
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail'] = $this->app_model->get_by_id($id);

        $data_update = array(
            'status' => 1
        );
        $update = $this->app_model->update_data($id, $data_update);

        if ( $update ) {
            insert_log('Mengaktifkan Pelanggan <em>'.$data['detail']['nama_pelanggan'].'</em>');
            redirect(base_url().$module);
        } else {
            $errMsg = 'Data gagal diaktifkan';
        }
    }

    function delete($id = ''){
        $detail = $this->app_model->get_by_id($id);
        if ( $detail ){
            insert_log('Hapus Pelanggan <em>'.$detail['menu'].'</em>');
        }
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
