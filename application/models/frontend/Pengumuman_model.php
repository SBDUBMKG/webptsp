<?php
class Pengumuman_model extends CI_Model {

  var $table_pengumuman = 'tbl_pengumuman';

  function __construct() {
    parent::__construct();
  }

  public function record_count() {
      $this->db->select('id_pengumuman');
      $this->db->from('tbl_pengumuman');
      return $this->db->count_all_results();
  }

  public function fetch_pengumuman($limit, $start) {
      $this->db->limit($limit, $start);
      $this->db->order_by("id_pengumuman","desc");
      $this->db->where("expired_date >= CURDATE()");
      $this->db->select("judul, judul_en, isi, isi_en, is_publish, expired_date");
      $query = $this->db->get("tbl_pengumuman");

      if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $row) {
              $data[] = $row;
          }
          return $data;
      }
      return false;
  }

  public function list_pengumuman() {
    $curr_year = date('Y');
    $curr_month = date('m');
    $sql = "SELECT * FROM $this->table_pengumuman WHERE is_publish = 1 AND YEAR(expired_date) = '$curr_year' AND MONTH(expired_date) = '$curr_month' ORDER BY expired_date ASC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function detil_pengumuman($id) {
    $sql = "SELECT * FROM $this->table_pengumuman WHERE id_pengumuman = '$id' AND is_publish = 1";
    $query = $this->db->query($sql);
    return $query->row_array();
  }

  public function detil_pengumuman_c($tgl) {
    $sql = "SELECT * FROM $this->table_pengumuman WHERE DATE(expired_date) = '$tgl'";
    $query = $this->db->query($sql);
    return $query->result_array();
  }
}
