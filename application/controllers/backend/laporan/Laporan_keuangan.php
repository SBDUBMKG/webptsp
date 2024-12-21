<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class Laporan_keuangan extends MY_Controller {
    var $page_title = 'Laporan Keuangan';

    // Awal script yang di non-aktifkan Rahmat, 17 Juni 2020
    /*
    var $column_datatable = array('A.id_detail_permohonan', 'B.no_permohonan','A.jumlah','A.harga','B.status');
    */
    // Akhir script yang di non-aktifkan Rahmat, 17 Juni 2020

    // Awal script yang ditambahkan Rahmat, 17 Juni 2020
    var $column_datatable = ['id_detail_permohonan', 'B.no_permohonan', 'C.nama', 'E.perusahaan', 'D.layanan', 'jumlah', 'A.harga', 'B.bukti', 'F.status'];
    // Akhir script yang ditambahkan Rahmat, 17 Juni 2020

    var $folder         = 'backend/laporan';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();

        // Awal script yang ditambahkan Rahmat, 17 Juni 2020
        $this->load->helper(['general', 'status']);
        // Akhir script yang ditambahkan Rahmat, 17 Juni 2020

        $this->load->model($this->folder.'/'.'laporan_keuangan_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $module =$this->module;

        // Awal script yang ditambahkan Rahmat, 17 Juni 2020
        $id_role  = $this->session->userdata('id_role');
        $url_ajax = site_url($module.'/getDataTable');
        // Akhir script yang ditambahkan Rahmat, 17 Juni 2020

        $script = '
            $(function () {
                var oTable = $("#datatable").DataTable({

                    // Awal script yang di non-aktifkan Rahmat, 17 Juni 2020
                    //responsive: {
                        //details: {
                            //type: "column",
                            //target: -1
                        //}
                    //},
                    // Akhir script yang ditambahkan Rahmat, 17 Juni 2020

                    columnDefs: [ {
                        className: "control",
                        orderable: false,
                        targets:   0
                    }],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    dom: \'Blfrtip\',
                    buttons: [
                      {
                          extend: \'copy\',
                          text: \'<div class="btn btn-sm btn-success" style="display:none;">Copy</div>\'
                      },
                      {
                          extend: \'excel\',
                          text: \'<div class="btn btn-sm btn-primary">Excel</div>\'
                      },
                      {
                          extend: \'pdf\',
                          text: \'<div class="btn btn-sm btn-warning">Print</div>\'
                      },
                      {
                          extend: \'print\',
                          text: \'<div class="btn btn-sm btn-warning" style="display:none;">Print</div>\'
                      }
                    ],
                    "order": [[ 0, "desc" ]],
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : {
                        "url": "' . $url_ajax . '",
                        "type": "POST"
                    }
                });
            });
            ';
        $data['title'] = $this->page_title;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_css('resources/plugins/datatables/dataTables.bootstrap.css');
        $this->template->add_css('resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css');

        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->add_js('resources/plugins/datatables/jquery.dataTables.min.js');
        $this->template->add_js('resources/plugins/datatables/dataTables.bootstrap.min.js');
        $this->template->add_js('resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js');
        $this->template->add_js('resources/plugins/datatables/dataTables.buttons.min.js');
        $this->template->add_js('resources/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js');
        $this->template->add_js('resources/plugins/datatables/jszip.min.js');
        $this->template->add_js('resources/plugins/datatables/pdfmake.min.js');
        $this->template->add_js('resources/plugins/datatables/vfs_fonts.js');
        $this->template->add_js('resources/plugins/datatables/buttons.flash.min.js');
        $this->template->add_js('resources/plugins/datatables/buttons.html5.min.js');
        $this->template->add_js('resources/plugins/datatables/buttons.print.min.js');

        $this->template->add_js($script,'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->folder.'/laporan_keuangan/datatable', $data, true);
        $this->template->render();
    }
    function getDataTable()
    {
        $iDisplayStart  = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        $order          = $this->input->get_post('order', true);
        $sSearch        = $this->input->get_post('search', true);

        $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch);

        echo $view;
    }
    private function valid_form($act = 'add') {
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'id_permohonan',
                        'label' => 'Id Permohonan',
                        'rules' => 'required|integer'
                    ),
                    array(
                        'field' => 'jumlah_lokasi',
                        'label' => 'Jumlah Lokasi',
                        'rules' => 'required|integer'
                    ),
                    array(
                        'field' => 'harga',
                        'label' => 'Harga',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'status',
                        'label' => 'Status',
                        'rules' => 'required|max_length[255]'
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
                'id_permohonan' => $this->input->post('id_permohonan'),
                'jumlah_lokasi' => $this->input->post('jumlah_lokasi'),
                'harga' => $this->input->post('harga'),
                'status' => strip_tags($this->input->post('status')),
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
        $this->template->write('title', 'Tambah '.$this->page_title);
        $this->template->write_view('content', $this->folder.'/laporan_keuangan/form', $data, true);
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
                $data_update = array(    'id_permohonan' => $this->input->post('id_permohonan'),
                'jumlah_lokasi' => $this->input->post('jumlah_lokasi'),
                'harga' => $this->input->post('harga'),
                'status' => strip_tags($this->input->post('status')),
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
        $this->template->write_view('content', $this->folder.'/laporan_keuangan/form', $data, true);
        $this->template->render();
    }
    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }
}
