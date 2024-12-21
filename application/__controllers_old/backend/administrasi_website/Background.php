<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class Background extends MY_Controller {
    var $page_title       = 'Background';
    var $column_datatable = array('id_background', 'tema','background','is_active');
    var $folder           = 'backend/administrasi_website';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'background_model', 'app_model');
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
                        '.($this->is_write ? '{ text: "<span class=\'fa fa-plus-circle\'></span> Tambah Data", className: "btn btn-sm btn-primary",
                         action: function ( e, dt, node, config ) {
                            go_add_data();
                        }},' : NULL).'
                        '.($this->is_write ? '{ text: "<span class=\'fa fa-pencil\'></span> Edit Data", className: "btn btn-sm btn-warning",
                         action: function ( e, dt, node, config ) {
                            go_edit_data();
                        }},' : NULL).'
                        '.($this->is_write ? '{ text: "<span class=\'fa fa-refresh\'></span> Active", className: "btn btn-sm btn-success",
                         action: function ( e, dt, node, config ) {
                            go_active_data();
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
            function go_add_data() {
                document.location = "'.base_url().$this->module.'/add";
            }
            function go_edit_data() {
                if ( active_id.length < 1 ) {
                    alert(\'Pilih baris data pada tabel yang ingin diubah!\');
                } else {
                    document.location = "'.base_url().$this->module.'/edit/" + active_id;
                }
            }
            function go_active_data() {
                if ( active_id.length < 1 ) {
                    alert(\'Pilih baris data pada tabel yang ingin diaktifkan!\');
                } else {
                    document.location = "'.base_url().$this->module.'/active/" + active_id;
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
        $this->template->write_view('content', $this->folder.'/background/datatable', $data, true);
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
    private function valid_form($act = 'add') {
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'tema',
                        'label' => 'Tema',
                        'rules' => 'max_length[100]'
                    ),
                
                    array(
                        'field' => 'background',
                        'label' => 'Banner',
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
                $this->load->library('upload');
                $this->load->library('image_lib');
                $tmp_name = $_FILES['background']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['background']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => 'resources/frontend/images/',
                        'allowed_types'     => 'gif|jpg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('background') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 1366;
                        $maxHeight = 768;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'], 
                            'width'         => 768,
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
                'tema' => strip_tags($this->input->post('tema')),
                'background' => $upload_conf['file_name'],
                );

                $insert = $this->app_model->insert_data($data_insert);
                if ( $insert ) {					insert_log('Tambah background');
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
        $this->template->write_view('content', $this->folder.'/background/form', $data, true);
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
                $tmp_name = $_FILES['background']['tmp_name'];
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['background']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => 'resources/frontend/images/',
                        'allowed_types'     => 'gif|jpg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('background') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $size = getimagesize($upload_data['full_path']);
                        $maxWidth = 1366;
                        $maxHeight = 768;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data['full_path'], 
                            'width'         => 768,
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
                $data_update = array( 
                    'tema' => strip_tags($this->input->post('tema')),
                    'background' => $upload_conf['file_name'],
                );
                
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {					insert_log('Edit background');
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
        $this->template->write_view('content', $this->folder.'/background/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {		
		insert_log('Hapus background');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

    function active($id=''){		insert_log('Ubah status background');
        $unset = $this->app_model->active_background($id);
        redirect(base_url().$this->module);
    }
}
