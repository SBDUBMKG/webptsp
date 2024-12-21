<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_status extends MY_Controller {
  var $page_title       = 'Monitoring Status';
  var $column_datatable = array('id_jenis_permintaan_layanan', 'jenis_layanan','jenis_permintaan_layanan','keterangan','aktivasi');
  var $folder           = 'backend/monitoring_status';
  var $module           = '';

  function __construct(){
    parent::__construct();
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

    $curr_lang = $this->session->userdata('language');
    $this->lang->load('backend/monitoring/monitoring', $curr_lang);

    if($_POST) {
      $no_permohonan = $this->input->post('no_permohonan');
      if($id_role == 7) {
        $data['permohonan'] = $this->db->get_where('tbl_permohonan', ['id_pemohon' => $id_admin, 'no_permohonan' => $no_permohonan])->row();
      } else {
        $data['permohonan'] = $this->db->get_where('tbl_permohonan', ['no_permohonan' => $no_permohonan])->row();
      }
      if ($data['permohonan'] !== NULL) {
        $data['detail_akun'] = $this->db->get_where('tbl_admin', ['id_admin' => $data['permohonan']->id_pemohon])->row();
        $data['detail_permohonan'] = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $data['permohonan']->id_permohonan])->result();
      } else {
        $errMsg = $this->lang->line('search.msg.error');
      }
    }

    $data['errMsg']         = $errMsg;

    $this->template->write('title', $this->lang->line('title.page'));
    $this->template->write_view('content', $this->folder.'/monitoring_status', $data, true);
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
