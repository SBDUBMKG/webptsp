<?php
class Pencarian_model extends CI_Model {

  var $table_kegiatan = 'tbl_kegiatan';
  var $table_bidang = 'tbl_bidang';
  var $table_berita   = 'tbl_berita';
  var $table_agenda   = 'tbl_agenda';

  function __construct() {
    parent::__construct();
  }

  public function get_kegiatan($bahasa='',$search) {
    $where = 'judul'.$bahasa.' like "%'.$search.'%"';
    $this->db->select('*');
    $this->db->from($this->table_kegiatan.' A');
    $this->db->join($this->table_bidang.' B', 'A.id_bidang=B.id_bidang');
    $this->db->where($where);
    $this->db->order_by('tanggal', 'DESC');
    $query = $this->db->get();
    if ( is_object($query) ) {
          $result = $query->result_array();
          return $result;
      }
      return array();
  }

  public function get_artikel($bahasa='',$search) {
    $where = 'judul'.$bahasa.' like "%'.$search.'%"';
    $this->db->select('*');
    $this->db->from($this->table_berita);
    $this->db->where($where);
    $this->db->order_by('tanggal_berita', 'DESC');
    $query = $this->db->get();
    if ( is_object($query) ) {
          $result = $query->result_array();
          return $result;
      }
      return array();
  }

  public function get_agenda($bahasa='',$search) {
    $where = 'judul'.$bahasa.' like "%'.$search.'%"';
    $this->db->select('*');
    $this->db->from($this->table_agenda);
    $this->db->where($where);
    $this->db->order_by('tgl_mulai', 'DESC');
    $query = $this->db->get();
    if ( is_object($query) ) {
          $result = $query->result_array();
          return $result;
      }
      return array();
  }
}