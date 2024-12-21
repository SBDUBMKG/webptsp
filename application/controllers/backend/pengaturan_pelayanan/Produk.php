<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

    // mengubah page title dari 'Produk' Menjadi 'Parameter Layanan'
    //	var $page_title         = 'Produk';

    var $page_title         = 'Parameter Layanan';
    // baris terakhir perubahan. Perbaikan oleh : Nurhayati Rahayu (22052020)
    var $column_datatable   = array('id_layanan', 'layanan','satuan','harga', 'role', 'berat', 'satuan_berat', 'nama_produk', 'is_produk');
    var $folder             = 'backend/pengaturan_pelayanan';
    var $module             = '';

    function __construct() {
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->helper('general_helper'); // Script yang ditambahkan Rahmat, 3 Juli 2020
        $this->load->model($this->folder.'/'.'produk_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index() {
        $module =$this->module;

        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (21 Mei 2024)
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
        //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (21 Mei 2024)

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
        $this->template->write_view('content', $this->folder.'/produk/datatable', $data, true);
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
                        'field' => 'layanan',
                        'label' => 'Jenis Layanan',
                        'rules' => 'required|max_length[200]'
                    ),
                );
        $this->form_validation->set_rules($config);
    }

    function edit($id = 0) {
        $this->load->model('global_model');
        $module = $this->module;
        $errMsg = NULL;
        $sccMsg = NULL;
        $data['detail'] = $this->app_model->get_by_id($id);

        if ( !$data['detail'] ) {
            show_404();
            return;
        }

        $data['title'] = "Edit Data";
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";
        $errMsg = NULL;

        $data['get_field_data'] = get_field_data(
            'tbl_detail_permohonan',
            ' AND COLUMN_NAME NOT IN ("id_layanan", "id_permohonan", "harga", "status", "download", "catatan", "mengambil_alat_di_ptsp", "menyerahkan_sampel", "is_survey", "ambil_di_ptsp")'
        );
        $jumlah_kolom = count($data['get_field_data']);
        $jumlah_kolom = $jumlah_kolom - 1;

        if($_POST) {
            $data_post      = $this->input->post();
            $simpan         = true;

            $this->valid_form('edit');

            if ( $this->form_validation->run() == FALSE ) {
                $simpan = false;
                $errMsg = '<ul>'.validation_errors('<li>','</li>').'</ul>';
            }

            $show_coloumn = array();
            $show_coloumn_en = array();
            for ($i=1; $i <= $jumlah_kolom; $i++) {
                $show_coloumn_ = $this->input->post('show_coloumn_'.$i);
                if( !empty($show_coloumn_)) {
                    $nama_kolom = $this->input->post('show_coloumn_'.$i);
                    $label      = $this->input->post('label_'.$i);
                    $show_coloumn[$nama_kolom] = $label;

                    $label_en      = $this->input->post('label_en_'.$i);

                    $show_coloumn_en[$nama_kolom] = $label_en;
                }
            }

            $show_coloumn    = json_encode($show_coloumn);
            $show_coloumn_en = json_encode($show_coloumn_en);

            if ( $simpan ) {
                $data_update = [
                    'layanan'                   => strip_tags($this->input->post('layanan')),
                    'satuan'                    => strip_tags($this->input->post('satuan')),
                    'harga'                     => strip_tags($this->input->post('harga')),
                    'penanggung_jawab'          => strip_tags($this->input->post('penanggung_jawab')),
                    'nama_produk'               => strip_tags($this->input->post('nama_produk')),
                    'berat'                     => strip_tags($this->input->post('berat')),
                    'satuan_berat'              => strip_tags($this->input->post('satuan_berat')),
                    'download'                  => strip_tags($this->input->post('download')),
                    'menyerahkan_sampel'        => strip_tags($this->input->post('menyerahkan_sampel')),
                    'mengambil_alat_di_ptsp'    => strip_tags($this->input->post('mengambil_alat_di_ptsp')),
                    'estimasi'                  => strip_tags($this->input->post('estimasi')),
                    'display_coloumn'           => $show_coloumn,
                    'display_coloumn_en'           => $show_coloumn_en,
                ];

                $config['upload_path']      = './upload/dokumen/';
                $config['encrypt_name']     = TRUE;
                $config['allowed_types']    = 'doc|docx|pdf|xls|xlsx|ppt|pptx';
                $config['file_ext_tolower'] = TRUE;

                $this->load->library('upload' );

                // var_dump(FCPATH."/upload/dokumen/");
                // $config2 = array(
                //         'upload_path'               => './upload/dokumen/',
                //         'allowed_types'             => 'jpg|jpeg|png|gif',
                //         'max_size'                  => 10000,
                //         'file_name'                 => "test.txt",
                //         'overwrite'                 => true
                // );


                // $this->load->initialize( $config2);
                $contoh_name = time()."_".$_FILES['contoh']['name'];
                if(move_uploaded_file($_FILES['contoh']['tmp_name'],'upload/dokumen/'.$contoh_name)){
                    $data_update['contoh']=$contoh_name;
                }



                $this->load->initialize( $config);


                // jika tidak upload
                $do_upload = $this->upload->do_upload('file_dokumen');
                if ( ! $do_upload ) {
                    $file_download = [ 'file_download' => NULL ];
                    if ( $_POST['download'] == 'Tidak' ) {
                        $this->session->set_userdata('message_1', 'Data berhasil disimpan');
                        $update = $this->app_model->update_data($id, array_merge($data_update, $file_download));
                    } elseif ( $_POST['download'] == 'Ya' && $_POST['file_download'] ) {
                        $this->session->set_userdata('message_2', $this->upload->display_errors());
                        $update = $this->app_model->update_data($id, array_merge($data_update, $file_download));
                    } elseif ( $_POST['download'] == 'Ya' && !empty( $data['detail']['file_download'] ) ) {
                        $this->session->set_userdata('message_1', 'Data berhasil disimpan');
                        $update = $this->app_model->update_data($id, $data_update);
                    } else {
                        $this->session->set_userdata('message_1', 'Data berhasil disimpan');
                        $update = $this->app_model->update_data($id, $data_update);
                    }
                } else {
                    $this->session->set_userdata('message_1', 'Data berhasil disimpan');
                    $file_download = [ 'file_download' => $this->upload->data('file_name') ];
                    $update = $this->app_model->update_data($id, array_merge($data_update, $file_download));
                }

                redirect(current_url());
            }
        }
        $message_1 = $this->session->userdata('message_1');
        $message_2 = $this->session->userdata('message_2');
        if ( !empty($message_1) ) {
            $sccMsg = $this->session->userdata('message_1');
            $this->session->unset_userdata('message_1');
        } else if ( !empty($message_2) ) {
            $errMsg = $this->session->userdata('message_2');
            $this->session->unset_userdata('message_2');
        }

        $data['page_title'] = $this->page_title;
        $data['id'] = $id;
        $data['errMsg'] = $errMsg;
        $data['sccMsg'] = $sccMsg;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Edit '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/produk/form', $data, true);
        $this->template->render();
        // $this->output
        // ->set_status_header(200)
        // ->set_content_type('application/json','utf-8')
        // ->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }

    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

    function test(){
        $data2 = [
            'nama' =>  123
        ];
        $data1 = [
            'kamu' => 11
        ];
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json','utf-8')
        ->set_output(json_encode(array_merge($data1, $data2), JSON_PRETTY_PRINT));
    }
}
