<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Libur_model extends CI_Model
    {
        var $table      = 'tbl_libur';
        var $pk_name    = 'id_libur';
        var $module     = '';

        function __construct(){
            parent::__construct();
        }
    
        function initialize($module) {
            if ( !empty($module) ) $this->module = $module;else $this->module = $this->module;
        }

        public function show_datatable($column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch) {
            $aColumns = $column_datatable;
            if(isset($iDisplayStart) && $iDisplayLength != '-1')
            {
                $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
            }
            $columns = $this->input->get_post('columns', true);
            if(isset($order) > 0)
            {
                for($i=0; $i<count($order); $i++)
                {
                    if($columns[$order[$i]['column']]['orderable'] == 'true')
                    {
                        $this->db->order_by($aColumns[intval($order[$i]['column'])], $order[$i]['dir']);
                    }
                }
            }
            if ( count($order) < 1 ) {
                $this->db->order_by($this->pk_name, 'desc');
            }

            $where = "1=1";
            if(isset($sSearch) && !empty($sSearch['value']))
            {
                $where .= " AND (";
                for($i=0; $i<count($aColumns); $i++)
                {
                    if( $columns[$i]['searchable'] == 'true')
                    {
                        $where .= "LOWER(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
                    }
                }
                $where  = substr($where, 0, strlen($where)-4);
                $where .= ")";
            }
            $select = 'id_libur, tgl_mulai, tgl_akhir, keterangan';
		    $this->db->where($where);
            $this->db->select($select);
            $this->db->from($this->table);        
            $rResult = $this->db->get();
            // Data set length after filtering
            $this->db->where($where);
            $this->db->select($select);
            $this->db->from($this->table);
            //baris terakhir perubahan oleh : Nurhayati Rahayu(24/08/2020)        
            $iFilteredTotal = $this->db->count_all_results();
            // Total data set length
            $iTotal = $iFilteredTotal;

            // Output
            $output = array(
                'sEcho' => 0,
                'iTotalRecords' => $iTotal,
                'iTotalDisplayRecords' => $iFilteredTotal,
                'aaData' => array()
            );
            $i=1;
            $nomor = (!empty($iDisplayStart) && $iDisplayStart != -1 ) ? $iDisplayStart+1 : 1;
            foreach($rResult->result_array() as $aRow)
            {
                $row = array();
                $row[] = $nomor;
                $row[] = date('d F Y', strtotime($aRow['tgl_mulai'])).' s/d '.date('d F Y', strtotime($aRow['tgl_akhir']));
                $jml_hari = round((strtotime($aRow['tgl_akhir']) - strtotime($aRow['tgl_mulai'])) / (60 * 60 * 24));
                if($jml_hari == 0) $jml_hari=1;else $jml_hari++;
                $row[] = $jml_hari;
                $row[] = $aRow['keterangan'];
                //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)
                if ( $this->is_write ) {
                    $row[] .= "<div class='btn-group'>
                        <a href='".base_url().strtolower($this->module).'/edit/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-primary btn-block' style='margin-bottom:2px;width:75px'><i class='fa fa-pencil'></i> Edit</span></a>
                        <a href='".base_url().strtolower($this->module).'/delete/'.$aRow[$this->pk_name]."' onclick='return confirm(\"Apa anda yakin menghapus data ini?\")'><span class='btn btn-xs btn-danger btn-block' style='margin-bottom:2px;width:75px'><i class='fa fa-trash'></i> Hapus</span></a>
                    </div>";
                }
                //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (22 Mei 2024)

                $output['aaData'][] = $row;
                $i++;
                $nomor++;
            }
            echo json_encode($output);
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