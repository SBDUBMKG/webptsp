<?php
class Kontak_model extends CI_Model {

  var $table_kontak = 'tbl_kontak';

  function __construct() {
    parent::__construct();
  }

  public function list_tanya_jawab() {
    $sql = "SELECT * FROM $this->table_kontak WHERE jawaban != '' AND is_publish = 1 ORDER BY tgl_balas DESC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function record_count($where = '1=1') {
  	  $where .= " AND jawaban != '' AND is_publish = 1";

      $this->db->select('id');
      $this->db->from('tbl_kontak');
      $this->db->where($where);
      return $this->db->count_all_results();
  }

  public function fetch_faq($limit, $start, $where = '1=1') {
  	  $where .= " AND jawaban != '' AND is_publish = 1";

      $this->db->where($where);
      $this->db->limit($limit, $start);
      $this->db->order_by("tgl_balas","DESC");
      $query = $this->db->get("tbl_kontak");

      if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $row) {
              $data[] = $row;
          }
          return $data;
      }
      return false;
  }
}