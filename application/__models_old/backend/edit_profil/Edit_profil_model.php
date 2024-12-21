<?php

/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_profil_model extends CI_Model
{
    var $table                  = 'tbl_admin';
    var $pk_name                = 'id_admin';
    var $table_perusahaan       = 'tbl_perusahaan';
    var $pk_name_perusahaan     = 'id_perusahaan';
    var $module                 = '';

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

    function get_perusahaan_by_id($id = '') {
        $this->db->from($this->table_perusahaan)->where($this->pk_name_perusahaan, $id);
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

    function update_data_perusahaan($id, $data) {
        $this->db->where($this->pk_name_perusahaan, $id);
        $update = $this->db->update($this->table_perusahaan, $data);
        return $update;
    }

    function delete_data($id = '') {
        $this->db->where($this->pk_name, $id);
        $delete = $this->db->delete($this->table);
        if ( $delete ) {
            $username   = $this->session->userdata('userName');
            return true;
        }
        return false;
    }

    function check_username_exists($username, $id_admin = '') {
        $con = array(
            'username' => $username
        );
        if ( !empty($id_admin) )
            $con[$this->pk_name.' !='] = $id_admin;
        $this->db->where($con);
        $count = $this->db->count_all_results($this->table);
        if ( $count > 0 )
            return true;

        return false;
    }
}