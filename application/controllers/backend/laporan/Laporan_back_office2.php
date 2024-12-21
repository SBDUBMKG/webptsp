<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_back_office2 extends MY_Controller {
    var $page_title       = 'Laporan Back Office 2';
    var $folder           = 'backend/laporan';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'laporan_back_office2_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index(){

        $this->load->model('global_model');
        $this->load->helper(['date', 'status', 'tgl_indo']);
        $this->load->library('highcharts');
        $id_role = $this->session->userdata("id_role");
        $script = '';
        $color = ['#7CB5EC','#ffff33','#90ED7D','#F7A35C','#8085E9','#F15C80','#E4D354','#2B908F','#F45B5B','#9900cc','#f442a7','#abb703'];

        $script ="";

        $data['jenis_layanan'] = $this->global_model->get_list_array('m_jenis_layanan');
        $data['jenis_layanan_selected'] =  empty($this->input->get("id_jenis_layanan")) ? NULL : $this->input->get("id_jenis_layanan");
        $data['backoffice'] = $this->global_model->get_list_array('tbl_role','id_role >= 9 ');
        $data['backoffice_selected'] = empty($this->input->get("id_role")) ? NULL : $this->input->get("id_role");
        $data['tahun'] = empty($this->input->get("tahun")) ? date("Y") : $this->input->get("tahun");

        $judul_grafik = "";

        $backoffice = $this->global_model->get_by_id("tbl_role", "id_role", $data['backoffice_selected']);
        if ($backoffice) {
            $judul_grafik .= $backoffice->role;
        }

        $jenis_layanan = $this->global_model->get_by_id("m_jenis_layanan", 'id_jenis_layanan', $data['jenis_layanan_selected']);
        if ($jenis_layanan) {
            $judul_grafik .= " Untuk Jenis Layanan " . $jenis_layanan->jenis_layanan;
        }

        // mengubah judul dan nama axis pada grafik. perbaikan oleh Nurhayati Rahayu (22/10/2019)
        // $judul_grafik = 'Laporan Kinerja Back Office Tahun '.$data['tahun'];
        $judul_grafik .= ' Tahun ' . $data['tahun'];
        $judul_x = 'Bulan';
        $judul_y = 'Total Layanan';
        // baris terakhir perbaikan

        $this->db->select("A.*,B.tanggal_permohonan as tanggal");
        $this->db->from("tbl_detail_permohonan A");
        $this->db->join("tbl_permohonan B","B.id_permohonan=A.id_permohonan","LEFT");
        if(!empty($data['jenis_layanan_selected'])){
            $this->db->join("m_layanan C","C.id_layanan=A.id_layanan","LEFT");
            $this->db->where("C.id_jenis_layanan=".$data['jenis_layanan_selected']);
        }
        if(!empty($data['backoffice_selected'])){
            $this->db->where("C.penanggung_jawab=".$data['backoffice_selected']);
        }
        $this->db->where("YEAR(B.tanggal_permohonan)=".$data['tahun']);

        $get = $this->db->get();
        $result = $get->result();
        $series=[];

        $total_perbulan = [0,0,0,0,0,0,0,0,0,0,0,0];
        // var_dump($result);
        foreach ($result as $row) {
            $bulan = date("n", strtotime($row->tanggal));
            $bulan_index = $bulan-1;

                $total_perbulan[$bulan_index]+=1;
        }

        $i =0;
        $series[$i]['name']="Total Layanan";
        $series[$i]['data']=$total_perbulan;


        $series_encode=json_encode($series);

        $data['jumlah_layanan'] = '
        <script>
            $(function(){
                Highcharts.setOptions({
                    "chart": {
                        "backgroundColor":{"linearGradient":[0,0,500,500],"stops":[[0,"rgb(255, 255, 255)"],[1,"rgb(240, 240, 255)"]]},"shadow":true},
                        "credits":{"enabled":false},
                        "lang":{"numericSymbols":[" ribu"," juta"," milyar"," trilyun"]},
                        "plotOptions":{"line":{"dataLabels":{"enabled":true}},
                        "column":{"dataLabels":{"enabled":true}},
                        "bar":{"dataLabels":{"enabled":true}}
                    }
                });
                var chart_1 = new Highcharts.Chart({
                    "series":'.$series_encode.',
                    "chart":{"renderTo":"chart_survey","type":"column"},
                    "title":{"text":"'.$judul_grafik.'"},
                    "xAxis":{"categories":["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
                    "title":{"text":"'.$judul_x.'"}},
                    "yAxis":{"title":{"text":"'.$judul_y.'"}},
                    "colors":["#0066ff","#fff028","#EF7321","#f7c604","#2ED1A2","#cc6699"]
                });
            });
        </script>
        <div id="chart_survey"></div>
        ';


        $data['kontak'] = $this->global_model->get_count_data('tbl_agenda');
        $data['id_role'] = $id_role;

        $this->template->add_js('resources/plugins/highcharts/highcharts.js');
        $this->template->add_js('resources/plugins/highcharts/highcharts-3d.js');
        $this->template->add_js('resources/plugins/highcharts/exporting.js');
        $this->template->add_js('resources/plugins/highcharts/export-csv.js');
        $this->template->add_js($script, 'embed');

        $this->template->write_view('content', $this->folder.'/laporan_back_office2/datatable', $data, true);
        $this->template->render();
    }

    function show_data($layanan, $tahun, $bulan){
        $layanan = 1;
        $tahun = $tahun;
        $bulan = $bulan;
        $cond = "SELECT * FROM tbl_permohonan ";
        $cond .= "WHERE MONTH(tanggal_permohonan) = '$bulan' ";
        $cond .= "AND  YEAR(tanggal_permohonan) = '$tahun' ";
        // $cond .= "AND id_jenis_layanan = '$layanan' ";
        // $cond .= "AND status = 7";
        $data = $this->db->query($cond)->result_array();
        // return $data;
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json','utf-8')
        ->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }
}
