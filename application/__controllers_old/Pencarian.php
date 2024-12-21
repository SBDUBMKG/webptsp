<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller 
{
 public function __construct() 
 {
    parent::__construct(); 
    $this->load->model('frontend/pencarian_model');
 } 

 public function index() 
 { 
    $data['title']  	= "Pencarian";
    $data['bahasa']   	= $this->session->userdata('bahasa');
    $search 			= strtolower($_GET['search']);
    $data['pencarian'] 	= $search;
    $data['kegiatan'] 	= $this->pencarian_model->get_kegiatan($data['bahasa'],$search);
    $data['artikel']	= $this->pencarian_model->get_artikel($data['bahasa'],$search);
    $data['agenda']		= $this->pencarian_model->get_agenda($data['bahasa'],$search);
    $row['content'] 	= $this->load->view('v_pencarian', $data, TRUE);
    $this->load->view('template', $row);
 } 
} 