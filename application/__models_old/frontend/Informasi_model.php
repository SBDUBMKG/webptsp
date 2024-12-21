<?php
class Informasi_model extends CI_Model {

  var $table_informasi = 'tbl_informasi';

  function __construct() {
    parent::__construct();
  }

  public function detil_informasi($id) {
    $sql = "SELECT * FROM $this->table_informasi WHERE id_informasi = $id";
    $query = $this->db->query($sql);
    return $query->row_array();
  }
}