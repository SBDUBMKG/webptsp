<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Laporan_survey extends MY_Controller
{
    var $page_title = "Laporan Survey";
    var $folder = "backend/laporan";
    var $module = "";

    function __construct()
    {
        parent::__construct();
        $module = $this->folder . "/" . $this->router->fetch_class();
        $this->load->model(
            $this->folder . "/" . "laporan_survey_model",
            "app_model"
        );
        $this->app_model->initialize($module);
        $this->module = $module;
    }

    public function index()
    {
        $this->load->model("global_model");
        $this->load->helper(["date", "status", "tgl_indo"]);
        $this->load->library("highcharts");
        $id_role = $this->session->userdata("id_role");

        $color = [
            "#7CB5EC",
            "#ffff33",
            "#90ED7D",
            "#F7A35C",
            "#8085E9",
            "#F15C80",
            "#E4D354",
            "#2B908F",
            "#F45B5B",
            "#9900cc",
            "#f442a7",
            "#abb703",
        ];
        $tahun = $_GET['tahun'] ?? date("Y");
        $judul_grafik = "RATA-RATA SURVEY TAHUN " . $tahun;
        $judul_x = "Bulan";
        $judul_y = "Total Survey";

        $kategori = [
            4 => "Sangat Setuju",
            3 => "Setuju",
            2 => "Kurang Setuju",
            1 => "Tidak Setuju",
        ];

        $this->db->select(
            "id_survey, id_layanan, id_detail_permohonan, survey, tanggal"
        );
        $this->db->from("tbl_survey");
        $this->db->where("YEAR(tanggal)=" . $tahun);
        $get = $this->db->get();
        $result = $get->result();

        $total_kategori = [];
        foreach ($result as $row) {
            $tanggal = $row->tanggal;
            $timestamp = strtotime($tanggal);
            $bulan = date("n", $timestamp) - 1;
            $survey = json_decode($row->survey);

            $bulan_count = [4 => 0, 3 => 0, 2 => 0, 1 => 0];
            foreach ($survey as $values) {
                $bulan_count[$values] = $bulan_count[$values] + 1; //TODO:
            }

            $total_kategori[$bulan] = $bulan_count;
        }

        for ($i = 0; $i <= 11; $i++) {
            if (!isset($total_kategori[$i])) {
                $total_kategori[$i] = [
                    4 => 0,
                    3 => 0,
                    2 => 0,
                    1 => 0,
                ];
            }
        }
        //echo "<pre>";var_dump($total_kategori);echo "</pre>"; return;
        $series = [];
        foreach ($kategori as $kat_key => $kat_nama) {
            $new_data = [];
            foreach ($total_kategori as $key => $value) {
                $new_data[$key] = $value[$kat_key];
                continue;

                if ($value[$kat_key] == 0) {
                    $new_data[$key] = $value[$kat_key];
                    continue;
                }

                $new_data[$key] = $key * $value[$kat_key] / $value[$kat_key];
            }

            ksort($new_data);
            $series[] = ["name" => $kat_nama, "data" => $new_data];
        }

        $series_encode = json_encode($series);
        $script = '
                const chart = new Highcharts.Chart({
                    "series":' . $series_encode . ',
                    "exporting": {"enabled": false},
                    "chart":{"renderTo":"chart_survey","type":"column"},
                    "title":{"text":"' . $judul_grafik . '"},
                    "xAxis":{"categories":["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
                    "title":{"text":"' . $judul_x . '"}},
                    "yAxis":{"title":{"text":"' . $judul_y . '"}},
                    "colors":["#0066ff","#fff028","#EF7321","#f7c604","#2ED1A2","#cc6699"]
                });
        ';

        $data = [];
        $data["kontak"] = $this->global_model->get_count_data("tbl_agenda");
        $data["id_role"] = $id_role;

        $this->template->add_js("resources/plugins/highcharts/highcharts.js");
        $this->template->add_js("resources/plugins/highcharts/highcharts-3d.js");
        $this->template->add_js("resources/plugins/highcharts/exporting.js");
        $this->template->add_js("resources/plugins/highcharts/export-csv.js");
        $this->template->add_js($script, "embed");

        $this->template->write_view(
            "content",
            $this->folder . "/laporan_survey/datatable",
            $data,
            true
        );
        $this->template->render();
    }

    function show_data($layanan, $tahun, $bulan)
    {
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
            ->set_content_type("application/json", "utf-8")
            ->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }
}
