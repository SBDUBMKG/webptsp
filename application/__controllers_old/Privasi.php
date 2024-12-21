<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Privasi extends CI_Controller 
{
 public function __construct() 
 {
    parent::__construct(); 
 } 

 public function index() 
 { 
    $data['title']  = "Privacy Policy";
    $data['bahasa']   = $this->session->userdata('bahasa');

    $row['content'] = $this->load->view('privasi', $data, TRUE);
    $this->load->view('template', $row);
 } 
} 