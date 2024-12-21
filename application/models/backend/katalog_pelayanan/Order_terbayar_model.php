<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_terbayar_model extends CI_Model {
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
		$this->db->order_by($this->pk_name, 'desc');
		}

		/*
		* Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
		*/

		$where = " 1 = 1 ";

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
		$this->db->where('B.status>=',6);
		if($id_role >= 9){
			//ROLE BO
			$this->db->where('D.penanggung_jawab',$id_role);
		}
		// Awal script yang diedit Rahmat, 3 Juni 2020 => asalnya "E.nama perusahaan" dirubah menjadi "E.perusahaan"
		$this->db->select('D.layanan, B.id_permohonan, B.no_permohonan, B.tanggal_permohonan, B.pengantar, C.id_admin, C.no_hp, C.id_perusahaan, C.nama, E.perusahaan, B.status,  B.tanggal_verifikasibendahara');
		// Akhir script yang diedit Rahmat, 3 Juni 2020
		$this->db->from($this->table_detail_permohonan. " A");
		$this->db->join($this->table.' B', 'A.id_permohonan = B.id_permohonan');
		$this->db->join('tbl_admin C', 'B.id_pemohon = C.id_admin');
		$this->db->join('m_layanan D', 'D.id_layanan = A.id_layanan');
		$this->db->join($this->table_perusahaan_user.' E', 'E.id_perusahaan = C.id_perusahaan','LEFT');

		$rResult = $this->db->get();

		// Data set length after filtering
		$this->db->where($where);
		$this->db->where('B.status>=',6);
		if($id_role >= 9){
			//ROLE BO
			$this->db->where('D.penanggung_jawab',$id_role);
		}
		// Awal script yang diedit Rahmat, 3 Juni 2020 => asalnya "E.nama perusahaan" dirubah menjadi "E.perusahaan"
		$this->db->select('D.layanan, B.id_permohonan, B.no_permohonan, B.tanggal_permohonan, B.pengantar, C.id_admin, C.no_hp, C.id_perusahaan, C.nama, E.perusahaan, B.status,  B.tanggal_verifikasibendahara');
		// Akhir script yang diedit Rahmat, 3 Juni 2020
		$this->db->from($this->table_detail_permohonan. " A");
		$this->db->join($this->table.' B', 'A.id_permohonan = B.id_permohonan');
		$this->db->join('tbl_admin C', 'B.id_pemohon = C.id_admin');
		$this->db->join('m_layanan D', 'D.id_layanan = A.id_layanan');
		$this->db->join($this->table_perusahaan_user.' E', 'E.id_perusahaan = C.id_perusahaan','LEFT');

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
			$row = [];
			$row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';

			$row[] = $aRow['no_permohonan'];
			$row[] = $aRow['layanan'];
			$row[] = $aRow['tanggal_permohonan'];
			// Awal script penambahan kolom (Nurhayati Rahayu 20/07/2022)
			$row[] = $aRow['tanggal_verifikasibendahara'];
			// Akhir script penambahan kolom (Nurhayati Rahayu 20/07/2022)

			$stts = NULL;
			$aksi = NULL;

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
				$aksi = '<a target="_blank" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi_pembayaran/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-circle-o"></i> Verifikasi</a>';
			} else if( $aRow['status'] == 5 ) {
				$stts = '<font color=green><i class="fa fa-fw fa-ban"></i> Proses Dihentikan</font>';
				$aksi = '';
			} else if( $aRow['status'] == 6 ) {
				$stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> Konfirmasi Pengiriman!</font>';
				$aksi = '<a target="_blank" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-circle-o"></i> Konfirmasi</a>';
			} else if( $aRow['status'] == 7 ) {
				$stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses (User Belum Mengisi Survei)</font>';
				$aksi = '';
			} else if( $aRow['status'] == 8 ) {
				$stts = '<font color=orange><i class="fa fa-fw fa-spinner fa-spin"></i> Menunggu Ulang Bukti Pembayaran</font>';
				$aksi = '';
			} else if( $aRow['status'] == 9 ) {
				$stts = '<font color=orange><i class="fa fa-fw fa-warning"></i> Verifikasi Akhir!</font>';
				$aksi = '<a target="_blank" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi_akhir/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-square"></i> Verifikasi</a>';
			} else if( $aRow['status'] == 10 ) {
				$stts = '<font color=green><i class="fa fa-fw fa-check"></i> Transaksi Sukses</font>';
				$aksi = '';
			} else {
				$stts = '<font color=red><i class="fa fa-fw fa-warning"></i> Error</font>';
				$aksi = '<font color=red><i class="fa fa-fw fa-warning"></i> Error</font>';
			}


			$row[] = $aRow['nama'];
    		$row[] = !empty($aRow['perusahaan']) ? $aRow['perusahaan'] : 'PERSEORANGAN';
			$row[] = $aRow['no_hp'];

