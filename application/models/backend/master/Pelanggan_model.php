<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Pelanggan_model extends CI_Model
{
    var $table      = 'tbl_admin';
    var $pk_name    = 'id_admin';
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
    public function show_datatable($column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch){
        $aColumns = $column_datatable;

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
            $this->db->order_by($this->pk_name, 'desc');
        }

        /*
        * Filtering
        * NOTE this does not match the built-in DataTables filtering which does it
        * word by word on any field. It's possible to do here, but concerned about efficiency
        * on very large tables, and MySQL's regex functionality is very limited
        */
        $where = "1=1 AND id_role = 7";
        if(isset($sSearch) && !empty($sSearch['value']))
        {
            $where .= " AND (";
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

                // Individual column filtering
                if( $columns[$i]['searchable'] == 'true')
                {
                    $where .= "LOWER(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
                }
            }
            $where  = substr($where, 0, strlen($where)-4);
            $where .= ")";
        }
		//$this->db->where($where);
        // Select Data
        //$this->db->select('id_admin, npwp, nama, alamat, id_perusahaan, email, status,no_hp');
        //$this->db->from($this->table);
        
        
        //$rResult = $this->db->get();

        // Data set length after filtering
        //$this->db->where($where);
        //$this->db->select('id_admin, npwp, nama, alamat, id_perusahaan, email, status,no_hp');
        //$this->db->from($this->table);
        
		//penambahan kolom nama perusahaan. Perubahan oleh : Nurhayati Rahayu (24/08/2020)
		//Baris pertama 
		
		$this->db->where($where);
        // Select Data
        $this->db->select('id_admin, npwp, nama, tbl_admin.alamat, tbl_admin.id_perusahaan, perusahaan, tbl_admin.email, status,no_hp');
        $this->db->join('tbl_perusahaan', 'tbl_admin.id_perusahaan = tbl_perusahaan.id_perusahaan','LEFT');
        $this->db->from($this->table);
        
        $rResult = $this->db->get();

        // Data set length after filtering
        $this->db->where($where);
        $this->db->select('id_admin, npwp, nama, tbl_admin.alamat, tbl_admin.id_perusahaan, perusahaan, tbl_admin.email, status,no_hp');
        $this->db->join('tbl_perusahaan', 'tbl_admin.id_perusahaan = tbl_perusahaan.id_perusahaan','LEFT');
        $this->db->from($this->table);
        //baris terakhir perubahan oleh : Nurhayati Rahayu(24/08/2020)
        
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
            $row[] = $aRow['npwp'];
            $row[] = $aRow['nama'];
            $row[] = $aRow['alamat'];
            $row[] = isset($aRow['id_perusahaan']) ? 'Perusahaan' : 'Perorangan';
	    $row[] = $aRow['perusahaan'];	
            $row[] = $aRow['email'];
            $row[] = $aRow['no_hp'];
            if($aRow['status'] == 1){
                $row[] = 'Aktif';
            }
            elseif ($aRow['status'] == 0) {
                $row[] = 'Non Aktif';
            }
            else{
                $row[] = ' - ';                
            }
            //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)
            if ( $this->is_write ) {
                $row[] .= "<div class='btn-group' role='group'>
                    <a href='".base_url().strtolower($this->module).'/edit/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-primary btn-block' style='margin-bottom:2px'><i class='fa fa-pencil'></i> Edit</span></a>
		    <a href='".base_url().strtolower($this->module).'/aktif_pelanggan/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-success btn-block' style='margin-bottom:2px'><i class='fa fa-check'></i> Aktif</span></a>
                    <a href='".base_url().strtolower($this->module).'/arsip_pelanggan/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-warning btn-block' style='margin-bottom:2px'><i class='fa fa-ban'></i> Non Aktif</span></a>
                    <a href='".base_url().strtolower($this->module).'/detail/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-info btn-block' style='margin-bottom:2px'><i class='fa fa-info-circle'></i> Reset Pass</span></a>                    
                </div>";
            }
            //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)

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