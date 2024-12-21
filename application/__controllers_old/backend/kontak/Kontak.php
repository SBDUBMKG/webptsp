<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class Kontak extends MY_Controller {
    var $page_title = 'Kelola Pesan';
    var $column_datatable = array('id_kontak', 'nama','email','pesan','jawaban','tgl_kirim','is_publish');
    var $folder         = 'backend/kontak';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'kontak_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index()
    {
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
                        '.($this->is_write ? '{ text: "<span class=\'fa fa-pencil\'></span> Jawab Pesan", className: "btn btn-sm btn-primary",
                         action: function ( e, dt, node, config ) {
                            go_edit_data();
                        }},' : NULL).'
                        '.($this->is_write ? '{ text: "<span class=\'fa fa-refresh\'></span> Publish", className: "btn btn-sm btn-success",
                         action: function ( e, dt, node, config ) {
                            go_publish_data();
                        }},' : NULL).'
                        '.($this->is_write ? '{ text: "<span class=\'fa fa-refresh\'></span> Unpublish", className: "btn btn-sm btn-warning",
                         action: function ( e, dt, node, config ) {
                            go_unpublish_data();
                        }},' : NULL).'
                        { text: "<span class=\'fa fa-file-o\'></span> Hapus Data", className: "btn btn-sm btn-danger",
                         action: function ( e, dt, node, config ) {
                            go_delete();
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
            function go_edit_data() {
                if ( active_id.length < 1 ) {
                    alert(\'Pilih baris data pada tabel yang ingin diubah!\');
                } else {
                    document.location = "'.base_url().$this->module.'/edit/" + active_id;
                }
            }
            function go_publish_data() {
                if ( active_id.length < 1 ) {
                    alert(\'Pilih baris data pada tabel yang ingin dipublish!\');
                } else {
                    document.location = "'.base_url().$this->module.'/publish/" + active_id;
                }
            }
            function go_unpublish_data() {
                if ( active_id.length < 1 ) {
                    alert(\'Pilih baris data pada tabel yang ingin diunpublish!\');
                } else {
                    document.location = "'.base_url().$this->module.'/unpublish/" + active_id;
                }
            }
            function go_delete() {
                if ( active_id.length < 1 ) {
                    alert(\'Pilih baris data pada tabel yang ingin dihapus!\');
                } else {
                    if ( confirm(\'Apakah anda yakin ingin menghapus data ini?\') ) {
                        document.location = "'.base_url().$this->module.'/delete/" + active_id;
                    }
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
        $this->template->write_view('content', $this->folder.'/datatable', $data, true);
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

    private function valid_form($act = 'add') 
    {
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'nama',
                        'label' => 'Nama',
                        'rules' => 'max_length[100]'
                    ),
                
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'max_length[50]|valid_email'
                    ),
                
                    array(
                        'field' => 'pesan',
                        'label' => 'Pesan',
                        'rules' => 'max_length[65535]'
                    ),
                
                    array(
                        'field' => 'jawaban',
                        'label' => 'Jawaban',
                        'rules' => 'max_length[65535]'
                    ),
                );
        $this->form_validation->set_rules($config);
    }

    function edit($id = 0) 
    {
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
                $data_update = array(    'nama' => strip_tags($this->input->post('nama')),
                'email' => strip_tags($this->input->post('email')),
                'pesan' => $this->input->post('pesan'),
                'jawaban' => $this->input->post('jawaban'),
                'tgl_balas' => date('Y-m-d H:i:s'),
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
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/form', $data, true);
        $this->template->render();
    }

    function publish($id=''){
        $publish = $this->app_model->publish($id);
        redirect(base_url().$this->module);
    }

    function unpublish($id=''){
        $unpublish = $this->app_model->unpublish($id);
        redirect(base_url().$this->module);
    }

    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