// $row[] = '<a class="btn btn-success" href="'.base_url().'backend/katalog_pelayanan/informasi_mkg/detail/'.$aRow['id_permohonan'].'"><i class="fa fa-info-circle"> Detail</a>';
			// $row[] = '';
            //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (08 Mei 2024)
            if ( $this->is_write ) {
                $row[] .= "<center>
				<a target=\"_blank\" href='".base_url().'backend/katalog_pelayanan/informasi_mkg/detail/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Detail Data</span></a>
                </center>";
            }
            //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (08 Mei 2024)

			$output['aaData'][] = $row;
			$i++;
			$nomor++;
		}

		return ( $output );
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

	$where = " tbl_permohonan.status = 6";

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
	tbl_permohonan.no_permohonan,
	tbl_permohonan.tanggal_permohonan,
	tbl_permohonan.tanggal_verifikasibendahara,
	tbl_permohonan.status,
	tbl_admin.id_admin,
	tbl_admin.nama,
	tbl_perusahaan.nama perusahaan,
	tbl_admin.no_hp,
	tbl_admin.id_perusahaan
	');
	$this->db->join('m_layanan', 'tbl_detail_permohonan.id_layanan = m_layanan.id_layanan');
	$this->db->join('tbl_permohonan', 'tbl_detail_permohonan.id_permohonan = tbl_permohonan.id_permohonan');
	$this->db->join('tbl_admin', 'tbl_permohonan.id_pemohon = tbl_admin.id_admin');
	$this->db->join('tbl_perusahaan', 'tbl_admin.id_perusahaan = tbl_perusahaan.id_perusahaan');
	$this->db->from($this->table_detail_permohonan);

	$rResult = $this->db->get();

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
	$id_det = $aRow['id_det'];
	$id_per = $aRow['id_permohonan'];
	$attr_1 = $aRow['status_detail'] == 'Tersedia' ? 'disabled' : 'onclick="window.location.href=\'?a='.$id_det.'&b='.$id_per.'&action=1\'"';
	$attr_2 = $aRow['status_detail'] == 'Tidak Tersedia' ? 'disabled' : 'onclick="window.location.href=\'?a='.$id_det.'&b='.$id_per.'&action=2\'"';

	$row = [];
	$row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';

	$row[] = $aRow['no_permohonan'];
	$row[] = $aRow['tanggal_permohonan'];
	// Awal script penambahan kolom (Nurhayati Rahayu 20/07/2022)
	$row[] = $aRow['tanggal_verifikasibendahara'];
	// Akhir script penambahan kolom (Nurhayati Rahayu 20/07/2022)

	$row[] = $aRow['layanan'];
	$row[] = $aRow['nama'];
	$row[] = !empty($aRow['perusahaan']) ? $aRow['perusahaan'] : 'PERSEORANGAN';
	$row[] = $aRow['no_hp'];

	$row[] = '<font color=orange><i class="fa fa-fw fa-warning"></i> Konfirmasi Pengiriman!</font>';
	$row[] = '<a target="_blank" href="'.site_url('backend/katalog_pelayanan/informasi_mkg/verifikasi/'.$aRow[$this->pk_name]).'"><i class="fa fa-fw fa-check-circle-o"></i> Konfirmasi</a>';
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
    $query = $this->db->get();
    if ( is_object($query) ) {
        $data = $query->row_array();
        if ( count($data) > 0 ) {
          return $data;
        }
    }
    return false;
  }

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
