<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class Galeri_ebook extends MY_Controller {
    var $page_title = 'Kelola Galeri Ebook';
    var $column_datatable = array('id_ebook', 'judul','judul_en','tanggal','lampiran');
    var $folder         = 'backend/manajemen_frontend';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'galeri_ebook_model', 'app_model');
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
        $this->template->write_view('content', $this->folder.'/galeri_ebook/datatable', $data, true);
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
                        'rules' => 'max_length[255]'
                    ),
                
                    array(
                        'field' => 'judul_en',
                        'label' => 'Judul En',
                        'rules' => 'max_length[255]'
                    ),
                
                    array(
                        'field' => 'tanggal',
                        'label' => 'Tanggal',
                        'rules' => 'max_length[255]'
                    )
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
                    'tanggal' => strip_tags($this->input->post('tanggal')),
                );

                $this->load->library('upload');
                $tmp_name = $_FILES['lampiran']['tmp_name'];
                $tmp_name_sampul = $_FILES['sampul']['tmp_name'];
                if ( !empty($tmp_name_sampul) ) {
                    $extension_expl_sampul = explode('.', $_FILES['sampul']['name']);
                    $extension_sampul = $extension_expl_sampul[count($extension_expl_sampul)-1];
                    $file_name_sampul = date("YmdHis");

                    $upload_conf_sampul = array(
                        'upload_path'       => './upload/ebook/',
                        'allowed_types'     => 'gif|jpg|jpeg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name_sampul.'.'.$extension_sampul,
                    );
                    $this->upload->initialize($upload_conf_sampul);
                    if ( !$this->upload->do_upload('sampul') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $this->load->library('image_lib');
                        $upload_data_sampul = $this->upload->data();
                        $size = getimagesize($upload_data_sampul['full_path']);
                        $maxWidth = 240;
                        $maxHeight = 300;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data_sampul['full_path'], 
                            'width'         => 100,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data_sampul;
                            }
                        }
                        $data_insert['sampul'] = $upload_conf_sampul['file_name'];
                    }
                }
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['lampiran']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './upload/ebook/',
                        'allowed_types'     => 'pdf',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('lampiran') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $data_insert['lampiran'] = $upload_conf['file_name'];

                        $insert = $this->app_model->insert_data($data_insert);                  
                        if ( $insert ) {                        							insert_log('Tambah galeri ebook<br/><p><em>'.$data_insert['judul'].'</em></p>');
                            redirect(base_url().$module);                   
                        } else {                        
                            $errMsg = 'Data gagal disimpan';                    
                        }
                    }
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
        $this->template->write_view('content', $this->folder.'/galeri_ebook/form', $data, true);
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
                    'tanggal' => strip_tags($this->input->post('tanggal')),
                );

                $this->load->library('upload');
                $tmp_name = $_FILES['lampiran']['tmp_name'];
                $tmp_name_sampul = $_FILES['sampul']['tmp_name'];
                if ( !empty($tmp_name_sampul) ) {
                    $extension_expl_sampul = explode('.', $_FILES['sampul']['name']);
                    $extension_sampul = $extension_expl_sampul[count($extension_expl_sampul)-1];
                    $file_name_sampul = date("YmdHis");

                    $upload_conf_sampul = array(
                        'upload_path'       => './upload/ebook/',
                        'allowed_types'     => 'gif|jpg|jpeg|png',
                        'max_size'          => '30000',
                        'file_name'         => $file_name_sampul.'.'.$extension_sampul,
                    );
                    $this->upload->initialize($upload_conf_sampul);
                    if ( !$this->upload->do_upload('sampul') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $this->load->library('image_lib');
                        $upload_data_sampul = $this->upload->data();
                        $size = getimagesize($upload_data_sampul['full_path']);
                        $maxWidth = 240;
                        $maxHeight = 300;
                        if ($size[0] > $maxWidth || $size[1] > $maxHeight){
                            $resize_real = array(
                            'source_image'  => $upload_data_sampul['full_path'], 
                            'width'         => 100,
                            );
                            $this->image_lib->initialize($resize_real);
                            if ( ! $this->image_lib->resize()){
                                $errMsg = $this->image_lib->display_errors('<li>','</li>');
                            }
                            else{
                                $errMsg = $upload_data_sampul;
                            }
                        }
                        $data_update['sampul'] = $upload_conf_sampul['file_name'];
                    }
                }
                if ( !empty($tmp_name) ) {
                    $extension_expl = explode('.', $_FILES['lampiran']['name']);
                    $extension = $extension_expl[count($extension_expl)-1];
                    $file_name = date("YmdHis");

                    $upload_conf = array(
                        'upload_path'       => './upload/ebook/',
                        'allowed_types'     => 'pdf',
                        'max_size'          => '30000',
                        'file_name'         => $file_name.'.'.$extension,
                    );
                    $this->upload->initialize($upload_conf);
                    if ( !$this->upload->do_upload('lampiran') ) {
                        $simpan = false;
                        $errMsg = $this->upload->display_errors('<li>','</li>');
                    } else {
                        $upload_data = $this->upload->data();
                        $data_update['lampiran'] = $upload_conf['file_name'];
                        $update = $this->app_model->update_data($id,$data_update);
                        if ( $update ) {							insert_log('Edit galeri ebook<br/><p><em>'.$data_update['judul'].'</em></p>');
                            redirect(base_url().$module);
                        } else {
                            $errMsg = 'Data gagal disimpan';
                        }
                    }
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
        $this->template->write_view('content', $this->folder.'/galeri_ebook/form', $data, true);
        $this->template->render();
    }
    function delete($id = '') {		
		$detail = $this->app_model->get_by_id($id);		
		if ( $detail )
			insert_log('Hapus galeri ebook<br/><p><em>'.$detail['judul'].'</em></p>');
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
