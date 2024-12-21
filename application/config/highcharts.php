<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// shared_options : highcharts global settings, like interface or language
$config['shared_options'] = array(
	'chart' => array(
		'backgroundColor' => array(
			'linearGradient' => array(0, 0, 500, 500),
			'stops' => array(
				array(0, 'rgb(255, 255, 255)'),
				array(1, 'rgb(240, 240, 255)')
			)
		),
		'shadow' => true,

		
	),
	'credits'=> array('enabled'=>false),
	// 'lang' => array('numericSymbols' => array(' ribu', ' juta' , ' milyar', ' trilyun')),
	'lang' => array('numericSymbols' => false),
	'plotOptions' => array('line' => array('dataLabels'=>array('enabled'=>true)),'column' => array('dataLabels'=>array('enabled'=>true)),'bar' => array('dataLabels'=>array('enabled'=>true))),

);

// Template Example
$config['chart_template'] = array(
	'chart' => array(
		'renderTo' => 'graph',
		'defaultSeriesType' => 'column',
		'backgroundColor' => array(
			'linearGradient' => array(0, 500, 0, 0),
			'stops' => array(
				array(0, 'rgb(255, 255, 255)'),
				array(1, 'rgb(190, 200, 255)')
			)
		),
     ),
     'colors' => array(
     	 '#ED561B', '#50B432'
     ),
     'credits' => array(
     	'enabled'=> false
     ),
     'title' => array(
		'text' => 'Template from config file'
     ),
     'legend' => array(
     	'enabled' => false
     ),
    'yAxis' => array(
		'title' => array(
			'text' => 'population'
		)
	),
	'xAxis' => array(
		'title' => array(
			'text' => 'Countries'
		)
	),
	'tooltip' => array(
		'shared' => true
	)
);