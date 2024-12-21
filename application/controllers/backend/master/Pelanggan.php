<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends MY_Controller {
    var $page_title       = 'Master Pelanggan';
    var $column_datatable = array('id_admin', 'npwp', 'nama', 'tbl_admin.alamat', 'tbl_admin.id_perusahaan', 'tbl_admin.email', 'status');
    var $folder           = 'backend/master';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->helper('general_helper'); // Script yang ditambahkan Rahmat, 3 Juli 2020
        $this->load->model($this->folder.'/'.'pelanggan_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index(){
        $module =$this->module;
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)
        $script = '
			$(function () {
                var active_id = \'\';
				$("#datatable").DataTable({
                    '.($this->is_write ? '"aoColumnDefs": [{"bSortable": false, "aTargets": [2]}],' : NULL).'
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : "'.base_url().$this->module.'/getDataTable"
                });
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
                    function go_detail() {
                        if ( active_id.length < 1 ) {
                            alert(\'Pilih baris data pada tabel yang ingin diaktifkan!\');
                        } else {
                            document.location = "'.base_url().$this->module.'/detail/" + active_id;
                        }
                    }
			';
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)

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

    private function valid_form($perusahaan){
        $this->load->library('form_validation');
        $config =  [['field' => 'nama', 'label' => 'Nama', 'rules' => 'required'],            
                    ['field' => 'email','label' => 'Email','rules' => 'required'],
                    ['field' => 'npwp', 'label' => 'NPWP','rules' => 'required'],
                    ['field' => 'no_ktp','label' => 'No KTP', 'rules' => 'required'],
                    ['field' => 'tempat_lahir','label' => 'Tempat Lahir','rules' => 'required'],
                    ['field' => 'tanggal_lahir','label' => 'Tanggal Lahir','rules' => 'required'],
                    ['field' => 'jenis_kelamin','label' => 'Jenis Kelamin','rules' => 'required'],
                    ['field' => 'pekerjaan','label' => 'Pekerjaan','rules' => 'required'],
                    ['field' => 'alamat','label' => 'Alamat','rules' => 'required'],
                    ['field' => 'id_pendidikan','label' => 'Pendidikan','rules' => 'required'],
                    ['field' => 'id_provinsi','label' => 'Provinsi','rules' => 'required'],
                    ['field' => 'id_kabupaten','label' => 'Kabupaten','rules' => 'required'],
                    ['field' => 'id_kecamatan','label' => 'Kecamatan','rules' => 'required'],
                    ['field' => 'id_kelurahan','label' => 'Kelurahan','rules' => 'required'],
                    ['field' => 'no_hp','label' => 'No. Handphone','rules' => 'required'],
                   ];
        if($perusahaan) {
            $config [] = ['field' => 'nama_perusahaan','label' => 'Nama Perusahaan','rules' => 'required'];
            $config [] = ['field' => 'alamat_perusahaan','label' => 'Alamat Perusahaan','rules' => 'required'];
            $config [] = ['field' => 'provinsi_perusahaan','label' => 'Provinsi Perusahaan','rules' => 'required'];
            $config [] = ['field' => 'kabupaten_perusahaan','label' => 'Kabuaten Perusahaan','rules' => 'required'];
            $config [] = ['field' => 'kecamatan_perusahaan','label' => 'Kecamatan Perusahaan','rules' => 'required'];
            $config [] = ['field' => 'kelurahan_perusahaan','label' => 'Kelurahan Perusahaan','rules' => 'required'];
            $config [] = ['field' => 'nama_perusahaan','label' => 'Nama Perusahaan','rules' => 'required'];
        }
        //die(json_encode($config, JSON_PRETTY_PRINT));
        $this->form_validation->set_rules($config);
    }

    /*function add(){
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
    } */

    function edit($id = 0){
        $this->load->model('global_model');
        $module = $this->module;
        $data['detail'] = $this->app_model->get_by_id($id);
        $data['detail_perusahaan'] = $this->db->get_where('tbl_perusahaan', ['id_perusahaan' => $data['detail']['id_perusahaan']])->row_array();        
        if ( !$data['detail'] ) {
            show_404();
            return;
        }
        $data['title'] = "Edit Data";
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;

        if($_POST)
        {
            //die(var_dump($this->input->post()));
            $simpan         = true;
            $this->valid_form($data['detail_perusahaan']);
            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }
            if ( $simpan ) {
                $data_update = [
                    'nama' => strip_tags($this->input->post('nama')),
                    'email'=> strip_tags($this->input->post('email')),
                    'npwp' => strip_tags($this->input->post('npwp')),                    
                    'no_ktp' => strip_tags($this->input->post('no_ktp')), 
                    'tempat_lahir'=>strip_tags($this->input->post('tempat_lahir')), 
                    'tanggal_lahir'=>strip_tags(date('Y-m-d', strtotime($this->input->post('tanggal_lahir')))), 
                    'jenis_kelamin'=>strip_tags($this->input->post('jenis_kelamin')), 
                    'pekerjaan'=>strip_tags($this->input->post('pekerjaan')), 
                    'id_pendidikan'=>strip_tags($this->input->post('id_pendidikan')), 
                    'alamat'=>strip_tags($this->input->post('alamat')), 
                    'id_kelurahan'=>strip_tags($this->input->post('id_kelurahan')), 
                    'id_kecamatan'=>strip_tags($this->input->post('id_kecamatan')), 
                    'id_kabupaten'=>strip_tags($this->input->post('id_kabupaten')), 
                    'id_provinsi'=>strip_tags($this->input->post('id_provinsi')), 
                    'kode_pos'=>strip_tags($this->input->post('kode_pos')), 
                    'no_telepon'=>strip_tags($this->input->post('no_telepon')), 
                    'no_hp'=>strip_tags($this->input->post('no_hp')),                    
                ];  
                $update = $this->app_model->update_data($id, $data_update);
                if ( $update ) {
                    insert_log('Edit Pelanggan <em>'.$data['detail']['id_admin'].'</em>');                    
                } else {
                    $errMsg = 'Data gagal disimpan data pelanggan';
                }                            
                if(isset($data['detail_perusahaan'])) {
                    $perusahaan_update = [
                        'perusahaan' => strip_tags($this->input->post('nama_perusahaan')),
                        'alamat' => strip_tags($this->input->post('alamat_perusahaan')),
                        'id_provinsi' => strip_tags($this->input->post('provinsi_perusahaan')),
                        'id_kabupaten' => strip_tags($this->input->post('kabupaten_perusahaan')),
                        'id_Kecamatan' => strip_tags($this->input->post('kecamatan_perusahaan')),
                        'id_kelurahan' => strip_tags($this->input->post('kelurahan_perusahaan')),
                        'kode_pos' => strip_tags($this->input->post('kode_pos_perusahaan')),
                        'no_telepon' => strip_tags($this->input->post('no_telepon_perusahaan')),
                        'fax' => strip_tags($this->input->post('fax')),
                        'email' => strip_tags($this->input->post('email_perusahaan')),    
                    ];
                    $update = $this->db->update('tbl_perusahaan', $perusahaan_update, ['id_perusahaan'=>$data['detail_perusahaan']['id_perusahaan']]);
                    if ( $update ) {
                        insert_log('Edit Perusahaan <em>'.$data['detail_perusahaan']['id_perusahaan'].'</em>');                        
                    } else {
                        $errMsg = 'Data gagal disimpan data perusahaan';
                    }                    
                }                
                if($update) redirect(base_url().$module);
            }                       
        }
        $data['page_title'] = $this->page_title;
        $data['id'] = $id;
        $data['errMsg'] = $errMsg;
        $data['mode'] = 'edit';
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        //$this->template->write_view('content', $this->folder.'/pelanggan/form', $data, true);
        $this->template->write_view('content', $this->folder.'/pelanggan/detail', $data, true);
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

    /*function delete($id = ''){
        $detail = $this->app_model->get_by_id($id);
        if ( $detail ){
            insert_log('Hapus Pelanggan <em>'.$detail['menu'].'</em>');
        }
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }*/

    function detail($id = 0){
        $this->load->model('global_model');
        $data['detail'] = $this->app_model->get_by_id($id);;
        $data['detail_perusahaan'] = $this->db->get_where('tbl_perusahaan', ['id_perusahaan' => $data['detail']['id_perusahaan']])->row_array();
        if ( !$data['detail'] ) {
            show_404();
            return;
        }
        $data['title'] = "Detail Pelanggan";
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;


        $data['page_title'] = $this->page_title;
        $data['id'] = $id;
        $data['errMsg'] = $errMsg;
        $data['mode'] = 'view';
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/pelanggan/detail', $data, true);
        $this->template->render();
    }
}
