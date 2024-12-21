<?php
/**
 * Pembuat : Arif Kurniawan
 * Contact : arif.kurniawan86@gmail.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Generator_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }
    function get_list_table() {
        $sql = "SELECT DISTINCT (
                    TABLE_NAME
                ) AS table_name
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA =  '".$this->db->database."'";
        $query = $this->db->query($sql);
        if ( is_object($query) ) {
            return $query->result();
        }
        return array();
    }
    function get_list_column($table = '') {
        $sql = "SELECT
                COLUMN_NAME AS id,
                COLUMN_NAME AS name,
                DATA_TYPE AS type,
                COLUMN_TYPE AS column_type,
                CHARACTER_MAXIMUM_LENGTH AS max_length,
                CASE WHEN UPPER(IS_NULLABLE) = 'NO' THEN 0 ELSE 1 END is_null,
                CASE WHEN UPPER(COLUMN_KEY) = 'PRI' THEN 1 ELSE 0 END primary_key,
                COLUMN_COMMENT AS label
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = '".$this->db->database."'
                AND TABLE_NAME= '".$table."'";
        $query = $this->db->query($sql);
        if ( is_object($query) ) {
            $result = $query->result();
            return $result;
        }
        return array();
    }
    function get_by_column_name($table = '', $column_name) {
        $sql = "SELECT COLUMN_NAME AS name,
                DATA_TYPE AS type,
                COLUMN_TYPE AS column_type,
                CHARACTER_MAXIMUM_LENGTH AS max_length,
                CASE WHEN UPPER(IS_NULLABLE) = 'NO' THEN 0 ELSE 1 END is_null,
                CASE WHEN UPPER(COLUMN_KEY) = 'PRI' THEN 1 ELSE 0 END primary_key,
                COLUMN_COMMENT AS label
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = '".$this->db->database."'
                AND TABLE_NAME= '".$table."'
                AND COLUMN_NAME = '".$column_name."'";
        $query = $this->db->query($sql);
        if ( is_object($query) ) {
            $data = $query->row();
            if ( is_object($data) )
                return $data;
        }
        return false;
    }
}