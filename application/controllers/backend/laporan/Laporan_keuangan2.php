<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("memory_limit", "512M");
class Laporan_keuangan2 extends MY_Controller {
    var $page_title = 'Laporan Keuangan';
    var $column_datatable = array('id_detail_permohonan', 'tanggal_permohonan', 'no_permohonan', 'nama', 'perusahaan', 'id_jenis_layanan', 'jenis_layanan', 'layanan', 'tarif_pnbp', 'Jumlah', 'total_tarif_pnbp', 'bukti', 'status_data', 'status_transaksi');
    var $folder         = 'backend/laporan';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'laporan_keuangan2_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $module =$this->module;
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
	$jenis_layanan = $this->input->post('jenis_layanan');
        $this->load->model('global_model');
        $script = '
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
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    dom: \'Blfrtip\',
                    buttons: [
                      {
                          extend: \'copy\',
                          text: \'<div class="btn btn-sm btn-success" style="display: none;">Copy</div>\'
                      },
                      {
                          extend: \'excel\',
                          text: \'<div class="btn btn-sm btn-primary">Excel</div>\'
                      },
                      {
                          extend: \'print\',
                          text: \'<div class="btn btn-sm btn-warning" style="display: none;">Print</div>\'
                      },
                      {
                        extend: \'pdfHtml5\',
                        text: \'<div class="btn btn-sm btn-warning">Print</div>\',
                        pageSize: \'LEGAL\',
                        orientation: \'landscape\',
			exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12]
                        },
			customize: function(doc) {
			   doc.styles.tableHeader.fontSize = 10
     			   doc.defaultStyle.fontSize = 10
 			}
                    }
                    ],
                    "order": [[ 0, "desc" ]],
"processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : {
                        "url": "'.base_url().$module.'/getDataTable?tahun='.$tahun.'&bulan='.$bulan.'&jenis_layanan='.$jenis_layanan.'",
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
        $this->template->write_view('content', $this->folder.'/laporan_keuangan2/datatable', $data, true);
        $this->template->render();
    }
    function getDataTable()
    {
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $sSearch = $this->input->get_post('search', true);
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
	$jenis_layanan = $this->input->get('jenis_layanan');

        $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch,$tahun,$bulan,$jenis_layanan);

        echo $view;
    }
    private function valid_form($act = 'add') {
        $this->load->library('form_validation');
        $config = array(
                    array(
                        'field' => 'tanggal_permohonan',
                        'label' => 'Tanggal_permohonan',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'no_permohonan',
                        'label' => 'no_permohonan',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'nama',
                        'label' => 'nama',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'perusahaan',
                        'label' => 'perusahaan',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'id_jenis_layanan',
                        'label' => 'id_jenis_Layanan',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'jenis_layanan',
                        'label' => 'jenis_Layanan',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'layanan',
                        'label' => 'Layanan',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'tarif_pnbp',
                        'label' => 'tarif_pnbp',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'jumlah',
                        'label' => 'jumlah',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'total_tarif_pnbp',
                        'label' => 'total_tarif_pnbp',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'status_data',
                        'label' => 'status_data',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'status_transaksi',
                        'label' => 'status_transaksi',
                        'rules' => 'required'
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
                'tanggal_permohonan' => $this->input->post('tanggal_permohonan'),
                'no_permohonan' => $this->input->post('no_permohonan'),
                'nama' => $this->input->post('nama'),
                'perusahaan' => $this->input->post('perusahaan'),
                'id_jenis_layanan' => $this->input->post('id_jenis_layanan'),
                'jenis_layanan' => $this->input->post('jenis_layanan'),
                'layanan' => $this->input->post('layanan'),
                'tarif_pnbp' => $this->input->post('tarif_pnbp'),
                'jumlah' => $this->input->post('jumlah'),
                'total_tarif_pnbp' => $this->input->post('total_tarif_pnbp'),
                'status_data' => $this->input->post('status_data'),
                'status_transaksi' => $this->input->post('status_transaksi'),
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
        $this->template->write_view('content', $this->folder.'/laporan_keuangan2/form', $data, true);
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
                'tanggal_permohonan' => $this->input->post('tanggal_permohonan'),
                'no_permohonan' => $this->input->post('no_permohonan'),
                'nama' => $this->input->post('nama'),
                'perusahaan' => $this->input->post('perusahaan'),
                'id_jenis_layanan' => $this->input->post('id_jenis_layanan'),
                'jenis_layanan' => $this->input->post('jenis_layanan'),
                'layanan' => $this->input->post('layanan'),
                'tarif_pnbp' => $this->input->post('tarif_pnbp'),
                'jumlah' => $this->input->post('jumlah'),
                'total_tarif_pnbp' => $this->input->post('total_tarif_pnbp'),
                'status_data' => $this->input->post('status_data'),
                'status_transaksi' => $this->input->post('status_transaksi'),
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
        $this->template->write_view('content', $this->folder.'/laporan_keuangan2/form', $data, true);
        $this->template->render();
    }
    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

}