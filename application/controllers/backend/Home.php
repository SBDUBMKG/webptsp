<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('backend/dashboard_model', 'app_model');
    }
	public function index()
	{
        $this->load->model('global_model');
        $this->load->helper(['date', 'status', 'tgl_indo' ,'general']);
        $this->load->library('highcharts');
        $data['filter'] = false;
        $id_role = $this->session->userdata("id_role");
        $dashboard_view = 'backend/dashboard';
        $script = '';
        $color = ['#7CB5EC','#ffff33','#90ED7D','#F7A35C','#8085E9','#F15C80','#E4D354','#2B908F','#F45B5B','#9900cc','#f442a7','#abb703'];

        if ($id_role != 7) {
            $data['filter']['dari'] = (int) ($this->input->get('dari') ?? false);
            $data['filter']['sampai'] = (int) ($this->input->get('sampai') ?? $data['filter']['dari']);

            if ($data['filter']['sampai'] && ($data['filter']['dari'] < 1 || $data['filter']['dari'] > 12)) {
                $data['filter']['dari'] = 1;
            }

            if ($data['filter']['sampai'] && ($data['filter']['sampai'] < 1 || $data['filter']['sampai'] > 12)) {
                $data['filter']['sampai'] = 12;
            }

            $data['filter']['tahun'] = (int) (($this->input->get('tahun')) ?? date('Y'));

            if ($data['filter']['tahun'] > date('Y') || ($data['filter']['tahun'] < 1)) {
                $data['filter']['tahun'] = date('Y');
            }
        }

        switch ($id_role) {
            case '3':
                $dashboard_view = 'backend/dashboard_admin';
                $script ="
                $(function(){
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'y Axis'
                            },
                            allowDecimals: false
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'A',
                            data: [20, 30]

                        },
                        {
                            name: 'B',
                            data: [30, 40]

                        }, {
                            name: 'C',
                            data: [40, 50]

                        }]
                    });

                    $('#container2').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Kategori A',
                                y: 70
                            }, {
                                name: 'Katgeori B',
                                y: 30,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });
                });
                ";
                break;
            case '4':
                //Awal baris perubahan dashboard (Nurhayati Rahayu 26/07/2022)
                $dashboard_view = 'backend/dashboard_admin';
                //$dashboard_view = 'backend/dashboard_bendahara';
                //Akhir baris perubahan dashboard (Nurhayati Rahayu 26/07/2022)
                $script ="
                $(function(){
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'y Axis'
                            },
                            allowDecimals: false
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'A',
                            data: [20, 30]

                        },
                        {
                            name: 'B',
                            data: [30, 40]

                        }, {
                            name: 'C',
                            data: [40, 50]

                        }]
                    });

                    $('#container2').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Kategori A',
                                y: 70
                            }, {
                                name: 'Katgeori B',
                                y: 30,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });

                    $('#container3').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'y Axis'
                            },
                            allowDecimals: false
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'A',
                            data: [20, 30]

                        },
                        {
                            name: 'B',
                            data: [30, 40]

                        }, {
                            name: 'C',
                            data: [40, 50]

                        }]
                    });
                });
                ";
                break;
            case '5':
                $dashboard_view = 'backend/dashboard_backoffice';
                $script ="
                $(function(){
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'y Axis'
                            },
                            allowDecimals: false
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'A',
                            data: [20, 30]

                        },
                        {
                            name: 'B',
                            data: [30, 40]

                        }, {
                            name: 'C',
                            data: [40, 50]

                        }]
                    });

                    $('#container2').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Kategori A',
                                y: 70
                            }, {
                                name: 'Katgeori B',
                                y: 30,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });

                    $('#container3').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'y Axis'
                            },
                            allowDecimals: false
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'A',
                            data: [20, 30]

                        },
                        {
                            name: 'B',
                            data: [30, 40]

                        }, {
                            name: 'C',
                            data: [40, 50]

                        }]
                    });
                });
                ";
                break;
            case '6':
                $dashboard_view = 'backend/dashboard_cs';
                $script ="
                $(function(){
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'y Axis'
                            },
                            allowDecimals: false
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'A',
                            data: [20, 30]

                        },
                        {
                            name: 'B',
                            data: [30, 40]

                        }, {
                            name: 'C',
                            data: [40, 50]

                        }]
                    });

                    $('#container2').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Kategori A',
                                y: 70
                            }, {
                                name: 'Katgeori B',
                                y: 30,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });

                    $('#container3').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Kategori A',
                                y: 70
                            }, {
                                name: 'Katgeori B',
                                y: 30,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });
                });
                ";
                break;
            case '7':
                $dashboard_view = 'backend/dashboard_member';
                $script = $this->dashboard_member();
                break;
            case '8':
                $dashboard_view = 'backend/dashboard_cs';
                $script ="
                $(function(){
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'y Axis'
                            },
                            allowDecimals: false
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'A',
                            data: [20, 30]

                        },
                        {
                            name: 'B',
                            data: [30, 40]

                        }, {
                            name: 'C',
                            data: [40, 50]

                        }]
                    });

                    $('#container2').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Kategori A',
                                y: 70
                            }, {
                                name: 'Katgeori B',
                                y: 30,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });

                    $('#container3').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [{
                                name: 'Kategori A',
                                y: 70
                            }, {
                                name: 'Katgeori B',
                                y: 30,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });
                });
                ";
                break;
        }

        if ($id_role != 7 && $id_role < 7) {
            $script .= $this->scriptJenisLayanan();
        }


        // Total Pendaftar

        $sql = "
            SELECT
            DATE_FORMAT(tanggal_daftar, '%Y') as 'tahun',
            cast(DATE_FORMAT(tanggal_daftar, '%c') as unsigned) as 'bulan',
            COUNT(id_admin) as 'total'
            FROM tbl_admin WHERE id_role = 7";

        $sql .= " AND DATE_FORMAT(tanggal_daftar, '%Y') = " . $this->db->escape($data['filter']['tahun']);
        if ($data['filter'] && $data['filter']['dari'] && $data['filter']['sampai']) {
            $sql .= " AND DATE_FORMAT(tanggal_daftar, '%c') >= " . $this->db->escape($data['filter']['dari']) . " AND DATE_FORMAT(tanggal_daftar, '%c') <= " . $this->db->escape($data['filter']['sampai']);
        }else if ($data['filter'] && $data['filter']['dari']) {
            $sql .= " AND DATE_FORMAT(tanggal_daftar, '%c') = " . $this->db->escape($data['filter']['dari']);
        }else if ($data['filter'] && $data['filter']['sampai']) {
            $sql .= " AND DATE_FORMAT(tanggal_daftar, '%c') = " . $this->db->escape($data['filter']['sampai']);
        }

        $sql .= " GROUP BY DATE_FORMAT(tanggal_daftar, '%Y%c')
            ORDER BY bulan, id_admin
            LIMIT 0,12";


        $tahun = [];
        $bulan = [];
        $total = [];

        $dari = (((int) $data['filter']['dari'] ? (int) $data['filter']['dari'] : 1)) - 1;
        $sampai = ((int) $data['filter']['sampai'] ? (int) $data['filter']['sampai'] : 12) - 1;

        if (!$data['filter']['dari'] && $data['filter']['sampai']) {
            $dari = $sampai;
        }elseif (!$data['filter']['sampai'] && $data['filter']['dari']) {
            $sampai = $dari;
        }




        for ($i=$dari; $i <= ($sampai) ; $i++) {
            $tahun[] = ( int ) $data['filter']['tahun'];
            $bulan[$i+1] = bulan( $i+1 );
            $total[$i+1] = 0;
        }


        // var_dump($bulan);
        // die();



        $query = $this->db->query($sql)->result();
        foreach ($query as $val) {
            $total[($val->bulan)] = (int) $val->total;
        }

        $total = array_values($total);
        $tahun = array_values($tahun);
        $bulan = array_values($bulan);

        $index = [ [ 'showInLegend'=>false, 'name'=> 'Total Pendaftar', 'data'=> $total ] ];


        $graph = $this->highcharts->format_chart($bulan, $index);
        $this->highcharts->set_type('column');
        $this->highcharts->set_color($color,'column');
        $this->highcharts->set_xAxis($graph['sumbu_x']);
        foreach($graph['values'] as $series) { $this->highcharts->set_serie($series); }
        //$this->highcharts->set_xAxis($graph_3['sumbu_x']);
	//foreach($graph_3['values'] as $series) { $this->highcharts->set_serie($series); }

        //$this->highcharts->set_title("Total Pendaftar PTSP Tahun ". htmlspecialchars($data['filter']['tahun']) , "Grafik Berdasarkan Bulan");
	$this->highcharts->set_title("Total Pendaftar PTSP<br>Bulan ".$bulan[0]. " s/d ".$bulan[count($bulan)-1]." Tahun ".htmlspecialchars($data['filter']['tahun']));
        //$this->highcharts->set_axis_titles('Bulan', 'Jumlah');
        $this->highcharts->set_3d(false);
        $this->highcharts->render_to('jumlah_pendaftar');
        $data['jumlah_pendaftar'] = $this->highcharts->render();

        // Total Permohonan Layanan

        $sql = "SELECT
            DATE_FORMAT(tanggal_permohonan, '%Y') as 'tahun',
            cast(DATE_FORMAT(tanggal_permohonan, '%c') as unsigned) as 'bulan',
            COUNT(no_permohonan) as 'total'
            FROM v_lap_pelayanan WHERE 1=1";

        $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%Y') = " . $this->db->escape($data['filter']['tahun']);
        if ($data['filter'] && $data['filter']['dari'] && $data['filter']['sampai']) {
            $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') >= " . $this->db->escape($data['filter']['dari']) . " AND DATE_FORMAT(tanggal_permohonan, '%c') <= " . $this->db->escape($data['filter']['sampai']);
        }else if ($data['filter'] && $data['filter']['dari']) {
            $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') = " . $this->db->escape($data['filter']['dari']);
        }else if ($data['filter'] && $data['filter']['sampai']) {
            $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') = " . $this->db->escape($data['filter']['sampai']);
        }

        $sql .= " GROUP BY DATE_FORMAT(tanggal_permohonan, '%Y%c')
            ORDER BY bulan, id_detail_permohonan";

        $query_2 = $this->db->query($sql)->result();
	// Merubah resource tabel yang sebelumnya tbl_permohonan menjadi v_lap_pelayanan
	// Merubah count(id_permohonan) menjadi count(no_permohonan)
	// perubahan dilakukan oleh Nurhayati Rahayu (26/08/2020)


        $tahun_2 = [];
        $bulan_2 = [];
        $total_2 = [];

        for ($i=$dari; $i <= ($sampai) ; $i++) {
            $tahun_2[$i+1] = ( int ) $data['filter']['tahun'];
            $bulan_2[$i+1] = bulan( $i+1 );
            $total_2[$i+1] = 0;
        }



        foreach ($query_2 as $val) {
            $total_2[$val->bulan] = (int) $val->total;
        }

        $total_2 = array_values($total_2);
        $tahun_2 = array_values($tahun_2);
        $bulan_2 = array_values($bulan_2);



        $index_2 = [ [ 'showInLegend'=>false, 'name'=> 'Total Permohonan', 'data'=> $total_2 ] ];
        $graph_2 = $this->highcharts->format_chart($bulan_2, $index_2);
        $this->highcharts->set_type('line');
        // $this->highcharts->set_color($color, 'line');
        $this->highcharts->set_xAxis($graph_2['sumbu_x']);
        foreach($graph_2['values'] as $series) { $this->highcharts->set_serie($series); }
        //$this->highcharts->set_title("Total Permohonan Layanan PTSP Tahun ".htmlspecialchars($data['filter']['tahun']), "Grafik Berdasarkan Bulan");
        $this->highcharts->set_title("Total Permohonan Layanan PTSP<br>Bulan ".$bulan[0]. " s/d ".$bulan[count($bulan)-1]." Tahun ".htmlspecialchars($data['filter']['tahun']));
	//$this->highcharts->set_axis_titles('Bulan', 'Jumlah');
        $this->highcharts->set_3d(false);
        $this->highcharts->render_to('jumlah_layanan');
        $data['jumlah_layanan'] = $this->highcharts->render();

        // Total Pendapatan

	// Total Transaksi PTSP
        $query_total = $this->db->query("
            SELECT
            DATE_FORMAT(tanggal_permohonan, '%Y') as 'tahun',
            cast(DATE_FORMAT(tanggal_permohonan, '%c') as unsigned) as 'bulan',
            SUM(total_harga) as 'total'
            FROM tbl_permohonan
	    WHERE DATE_FORMAT(tanggal_permohonan, '%Y') = year(curdate())
            GROUP BY DATE_FORMAT(tanggal_permohonan, '%Y%c')
	    ORDER BY bulan, id_permohonan
        ")->result();
        $tahun_total = [];
        $bulan_total = [];
        $total_total = [];
	 foreach ($query_total as $val) {
            $tahun_total[] = (int) $val->tahun;
	    $bulan_total[] = bulan( $val->bulan );
            $total_total[] = (int) $val->total;
        }
        $index_total = [ [ 'showInLegend'=>false, 'name'=> 'Pendapatan', 'data'=> $total_total ] ];
        $graph_total = $this->highcharts->format_chart($bulan_total, $index_total);

	// Total Realisasi Pendapatan PTSP

        $sql = "SELECT
        DATE_FORMAT(a.tanggal_permohonan, '%Y') as 'tahun',
        cast(DATE_FORMAT(a.tanggal_permohonan, '%c') as unsigned) as 'bulan',
        SUM(b.harga) as 'total'
        FROM tbl_permohonan a, tbl_detail_permohonan b
        WHERE a.id_permohonan = b.id_permohonan";

        $sql .= " AND DATE_FORMAT(a.tanggal_permohonan, '%Y') = " . $this->db->escape($data['filter']['tahun']);
        if ($data['filter'] && $data['filter']['dari'] && $data['filter']['sampai']) {
            $sql .= " AND DATE_FORMAT(a.tanggal_permohonan, '%c') >= " . $this->db->escape($data['filter']['dari']) . " AND DATE_FORMAT(a.tanggal_permohonan, '%c') <= " . $this->db->escape($data['filter']['sampai']);
        }else if ($data['filter'] && $data['filter']['dari']) {
            $sql .= " AND DATE_FORMAT(a.tanggal_permohonan, '%c') = " . $this->db->escape($data['filter']['dari']);
        }else if ($data['filter'] && $data['filter']['sampai']) {
            $sql .= " AND DATE_FORMAT(a.tanggal_permohonan, '%c') = " . $this->db->escape($data['filter']['sampai']);
        }

        $sql .= " AND a.status in ('6','7','9','10')
            GROUP BY DATE_FORMAT(a.tanggal_permohonan, '%Y%c')
	    ORDER BY bulan, a.id_permohonan";


        $query_3 = $this->db->query($sql)->result();
        $tahun_3 = [];
        $bulan_3 = [];
        $total_3 = [];

        for ($i=$dari; $i <= ($sampai) ; $i++) {
            $tahun_3[$i+1] = ( int ) $data['filter']['tahun'];
            $bulan_3[$i+1] = bulan( $i+1 );
            $total_3[$i+1] = 0;
        }

        foreach ($query_3 as $val) {
            $total_3[$val->bulan] = (int) $val->total;
        }

        $total_3 = array_values($total_3);
        $tahun_3 = array_values($tahun_3);
        $bulan_3 = array_values($bulan_3);

        $index_3 = [ [ 'showInLegend'=>false, 'name'=> 'Pendapatan', 'data'=> $total_3 ] ];
        $graph_3 = $this->highcharts->format_chart($bulan_3, $index_3);

        $this->highcharts->set_type('column');
        $this->highcharts->set_color($color, 'column');
        $this->highcharts->set_xAxis($graph_3['sumbu_x']);
        foreach($graph_3['values'] as $series) { $this->highcharts->set_serie($series); }
        //$this->highcharts->set_title("Total Pendapatan PTSP Tahun ".htmlspecialchars($data['filter']['tahun']), "Grafik Berdasarkan Bulan");
        $this->highcharts->set_title("Total Pendapatan PTSP<br>Bulan ".$bulan[0]. " s/d ".$bulan[count($bulan)-1]." Tahun ".htmlspecialchars($data['filter']['tahun']));
        //$this->highcharts->set_axis_titles('Bulan', 'Nominal');
        $this->highcharts->set_3d(false);
        $this->highcharts->render_to('jumlah_pendapatan');
        $data['jumlah_pendapatan'] = in_array($this->session->userdata('id_role'), ['1', '3', '4']) ? $this->highcharts->render() : null;

        // Status Permohonan
        $sql = "SELECT id_jenis_layanan, status,
            COUNT(status) as 'total'
            FROM tbl_permohonan
	    WHERE 1=1";

        $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%Y') = " . $this->db->escape($data['filter']['tahun']);

        // Uncomment jika ingin menggunakan filter bulan
        if ($data['filter'] && $data['filter']['dari'] && $data['filter']['sampai']) {
            $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') >= " . $this->db->escape($data['filter']['dari']) . " AND DATE_FORMAT(tanggal_permohonan, '%c') <= " . $this->db->escape($data['filter']['sampai']);
        }else if ($data['filter'] && $data['filter']['dari']) {
            $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') = " . $this->db->escape($data['filter']['dari']);
        }else if ($data['filter'] && $data['filter']['sampai']) {
             $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') = " . $this->db->escape($data['filter']['sampai']);
        }

        $sql .= " GROUP BY status";

        $query_4 = $this->db->query($sql)->result();
        $status = [];
        $total_4 = [];
        foreach ($query_4 as $val) {
            $status[] = status_lengkap((int) $val->status);
            $total_4[] = (int) $val->total;
        }
        $index_4 = [ [ 'showInLegend'=>false, 'name'=> 'Status Permohonan', 'data'=> $total_4 ] ];
        $graph_4 = $this->highcharts->format_chart($status, $index_4);
        $this->highcharts->set_type('bar');
        $this->highcharts->set_color($color, 'bar');
        $this->highcharts->set_xAxis($graph_4['sumbu_x']);
        foreach($graph_4['values'] as $series) { $this->highcharts->set_serie($series); }
        $this->highcharts->set_title("Status Permohonan Pelanggan PTSP<br>Bulan ".$bulan[0]. " s/d ".$bulan[count($bulan)-1]." Tahun ".htmlspecialchars($data['filter']['tahun']), "Grafik Berdasarkan Status");
        $this->highcharts->set_axis_titles('Status', 'Jumlah Permohonan');
        $this->highcharts->set_3d(false);
        $this->highcharts->render_to('status_permohonan');
        $data['status_permohonan'] = $this->highcharts->render();

        $data['kontak'] = $this->global_model->get_count_data('tbl_agenda');
        $data['id_role'] = $id_role;

        $this->template->add_js('resources/plugins/highcharts/highcharts.js');
        $this->template->add_js('resources/plugins/highcharts/highcharts-3d.js');
        $this->template->add_js('resources/plugins/highcharts/exporting.js');
        $this->template->add_js('resources/plugins/highcharts/export-csv.js');
        $this->template->add_js($script, 'embed');
        $this->template->write_view('content', $dashboard_view, $data, true);
        $this->template->render();

        // $this->output
        // ->set_status_header(200)
        // ->set_content_type('application/json','utf-8')
        // ->set_output(json_encode($graph_4, JSON_PRETTY_PRINT));
	}

	function dashboard_member() {
	    $this->load->model('global_model');
        $this->load->helper(['date', 'status', 'tgl_indo' ,'general']);
        $this->load->library('highcharts');
        $this->lang->load('backend/dashboard/member', $this->session->userdata('language'));

        $curr_lang = $this->session->userdata('language');
        $lang_key = $curr_lang === 'indonesia' ? 'id' : 'en';

        $year = (int) $this->input->get('year') ? $this->input->get('year') : date('Y');
        $f_month = (int) $this->input->get('from_month') ? $this->input->get('from_month') : date('m');
        $t_month = (int) $this->input->get('to_month');

        if ($f_month > $t_month) {
            $t_month = $f_month;
        }

        $colors = ['#7CB5EC','#ffff33','#90ED7D','#F7A35C','#8085E9','#F15C80','#E4D354','#2B908F','#F45B5B','#9900cc','#f442a7','#abb703'];
        $months = [
                'en' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                'id' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
        ];

        $selected_from_month = $months[$lang_key][$f_month - 1];
        $selected_to_month = $months[$lang_key][$t_month - 1];

        $script_container = "$(document).ready(function() {";

        // --------------------------------------------------------------------------------- //
        // ---------------------------- Riwayat Permohonan --------------------------------- //
        // --------------------------------------------------------------------------------- //
        $riwayat_permohonan_query= $this->db
                ->select('status, COUNT(status) as total')
                ->from('tbl_permohonan')
                ->where('id_pemohon', $this->session->userdata('id_admin'))
                ->where('EXTRACT(YEAR from tanggal_permohonan) = ' . $year);

        $riwayat_permohonan_query->where("EXTRACT(MONTH from tanggal_permohonan) >= ". $f_month);
        $riwayat_permohonan_query->where("EXTRACT(MONTH from tanggal_permohonan) <= ". $t_month);

        $riwayat_permohonan_subquery = $riwayat_permohonan_query->group_by('status')->get_compiled_select();
        $riwayat_permohonan_result = $this->db
                ->select('COALESCE(a.total, 0) as total, b.id_status')
                ->from('m_status b')
                ->join('(' . $riwayat_permohonan_subquery . ') a', 'b.id_status = a.status', 'left')
                ->group_by('b.id_status')
                ->get()
                ->result();


        $cats_riwayat_permohonan = array_map(function($item) {
           return $this->lang->line('request.status.'. $item->id_status);
        }, $riwayat_permohonan_result);

        $data_riwayat_permohonan = array_map(function($item) use ($year) {
            return [
                'y' => (int) $item->total,
                'url' => site_url('/backend/permohonan_layanan/permohonan_layanan') . '?tahun='.$year.'&status='.$item->id_status
            ];
        }, $riwayat_permohonan_result);

        $riwayat_permohonan_series_json = json_encode([
            [
                'showInLegend'=>false,
                'name' => $this->lang->line('chart.1.series.name'),
                'data' => $data_riwayat_permohonan
            ]
        ]);

        $riwayat_permohonan_title = $this->lang->line('chart.1.title') . $selected_from_month;
        if((int) $this->input->get('to_month') !== 0) {
            $riwayat_permohonan_title .= ' - ' . $selected_to_month;
        }
        $riwayat_permohonan_title .= ' ' . $year;

        $riwayat_permohonan_script = "
                $('#riwayatPermohonanChart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: '" . $riwayat_permohonan_title . "'
                    },
                    xAxis: {
                        categories: ". json_encode($cats_riwayat_permohonan) ."
                    },
                    yAxis: {
                        title: {
                            text: '" . $this->lang->line('chart.1.series.name') . "'
                        },
                        allowDecimals: false
                    },
                    series: ". $riwayat_permohonan_series_json .",
                    plotOptions: {
                        series: {
                            cursor: 'pointer',
                            point: {
                                events: {
                                    click: function() {
                                        window.open(this.options.url, '_blank');
                                    }
                                }
                            }
                        }
                    }
                })
        ";

        $script_container .= $riwayat_permohonan_script;

        // --------------------------------------------------------------------------------- //
        // ----------------------------- Daftar Permohonan --------------------------------- //
        // --------------------------------------------------------------------------------- //

        $daftar_permohonan_result = $this->db
            ->select('a.id_permohonan, a.no_permohonan, a.tanggal_permohonan, a.status, b.nama, c.perusahaan')
            ->from('tbl_permohonan a')
            ->join('tbl_admin b', 'b.id_admin = a.id_pemohon', 'left')
            ->join('tbl_perusahaan c', 'c.id_perusahaan = b.id_perusahaan', 'left')
            ->where('a.id_pemohon = ' . $this->session->userdata('id_admin'))
            ->where('a.status = 7')
            ->where('EXTRACT(YEAR FROM a.tanggal_permohonan) = ' . $year)
            ->where('EXTRACT(MONTH FROM a.tanggal_permohonan) >= ' . $f_month)
            ->where('EXTRACT(MONTH FROM a.tanggal_permohonan) <= ' . $t_month)
            ->get()
            ->result();

        $daftar_permohonan_rows = "";

       	$daftar_permohonan_title = $this->lang->line('table.title')  . $selected_from_month;
        if ((int) $this->input->get('to_month') !== 0) {
            $daftar_permohonan_title .= ' - ' . $selected_to_month;
        }
        $daftar_permohonan_title .= ' ' . $year;

        $table_title_script = '
            $("#tableTitle").text("' . $daftar_permohonan_title . '");
        ';

        $script_container .= $table_title_script;

        foreach($daftar_permohonan_result as $result) {
            $daftar_permohonan_row = "<tr>
                <td>" . $result->no_permohonan . "</td>
                <td>" . $result->tanggal_permohonan . "</td>
                <td>" . $result->perusahaan . "</td>
                <td>" . $result->nama . "</td>
                <td>" . $this->lang->line('request.status.'.$result->status) . "</td>
                <td><a href=\" " . site_url('backend/permohonan_layanan/permohonan_layanan/review/'.$result->id_permohonan) . " \" class=\"btn btn-danger btn-sm\" role=\"button\">" . $this->lang->line('table.action.button') . "</a></td>
            </tr>";

            $daftar_permohonan_rows .= $daftar_permohonan_row;
        }

        if (strlen($daftar_permohonan_rows) > 0) {
            $daftar_permohonan_script = '
                $("#dataPermohonanTable tbody").html(`'. $daftar_permohonan_rows .'`);
            ';

            $script_container .= $daftar_permohonan_script;
        }


        // --------------------------------------------------------------------------------- //
        // ------------------------- Jenis Layanan per Bulan ------------------------------- //
        // --------------------------------------------------------------------------------- //

        $jenis_layanan_per_bulan_query = $this->db
                ->select('COUNT(a.id_permohonan) as total, b.layanan as jenis_layanan_name_id, b.layanan_en as jenis_layanan_name_en')
                ->from('tbl_permohonan a')
                ->join('tbl_detail_permohonan c', 'a.id_permohonan = c.id_permohonan')
                ->join('m_layanan b', 'c.id_layanan = b.id_layanan')
                ->where('a.id_pemohon = ' . $this->session->userdata('id_admin'))
                ->where('EXTRACT(YEAR from a.tanggal_permohonan) = ' . $year);

        $jenis_layanan_per_bulan_query->where('EXTRACT(MONTH from a.tanggal_permohonan) >= ' . $f_month);
        $jenis_layanan_per_bulan_query->where('EXTRACT(MONTH from a.tanggal_permohonan) <= ' . $t_month);

        $jenis_layanan_per_bulan_result = $jenis_layanan_per_bulan_query
                ->group_by('b.layanan')
                ->get()
                ->result();

        $cats_jenis_layanan_per_bulan = array_map(function($item) use ($curr_lang) {
            if($curr_lang === 'english') {
                return $item->jenis_layanan_name_en;
            }

            return $item->jenis_layanan_name_id;
        }, $jenis_layanan_per_bulan_result);


        $data_jenis_layanan_per_bulan = array_map(function($item) use ($year, $f_month, $t_month, $colors) {
            return [
                'y' => (int) $item->total,
                'color' => $colors[array_rand($colors)],
            ];
        }, $jenis_layanan_per_bulan_result);


        $jenis_layanan_per_bulan_series_json = json_encode([
            [
                'name' => 'Total',
                'data' => $data_jenis_layanan_per_bulan
            ]
        ]);

        $jenis_layanan_per_bulan_title = $this->lang->line('chart.2.title') . $selected_from_month;
        if ((int) $this->input->get('to_month')  !== 0) {
            $jenis_layanan_per_bulan_title .= ' - ' . $selected_to_month;
        }
        $jenis_layanan_per_bulan_title .= ' ' . $year;

        $jenis_layanan_per_bulan_script = "
                $('#jenisLayananChart').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: '" . $jenis_layanan_per_bulan_title . "'
                    },
                    xAxis: {
                        categories: ". json_encode($cats_jenis_layanan_per_bulan) ."
                    },
                    legend: {
                        enabled: false
                    },
                    yAxis: {
                        title: {
                            text: 'Total'
                        },
                        allowDecimals: false
                    },
                    series: ". $jenis_layanan_per_bulan_series_json ."
                })";

        $script_container .= $jenis_layanan_per_bulan_script;

        // --------------------------------------------------------------------------------- //
        // ---------------------------------- Pembayaran ----------------------------------- //
        // --------------------------------------------------------------------------------- //

        $pembayaran_per_bulan_result = $this->db
                ->select('COALESCE(b.total, 0) as total, a.nama as bulan')
                ->from('m_bulan a')
                ->join('(
                    SELECT SUM(total_harga) as total, EXTRACT(MONTH FROM tanggal_permohonan) as bulan
                    FROM tbl_permohonan
                    WHERE id_pemohon = ' . $this->session->userdata('id_admin') . '
                     AND EXTRACT(YEAR FROM tanggal_permohonan) = ' . $year . '
                     AND (status = 10 OR status = 7) GROUP BY bulan
                    ) b', 'a.id_bulan = b.bulan', 'left')
                ->group_by('a.id_bulan')
                ->get()
                ->result();

        $cats_pembayaran_per_bulan = $months[$lang_key];

        $data_pembayaran_per_bulan = array_map(function($item) {
            return (int) $item->total;
        }, $pembayaran_per_bulan_result);

        $pembayaran_per_bulan_series_json = json_encode([
            [
                'showInLegend'=>false,
                'name' => $this->lang->line('chart.3.series.name'),
                'data' => $data_pembayaran_per_bulan
            ]
        ]);

        $pembayaran_per_bulan_title = $this->lang->line('chart.3.title') . $year;
        $pembayaran_per_bulan_script = "
           $('#pembayaranChart').highcharts({
                chart: {
                    type: 'areaspline'
                },
                title: {
                    text: '". $pembayaran_per_bulan_title ."'
                },
                xAxis: {
                    categories: ". json_encode($cats_pembayaran_per_bulan) ."
                },
                yAxis: {
                    title: {
                        text: 'Total'
                    },
                    allowDecimals: false,
                    labels: {
                        formatter: function () {
                           return Highcharts.numberFormat(this.value,0,',','.');
                        }
                    }
                },
                series: ". $pembayaran_per_bulan_series_json."
           })";

        $script_container .= $pembayaran_per_bulan_script;


        $script_container .= '});';
        return $script_container;
	}

    function scriptJenisLayanan() {
        $filter['dari'] = (int) ($this->input->get('dari') ?? false);
        $filter['sampai'] = (int) ($this->input->get('sampai') ?? $filter['dari']);
        $filter['tahun'] = (int) (($this->input->get('tahun')) ?? date('Y'));

        if ($filter['sampai'] && ($filter['dari'] < 1 || $filter['dari'] > 12)) {
            $filter['dari'] = 1;
        }

        if ($filter['sampai'] && ($filter['sampai'] < 1 || $filter['sampai'] > 12)) {
            $filter['sampai'] = 12;
        }

        if ($filter['tahun'] > date('Y')) {
            $filter['tahun'] = date('Y');
        }

        $colors = ['#7CB5EC','#90ED7D','#F7A35C','#8085E9','#F15C80','#E4D354','#2B908F','#F45B5B','#9900cc','#f442a7','#abb703'];
        $colors = json_encode($colors);


        $this->db->select('id_jenis_layanan, jenis_layanan');
        $this->db->from('m_jenis_layanan');
        $this->db->order_by('id_jenis_layanan', 'asc');
        $jenis_layanan = array_column($this->db->get()->result_array(), 'jenis_layanan');



        $sql = "SELECT
            DATE_FORMAT(tanggal_permohonan, '%Y') as 'tahun',
            jenis_layanan,
            cast(DATE_FORMAT(tanggal_permohonan, '%c') as unsigned) as 'bulan',
            COUNT(no_permohonan) as 'total'
            FROM v_lap_pelayanan WHERE 1=1";

        $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%Y') = " . $this->db->escape($filter['tahun']);
        if ($filter && $filter['dari'] && $filter['sampai']) {
            $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') >= " . $this->db->escape($filter['dari']) . " AND DATE_FORMAT(tanggal_permohonan, '%c') <= " . $this->db->escape($filter['sampai']);
        }else if ($filter && $filter['dari']) {
            $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') = " . $this->db->escape($filter['dari']);
        }else if ($filter && $filter['sampai']) {
            $sql .= " AND DATE_FORMAT(tanggal_permohonan, '%c') = " . $this->db->escape($filter['sampai']);
        }

        $sql .= " GROUP BY jenis_layanan, DATE_FORMAT(tanggal_permohonan, '%Y%c')
            ORDER BY bulan, id_jenis_layanan";

        $result = $this->db->query($sql)->result();

        $dari = (((int) $filter['dari'] ? (int) $filter['dari'] : 1)) - 1;
        $sampai = ((int) $filter['sampai'] ? (int) $filter['sampai'] : 12) - 1;

        $bulan = [];
        $total = [];
        $data = [];

        if (!$filter['dari'] && $filter['sampai']) {
            $dari = $sampai;
        }elseif (!$filter['sampai'] && $filter['dari']) {
            $sampai = $dari;
        }
        if ($filter['tahun'] > date('Y') || ($filter['tahun'] < 1)) {
            $filter['tahun'] = date('Y');
        }


        for ($i=$dari; $i <= ($sampai) ; $i++) {
            foreach($jenis_layanan as $val) {
                $data[bulan( $i+1 )][$val] = 0;
            }
        }

        foreach ($result as $row) {
            $data[bulan($row->bulan)][$row->jenis_layanan] = (int) $row->total;
        }


        foreach ($data as $key => $val) {
            $data[$key] = array_values($val);
        }

        $jenis_layanan = json_encode($jenis_layanan);
        $data = json_encode($data);

        // const data = {
        //     January: [30, 40, 50],
        //     February: [20, 30, 40],
        //     March: [25, 35, 45],
        // };


            $script = "
            $(function(){
                    const data = {$data};

                    const services = {$jenis_layanan};
                    const months = Object.keys(data);
                    const seriesData = services.map((service, index) => ({
                        name: service,
                        data: months.map(month => data[month][index] || 0)
                    }));

                    Highcharts.chart('containerLayanan', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Total Permohonan Berdasarkan Jenis Layanan Tahun {$filter['tahun']}'
			    //text: 'Total jenis layanan yang Dipesan Tahun {$filter['tahun']}'
                        },
                        colors: {$colors},
                        subtitle: {
                            text: 'Grafik berdasarkan bulan'
                        },
                        xAxis: {
                            categories: months,
                            crosshair: true,
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Jumlah Pesanan'
                            },
                            allowDecimals: false
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: seriesData
                    });
                });
                ";

        return $script;
    }

    function change_password() {
        $this->load->model('backend/login_model');
        if ( isset($_POST['btn_simpan']) ) {
            $id_user            = $this->session->userdata('id_admin');
            $password_lama      = $this->input->post('password_lama');
            $password_baru      = $this->input->post('password_baru');
            $ulangi_password    = $this->input->post('ulangi_password');

            $check_password     = $this->login_model->check_password($id_user, $password_lama);

            if ( !$check_password ) {
                $this->session->set_flashdata('msg_change_password', 'Password lama tidak valid');
            } else if ( empty($password_baru) ) {
                $this->session->set_flashdata('msg_change_password', 'Password baru masih kosong');
            } else if ( $password_baru  != $ulangi_password ) {
                $this->session->set_flashdata('msg_change_password', 'Pengulangan tidak valid');
            } else {
                $data_update    = array(
                    'password' => strrev(md5($password_baru))
                );
                $update = $this->login_model->update_user($id_user, $data_update);
                $this->session->set_flashdata('msg_change_password', 'Password berhasil diubah');
            }
            redirect(base_url().'backend/home/change_password');
        }

        $data['msg_change_password']    = $this->session->flashdata('msg_change_password');
        $data['breadcrumb']             = array(
            array(
                'label' => 'Ubah Password',
                'link'  => NULL
            )
        );
        $data['active_breadcrumb']      = 'Ubah Password';
        $this->template->write('title', 'Ubah Password');
        $this->template->write_view('content', 'backend/change_password', $data, true);
        $this->template->render();
    }

    function gapi(){
        $data = array();
        $data['client_id'] = '183671426529-69gfuvj85kprao839cim2svbtk15su85.apps.googleusercontent.com';
        $this->load->view('backend/gapi', $data);
    }
}
