<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_mkg_model extends CI_Model {
  var $table                      = 'tbl_permohonan';
  var $table_detail_permohonan    = 'tbl_detail_permohonan';
  var $table_user                 = 'tbl_admin';
  var $table_perusahaan_user      = 'tbl_perusahaan';
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

	public function show_datatable($column_datatable, $iDisplayStart, $iDisplayLength, $order, $sSearch) {
		$aColumns = $column_datatable;
		$id_admin = $this->session->userdata('id_admin');
		$id_role  = $this->session->userdata('id_role');

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
		$this->db->order_by($aColumns[intval($order[$i]['column'])], $order[$i]['dir']);
		}
		}
		}
		if ( count($order) < 1 ) {
		$this->db->order_by('B.'.$this->pk_name, 'desc');
		}

		/*
		* Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
		*/

		$where = "1=1";
		if($id_role == 7) {
		$where .= " AND B.id_pemohon = ".$id_admin;
		}

		if(isset($sSearch) && !empty($sSearch['value'])) {
		$where .= " AND (";
		for($i=0; $i<count($aColumns); $i++) {
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
		$where  = substr($where, 0, strlen($where)-4);
		$where .= ")";
		}

		$this->db->where($where);
		// Select Data
		$this->db->select('
			B.id_permohonan,
			B.id_pemohon,
			B.no_permohonan,
			B.tanggal_permohonan,
			B.pengantar,
			A.nama,
			A.alamat,
			A.no_hp,
			B.status,
			B.tanggal_verifikasibendahara,
			C.perusahaan
			');
		// $this->db->join('tbl_admin A', 'B.id_pemohon = A.id_admin');
		$this->db->from($this->table.' B');
		// Baris awal penambahan kolom nama perusahaan (Nurhayati Rahayu 11/07/2024)
		$this->db->join($this->table_user.' A', 'B.id_pemohon = A.id_admin');
    	$this->db->join($this->table_perusahaan_user.' C', 'C.id_perusahaan = A.id_perusahaan','LEFT');
		// Baris akhir penambahan kolom nama perusahaan (Nurhayati Rahayu 11/07/2024)

		$rResult = $this->db->get();

		// Data set length after filtering
		$this->db->where($where);
		$this->db->select('
			B.id_permohonan,
			B.id_pemohon,
			B.no_permohonan,
			B.tanggal_permohonan,
			B.pengantar,
			A.nama,
			A.alamat,
			A.no_hp,
			B.status,
			B.tanggal_verifikasibendahara,
			C.perusahaan
			');
		// $this->db->join('tbl_admin A', 'B.id_pemohon = A.id_admin');
		$this->db->from($this->table.' B');
		// Baris awal penambahan kolom nama perusahaan (Nurhayati Rahayu 11/07/2024)
		$this->db->join($this->table_user.' A', 'B.id_pemohon = A.id_admin');
    	$this->db->join($this->table_perusahaan_user.' C', 'C.id_perusahaan = A.id_perusahaan','LEFT');
		// Baris akhir penambahan kolom nama perusahaan (Nurhayati Rahayu 11/07/2024)

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
		$nama_perusahaan = get_nama_perusahaan($aRow['id_pemohon']);
		// Baris awal penambahan kolom alamat(Nurhayati Rahayu 15 Maret 2024)
		$alamat_perusahaan = get_alamat_perusahaan($aRow['id_pemohon']);
		// Baris akhir penambahan kolom alamat(Nurhayati Rahayu 15 Maret 2024)
		$row = [];
		$row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';

		$row[] = $aRow['no_permohonan'];
		$row[] = $aRow['tanggal_permohonan'];

		// Awal script penambahan kolom (Nurhayati Rahayu 19 Juli 2022
		$row[] = $aRow['tanggal_verifikasibendahara'];
		// Akhir script penambahan kolom (Nurhayati Rahayu 19 Juli 2022

		// Awal script yang diedit Rahmat 6 Mei 2020
		// $id_role == 1 diganti $id_role < 4
		$row[] = !empty($aRow['perusahaan']) ? $aRow['perusahaan'] : 'PERSEORANGAN';
		if($id_role < 4 ) {
		$row[] = $nama_perusahaan != NULL ? $aRow['nama'].'<br><strong>Nama PT</strong>: '.$nama_perusahaan : $aRow['nama'];
		// Baris awal penambahan kolom alamat(Nurhayati Rahayu 18 Maret 2024)
		$row[] = $alamat_perusahaan != NULL ? $aRow['alamat'].'<br><strong>Alamat PT</strong>: '.$alamat_perusahaan : $aRow['alamat'];
		// Baris akhir penambahan kolom alamat(Nurhayati Rahayu 18 Maret 2024)
		}

		$row[] = $aRow['no_hp'];

		// Awal script yang dinon-aktifkan Rahmat 6 Mei 2020
		/*
		$stts = NULL;
		$aksi = NULL;
		// HAK AKSES
		if( $id_role == 1 ) { // ADMIN
		if( $aRow['status'] == 0 ) {
		$stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Belum Dikonfirmasi</font>';
		$aksi = '<a target="_blank" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/konfirmasi/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check"></i> Konfirmasi</a>';
		} else if( $aRow['status'] == 1 ) {
		$stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Kelengkapan Data</font>';
		$aksi = '';
		} else if( $aRow['status'] == 2 ) {
		$stts = '<font color=green><i class="fa fa-fw fa-ban"></i> Proses Dihentikan</font>';
		$aksi = '';
		} else if( $aRow['status'] == 3 ) {
		$stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Bukti Pembayaran</font>';
		$aksi = '';
		} else if( $aRow['status'] == 4 ) {
		$stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Verifikasi Pembayaran</font>';
		$aksi = '<a href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi_pembayaran/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-circle-o"></i> Verifikasi</a>';
		} else if( $aRow['status'] == 5 ) {
		$stts = '<font color=green><i class="fa fa-fw fa-ban"></i> Proses Dihentikan</font>';
		$aksi = '';
		} else if( $aRow['status'] == 6 ) {
		$stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> Konfirmasi Pengiriman!</font>';
		$aksi = '<a href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-circle-o"></i> Konfirmasi</a>';
		} else if( $aRow['status'] == 7 ) {
		$stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses (User Belum Mengisi Survei)</font>';
		$aksi = '';
		} else if( $aRow['status'] == 8 ) {
		$stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Ulang Bukti Pembayaran</font>';
		$aksi = '';
		} else if( $aRow['status'] == 9 ) {
		$stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> Verifikasi Akhir!</font>';
		$aksi = '<a href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi_akhir/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-square"></i> Verifikasi</a>';
		} else if( $aRow['status'] == 10 ) {
		$stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses</font>';
		$aksi = '';
		} else {
		$stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Error</font>';
		$aksi = '<font color=red><i class="fa fa-fw fa-warning"></i> Error</font>';
		}
		} else if( $id_role == 7 ) { // PENGGUNA
		if( $aRow['status'] == 0 ) {
		$stts = '<font color=green><i class="fa fa-fw fa-spinner fa-spin"></i> Terkirim (Menunggu Konfirmasi)</font>';
		$aksi = '';
		} else if( $aRow['status'] == 1 ) {
		$stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> Belum Dilengkapi</font>';
		$aksi = '<a class="btn btn-xs btn-primary" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/proses/'.$aRow[$this->pk_name]).'"><i class="fa fa-pencil-square"></i> Lengkapi Data</a>';
		} else if( $aRow['status'] == 2 ) {
		$stts = '<font color=red><i class="fa fa-fw fa-ban"></i> Produk tidak Tersedia</font>';
		$aksi = '';
		} else if( $aRow['status'] == 3 ) {
		$stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Upload Bukti Pembayaran</font>';
		$aksi = '<a class="btn btn-xs btn-success" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/invoice/'.$aRow[$this->pk_name]).'" target="_blank"><i class="fa fa-file-o"></i> Invoice</a> <a class="btn btn-xs btn-warning" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/upload/'.$aRow[$this->pk_name]).'"><i class="fa fa-upload"></i> Upload</a>';
		} else if( $aRow['status'] == 4 ) {
		$stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Pembayaran Sedang Diverifikasi</font>';
		$aksi = '';
		} else if( $aRow['status'] == 5 ) {
		$stts = '<font color=red><i class="fa fa-fw fa-ban"></i> Pembayaran Ditolak</font>';
		$aksi = '';
		} else if( $aRow['status'] == 6 ) {
		$stts = '<font color=green><i class="fa fa-fw fa-check"></i> Pembayaran Diterima</font>';
		$aksi = '';
		} else if( $aRow['status'] == 7 ) {
		$stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses</font>';
		$aksi = '<a class="btn btn-xs btn-success" href="'.site_url('upload/dokumen/'.$aRow['pengantar']).'"><i class="fa fa-fw fa-print"></i> Dok. Pengantar</a> <a class="btn btn-xs btn-danger" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/review/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-pencil-square"></i> Review Layanan</a>';
		} else if( $aRow['status'] == 8 ) {
		$stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Upload Bukti Pembayaran Terbaru</font>';
		$aksi = '<a class="btn btn-xs btn-success" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/invoice/'.$aRow[$this->pk_name]).'" target="_blank"><i class="fa fa-file-o"></i> Invoice</a> <a class="btn btn-xs btn-warning" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/upload/'.$aRow[$this->pk_name]).'"><i class="fa fa-upload"></i> Upload Ulang</a>';
		} else if( $aRow['status'] == 9 ) {
		$stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Verifikasi Akhir Oleh Admin</font>';
		$aksi = '';
		} else if( $aRow['status'] == 10 ) {
		$stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses</font>';
		$aksi = '<a class="btn btn-xs btn-success" href="'.site_url('upload/dokumen/'.$aRow['pengantar']).'"><i class="fa fa-fw fa-print"></i> Dok. Pengantar</a>';
		} else {
		$stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Error</font>';
		$aksi = '<font color=red><i class="fa fa-fw fa-warning"></i> Error</font>';
		}
		}


		$row[] = $stts;
		$row[] = $aksi;
		*/
		// Akhir script yang dinon-aktifkan Rahmat 6 Mei 2020

		//Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (30 Mei 2024)
		if ( $this->is_write ) {
			$row[] .= "<center>
			<a target=\"_blank\" href='".base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Detail Data</span></a>
			</center>";
		}
		//Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (30 Mei 2024)


		$output['aaData'][] = $row;
		$i++;
		$nomor++;
		}
		$this->output
		->set_status_header(200)
		->set_content_type('application/json','utf-8')
		->set_output(json_encode($output, JSON_PRETTY_PRINT));
	}

// Awal script yang diedit Rahmat 6 Mei 2020
	// $column_datatable diganti jadi $column_datatable2
public function show_datatable_bo($column_datatable2, $iDisplayStart, $iDisplayLength, $order, $sSearch) {
	$aColumns = $column_datatable2;
	$id_admin = $this->session->userdata('id_admin');
	$id_role  = $this->session->userdata('id_role');
// Akhir script yang diedit Rahmat 6 Mei 2020

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
	$this->db->order_by('C.id_detail_permohonan', 'desc');
	}

	$where = " B.status = 6 AND D.penanggung_jawab=".$id_role;

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
	C.id_detail_permohonan as id_det,
	C.status as status_detail,
	C.due_date,
	D.layanan,
	D.penanggung_jawab as id_bo,
	B.id_permohonan,
	B.id_pemohon,
	B.no_permohonan,
	B.tanggal_permohonan,
	B.status,
	B.tanggal_verifikasibendahara,
	A.nama,
	A.alamat,
	A.no_hp
	');
	$this->db->from($this->table_detail_permohonan.' C');
	$this->db->join('tbl_permohonan B', 'C.id_permohonan = B.id_permohonan');
	$this->db->join('tbl_admin A', 'B.id_pemohon = A.id_admin','LEFT');
	$this->db->join('m_layanan D', 'C.id_layanan = D.id_layanan','LEFT');

	//penambahan klausa order by berdasarkan no_permohonan (perbaikan dilakukan oleh Nurhayati Rahayu 30/03/2020)
	$this->db->group_by('B.no_permohonan');
	//baris terakhir perbaikan

	$rResult = $this->db->get();


	// Awal script yang ditambahkan Rahmat 6 Mei 2020

	$this->db->where($where);
	// Data set length after filtering
	$this->db->select('
	C.id_detail_permohonan as id_det,
	C.status as status_detail,
	C.due_date,
	D.layanan,
	D.penanggung_jawab as id_bo,
	B.id_permohonan,
	B.id_pemohon,
	B.no_permohonan,
	B.tanggal_permohonan,
	B.status,
	B.tanggal_verifikasibendahara,
	A.nama,
	A.alamat,
	A.no_hp
	');
	$this->db->from($this->table_detail_permohonan.' C');
	$this->db->join('tbl_permohonan B', 'C.id_permohonan = B.id_permohonan');
	$this->db->join('tbl_admin A', 'B.id_pemohon = A.id_admin','LEFT');
	$this->db->join('m_layanan D', 'C.id_layanan = D.id_layanan','LEFT');

	// Akhir script yang ditambahkan Rahmat 6 Mei 2020
	$this->db->group_by('B.no_permohonan');

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
	// Baris awal penambahan kolom alamat(Nurhayati Rahayu 15 Maret 2024)
	$alamat_perusahaan = get_alamat_perusahaan($aRow['id_pemohon']);
	// Baris akhir penambahan kolom alamat(Nurhayati Rahayu 15 Maret 2024)
	$id_det = $aRow['id_det'];
	$id_per = $aRow['id_permohonan'];
	$attr_1 = $aRow['status_detail'] == 'Tersedia' ? 'disabled' : 'onclick="window.location.href=\'?a='.$id_det.'&b='.$id_per.'&action=1\'"';
	$attr_2 = $aRow['status_detail'] == 'Tidak Tersedia' ? 'disabled' : 'onclick="window.location.href=\'?a='.$id_det.'&b='.$id_per.'&action=2\'"';

	$row = [];
	$row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';

	$row[] = $aRow['no_permohonan'];
	$row[] = $aRow['tanggal_permohonan'];
	//Awal baris penambahan kolom tanggal_verifikasibendahara (Nurhayati Rahayu 15072022)
	$row[] = $aRow['tanggal_verifikasibendahara'];
	//Akhir baris penambahan kolom tanggal_verifikasibendahara (Nurhayati Rahayu 15072022)

	$row[] = $aRow['layanan'];
	$row[] = !empty($aRow['perusahaan']) ? $aRow['perusahaan'] : 'PERSEORANGAN';
	$row[] = $nama_perusahaan != NULL ? $aRow['nama'].'<br><strong>Nama PT</strong>: '.$nama_perusahaan : $aRow['nama'];
	// Baris awal penambahan kolom alamat(Nurhayati Rahayu 15 Maret 2024)
	$row[] = $alamat_perusahaan != NULL ? $aRow['alamat'].'<br><strong>Alamat PT</strong>: '.$alamat_perusahaan : $aRow['alamat'];
	// Baris akhir penambahan kolom alamat(Nurhayati Rahayu 15 Maret 2024)
	$row[] = $aRow['no_hp'];
	$date_start = new DateTime($aRow['due_date']);
    	$date_end   = new DateTime(date('Y-m-d'));
    	$interval = $date_start->diff($date_end);

	$row[] = $interval->d <= 3 ? '<small class="label bg-red">'.format_datetime($aRow['due_date']).'</small>' : '<small class="label bg-green">'.format_datetime($aRow['due_date']).'</small>';

	$row[] = '<font color=orange><i class="fa fa-fw fa-warning"></i> Konfirmasi Pengiriman!</font>';;
	// $row[] = '<a href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-circle-o"></i> Konfirmasi</a>';
	//Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (30 Mei 2024)
	if ( $this->is_write ) {
		$row[] .= "<center>
		<a target=\"_blank\" href='".base_url().strtolower($this->module).'/verifikasi/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i> Konfirmasi </span></a>
		<br>
		<a target=\"_blank\" href='".base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Detail Data</span></a>
		</center>";
	}
	//Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (30 Mei 2024)

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
    $query = $this->db->get();
    if ( is_object($query) ) {
        $data = $query->row_array();
        if ( count($data) > 0 ) {
          return $data;
        }
    }
    return false;
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
}
