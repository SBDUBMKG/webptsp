<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_back_office extends MY_Controller {
    var $page_title       = 'Laporan Back Office';
    var $folder           = 'backend/laporan';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'laporan_back_office_model', 'app_model');
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
        
        $tahun = empty($this->input->get("tahun")) ? date("Y") : $this->input->get("tahun");
        $script ="";

        $layanan=$this->db->select("*")->from("m_layanan")->get()->result();
        $data['layanan']=$layanan;

        $judul_grafik = 'Laporan Kinerja Back Office Tahun '.$tahun;
        $judul_x = 'Bulan';
        $judul_y = 'Total Layanan';

        $this->db->select("A.*,B.tanggal_permohonan as tanggal");
        $this->db->from("tbl_detail_permohonan A");
        $this->db->join("tbl_permohonan B","B.id_permohonan=A.id_permohonan","LEFT");
        $this->db->where("YEAR(B.tanggal_permohonan)=".$tahun);
        if (!empty($this->input->get("id_layanan"))){
         $this->db->where("A.id_layanan='".$this->input->get("id_layanan")."'");
        }
        $get = $this->db->get();
        // echo $this->db->last_query();
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

        $this->template->write_view('content', $this->folder.'/laporan_back_office/datatable', $data, true);
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

// line 32  :
// mengubah : $judul_grafik = 'LAPORAN KINERJA BACK OFFICE '.$tahun;
// menjadi  : $judul_grafik = 'Laporan Kinerja Back Office Tahun '.$tahun;

// line 33  :
// mengubah : $judul_x = 'TAHUN';
// menjadi  : $judul_x = 'Bulan';

// line 34  :
// mengubah : $judul_y = 'TOTAL';
// menjadi  : $judul_y = 'Total Layanan';