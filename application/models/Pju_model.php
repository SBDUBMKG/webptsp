<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Pju_model extends CI_Model
{
    var $table      = 'tbl_pju';
    var $table_list_pju = 'tbl_list_pju';
    var $table_kelurahan = 'm_kelurahan';
    var $table_kecamatan = 'm_kecamatan';
    var $pk_name    = 'id_pju';
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
    public function show_datatable($column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch,$con, $level){
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
        if ( is_array($con) ) {
            foreach ($con as $key_con => $value_con) {
                if ( !empty($value_con) || is_numeric($value_con) ) {
                    $where .= " AND ".$key_con." = '".$value_con."'";
                }
            }
        }
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
        $this->db->where($where);
        // Select Data
        if ( $level == 'kabupaten' ) {
            $this->db->select('DISTINCT(m_kelurahan.id_kecamatan) AS id_kecamatan,
                                    kecamatan', false);
        } else if ( $level == 'kecamatan' ) {
            $this->db->select('DISTINCT(m_kelurahan.id_kelurahan) AS id_kelurahan,
                                    kelurahan, m_kelurahan.id_kecamatan, kecamatan', false);
        } else if ( $level == 'kelurahan' ) {
            $this->db->select('id_pju, alamat, kecamatan,
                                    kelurahan');
        }
        $this->db->from($this->table);
        $this->db->join('m_kelurahan', 'm_kelurahan.id_kelurahan = '.$this->table.'.id_kelurahan', 'left');
        $this->db->join('m_kecamatan', 'm_kelurahan.id_kecamatan = m_kecamatan.id_kecamatan', 'left');
                
        
        $rResult = $this->db->get();

        // Data set length after filtering
        if ( $level == 'kabupaten' )
            $this->db->select('m_kelurahan.id_kecamatan');
        else if ( $level == 'kecamatan' ) 
            $this->db->select($this->table.'.id_kelurahan');

        $this->db->where($where);
        $this->db->from($this->table);
        $this->db->join('m_kelurahan', 'm_kelurahan.id_kelurahan = '.$this->table.'.id_kelurahan', 'left');
        $this->db->join('m_kecamatan', 'm_kelurahan.id_kecamatan = m_kecamatan.id_kecamatan', 'left');
        if ( $level == 'kabupaten' )
            $this->db->group_by('m_kecamatan.id_kecamatan');
        else if ( $level == 'kecamatan' ) 
            $this->db->group_by('m_kelurahan.id_kelurahan');

                
        
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
            if ( $level == 'kecamatan' || $level == 'kelurahan' ) 
                $row[] = $aRow['kecamatan'];
            $row[] = $level == 'kabupaten' ? $aRow['kecamatan'] : $aRow['kelurahan'];

            if ( $level == 'kelurahan' )
                $row[] = $aRow['alamat'];
            if ( $level == 'kabupaten' )
                $row[] = $this->get_total_pju_by_kec($aRow['id_kecamatan']);
            else if ( $level == 'kecamatan' )
                $row[] = $this->get_total_pju_by_kel($aRow['id_kelurahan']);
            else if ( $level == 'kelurahan' )
                $row[] = $this->get_total_pju_by_id($aRow['id_pju']);


            if ( $level == 'kabupaten' )
                $row[] = '<a href="'.base_url().'penerangan_jalan_umum/index?kec='.$aRow['id_kecamatan'].'"><span class="fa fa-search"></span> Lihat Detil</a>';
            else if ( $level == 'kecamatan' )
                $row[] = '<a href="'.base_url().'penerangan_jalan_umum/index?kec='.$aRow['id_kecamatan'].'&kel='.$aRow['id_kelurahan'].'"><span class="fa fa-search"></span> Lihat Detil</a>';
            else if ( $level == 'kelurahan' )
                $row[] = '<a href="'.base_url().'penerangan_jalan_umum/index?id_pju='.$aRow['id_pju'].'"><span class="fa fa-search"></span> Lihat Detil</a>';
             
            $output['aaData'][] = $row;
            $i++;
            $nomor++;  
        }
        echo json_encode($output);
    }
    function get_total_pju_by_id($id_pju) {
        $this->db->where('id_pju', $id_pju);
        return $this->db->count_all_results($this->table_list_pju);
    }
    function get_total_pju_by_kec($id_kecamatan) {
        $this->db->where('m_kelurahan.id_kecamatan', $id_kecamatan);
        $this->db->join($this->table, $this->table.'.id_pju = '.$this->table_list_pju.'.id_pju', 'left');
        $this->db->join('m_kelurahan', 'm_kelurahan.id_kelurahan = '.$this->table.'.id_kelurahan', 'left');
        $this->db->join('m_kecamatan', 'm_kelurahan.id_kecamatan = m_kecamatan.id_kecamatan', 'left');
        return $this->db->count_all_results($this->table_list_pju);
    }
    function get_total_pju_by_kel($id_kelurahan) {
        $this->db->where($this->table.'.id_kelurahan', $id_kelurahan);
        $this->db->join($this->table, $this->table.'.id_pju = '.$this->table_list_pju.'.id_pju', 'left');
        return $this->db->count_all_results($this->table_list_pju);
    }
    function get_by_id($id = '') {
        $this->db->select('A.*, B.id_kecamatan, B.kelurahan, C.kecamatan')
                 ->from($this->table.' A')
                 ->join($this->table_kelurahan.' B', 'A.id_kelurahan = B.id_kelurahan', 'left')
                 ->join($this->table_kecamatan.' C', 'B.id_kecamatan = C.id_kecamatan', 'left')
                 ->where($this->pk_name, $id);
        $query = $this->db->get();
        if ( is_object($query) ) {
            $data = $query->row_array();
            if ( count($data) > 0 )
                return $data;
        }
        return false;
    }
    function list_point_pju($id_pju) {
        $this->db->where('id_pju', $id_pju);
        $query = $this->db->get($this->table_list_pju);
        if ( is_object($query) ) {
            $row = $query->result();
            return $row;
        }
        return array();
    }
}