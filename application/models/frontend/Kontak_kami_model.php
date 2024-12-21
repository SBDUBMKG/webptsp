<?php
class Kontak_kami_model extends CI_Model {

    var $table   = 'tbl_kontak_kami';
    var $pk_name = 'id_kontak_kami';

    function __construct() {
    parent::__construct();
    }

    function insert_data($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function update_data($id, $data) {
        if (count($data) ) {
            $this->db->where($this->pk_name, $id);
            $update = $this->db->update($this->table, $data);
            return $update;
        } 
    }

    function delete_data($id = '') {
        $this->db->where($this->pk_name, $id);
        $delete = $this->db->delete($this->table);
        if ( $delete ) {
            return true;
        }
        return false;
    }

    function get_list_kontak() {
      $get = $this->db->from($this->table)
        ->where("is_publish", 1)
        ->get();
      $result = $get->result_array();
      return $result;
    }
}