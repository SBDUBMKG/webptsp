<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_backoffice_model extends CI_Model
{
    var $table      = 'tbl_detail_permohonan';
    var $pk_name    = '';
    var $module     = '';

    function __construct(){
        parent::__construct();
    }

    function initialize($module) {
        if ( !empty($module) )
            $this->module = $module;
        else
            $this->module = $this->module;
    }

    function get_by_id($id = '') {
        $this->db->from($this->table)->where($this->pk_name, $id);
        $query = $this->db->get();
        if ( is_object($query) ) {
            $data = $query->row_array();
            if ( count($data) > 0 )
                return $data;
        }
        return false;
    }
    function insert_data($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    function update_data($id, $data) {
        $this->db->where($this->pk_name, $id);
        $update = $this->db->update($this->table, $data);
        return $update;
    }
    function delete_data($id = '') {
        $this->db->where($this->pk_name, $id);
        $delete = $this->db->delete($this->table);
        if ( $delete ) {
            return true;
        }
        return false;
    }
}