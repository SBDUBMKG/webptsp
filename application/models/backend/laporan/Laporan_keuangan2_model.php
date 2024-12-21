<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan_keuangan2_model extends CI_Model
{
    var $view      = 'v_lap_keuangan';
    var $pk_name    = 'id_detail_permohonan';
    var $module     = '';
    function __construct(){
        parent::__construct();
    }
    function initialize($module) {
        if ( !empty($module) )
            $this->module = $module;
        else
            $this->module = $this->module;
    }
    public function show_datatable($column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch,$tahun,$bulan,$jenis_layanan){
        $aColumns = $column_datatable;

        // DB view to use
        $sView = $this->view;

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
            $this->db->order_by($this->pk_name, 'desc');
        }

        /*
        * Filtering
        * NOTE this does not match the built-in DataTables filtering which does it
        * word by word on any field. It's possible to do here, but concerned about efficiency
        * on very large tables, and MySQL's regex functionality is very limited
        */
        $where = "1=1";
        $where .= !empty($tahun) ? ' AND YEAR(tanggal_permohonan)='.$tahun : NULL;
        $where .= !empty($bulan) ? ' AND MONTH(tanggal_permohonan)='.$bulan : NULL;
	$where .= !empty($jenis_layanan) ? ' AND id_jenis_layanan ='.$jenis_layanan : NULL;
        if(isset($sSearch) && !empty($sSearch['value']))
        {
            $where .= " AND (";
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

                // Individual column filtering
                if( $columns[$i]['searchable'] == 'true')
                {
                    if ( $aColumns[$i] == 'no_permohonan' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'nama' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'perusahaan' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'id_jenis_layanan' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'jenis_layanan' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'layanan' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'tarif_pnbp' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'jumlah' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'total_tarif_pnbp' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'bukti' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'status_data' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'status_transaksi' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else
                    $where .= "LOWER(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
                }
            }
            $where  = substr($where, 0, strlen($where)-4);
            $where .= ")";
        }
        $this->db->where($where);
        // Select Data
        $this->db->select('id_detail_permohonan, tanggal_permohonan, no_permohonan, nama, perusahaan, id_jenis_layanan,jenis_layanan, layanan, tarif_pnbp, jumlah, total_tarif_pnbp, bukti, status_data, status_transaksi');
        $this->db->from($this->view);
        
        
        $rResult = $this->db->get();

        // Data set length after filtering
        $this->db->where($where);
        $this->db->select('id_detail_permohonan, tanggal_permohonan, no_permohonan, nama, perusahaan, id_jenis_layanan,jenis_layanan, layanan, tarif_pnbp, jumlah, total_tarif_pnbp, bukti, status_data, status_transaksi');
        $this->db->from($this->view);
        
        
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
            $row = array();
            $row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';
	    //baris awal perbaikan format tanggal (diperbaiki Nurhayati Rahayu, tanggal 15/11/2022)
            //$row[] = empty($aRow['tanggal_permohonan']) || $aRow['tanggal_permohonan'] == '0000-00-00' ? NULL : short_datetime($aRow['tanggal_permohonan']) ;    
            $row[] = empty($aRow['tanggal_permohonan']) || $aRow['tanggal_permohonan'] == '0000-00-00' ? NULL : $aRow['tanggal_permohonan'] ;
            //baris akhir perbaikan format tanggal (diperbaiki Nurhayati Rahayu, tanggal 15/11/2022)
            $row[] = $aRow['no_permohonan'];
            $row[] = $aRow['nama'];
            $row[] = $aRow['perusahaan'];
            //$row[] = $aRow['id_jenis_layanan'];
            $row[] = $aRow['jenis_layanan'];
            $row[] = $aRow['layanan'];
            $row[] = $aRow['tarif_pnbp'];
            $row[] = $aRow['jumlah'];
            $row[] = $aRow['total_tarif_pnbp'];

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
            $row[]  = empty($aRow['bukti']) ? NULL : '<a class="btn btn-xs btn-success" href="'.base_url().'upload/bukti/'.$aRow['bukti'].'" target="_blank">'.$icon_file.' Bukti</a>  ';
            // Akhir script yang ditambahkan Nurhayati Rahayu, 24 Juni 2020
            
            $row[] = $aRow['status_data'];
            $row[] = $aRow['status_transaksi'];
            $row[] = '';
            $output['aaData'][] = $row;
            $i++;
            $nomor++;
        }
        echo json_encode($output);
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