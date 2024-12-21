<?php
class Agenda_model extends CI_Model {

  var $table_agenda = 'tbl_agenda';

  function __construct() {
    parent::__construct();
  }

  public function record_count() {
      $this->db->select('id_agenda');
      $this->db->from('tbl_agenda');
      return $this->db->count_all_results();
  }

  public function fetch_agenda($limit, $start) {
      $this->db->limit($limit, $start);
      $this->db->order_by("id_agenda","desc");
      $query = $this->db->get("tbl_agenda");

      if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $row) {
              $data[] = $row;
          }
          return $data;
      }
      return false;
  }

  public function list_agenda() {
    $sql = "SELECT * FROM $this->table_agenda";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function detil_agenda($id) {
    $sql = "SELECT * FROM $this->table_agenda WHERE id_agenda = '$id'";
    $query = $this->db->query($sql);
    return $query->row_array();
  }

  public function detil_agenda_c($tgl) {
    $sql = "SELECT * FROM $this->table_agenda WHERE DATE(tgl_mulai) = '$tgl'";
    $query = $this->db->query($sql);
    return $query->result_array();
  }
}