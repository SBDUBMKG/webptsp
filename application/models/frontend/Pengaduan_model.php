<?php
class Pengaduan_model extends CI_Model {

  var $table = 'tbl_pengaduan';

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

    function get_list_pengaduan() {
      $id_admin = $this->session->userdata('id_admin');

      $get = $this->db->from($this->table)
        ->where("id_admin", $id_admin)
        ->where("is_publish", 1)
        ->get();

      $result = $get->result_array();

      return $result;
    }

    function get_list_response() {
      $id_admin = $this->session->userdata('id_admin');
      $get = $this->db->from($this->table)
        ->where("id_admin", $id_admin)
        ->where("is_response", 1)
        ->get();

      $result = $get->result_array();

      return $result;
    }

    function get_total_pengaduan() {
      $id_admin = $this->session->userdata('id_admin');
      $get = $this->db->from($this->table)
        ->where("id_admin", $id_admin)
        ->where("is_publish", 1);

      $result = $get->count_all_results();

      return $result;
    }
}