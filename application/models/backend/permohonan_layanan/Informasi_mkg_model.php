<?php
//file: application\models\backend\permohonan_layanan\Informasi_mkg_model.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_mkg_model extends CI_Model {
  var $table                      = 'tbl_permohonan';
  var $table_detail_permohonan    = 'tbl_detail_permohonan';
  var $table_user                 = 'tbl_admin';
  var $table_perusahaan_user      = 'tbl_perusahaan';
  var $table_status               = 'm_status';
  var $pk_name                    = 'id_permohonan';
  var $module                     = '';

  function __construct(){
    parent::__construct();
  }

  function initialize($module) {
    if ( !empty($module) ) {
      $this->module = $module;
    }
    else {
      $this->module = $this->module;
    }
  }

  public function show_datatable($column_datatable, $iDisplayStart, $iDisplayLength, $order, $sSearch, $queries = []) {
    $aColumns = $column_datatable;
    $id_admin = $this->session->userdata('id_admin');
    $id_role  = $this->session->userdata('id_role');

    $curr_lang = $this->session->userdata('language');
    $this->lang->load('backend/service_request/datatable', $curr_lang);

    // DB table to use
    $sTable = $this->table;

    // Paging
    if(isset($iDisplayStart) && $iDisplayLength != '-1') {
      $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
    }

    // Columns
    $columns = $this->input->get_post('columns', true);

    // Ordering
    if(isset($order) > 0) {
      for($i=0; $i<count($order); $i++) {
        if($columns[$order[$i]['column']]['orderable'] == 'true') {
          if($order[$i]['column']==3){
            $this->db->order_by('('.$aColumns[8].' is null), '.$aColumns[8].' '.$order[$i]['dir']);
          } elseif($order[$i]['column']==8){
            $this->db->order_by('(D.sort is null), D.sort '.$order[$i]['dir']);
          } else {
            //if($order[$i]['column']==8) $this->db->order_by('FIELD(B.status,0,9,4,7,10,2,1,3,5,6,8)');else
            $this->db->order_by($aColumns[intval($order[$i]['column'])], $order[$i]['dir']);
          }
        }
      }
    }
    if ( count($order) < 1 ) {
      $this->db->order_by($this->pk_name, 'desc');
    }

    /*
    * Filtering
    * NOTE this does not match the built-in DataTables filtering which does it
    * word by word on any field. It's possible to do here, but concerned about efficiency
    * on very large tables, and MySQL's regex functionality is very limited
    */

    $where = " 1 = 1";
    if($id_role == 4) {
      $where .= " AND B.status = 4 ";
    }
    if($id_role == 7) {
      $where .= " AND B.id_pemohon = ".$id_admin;
    }

    if (isset($queries['tahun'])) {
        $where .= " AND EXTRACT(YEAR from B.tanggal_permohonan) = ".$queries['tahun'];
    }

    if (isset($queries['status'])) {
        $where .= " AND B.status = ".$queries['status'];
    }

    if(isset($sSearch) && !empty($sSearch['value'])) {
      $where .= " AND (";
      for($i=0; $i<count($aColumns) - 1; $i++) {
        $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

        // Individual column filtering
        if( $columns[$i]['searchable'] == 'true') {
          // if ( $aColumns[$i] == 'jenis_layanan' )
          //     $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
          // else if ( $aColumns[$i] == 'keterangan' )
          //     $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
          // else
          $where .= "LOWER(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
        }
      }
      $where .= "LOWER(D.status) LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
      $where  = substr($where, 0, strlen($where)-4);
      $where .= ")";
    }

    $this->db->where($where);
    // Select Data
    // Awal script yang diedit Rahmat, 3 Juni 2020 => asalnya "C.nama perusahaan" dirubah menjadi "C.perusahaan"
    $this->db->select('B.id_permohonan, B.id_pemohon, B.no_permohonan, B.tanggal_permohonan, B.tanggal_verifikasibendahara, B.pengantar, A.nama, A.no_hp, B.status, C.perusahaan, group_concat(E.download) as docs');
    // Akhir script yang diedit Rahmat, 3 Juni 2020
    $this->db->from($this->table.' B');
    $this->db->join($this->table_user.' A', 'B.id_pemohon = A.id_admin');
    $this->db->join($this->table_perusahaan_user.' C', 'C.id_perusahaan = A.id_perusahaan','LEFT');
    $this->db->join($this->table_status.' D', 'D.id_status = B.status','LEFT');
    $this->db->join($this->table_detail_permohonan.' E', 'B.id_permohonan = E.id_permohonan','LEFT');
    $this->db->group_by('B.id_permohonan');

    $rResult = $this->db->get();

    // Data set length after filtering
    $this->db->where($where);
    // Awal script yang diedit Rahmat, 3 Juni 2020 => asalnya "C.nama perusahaan" dirubah menjadi "C.perusahaan"
    // $this->db->select('B.id_permohonan, B.id_pemohon, B.no_permohonan, B.tanggal_permohonan, B.tanggal_verifikasibendahara, B.pengantar, A.nama, A.no_hp, B.status, C.perusahaan');
    $this->db->select('B.id_permohonan, B.id_pemohon, B.no_permohonan, B.tanggal_permohonan, B.tanggal_verifikasibendahara, B.pengantar, A.nama, A.no_hp, B.status, C.perusahaan, group_concat(E.download) as docs');
    // Akhir script yang diedit Rahmat, 3 Juni 2020
    $this->db->from($this->table.' B');
    $this->db->join($this->table_user.' A', 'B.id_pemohon = A.id_admin');
    $this->db->join($this->table_perusahaan_user.' C', 'C.id_perusahaan = A.id_perusahaan','LEFT');
    $this->db->join($this->table_status.' D', 'D.id_status = B.status','LEFT');
    $this->db->join($this->table_detail_permohonan.' E', 'B.id_permohonan = E.id_permohonan','LEFT');
    $this->db->group_by('B.id_permohonan');

    $iFilteredTotal = $this->db->count_all_results();
    $iTotal = $iFilteredTotal;

    // Output
    $output = array(
      'sEcho' => 0,
      'iTotalRecords' => $iTotal,
      'iTotalDisplayRecords' => $iFilteredTotal,
      'aaData' => array()
    );

    $i=1;
    $nomor = (!empty($iDisplayStart) && $iDisplayStart != -1 ) ? $iDisplayStart+1 : 1;

    foreach($rResult->result_array() as $aRow)
    {

        // var_dump($aRow);
        // die();
      // $nama_perusahaan = get_nama_perusahaan($aRow['id_pemohon']);
      $row = [];
      $row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';

      $row[] = $aRow['no_permohonan'];
      //Menghapus format tanggal tanpa jam diubah menjadi ditambahkan jam. Perubahan dilakukan oeh Nurhayati Rahayu (06/07/2021)
      //$row[] = format_datetime($aRow['tanggal_permohonan']);
      $row[] = $aRow['tanggal_permohonan'];
      $row[] = $aRow['tanggal_verifikasibendahara'];
      //baris terakhir perubahan oleh Nurhayati Rahayu (06/07/2021)
      // Awal script yang diedit Rahmat, 25 Maret 2021 => tukar posisi nama dengan perusahaan
      $row[] = !empty($aRow['perusahaan']) ? $aRow['perusahaan'] : 'PERSEORANGAN';
      $row[] = $aRow['nama'];

      // Awal script yang ditambahkan Rahmat, 13 April 2021
      $row[] = $aRow['no_hp'];
      // Akhir script yang ditambahkan Rahmat, 13 April 2021

      $stts = NULL;
      $aksi = NULL;

      // Akhir script yang dinon-aktifkan Rahmat 6 Mei 2020

      // HAK AKSES
      if ($aRow['status'] == 0) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Belum Dikonfirmasi</font>';
          // $aksi = '<a href="'.site_url('backend/permohonan_layanan/permohonan_layanan/konfirmasi/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check"></i> Konfirmasi</a>';
          $aksi = '
          <a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/konfirmasi/'.$aRow[$this->pk_name]).'"><span class="btn btn-xs btn-danger" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Konfirmasi</span></a>
          <br>
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=green><i class="fa fa-fw fa-spinner fa-spin"></i> ' . $this->lang->line('request.status.0') . ' </font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Belum Dikonfirmasi</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 1) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Kelengkapan Data</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';

        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> ' . $this->lang->line('request.status.1') . ' </font>';
          $aksi = '
          <a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/proses/'.$aRow[$this->pk_name]).'"><span class="btn btn-xs btn-primary" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-pencil-square"></i> ' . $this->lang->line('navigation.button.complete') . '  </span></a>
          <br>
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Kelengkapan Data</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 2) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=green><i class="fa fa-fw fa-ban"></i> Proses Dihentikan</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=red><i class="fa fa-fw fa-ban"></i> ' . $this->lang->line('request.status.2') . ' </font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=green><i class="fa fa-fw fa-ban"></i> Proses Dihentikan</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 3) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Bukti Pembayaran</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=red><i class="fa fa-fw fa-warning"></i> ' . $this->lang->line('request.status.3') . ' </font>';
          $aksi = '
          <a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/invoice/'.$aRow[$this->pk_name]).'"target="_blank"><span class="btn btn-xs btn-info" style="min-width:110px;margin-bottom:2px"><i class="fa fa-file-o"></i> Invoice </span></a>
          <br>
          <a class="btn btn-xs btn-warning" style="min-width:110px;margin-bottom:2px" target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/upload/'.$aRow[$this->pk_name]).'"><i class="fa fa-upload"></i> '. $this->lang->line('navigation.button.upload') .' </a>
          <br>
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Bukti Pembayaran</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 4) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Verifikasi Pembayaran</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif ($id_role == 4) { //BENDAHARA
          $stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Verifikasi Pembayaran</font>';
          // $aksi = '<a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/verifikasi_pembayaran/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-circle-o"></i> Verifikasi</a>';
          $aksi = '
          <a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/verifikasi_pembayaran/'.$aRow[$this->pk_name]).'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check-circle-o"></i> Verifikasi</span></a>
          <br>
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-info" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> ' . $this->lang->line('request.status.4') . ' </font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Verifikasi Pembayaran</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 5) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=green><i class="fa fa-fw fa-ban"></i> Proses Dihentikan</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=red><i class="fa fa-fw fa-ban"></i> ' . $this->lang->line('request.status.5') . ' </font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=green><i class="fa fa-fw fa-ban"></i> Proses Dihentikan</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 6) {
        if($id_role == 7){ //PENGGUNA
          $stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> ' . $this->lang->line('request.status.6') . ' </font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=orange><i class="fa fa-fw fa-warning"></i>Konfirmasi Pengiriman</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 7) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses (User Belum Mengisi Survei)</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=green><i class="fa fa-fw fa-check"></i> ' . $this->lang->line('request.status.7') . ' </font>';

          $aksi = '';

          $year = date('Y', strtotime($aRow['tanggal_permohonan']));
          if ($year < 2025) {
              $docs = explode(",", $aRow['docs']);
              foreach($docs as $i => $doc) {
                  $aksi .= '
                  <a role="button" id="btnDokHasil" data-document="' . $doc .  '" ><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px" ><i class="fa fa-fw fa-download"></i> ' . $this->lang->line('navigation.button.coverletter') . ' ' . ($i+1) . ' </span></a>
                  <br>
                  ';
              }
          }

          $aksi .= '
          <a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/review/'.$aRow[$this->pk_name]).'"><span class="btn btn-xs btn-warning" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-pencil-square"></i> ' . $this->lang->line('navigation.button.review') . '</a>
          <br>
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses (User Belum Mengisi Survei)</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 8) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Ulang Bukti Pembayaran</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=red><i class="fa fa-fw fa-warning"></i> ' . $this->lang->line('request.status.8') . ' </font>';
          // $aksi = '<a class="btn btn-xs btn-success" target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/invoice/'.$aRow[$this->pk_name]).'" target="_blank"><i class="fa fa-file-o"></i> Invoice</a> <a class="btn btn-xs btn-warning" target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/upload/'.$aRow[$this->pk_name]).'"><i class="fa fa-upload"></i> Upload Ulang</a>';
          $aksi = '
          <a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/invoice/'.$aRow[$this->pk_name]).'" target="_blank"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-file-o"></i> Invoice</span></a>
          <br>
          <a class="btn btn-xs btn-warning" style="min-width:110px;margin-bottom:2px" target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/upload/'.$aRow[$this->pk_name]).'"><i class="fa fa-upload"></i> ' . $this->lang->line('navigation.button.reupload') . ' </a>
          <br>
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Ulang Bukti Pembayaran</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 9) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> Verifikasi Akhir</font>';
          // $aksi = '<a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/verifikasi_akhir/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-square"></i> Verifikasi</a>';
          // <a data-target="#modal_verifikasi_akhir" data-toggle="modal" onclick="showModalVerifikasiAkhir('. $aRow[$this->pk_name] .')"><span class="btn btn-xs btn-warning"><i class="fa fa-fw fa-check-square"></i> Verifikasi</span></a>
          $aksi = '
          <a target="_blank" href="'.site_url('backend/permohonan_layanan/permohonan_layanan/verifikasi_akhir/'.$aRow[$this->pk_name]).'"><span class="btn btn-xs btn-warning" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check-square"></i> Verifikasi</span></a>
          <br>
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> ' . $this->lang->line('request.status.9') . ' </font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }
        else{
          $stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> Verifikasi Akhir</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
      }elseif ($aRow['status'] == 10) {
        if ($id_role == 3) { //ADMIN
          $stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i> Detail Data</span></a>';
        }
        elseif($id_role == 7){ //PENGGUNA
          $stts = '<font color=green><i class="fa fa-fw fa-check"></i> ' . $this->lang->line('request.status.10') . ' </font>';

          $aksi = '';
          $docs = explode(",", $aRow['docs']);
          foreach($docs as $i => $doc) {
              $aksi .= '
              <a role="button" id="btnDokHasil" data-document="' . $doc .  '" ><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px" ><i class="fa fa-fw fa-download"></i> ' . $this->lang->line('navigation.button.coverletter') . ' ' . ($i+1) . ' </span></a>
              <br>
              ';
          }

          $aksi .= '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>
          ';
        }
        else{
          $stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses</font>';
          $aksi = '
          <a target="_blank" href="'.base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name].'"><span class="btn btn-xs btn-success" style="min-width:110px;margin-bottom:2px"><i class="fa fa-fw fa-check"></i>' . $this->lang->line('navigation.button.detail') . '</span></a>';
        }

      }

      $row[] = $stts;
      $row[] = '<center>'.$aksi.'</center>';

      $row[] = '';

      $output['aaData'][] = $row;
      $i++;
      $nomor++;
    }

    // $this->output
    // ->set_status_header(200)
    // ->set_content_type('application/json','utf-8')
    // ->set_output(json_encode($output, JSON_PRETTY_PRINT));
    return $output;
  }


  public function show_datatable_bo($column_datatable, $iDisplayStart, $iDisplayLength, $order, $sSearch) {
    $aColumns = $column_datatable;
    $id_admin = $this->session->userdata('id_admin');
    $id_role  = $this->session->userdata('id_role');

    // DB table to use
    $sTable = $this->table_detail_permohonan;

    // Paging
    if(isset($iDisplayStart) && $iDisplayLength != '-1') {
      $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
    }

    // Columns
    $columns = $this->input->get_post('columns', true);

    // Ordering
    if(isset($order) > 0) {
      for($i=0; $i<count($order); $i++) {
        if($columns[$order[$i]['column']]['orderable'] == 'true') {
          $this->db->order_by($aColumns[intval($order[$i]['column'])], $order[$i]['dir']);
        }
      }
    }
    if ( count($order) < 1 ) {
      $this->db->order_by('id_detail_permohonan', 'desc');
    }

    $where = " tbl_permohonan.status = 0";

    if(isset($sSearch) && !empty($sSearch['value'])) {
      $where .= " AND (";
      for($i=0; $i<count($aColumns); $i++) {
        $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

        // Individual column filtering
        if( $columns[$i]['searchable'] == 'true') {
          $where .= "LOWER(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
        }
      }
      $where  = substr($where, 0, strlen($where)-4);
      $where .= ")";
    }

    // Select Data1
    $this->db->where($where);
    $this->db->select('
      tbl_detail_permohonan.id_detail_permohonan as id_det,
      tbl_detail_permohonan.status as status_detail,
      m_layanan.layanan,
      m_layanan.penanggung_jawab as id_bo,
      tbl_permohonan.id_permohonan,
      tbl_permohonan.id_pemohon,
      tbl_permohonan.no_permohonan,
      tbl_permohonan.tanggal_permohonan,
      tbl_permohonan.tanggal_verifikasibendahara,
      tbl_permohonan.status,
      tbl_admin.nama
    ');
    $this->db->join('m_layanan', 'tbl_detail_permohonan.id_layanan = m_layanan.id_layanan');
    $this->db->join('tbl_permohonan', 'tbl_detail_permohonan.id_permohonan = tbl_permohonan.id_permohonan');
    $this->db->join('tbl_admin', 'tbl_permohonan.id_pemohon = tbl_admin.id_admin');
    $this->db->from($this->table_detail_permohonan);

    $rResult = $this->db->get();

    // $this->output
    // ->set_status_header(200)
    // ->set_content_type('application/json','utf-8')
    // ->set_output(json_encode($rResult->result_array(), JSON_PRETTY_PRINT));

    $iFilteredTotal = $this->db->count_all_results();

    // Total data set length
    $iTotal = $iFilteredTotal;

    // Output
    $output = array(
      'sEcho' => 0,
      'iTotalRecords' => $iTotal,
      'iTotalDisplayRecords' => $iFilteredTotal,
      'aaData' => array()
    );

    $i=1;
    $nomor = (!empty($iDisplayStart) && $iDisplayStart != -1 ) ? $iDisplayStart+1 : 1;

    foreach($rResult->result_array() as $aRow)
    {
      if($aRow['id_bo'] == $id_role) {
        $nama_perusahaan = get_nama_perusahaan($aRow['id_pemohon']);
        $id_det = $aRow['id_det'];
        $id_per = $aRow['id_permohonan'];
        $attr_1 = $aRow['status_detail'] == 'Tersedia' ? 'disabled' : 'onclick="window.location.href=\'?a='.$id_det.'&b='.$id_per.'&action=1\'"';
        $attr_2 = $aRow['status_detail'] == 'Tidak Tersedia' ? 'disabled' : 'onclick="window.location.href=\'?a='.$id_det.'&b='.$id_per.'&action=2\'"';

        $row = [];
        $row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';

        $row[] = $aRow['no_permohonan'];
        $row[] = format_datetime($aRow['tanggal_permohonan']);

        //Awal script penambahan kolom (Nurhayati Rahayu 19/07/2022)
        $row[] = format_datetime($aRow['tanggal_verifikasibendahara']);
        //Awal script penambahan kolom (Nurhayati Rahayu 19/07/2022)

        $row[] = $aRow['layanan'];
        $row[] = $aRow['nama'];
        $row[] = !empty($aRow['perusahaan']) ? $aRow['perusahaan'] : 'PERSEORANGAN';
        // Awal script yang ditambahkan Rahmat, 13 Agustus 2020
        $date_start = new DateTime($aRow['due_date']);
        $date_end   = new DateTime(date('Y-m-d'));
        $interval = $date_start->diff($date_end);

        $row[] = $interval->d <= 3 ? '<small class="label bg-red">'.format_datetime($aRow['due_date']).'</small>' : '<small class="label bg-green">'.format_datetime($aRow['due_date']).'</small>';

        $row[] = '<font color=orange><i class="fa fa-fw fa-warning"></i> Konfirmasi Pengiriman</font>';;
        $row[] = '<a href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-circle-o"></i> Konfirmasi</a>';
        $row[] = '';
        // Akhir script yang ditambahkan Rahmat, 13 Agustus 2020

        if( $aRow['status'] == 0 ) {
          $stts = $aRow['status_detail'] != NULL ? '<font color=green><i class="fa fa-fw fa-check"></i> Sudah Dikonfirmasi</font>' : '<font color=red><i class="fa fa-fw fa-warning"></i> Belum Dikonfirmasi</font>';
          $aksi = '<a class="btn btn-xs btn-success" title="Tersedia" '.$attr_1.'><i class="fa fa-fw fa-check"></i></a> <a class="btn btn-xs btn-danger" title="Tidak Tersedia" '.$attr_2.'><span class="fa fa-fw fa-close"></span></a>';

          //
        } else {
          $stts = "";
          $aksi = "";
        }


        $row[] = $stts;
        $row[] = $aksi;
        $row[] = '';

        $output['aaData'][] = $row;
        $i++;
        $nomor++;
      }
    }
    $this->output
    ->set_status_header(200)
    ->set_content_type('application/json','utf-8')
    ->set_output(json_encode($output, JSON_PRETTY_PRINT));
  }

  function get_by_id($id = '') {
    $this->db->from($this->table)->where($this->pk_name, $id);
    $query = $this->db->get();
    if ( is_object($query) ) {
      $data = $query->row_array();
      if ( count($data) > 0 ) {
        return $data;
      }
    }
    return false;
  }

  function get_detail_permohonan_by_id($id = '') {
    $this->db->from($this->table_detail_permohonan)->where('id_permohonan', $id);
    $query = $this->db->get();
    if ( is_object($query) ) {
      $data = $query->result_array();
      if ( count($data) > 0 ) {
        return $data;
      }
    }
    return false;
  }

  function get_data_pemohon_by_id($id = '') {
    $this->db->from($this->table_user)->where('id_admin', $id);
    $query = $this->db->get();
    if ( is_object($query) ) {
        $data = $query->row_array();
        if ( count($data) > 0 ) {
          return $data;
        }
    }
    return false;
  }

  function get_data_perusahaan_by_id($id = '') {
    $this->db->from($this->table_perusahaan_user)->where('id_perusahaan', $id);
    return $this->db->get()->row_array();
  }

  // Awal script yang ditambahkan Rahmat, 9 April 2021
  function get_perusahaan_pemohon($id = '') {
	$this->db->select('*');
    $this->db->from($this->table);
	$this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_permohonan.id_pemohon', 'left');
	$this->db->join('tbl_perusahaan', 'tbl_perusahaan.id_perusahaan = tbl_admin.id_perusahaan', 'left');
	$this->db->where('id_permohonan', $id);
    $query = $this->db->get()->result_array();
    return $query;
  }
  // Akhir script yang ditambahkan Rahmat, 9 April 2021

  function insert_data($data) {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  function update_data($id, $data) {
    $this->db->where($this->pk_name, $id);
    $update = $this->db->update($this->table, $data);
    return $update;
  }

  function delete_data($id = '') {
    $this->db->where($this->pk_name, $id);
    $delete = $this->db->delete($this->table);
    if ( $delete ) {
        return true;
    }
    return false;
  }

  function delete($id = '') {
    $this->load->model('global_model');
    $this->global_model->delete_data('tbl_detail_permohonan','id_permohonan',$id);
    $this->app_model->delete_data($id);
    redirect(site_url($this->module));
  }

  function cari_bo ($id = '') {
        $this->db->distinct();
        $this->db->select('E.email');
        $this->db->join('tbl_permohonan B', 'A.id_permohonan = B.id_permohonan');
        $this->db->join('m_layanan D', 'D.id_layanan = A.id_layanan');
        $this->db->join('tbl_admin E', 'E.id_role = D.penanggung_jawab');
        $this->db->from("tbl_detail_permohonan A");
        if (!empty($id)) {
            $this->db->where('A.id_permohonan', $id);
        }
        $query = $this->db->get();
        if ( is_object($query) ) {
      $data = $query->result_array();
      if ( count($data) > 0 ) {
        return $data;
      }
    }
    return false;
  }
}
