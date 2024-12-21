<?php
// application\models\Global_model.php
defined('BASEPATH') OR exit('No direct script access allowed');
class Global_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function get_list($table = '', $con = '', $sort_by = '', $order_by = 'ASC') {
        $this->db->from($table);
        if ( !empty($con) ) {
            $this->db->where($con);
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

    function insert_foto($table,$data = array()){
        $insert = $this->db->insert_batch($table,$data);
        return $insert?true:false;
    }

    function search($limit = '', $start = '', $table = '', $string = '') {
        $this->db->from($table);
      $this->db->like('judul',$string, 'both'); 
      $this->db->or_like('judul_en', $string, 'both'); 
      $this->db->or_like('isi', $string, 'both'); 
      $this->db->or_like('isi_en', $string, 'both'); 
        
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
      $this->db->like('judul',$string, 'both'); 
      $this->db->or_like('judul_en', $string, 'both'); 
      $this->db->or_like('isi', $string, 'both'); 
      $this->db->or_like('isi_en', $string, 'both'); 
      return $this->db->count_all_results();
  }
}