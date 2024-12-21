<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class Kegiatan extends MY_Controller {
    var $page_title = 'Kelola Kegiatan';
    var $column_datatable = array('id_kegiatan', 'judul','judul_en','tanggal','keterangan','keterangan_en','id_bidang');
    var $folder         = 'backend/kegiatan';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'kegiatan_model', 'app_model');
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
                        'field' => 'tanggal',
                        'label' => 'Tanggal',
                        'rules' => 'required'
                    ),
                
                    array(
                        'field' => 'keterangan',
                        'label' => 'Keterangan',
                        'rules' => 'required|max_length[65535]'
                    ),
                
                    array(
                        'field' => 'keterangan_en',
                        'label' => 'Keterangan En',
                        'rules' => 'required|max_length[65535]'
                    ),
                
                    array(
                        'field' => 'id_bidang',
                        'label' => 'Id Bidang',
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
                    'judul' => strip_tags($this->input->post('judul')),
                    'judul_en' => strip_tags($this->input->post('judul_en')),
                    'tanggal' => $this->input->post('tanggal'),
                    'keterangan' => $this->input->post('keterangan'),
                    'keterangan_en' => $this->input->post('keterangan_en'),
                    'id_bidang' => $this->input->post('id_bidang'),
                );

                $insert = $this->app_model->insert_data($data_insert);
                
                if ( $insert ) {
                    if(!empty($_FILES['userFiles']['name'])){
                        $filesCount = count($_FILES['userFiles']['name']);
                        for($i = 0; $i < $filesCount; $i++){
                            $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                            $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                            $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                            $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                            $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                            $bidang = $this->global_model->get_by_id_array('tbl_bidang','id_bidang',$data_insert['id_bidang']);
                            $uploadPath = 'upload/kegiatan/'.$bidang['bidang'].'/';

                            if ( !is_dir($uploadPath) ) {
                                mkdir($uploadPath, 0755, true);
                            }
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'gif|jpg|png';
                            
                            $this->load->library('upload', $config);
                            $this->load->library('image_lib');
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('userFile')){
                                $fileData = $this->upload->data();
                                $uploadData[$i]['nama'] = $fileData['file_name'];
                                $uploadData[$i]['id_kegiatan'] = $insert;
                                $uploadData[$i]['is_default'] = 0;

                                $size[$i] = getimagesize($fileData['full_path']);
                                $maxWidth = 1000;
                                $maxHeight = 1000;
                                if ($size[$i][0] > $maxWidth || $size[$i][1] > $maxHeight){
                                    $resize_real[$i] = array(
                                    'source_image'  => $fileData['full_path'], 
                                    'width'         => 1000,
                                    );
                                    $this->image_lib->initialize($resize_real[$i]);
                                    if ( ! $this->image_lib->resize()){
                                        $errMsg = $this->image_lib->display_errors('<li>','</li>');
                                    }
                                    else{
                                        $errMsg = $fileData;
                                    }
                                }
                            }
                        }
                        
                        if(!empty($uploadData)){
                            $insert_foto = $this->global_model->insert_foto('tbl_fotokegiatan', $uploadData);
                        }
                    }
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
        $this->template->write_view('content', $this->folder.'/form', $data, true);
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
                    'judul' => strip_tags($this->input->post('judul')),
                    'judul_en' => strip_tags($this->input->post('judul_en')),
                    'tanggal' => $this->input->post('tanggal'),
                    'keterangan' => $this->input->post('keterangan'),
                    'keterangan_en' => $this->input->post('keterangan_en'),
                    'id_bidang' => $this->input->post('id_bidang'),
                );
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
                    if(!empty($_FILES['userFiles']['name'])){
                        $filesCount = count($_FILES['userFiles']['name']);
                        for($i = 0; $i < $filesCount; $i++){
                            $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                            $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                            $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                            $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                            $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                            $bidang = $this->global_model->get_by_id_array('tbl_bidang','id_bidang',$data_update['id_bidang']);
                            $uploadPath = 'upload/kegiatan/'.$bidang['bidang'].'/';
                            if ( !is_dir($uploadPath) ) {
                                mkdir($uploadPath, 0755, true);
                            }
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'gif|jpg|png|jpeg';
                            
                            $this->load->library('upload', $config);
                            $this->load->library('image_lib');
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('userFile')){
                                $fileData = $this->upload->data();
                                $uploadData[$i]['nama'] = $fileData['file_name'];
                                $uploadData[$i]['id_kegiatan'] = $id;
                                $uploadData[$i]['is_default'] = 0;

                                $size[$i] = getimagesize($fileData['full_path']);
                                $maxWidth = 1000;
                                $maxHeight = 1000;
                                if ($size[$i][0] > $maxWidth || $size[$i][1] > $maxHeight){
                                    $resize_real[$i] = array(
                                    'source_image'  => $fileData['full_path'], 
                                    'width'         => 1000,
                                    );
                                    $this->image_lib->initialize($resize_real[$i]);
                                    if ( ! $this->image_lib->resize()){
                                        $errMsg = $this->image_lib->display_errors('<li>','</li>');
                                    }
                                    else{
                                        $errMsg = $fileData;
                                    }
                                }
                            }else{
                                $simpan = false;
                                $errMsg = $this->upload->display_errors('<li>','</li>');
                            }
                        }
                        
                        if(!empty($uploadData)){
                            $insert_foto = $this->global_model->insert_foto('tbl_fotokegiatan', $uploadData);
                        }
                    }
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

    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

    function delete_foto($id,$id_kegiatan){
        $url = $_SESSION['url'];
        $this->load->model('global_model');
        $delete = $this->global_model->delete_data('tbl_fotokegiatan', 'id_fotokegiatan', $id);
        if($delete){
            unlink($_SESSION['url']);
            unset($_SESSION['url']);
            redirect(base_url().$this->module.'/edit/'.$id_kegiatan);
        }
    }

    function default_foto($id_fotokegiatan,$id_kegiatan){
        $this->load->model('global_model');
        $reset_default = $this->global_model->update_data('tbl_fotokegiatan', 'id_kegiatan', $id_kegiatan, array('is_default' => 0));
        if($reset_default){
            $this->global_model->update_data('tbl_fotokegiatan', 'id_fotokegiatan', $id_fotokegiatan, array('is_default' => 1));
            redirect(base_url().$this->module.'/edit/'.$id_kegiatan);
        }
    }
}
