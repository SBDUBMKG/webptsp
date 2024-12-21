<?php
class Press_release_model extends CI_Model {

  var $table_press_release = 'tbl_berita';

  function __construct() {
    parent::__construct();
  }

  public function record_count($where = '1=1 and id_jenis_konten=3') {
      $this->db->select('id');
      $this->db->from($this->table_press_release);
      $this->db->where($where);
      return $this->db->count_all_results();
  }

  public function fetch_press_release($limit, $start, $where = '1=1 and id_jenis_konten=3') {
      $this->db->where($where);
      $this->db->order_by("id","desc");
      $this->db->limit($limit, $start);
      $query = $this->db->get($this->table_press_release);

      if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $row) {
              $data[] = $row;
          }
          return $data;
      }
      return false;
  }

  public function list_press_release($limit = 0) {
    $sql = "SELECT * FROM  $this->table_press_release  where id_jenis_konten=3 ORDER BY id ASC LIMIT $limit";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function all_press_release() {
    $sql = "SELECT * FROM  $this->table_press_release  where id_jenis_konten=3 ORDER BY id ASC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function detil_press_release($id) {
    $sql = "SELECT * FROM $this->table_press_release WHERE id = $id";
    $query = $this->db->query($sql);
    return $query->row_array();
  }
}