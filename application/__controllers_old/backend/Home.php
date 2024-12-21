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
        $this->load->helper(['date', 'status', 'tgl_indo']);
        $this->load->library('highcharts');
        $id_role = $this->session->userdata("id_role");
        $dashboard_view = 'backend/dashboard';
        $script = '';
        $color = ['#7CB5EC','#ffff33','#90ED7D','#F7A35C','#8085E9','#F15C80','#E4D354','#2B908F','#F45B5B','#9900cc','#f442a7','#abb703']; 
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
                            }
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
                $dashboard_view = 'backend/dashboard_bendahara';
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
                            }
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
                            }
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
                            }
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
                            }
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
                            }
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
                            }
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
                        title: {
                            text: '',
                            x: -20 //center
                        },
                        subtitle: {
                            text: '',
                            x: -20
                        },
                        xAxis: {
                            categories: ['A', 'B', 'C']
                        },
                        yAxis: {
                            title: {
                                text: 'y Axis'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                        },
                        tooltip: {
                            valueSuffix: '°C'
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle',
                            borderWidth: 0
                        },
                        series: [{
                            name: 'Tokyo',
                            data: [7, 8, 9]
                        }, {
                            name: 'New York',
                            data: [8, 9, 8]
                        }, {
                            name: 'Berlin',
                            data: [9, 10, 7]
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

                    $('#container4').highcharts({
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
                            }
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

                    $('#container5').highcharts({
                        title: {
                            text: '',
                            x: -20 //center
                        },
                        subtitle: {
                            text: '',
                            x: -20
                        },
                        xAxis: {
                            categories: ['A', 'B', 'C']
                        },
                        yAxis: {
                            title: {
                                text: 'y Axis'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                        },
                        tooltip: {
                            valueSuffix: '°C'
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle',
                            borderWidth: 0
                        },
                        series: [{
                            name: 'Tokyo',
                            data: [7, 8, 9]
                        }, {
                            name: 'New York',
                            data: [8, 9, 8]
                        }, {
                            name: 'Berlin',
                            data: [9, 10, 7]
                        }]
                    });

                    $('#container6').highcharts({
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

                    $('#container7').highcharts({
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
                            }
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
                            }
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

        // Total Pendaftar
        $query = $this->db->query("
            SELECT
            DATE_FORMAT(tanggal_daftar, '%Y') as 'tahun',
            cast(DATE_FORMAT(tanggal_daftar, '%c') as unsigned) as 'bulan',
            COUNT(id_admin) as 'total'
            FROM tbl_admin
            WHERE id_role = 7 and DATE_FORMAT(tanggal_daftar, '%Y') = year(curdate())
            GROUP BY DATE_FORMAT(tanggal_daftar, '%Y%c')
            ORDER BY bulan, id_admin
            LIMIT 0,12
        ")->result();
        $tahun = [];
        $bulan = [];
        $total = [];
        foreach ($query as $val) {
            $tahun[] = (int) $val->tahun;
            //$bulan[] = bulan( $val->bulan )." ".$val->tahun;
	    //perbaikan oleh Nurhayati Rahayu (24/10/2019)
 	    $bulan[] = bulan( $val->bulan );
	    //baris terakhir perbaikan 
            $total[] = (int) $val->total;
        }
        $index = [ [ 'name'=> 'Total Pendaftar', 'data'=> $total ] ];
        $graph = $this->highcharts->format_chart($bulan, $index);
        $this->highcharts->set_type('area');
        // $this->highcharts->set_color($color,'area');
        $this->highcharts->set_xAxis($graph['sumbu_x']); 
        foreach($graph['values'] as $series) { $this->highcharts->set_serie($series); }
        $this->highcharts->set_title("Total Pendaftar PTSP Tahun ".date("Y"), "Grafik Berdasarkan Bulan");
        $this->highcharts->set_axis_titles('Bulan', 'Jumlah Pendaftar');
        $this->highcharts->set_3d(false);
        $this->highcharts->render_to('jumlah_pendaftar');
        $data['jumlah_pendaftar'] = $this->highcharts->render();

        // Total Permohonan Layanan
        $query_2 = $this->db->query("
            SELECT
            DATE_FORMAT(tanggal_permohonan, '%Y') as 'tahun',
            cast(DATE_FORMAT(tanggal_permohonan, '%c') as unsigned) as 'bulan',
            COUNT(id_permohonan) as 'total'
            FROM tbl_permohonan
	    WHERE DATE_FORMAT(tanggal_permohonan, '%Y') = year(curdate())
            GROUP BY DATE_FORMAT(tanggal_permohonan, '%Y%c')
            ORDER BY bulan, id_permohonan
        ")->result();
        $tahun_2 = [];
        $bulan_2 = [];
        $total_2 = [];
        foreach ($query_2 as $val) {
            $tahun_2[] = (int) $val->tahun;
            //$bulan_2[] = bulan( $val->bulan )." ".$val->tahun;
	    //perbaikan oleh Nurhayati Rahayu (24/10/2019)
	    $bulan_2[] = bulan( $val->bulan );
	    //baris terakhir perbaikan 
            $total_2[] = (int) $val->total;
        }
        $index_2 = [ [ 'name'=> 'Total Permohonan', 'data'=> $total_2 ] ];
        $graph_2 = $this->highcharts->format_chart($bulan_2, $index_2);
        $this->highcharts->set_type('column');
        $this->highcharts->set_color($color, 'column');
        $this->highcharts->set_xAxis($graph_2['sumbu_x']); 
        foreach($graph_2['values'] as $series) { $this->highcharts->set_serie($series); }
        $this->highcharts->set_title("Total Permohonan Layanan PTSP Tahun ".date("Y"), "Grafik Berdasarkan Bulan");
        $this->highcharts->set_axis_titles('Bulan', 'Jumlah Permohonan');
        $this->highcharts->set_3d(false);
        $this->highcharts->render_to('jumlah_layanan');
        $data['jumlah_layanan'] = $this->highcharts->render();
        
        // Total Pendapatan
        $query_3 = $this->db->query("
            SELECT
            DATE_FORMAT(tanggal_permohonan, '%Y') as 'tahun',
            cast(DATE_FORMAT(tanggal_permohonan, '%c') as unsigned) as 'bulan',
            SUM(total_harga) as 'total'
            FROM tbl_permohonan
	    WHERE DATE_FORMAT(tanggal_permohonan, '%Y') = year(curdate())	
            GROUP BY DATE_FORMAT(tanggal_permohonan, '%Y%c')
	    ORDER BY bulan, id_permohonan
        ")->result();
        $tahun_3 = [];
        $bulan_3 = [];
        $total_3 = [];
        foreach ($query_3 as $val) {
            $tahun_3[] = (int) $val->tahun;
            //$bulan_3[] = bulan( $val->bulan )." ".$val->tahun;
	    //perbaikan oleh Nurhayati Rahayu (24/10/2019)
	    $bulan_3[] = bulan( $val->bulan );
	    //baris terakhir perbaikan
            $total_3[] = (int) $val->total;
            // $total_3[] = number_format($val->total, 0, '', '.');
        }
        $index_3 = [ [ 'name'=> 'Pendapatan', 'data'=> $total_3 ] ];
        $graph_3 = $this->highcharts->format_chart($bulan_3, $index_3);
        $this->highcharts->set_type('line');
        // $this->highcharts->set_color($color, 'line');
        $this->highcharts->set_xAxis($graph_3['sumbu_x']); 
        foreach($graph_3['values'] as $series) { $this->highcharts->set_serie($series); }
        $this->highcharts->set_title("Total Pendapatan PTSP Tahun ".date("Y"), "Grafik Berdasarkan Bulan");
        $this->highcharts->set_axis_titles('Bulan', 'Nominal');
        $this->highcharts->set_3d(false);
        $this->highcharts->render_to('jumlah_pendapatan');
        $data['jumlah_pendapatan'] = $this->highcharts->render();
        
        // Status Permohonan
        $query_4 = $this->db->query("
            SELECT id_jenis_layanan, status,
            COUNT(status) as 'total'
            FROM tbl_permohonan
	    WHERE DATE_FORMAT(tanggal_permohonan, '%Y') = year(curdate())
            GROUP BY status
        ")->result();
        $status = [];
        $total_4 = [];
        foreach ($query_4 as $val) {
            $status[] = status_lengkap((int) $val->status);
            $total_4[] = (int) $val->total;
        }
        $index_4 = [ [ 'name'=> 'Status Permohonan', 'data'=> $total_4 ] ];
        $graph_4 = $this->highcharts->format_chart($status, $index_4);
        $this->highcharts->set_type('bar');
        $this->highcharts->set_color($color, 'bar');
        $this->highcharts->set_xAxis($graph_4['sumbu_x']); 
        foreach($graph_4['values'] as $series) { $this->highcharts->set_serie($series); }
        $this->highcharts->set_title("Status Permohonan Pelanggan PTSP Tahun ".date("Y"), "Grafik Berdasarkan Status");
        $this->highcharts->set_axis_titles('Status Permohonan', 'Jumlah Pelanggan');
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
