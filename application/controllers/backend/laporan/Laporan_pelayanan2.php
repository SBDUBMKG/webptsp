<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit','512M');
class Laporan_pelayanan2 extends MY_Controller {
    var $page_title = 'Laporan Pelayanan';
    var $column_datatable = array('id_detail_permohonan', 'tanggal_permohonan', 'no_permohonan',  'tanggal_surat_keluar', 'no_surat_keluar', 'nama', 'perusahaan', 'email', 'no_telepon', 'id_jenis_layanan', 'jenis_layanan', 'layanan', 'tarif_pnbp', 'Jumlah', 'total_tarif_pnbp', 'status_data', 'status_transaksi');
    var $folder         = 'backend/laporan';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'laporan_pelayanan2_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $module =$this->module;
        $jenis_layanan = $this->input->post('jenis_layanan');
        $tahun = (int) $this->input->post('tahun');
        $bulan = (int) $this->input->post('bulan');
        $status = $this->input->post('status');
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
                     columnDefs: [{
                        className: "control",
                        orderable: false,
                        targets:   -1
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
                        extend: \'print\',
                        text: \'<div class="btn btn-sm btn-warning" style="display:none;">Print</div>\'
                      },
                      {
                        text: \'<div class="btn btn-sm btn-info">Laporan</div>\',
                        action: function ( e, dt, node, config ) {
                            $.ajax({
                                url: "'.base_url().$module.'/laporan?tahun='.$tahun.'&bulan='.$bulan.'",
                                type: "GET",
                                success: function(data){
                                    window.open("'.base_url().$module.'/laporan?tahun='.$tahun.'&bulan='.$bulan.'", "_blank");
                                }
                            });
                        }
                      },
                      {
                        extend: \'pdfHtml5\',
                        text: \'<div class="btn btn-sm btn-success" style="margin-left: 3px;">Print</div>\',
                        pageSize: \'LEGAL\',
                        orientation: \'landscape\',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
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
                        "url": "'.base_url().$module.'/getDataTable?tahun='.$tahun.'&bulan='.$bulan.'&status='.$status.'&jenis_layanan='.$jenis_layanan.'",
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
        $this->template->write_view('content', $this->folder.'/laporan_pelayanan2/datatable', $data, true);
        $this->template->render();
    }
    function getDataTable()
    {
        $iDisplayStart      = $this->input->get_post('start', true);
        $iDisplayLength     = $this->input->get_post('length', true);
        $order              = $this->input->get_post('order', true);
        $sSearch            = $this->input->get_post('search', true);
        $jenis_layanan      = $this->input->get('jenis_layanan');
        $tahun              = $this->input->get('tahun');
        $bulan              = $this->input->get('bulan');
	    $status             = $this->input->get('status');

        $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart, $iDisplayLength, $order, $sSearch, $jenis_layanan, $tahun, $bulan, $status);

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
                    //Baris awal penambahan kolom email. Perbaikan oleh Nurhayati Rahayu 17/10/2022
                    array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'no_telepon',
                        'label' => 'no_telepon',
                        'rules' => 'required'
                    ),
                    //Baris akhir penambahan kolom email. Perbaikan oleh Nurhayati Rahayu 17/10/2022
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
                    // awal perbaikan penambahan kolom petugaskonfirmasi dan petugasverifikasi
                    array(
                        'field' => 'petugaskonfirmasi',
                        'label' => 'petugaskonfirmasi',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'petugasverifikasi',
                        'label' => 'petugasverifikasi',
                        'rules' => 'required'
                    ),
                    // akhir perbaikan penambahan kolom petugaskonfirmasi dan petugasverifikasi
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
                //Baris awal penambahan kolom email. Perbaikan oleh Nurhayati Rahayu 17/10/2022
                'email' => $this->input->post('email'),
                'no_telepon' => $this->input->post('no_telepon'),
                //Baris akhir penambahan kolom email. Perbaikan oleh Nurhayati Rahayu 17/10/2022
                'id_jenis_layanan' => $this->input->post('id_jenis_layanan'),
                'jenis_layanan' => $this->input->post('jenis_layanan'),
                'layanan' => $this->input->post('layanan'),
                'tarif_pnbp' => $this->input->post('tarif_pnbp'),
                'jumlah' => $this->input->post('jumlah'),
                'total_tarif_pnbp' => $this->input->post('total_tarif_pnbp'),
                'status_data' => $this->input->post('status_data'),
                'status_transaksi' => $this->input->post('status_transaksi'),
                //Baris awal penambahan kolom petugaskonfirmasi dan petugasverifikasi. Perbaikan oleh Nurhayati Rahayu 24/01/2023
                'petugaskonfirmasi' => $this->input->post('petugaskonfirmasi'),
                'petugasverifikasi' => $this->input->post('petugasverifikasi')
                //Baris akhir penambahan kolom petugaskonfirmasi dan petugasverifikasi. Perbaikan oleh Nurhayati Rahayu 24/01/2023
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
        $this->template->write_view('content', $this->folder.'/laporan_pelayanan2/form', $data, true);
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
                //Baris awal penambahan kolom email. Perbaikan oleh Nurhayati Rahayu 17/10/2022
                'email' => $this->input->post('email'),
                'no_telepon' => $this->input->post('no_telepon'),
                //Baris akhir penambahan kolom email. Perbaikan oleh Nurhayati Rahayu 17/10/2022
                'id_jenis_layanan' => $this->input->post('id_jenis_layanan'),
                'jenis_layanan' => $this->input->post('jenis_layanan'),
                'layanan' => $this->input->post('layanan'),
                'tarif_pnbp' => $this->input->post('tarif_pnbp'),
                'jumlah' => $this->input->post('jumlah'),
                'total_tarif_pnbp' => $this->input->post('total_tarif_pnbp'),
                'status_data' => $this->input->post('status_data'),
                'status_transaksi' => $this->input->post('status_transaksi'),
                //Baris awal penambahan kolom petugaskonfirmasi dan petugasverifikasi. Perbaikan oleh Nurhayati Rahayu 24/01/2023
                'petugaskonfirmasi' => $this->input->post('petugaskonfirmasi'),
                'petugasverifikasi' => $this->input->post('petugasverifikasi')
                //Baris awal penambahan kolom petugaskonfirmasi dan petugasverifikasi. Perbaikan oleh Nurhayati Rahayu 24/01/2023
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
        $this->template->write_view('content', $this->folder.'/laporan_pelayanan2/form', $data, true);
        $this->template->render();
    }

    function delete($id = '') {
        $this->app_model->delete_data($id);
        redirect(base_url().$this->module);
    }

    public function laporan() {
        $this->load->library('pdf');

        $year = (int) $this->input->get('tahun');
        $month = (int) $this->input->get('bulan');

        $data = [];

        $signers = ['nama_kepala_bmkg', 'nip_kepala_bmkg', 'nama_kepala_ptsp', 'nip_kepala_ptsp', 'nama_kepala_biro', 'nama_pembuat_laporan', 'nip_pembuat_laporan'];
        foreach($signers as $signer) {
            $data[$signer] = $this->db->get_where('tbl_setting_content', ['variable_task' => $signer])->row()->value_task;
        }

        $query = $this->db
                ->select('a.*, b.nama, d.layanan')
                ->from('tbl_permohonan a')
                ->join('tbl_admin b', 'b.id_admin = a.id_pemohon', 'left')
                ->join('tbl_detail_permohonan c', 'c.id_permohonan = a.id_permohonan', 'left')
                ->join('m_layanan d', 'c.id_layanan = d.id_layanan', 'left')
                ->where('YEAR(a.tanggal_permohonan) = ' . $year);

        if ($month > 0) {
           $query = $query->where('MONTH(a.tanggal_permohonan) = ' . $month);
        }

        $query = $query->where('(a.status = 10 OR a.status = 7)');
        $result = $query->get()->result();

        $data['result'] = array_map(function($res) {
            return [
                'nomor_tanggal_wajib_bayar' => $res->tanggal_permohonan,
                'tanggal_surat_masuk' => $res->no_permohonan,
                'nama' => $res->nama,
                'uraian' => $res->layanan,
                'jumlah' => number_format((float) $res->total_harga, 0, ',', '.'),
                'nomor_tanggal_surat_keluar' => $res->no_permohonan,
                'tanggal_pengambilan' => $res->tanggal_verifikasibendahara,
                'keterangan' => '',
            ];
        }, $result);

        $this->pdf->load_view($this->folder.'/laporan_pelayanan2/laporan', $data);
    }
}
