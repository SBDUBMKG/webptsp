<?php
class Minerba_model extends CI_Model {

  var $table_berita = 'tbl_berita';

  function __construct() {
    parent::__construct();
  }

  public function record_count($where = '1=1') {
      $this->db->select('id');
      $this->db->from('tbl_berita');
      $this->db->where($where);
      $this->db->where('id_jenis_konten=1');
      $this->db->where('is_publish = 1');
      return $this->db->count_all_results();
  }

  public function fetch_berita($limit, $start, $where = '1=1') {
      $this->db->where($where);
      $this->db->where('id_jenis_konten=1');
      $this->db->where('is_publish = 1');
      $this->db->limit($limit, $start);
      $this->db->order_by("id","desc");
      $query = $this->db->get("tbl_berita");

      if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $row) {
              $data[] = $row;
          }
          return $data;
      }
      return false;
  }

  public function list_berita($limit = 0) {
    $sql = "SELECT * FROM  $this->table_berita ORDER BY id ASC LIMIT $limit";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function all_berita() {
    $sql = "SELECT * FROM  $this->table_berita ORDER BY id ASC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function detil_berita($id) {
    $sql = "SELECT * FROM $this->table_berita WHERE id = $id";
    $query = $this->db->query($sql);
    return $query->row_array();
  }
}