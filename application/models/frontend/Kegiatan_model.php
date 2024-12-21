<?php
class Kegiatan_model extends CI_Model {

  var $table_kegiatan = 'tbl_kegiatan';
  var $table_fotokegiatan = 'tbl_fotokegiatan';
  var $table_bidang = 'tbl_bidang';

  function __construct() {
    parent::__construct();
  }

  public function list_kegiatan_groupbidang($order = 'DESC') {
    $sql = "SELECT * 
            FROM  $this->table_kegiatan a 
            JOIN tbl_fotokegiatan b
            ON a.id_kegiatan = b.id_kegiatan
            JOIN $this->table_bidang c
            ON c.id_bidang = a.id_bidang
            WHERE is_default = 1
            GROUP BY a.id_bidang
            ORDER BY a.id_kegiatan $order";
    // echo nl2br($sql);exit();
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function list_kegiatan_slide($bidang=''){
    $sql = "SELECT * FROM tbl_kegiatan a 
            JOIN tbl_fotokegiatan b ON a.id_kegiatan = b.id_kegiatan 
            JOIN tbl_bidang c ON c.id_bidang = a.id_bidang 
            WHERE is_default = 1 and a.id_bidang=$bidang
            order by a.id_kegiatan desc
            limit 1";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function list_kegiatan_perbidang($id_bidang, $limit = '') {
    if(!empty($limit)){
      $lm = "LIMIT 1";
    }else{
      $lm = "";      
    }

    $sql = "SELECT * 
            FROM  $this->table_kegiatan a 
            JOIN tbl_fotokegiatan b
            ON a.id_kegiatan = b.id_kegiatan
            JOIN $this->table_bidang c
            ON c.id_bidang = a.id_bidang
            WHERE a.id_bidang = $id_bidang AND is_default = 1
            ORDER BY a.id_kegiatan DESC
            $lm";

    // echo nl2br($sql);exit();
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function detil_kegiatan($id, $default = '') {
    if(!empty($default)){
      $where = "WHERE a.id_kegiatan = $id AND is_default = 1";
    }else{
      $where = "WHERE a.id_kegiatan = $id";      
    }

    $sql = "SELECT * 
            FROM  $this->table_kegiatan a 
            JOIN tbl_fotokegiatan b
            ON a.id_kegiatan = b.id_kegiatan
            JOIN $this->table_bidang c
            ON c.id_bidang = a.id_bidang
            $where
            ORDER BY a.id_kegiatan DESC";
    // echo nl2br($sql);exit();
    $query = $this->db->query($sql);
    return $query->result_array();
  }
}