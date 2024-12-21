<?php
class Faq_model extends CI_Model {

  var $table = 'tbl_faq';

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

    function get_list_faq() {
      $get = $this->db->from($this->table)
        ->where("is_publish", 1)
        ->get();
      $result = $get->result_array();
      return $result;
    }
}