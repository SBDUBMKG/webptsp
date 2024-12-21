<?php
class Galeri_foto_model extends CI_Model {

  var $table = 'tbl_galeri_foto';
  var $table_relasi = 'r_galeri_foto';

  function __construct() {
    parent::__construct();
  }

  public function list_foto() {
    $sql = "SELECT * 
            FROM  $this->table a 
            JOIN $this->table_relasi b
            ON a.id_kegiatan = b.id_kegiatan
            WHERE is_default = 1
            ORDER BY a.id_kegiatan DESC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function detil_foto($id, $default = '') {
    if(!empty($default)){
      $where = "WHERE a.id_kegiatan = $id AND is_default = 1";
    }else{
      $where = "WHERE a.id_kegiatan = $id";      
    }

    $sql = "SELECT * 
            FROM  $this->table a 
            JOIN $this->table_relasi b
            ON a.id_kegiatan = b.id_kegiatan
            $where
            ORDER BY a.id_kegiatan DESC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function list_slider_foto(){
    $this->db->from($this->table . ' A');
    $this->db->join($this->table_relasi.' B', 'A.id_kegiatan = B.id_kegiatan');
    $this->db->where('B.is_default',1);
    //$this->db->limit(1);
    $query = $this->db->get();
    if ( is_object($query) ) {
        $data = $query->result_array();
        if ( count($data) > 0 )
            return $data;
    }
    return false;
  }
}