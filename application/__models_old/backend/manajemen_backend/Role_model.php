<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Role_model extends CI_Model
{
    var $table      = 'tbl_role';
    var $table_hak_akses = 'tbl_hak_akses';
    var $table_kategori_menu = 'tbl_kategori_menu';
    var $table_menu = 'tbl_menu';
    var $pk_name    = 'id_role';
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
        $where = "1=1 AND is_super_admin = 0";
        if(isset($sSearch) && !empty($sSearch['value']))
        {
            $where .= " AND (";
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

                // Individual column filtering
                if( $columns[$i]['searchable'] == 'true')
                {
                    if ( $aColumns[$i] == 'role' )
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
        $this->db->select('id_role, role');
        $this->db->from($this->table);
        
        
        $rResult = $this->db->get();

        // Data set length after filtering
        $this->db->where($where);
        $this->db->from($this->table . ' A');
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
            $row[] = $nomor;

            $row[] = $aRow['role'];
                

            if ( $this->is_write ) {
                $row[] .= "<center>
				<a href='".base_url().strtolower($this->module).'/edit/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-flat btn-success'><i class='fa fa-pencil'></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href='".base_url().strtolower($this->module).'/hak_akses/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-flat btn-info'><i class='fa fa-cog'></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='".base_url().strtolower($this->module).'/delete/'.$aRow[$this->pk_name]."' onclick='return confirm(\"Apa anda yakin menghapus data ini?\")'><span class='btn btn-xs btn-flat btn-danger'><i class='fa fa-trash'></i></span></a>
				</center>";
            }

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
            $username   = $this->session->userdata('userName');
            return true;
        }
        return false;
    }
    function get_list_hak_akses($id_role = 0) {
        $this->db->where('id_role', $id_role);
        $query = $this->db->get($this->table_hak_akses);
        if ( is_object($query) ) {
            $result = $query->result();
            return $result;
        }
        return array();
    }
    function get_list_kategori_menu() {
        $query = $this->db->get($this->table_kategori_menu);
        if ( is_object($query) ) {
            return $query->result();
        }
        return array();
    }
    function get_list_menu($id_kategori_menu = 0) {
        if ( empty($id_kategori_menu) )
            $this->db->where('id_kategori_menu IS NULL');
        else
            $this->db->where('id_kategori_menu', $id_kategori_menu);

        $query = $this->db->get($this->table_menu);
        if ( is_object($query) ) {
            return $query->result();
        }
        return array();
    }
    function insert_hak_akses($data) {
        $insert = $this->db->insert($this->table_hak_akses, $data);
        if ( $insert )
            return $this->db->insert_id();

        return false;
    }
    function update_hak_akses($id, $data) {
        $this->db->where('id_hak_akses', $id);
        $update = $this->db->update($this->table_hak_akses, $data);
        if ( $update )
            return true;

        return false;
    }
}