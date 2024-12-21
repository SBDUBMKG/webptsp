<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Global_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function get_list($table = '', $con = '', $sort_by = '', $order_by = 'ASC',$limit = '') {
        $this->db->from($table);
        if ( !empty($con) ) {
            $this->db->where($con);
        }
        if ( !empty($limit) ){
            $this->db->limit($limit);
        }
        if ( !empty($sort_by) )
            $this->db->order_by($sort_by, $order_by);
        $query = $this->db->get();
        if ( is_object($query) ) {
            $result = $query->result();
            return $result;
        }
        return array();
    }

    function get_list_array($table = '', $con = '', $sort_by = '', $order_by = 'ASC', $limit = '') {
        $this->db->from($table);
        if ( !empty($con) ) {
            $this->db->where($con);
        }
        if ( !empty($sort_by) ){
            $this->db->order_by($sort_by, $order_by);
        }
        if ( !empty($limit) ){
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        if ( is_object($query) ) {
            $result = $query->result_array();
            return $result;
        }
        return array();
    }

    function get_by_id($table = '', $pk_name = '', $id = '') {
        $this->db->from($table)->where($pk_name, $id);
        $query = $this->db->get();
        if ( is_object($query) ) {
            $data = $query->row();
            if ( is_object($data) )
                return $data;
        }
        return false;
    }

    function insert_data($table = '', $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function update_data($table = '', $pk_name = '', $id, $data) {
        $this->db->where($pk_name, $id);
        $update = $this->db->update($table, $data);
        return $update;
    }

    function delete_data($table = '', $pk_name = '', $id = '') {
        $this->db->where($pk_name, $id);
        $delete = $this->db->delete($table);
        return $delete;
    }

    function get_by_id_array($table = '', $con = '', $val = ''){
        $this->db->from($table)->where($con, $val);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data;
    }

    function get_count_data($table = '', $con = ''){
        $this->db->select('COUNT(*) as count');
        $this->db->from($table);
        if(!empty($con)){
            $this->db->where($con);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0 )
        {
            $row = $query->row();
            return $row->count;
        }
        return 0;
    }

    function get_max_data($table = '', $col, $con = ''){
	//Memperbaiki no permohonan. Perbaikan oleh : Nurhayati Rahayu (22/01/2020)
        $this->db->select('count('.$col.') as maksimal');
	//$this->db->select('max('.$col.') as maksimal');
	//baris terakhir perbaikan
        $this->db->from($table);
        if(!empty($con)){
            $this->db->where($con);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0 )
        {
            $row = $query->row();
            return $row->maksimal+1;
        }
        return 0;
    }

    function insert_foto($table,$data = array()){
        $insert = $this->db->insert_batch($table,$data);
        return $insert?true:false;
    }

    function search($limit, $start, $table = '', $string = '', $columns = []) {
        $this->db->from($table);

        $con = "";
        for($i = 0; $i < count($columns); $i++) {
          if ($i > 0) {
            $con .= " or ";
          }

          $col = $columns[$i];
          $con .= $col . " like '%" . $string . "%' or " . $col . "_en like '%" . $string . "%'";
        }

        // $con = $column." like '%".$string."%' or ". $column. "_en like '%".$string."%' or isi like '%".$string."%' or isi_en like '%".$string."%' or sumber like '%".$string."%'";

        $this->db->where($con);
        if($limit && $start) {
          $this->db->limit($limit, $start);
        }

        $query = $this->db->get();

        if ( is_object($query) ) {
            $result = $query->result_array();
            return $result;
        }
        return array();
    }

    function search_katalog($limit = '', $start = '', $table = '', $string = '') {
        $this->db->from($table);

        $con = "layanan like '%".$string."%' or layanan_en like '%".$string."%'";

        $this->db->where($con);

        $this->db->limit($limit, $start);

        $query = $this->db->get();

        if ( is_object($query) ) {
            $result = $query->result_array();
            return $result;
        }
        return array();
    }

  public function record_count($tabel = '', $string = '') {
      $this->db->select('id');
      $this->db->from($tabel);
      $where = "judul like '%".$string."%' or judul_en like '%".$string."%' or isi like '%".$string."%' or isi_en like '%".$string."%' or sumber like '%".$string."%'";
      $this->db->where($where);
      return $this->db->count_all_results();
  }
    public function record_count_katalog($tabel = '', $string = '') {
      $this->db->select('id_layanan');
      $this->db->from($tabel);
      $where = "layanan like '%".$string."%' or layanan_en like '%".$string."%'";
      $this->db->where($where);
      return $this->db->count_all_results();
  }
}
