<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_survey extends MY_Controller {
    var $page_title       = 'Laporan Survey';
    var $folder           = 'backend/laporan';
    var $module           = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model($this->folder.'/'.'laporan_survey_model', 'app_model');
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
        
        $tahun =  date("Y");
        $script ="";


        $query_2 = $this->db->query("
            SELECT
            DATE_FORMAT(tanggal_permohonan, '%Y') as 'tahun',
            DATE_FORMAT(tanggal_permohonan, '%c') as 'bulan',
            COUNT(id_permohonan) as 'total'
            FROM tbl_permohonan
            GROUP BY DATE_FORMAT(tanggal_permohonan, '%Y%c')
            ORDER BY id_permohonan
        ")->result();

        $judul_grafik = 'RATA-RATA SURVEY TAHUN '.$tahun;
        //$judul_x = 'TAHUN';
        //$judul_y = 'TOTAL';
	//Perbaikan titel axis. Perubahan oleh: Nurhayati Rahayu (25/10/2019)
	$judul_x = 'Bulan';
        $judul_y = 'Total Survey';
	//baris akhir perbaikan
        $kategori = [1=>"Baik",2=>"Sedang", 3=>"Buruk", 4=>"Jelek"];


        $this->db->select("id_survey, id_layanan, id_detail_permohonan, survey, tanggal");
        $this->db->from("tbl_survey");
        $this->db->where("YEAR(tanggal)=".$tahun);
        $get = $this->db->get();
        $result = $get->result();

        $total_kategori = [];
        foreach ($result as $row) {
            $tanggal=$row->tanggal;
            $timestamp = strtotime($tanggal);
            $bulan = date("n", $timestamp)-1;
            $survey=json_decode($row->survey);
            $bulan_total=[1=>0,2=>0,3=>0,4=>0];
            foreach ($survey as $values) {
                $bulan_total[$values]=$bulan_total[$values]+1;
            }
            $total_kategori[$bulan]=$bulan_total;
        }
       //for ($i=1;$i<=12;$i++) {
       //Perbaikan jumlah kolom pada x axis. Perubahan oleh: Nurhayati Rahayu (25/10/2019)
       for ($i=1;$i<=11;$i++) {
       //baris terakhir perbaikan	
            $bulan_index = sprintf('%02d', $i);
            if (!isset($total_kategori[$bulan_index])){
                $total_kategori[$bulan_index]=[1=>0,2=>0,3=>0,4=>0];
            }
        }
        // echo "<pre>";var_dump($total_kategori);echo "</pre>"; return;
        $series = [];
        $i=0;
        foreach ($kategori as $kat_key=>$kat_nama) {
            $series[$i]["name"] = $kat_nama;
            $j = 0;
            $new_data=[];
            $new_data[0]=0;
            foreach ($total_kategori as $key => $value) {
                $new_data[intval($key)]=$value[$kat_key];
                $j++;
            }
            ksort($new_data);

            $series[$i]["data"] =  ($new_data);
            $i++;
        }

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
                    // "series":[
                    //     {
                    //         "name":"Kategori 1",
                    //         "data":[1,2,3,4,5]
                    //     },
                    //     {
                    //         "name":"Katgori 2",
                    //         "data":[6,8,9,0,6]
                    //     }
                    // ],

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

        $this->template->write_view('content', $this->folder.'/laporan_survey/datatable', $data, true);
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
