<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan_keuangan_model extends CI_Model
{
    var $table      = 'tbl_detail_permohonan';
    var $pk_name    = 'id_detail_permohonan';
    var $module     = '';

    // Awal script yang ditambahkan Rahmat, 17 Juni 2020
    var $table_permohonan 	= 'tbl_permohonan';
    var $table_admin		= 'tbl_admin';
    var $table_perusahaan	= 'tbl_perusahaan';
    var $table_m_layanan	= 'm_layanan';
	var $table_m_status		= 'm_status';
    // Akhir script yang ditambahkan Rahmat, 17 Juni 2020

    function __construct(){
        parent::__construct();
    }
    function initialize($module) {
        if ( !empty($module) )
            $this->module = $module;
        else
            $this->module = $this->module;
    }
    public function show_datatable($column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch){
        $aColumns = $column_datatable;

        // Awal script yang ditambahkan Rahmat, 17 Juni 2020
        $id_admin = $this->session->userdata('id_admin');
		$id_role  = $this->session->userdata('id_role');
		// Akhir script yang ditambahkan Rahmat, 17 Juni 2020

        // DB table to use
        $sTable = $this->table;

        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }

        $columns = $this->input->get_post('columns', true);
        // Ordering
        if(isset($order) > 0)
        {
            for($i=0; $i<count($order); $i++)
            {
                if($columns[$order[$i]['column']]['orderable'] == 'true')
                {
                    $this->db->order_by($aColumns[intval($order[$i]['column'])], $order[$i]['dir']);
                }
            }
        }
        if ( count($order) < 1 ) {
            $this->db->order_by('A.'.$this->pk_name, 'desc');
        }

        /*
        * Filtering
        * NOTE this does not match the built-in DataTables filtering which does it
        * word by word on any field. It's possible to do here, but concerned about efficiency
        * on very large tables, and MySQL's regex functionality is very limited
        */

        // Awal script yang diedit Rahmat, 17 Juni 2020, asalnya 'IN(7,10)' diganti jadi 'IN(6,7,9,10)'
        $where = "1=1 AND B.status IN(6,7,9,10)";
        // Akhir script yang diedit Rahmat, 17 Juni 2020, asalnya 'IN(7,10)' diganti jadi 'IN(6,7,9,10)'

        if(isset($sSearch) && !empty($sSearch['value']))
        {
            $where .= " AND (";
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

                // Individual column filtering
                if( $columns[$i]['searchable'] == 'true')
                {
                    // Awal script yang di non-aktifkan Rahmat, 17 Juni 2020
					/*
					if ( $aColumns[$i] == 'status' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else
					*/
					// Akhir script yang di non-aktifkan Rahmat, 17 Juni 2020
                    $where .= "LOWER(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
                }
            }
            $where  = substr($where, 0, strlen($where)-4);
            $where .= ")";
        }
        $this->db->where($where);
        // Select Data

        // Awal script yang di non-aktifkan Rahmat, 17 Juni 2020
        /*
        $this->db->select('A.id_detail_permohonan, B.no_permohonan, A.jumlah, A.harga, B.status');
        $this->db->from($this->table.' A');
        $this->db->join('tbl_permohonan B', 'B.id_permohonan = A.id_permohonan', 'left');
        */
        // Akhir script yang di non-aktifkan Rahmat, 17 Juni 2020

        // Awal script yang ditambahkan Rahmat, 17 Juni 2020
        $this->db->select('A.id_detail_permohonan, B.no_permohonan, C.nama, E.perusahaan, D.layanan, A.jumlah, A.harga, B.bukti, F.status');
        $this->db->from($this->table.' A');
        $this->db->join($this->table_permohonan.' B', 'A.id_permohonan = B.id_permohonan');
		$this->db->join($this->table_admin.' C', 'B.id_pemohon = C.id_admin');
		$this->db->join($this->table_m_layanan.' D', 'D.id_layanan = A.id_layanan');
		$this->db->join($this->table_perusahaan.' E', 'E.id_perusahaan = C.id_perusahaan','LEFT');
		$this->db->join($this->table_m_status.' F', 'B.status = F.id_status');
		// Akhir script yang ditambahkan Rahmat, 17 Juni 2020

        $rResult = $this->db->get();

        // Data set length after filtering
        $this->db->where($where);

        // Awal script yang di non-aktifkan Rahmat, 17 Juni 2020
        /*
        $this->db->select('A.id_detail_permohonan, B.no_permohonan, A.jumlah, A.harga, B.status');
        $this->db->from($this->table.' A');
        $this->db->join('tbl_permohonan B', 'B.id_permohonan = A.id_permohonan', 'left');
        */
        // Akhir script yang di non-aktifkan Rahmat, 17 Juni 2020

        // Awal script yang ditambahkan Rahmat, 17 Juni 2020
        $this->db->select('A.id_detail_permohonan, B.no_permohonan, C.nama, E.perusahaan, D.layanan, A.jumlah, A.harga, B.bukti, F.status');
        $this->db->from($this->table.' A');
        $this->db->join($this->table_permohonan.' B', 'A.id_permohonan = B.id_permohonan');
		$this->db->join($this->table_admin.' C', 'B.id_pemohon = C.id_admin');
		$this->db->join($this->table_m_layanan.' D', 'D.id_layanan = A.id_layanan');
		$this->db->join($this->table_perusahaan.' E', 'E.id_perusahaan = C.id_perusahaan','LEFT');
		$this->db->join($this->table_m_status.' F', 'B.status = F.id_status');
		// Akhir script yang ditambahkan Rahmat, 17 Juni 2020



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

		// Awal script yang di non-aktifkan Rahmat, 17 Juni 2020
		/*
		$this->load->helper('status');
		*/
		// Akhir script yang di non-aktifkan Rahmat, 17 Juni 2020

        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
            $row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';

            $row[] = $aRow['no_permohonan'];

            // Awal script yang ditambahkan Rahmat, 17 Juni 2020
            $row[] = $aRow['nama'];
            $row[] = !empty($aRow['perusahaan']) ? $aRow['perusahaan'] : 'PERSEORANGAN';
            $row[] = $aRow['layanan'];
            // Akhir script yang ditambahkan Rahmat, 17 Juni 2020

            $row[] = $aRow['jumlah'];
            $row[] = $aRow['harga'];

			// Awal script yang ditambahkan Nurhayati Rahayu, 24 Juni 2020
            $tipe_file = pathinfo(base_url().'upload/bukti/'.$aRow['bukti'], PATHINFO_EXTENSION);
            $icon_file = '<i class="fa fa-file"></i>';
            if ($tipe_file=='pdf') {
                $icon_file = '<i class="fa fa-file-pdf-o"></i>';
            }elseif ($tipe_file=='jpg' || $tipe_file=='jpeg' || $tipe_file=='png' || $tipe_file=='gif') {
                $icon_file = '<i class="fa fa-file-image-o"></i>';
            }elseif ($tipe_file=='doc'|| $tipe_file=='docx') {
                $icon_file = '<i class="fa fa-file-word-o"></i>';
            }elseif ($tipe_file=='ppt'|| $tipe_file=='pptx') {
                $icon_file = '<i class="fa fa-file-powerpoint-o"></i>';
            }
            $row[] = empty($aRow['bukti']) ? NULL : '<a class="btn btn-xs btn-success" href="'.base_url().'upload/bukti/'.$aRow['bukti'].'" target="_blank">'.$icon_file.' Bukti</a>  ';
            $row[] = $aRow['status'];
            $row[] = '-';

            $output['aaData'][] = $row;
            $i++;
            $nomor++;
        }

        // Awal script yang di non-aktifkan Rahmat, 17 Juni 2020
        /*
        */
        // Akhir script yang di non-aktifkan Rahmat, 17 Juni 2020
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
            if ( count($data) > 0 )
                return $data;
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
}
