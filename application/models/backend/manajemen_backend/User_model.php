<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model
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
        $where = "1=1";
        if(isset($sSearch) && !empty($sSearch['value']))
        {
            $where .= " AND (";
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

                // Individual column filtering
                if( $columns[$i]['searchable'] == 'true')
                {
                    if ( $aColumns[$i] == 'username' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else if ( $aColumns[$i] == 'email' )
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
        $this->db->select($this->pk_name.', A.id_role, role, username, nama, email, B.is_super_admin');
        $this->db->where('A.id_role<>',7);
        $this->db->from($this->table .' A');
        $this->db->join('tbl_role B', 'A.id_role = B.id_role');
                
        
        $rResult = $this->db->get();

        // Data set length after filtering
        $this->db->where($where);
        $this->db->where('A.id_role<>',7);
        $this->db->from($this->table . ' A');
        $this->db->join('tbl_role B', 'A.id_role = B.id_role');
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
                $row[] = $aRow['username'];
                $row[] = $aRow['nama'];
                
            $id_role = $this->session->userdata('id_role');
            if ( $this->is_write ) {
                $menu = "<center>";
                if ( $aRow['is_super_admin'] == 1 ) {
                    $menu .= "<a href='".base_url().strtolower($this->module).'/edit/'.$aRow[$this->pk_name]."'>
                    <span class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Edit</span>
                    </a>";
                } else {
                    $menu .= "<a href='".base_url().strtolower($this->module).'/edit/'.$aRow[$this->pk_name]."'>
                    <span class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Edit</span></a>
				    <a href='".base_url().strtolower($this->module).'/delete/'.$aRow[$this->pk_name]."' onclick='return confirm(\"Apa anda yakin menghapus data ini?\")'>
                    <span class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</span>
                    </a>";
                }
                $menu .= "</center>";
                $row[] = $menu;
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
    function check_username_exists($username, $id_admin = '') {
        $con = array(
            'username' => $username
        );
        if ( !empty($id_admin) )
            $con[$this->pk_name.' !='] = $id_admin;
        $this->db->where($con);
        $count = $this->db->count_all_results($this->table);
        if ( $count > 0 )
            return true;

        return false;
    }
}