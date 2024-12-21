<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_pelayanan extends MY_Controller {
    var $page_title       = 'Laporan Pelayanan';
    var $folder           = 'backend/laporan';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'laporan_pelayanan_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index(){
        $this->load->model('global_model');
        $module     = $this->module;
        if ($_POST) {
            $id_jenis_layanan = $this->input->post('id_jenis_layanan');
            $tahun = $this->input->post('tahun');
            $bulan = $this->input->post('bulan');
            $cond = "SELECT * FROM tbl_permohonan ";
            $cond .= "WHERE MONTH(tanggal_permohonan) = '$bulan' ";
            $cond .= "AND  YEAR(tanggal_permohonan) = '$tahun' ";
            $cond .= "AND id_jenis_layanan = '$id_jenis_layanan' ";
            // $cond .= "AND status = 7";
            $data['data_permohonan'] = $this->db->query($cond)->result_array();
        }

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
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->folder.'/laporan_pelayanan', $data, true);
        $this->template->render();
    }

    function show_data($layanan, $tahun, $bulan){
        $layanan = 1;
        $tahun = $tahun;
        $bulan = $bulan;
        $cond = "SELECT * FROM tbl_permohonan ";
        $cond .= "WHERE MONTH(tanggal_permohonan) = '$bulan' ";
        $cond .= "AND  YEAR(tanggal_permohonan) = '$tahun' ";
        $cond .= "AND id_jenis_layanan = '$layanan' ";
        // $cond .= "AND status = 7";
        $data = $this->db->query($cond)->result_array();
        // return $data;
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json','utf-8')
        ->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }
}
