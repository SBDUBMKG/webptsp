<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_status extends CI_Controller {
  var $page_title       = 'Monitoring Status';
  var $column_datatable = array('id_jenis_permintaan_layanan', 'jenis_layanan','jenis_permintaan_layanan','keterangan','aktivasi');
  var $folder           = 'backend/monitoring_status';
  var $module           = '';

  function __construct(){
    parent::__construct();
    // $this->template->set_template('frontend');
$this->template->set_template('frontend_ptsp');
    $module = $this->folder.'/'.$this->router->fetch_class();
    $this->load->model($this->folder.'/'.'monitoring_status_model', 'app_model');
    $this->app_model->initialize($module);
    $this->load->helper('status');
    $this->module = $module;
  }

  public function index() {
    $module             = $this->module;
    $data['title']      = "Monitoring Status";
    $data['url_back']   = "window.location.href='".site_url($module)."'";
    $id_role            = $this->session->userdata('id_role');
    $id_admin           = $this->session->userdata('id_admin');
    $scsMsg             = NULL;
    $errMsg             = NULL;
    
    if($_POST) {
      $no_permohonan = trim($this->input->post('no_permohonan',true));
      if($id_role == 7) {
        $data['permohonan'] = $this->db->get_where('tbl_permohonan', ['id_pemohon' => $id_admin, 'no_permohonan' => $no_permohonan])->row();
      } else {
        $data['permohonan'] = $this->db->get_where('tbl_permohonan', ['no_permohonan' => $no_permohonan])->row();
      }
      if ($data['permohonan'] !== NULL) {
        $data['detail_akun'] = $this->db->get_where('tbl_admin', ['id_admin' => $data['permohonan']->id_pemohon])->row();
        $data['detail_permohonan'] = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $data['permohonan']->id_permohonan])->result();
      } else {
        $errMsg = 'No Invoice Tidak Ditemukan';
      }
    }

    $data['errMsg']         = $errMsg;
    
    $this->template->write('title', $data['title']);
    $this->template->write_view('content', 'v_cek_status', $data, true);
    $this->template->render();
  }

  function test(){
    $data['permohonan'] = $this->db->get_where('tbl_permohonan', ['no_permohonan' => 5492])->row();
    if ($data['permohonan'] !== NULL) {
      $data['detail_akun'] = $this->db->get_where('tbl_admin', ['id_admin' => $data['permohonan']->id_pemohon])->row();
      $data['detail_permohonan'] = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $data['permohonan']->id_permohonan])->result();
    }

    $this->output
    ->set_status_header(200)
    ->set_content_type('application/json','utf-8')
    ->set_output(json_encode($data, JSON_PRETTY_PRINT));
  }
}