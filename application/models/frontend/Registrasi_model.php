<?php
class Registrasi_model extends CI_Model {

  var $table            = 'tbl_admin';
  var $table_perusahaan = 'tbl_perusahaan';

  function __construct() {
    parent::__construct();
  }

    function insert_data($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function insert_data_perusahaan($data) {
        $this->db->insert($this->table_perusahaan, $data);
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

    function get_list_provinsi() {
        $this->db->select('*');
        $this->db->from('m_provinsi');
        $this->db->order_by('provinsi', 'ASC');
        $query = $this->db->get();
        if ( is_object($query) ) {
            $result = $query->result();
            return $result;
        }
        return array();
    }
}