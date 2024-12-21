<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class File_menu_model extends CI_Model
{
    var $table      = 'tbl_file_menu';
    var $pk_name    = 'id';
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
    public function show_datatable($column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch){
        $aColumns = $column_datatable;

        // DB table to use
        $sTable = $this->table;

        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }

        $columns = $this->input->get_post('columns', true);
        // Ordering
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

        /*
        * Filtering
        * NOTE this does not match the built-in DataTables filtering which does it
        * word by word on any field. It's possible to do here, but concerned about efficiency
        * on very large tables, and MySQL's regex functionality is very limited
        */
        $where = "1=1";
        if(isset($sSearch) && !empty($sSearch['value']))
        {
            $where .= " AND (";
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

                // Individual column filtering
                if( $columns[$i]['searchable'] == 'true')
                {

                    if ( $aColumns[$i] == 'lampiran' )
                        $where .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch['value'])."%' OR ";
                    else
                    $where .= "LOWER(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
                }
            }
            $where  = substr($where, 0, strlen($where)-4);
            $where .= ")";
        }
        $this->db->where($where);
        // Select Data
        $this->db->select('id,nama_file,lampiran');
        $this->db->from($this->table);


        $rResult = $this->db->get();

        // Data set length after filtering
        $this->db->where($where);
        $this->db->select('id,nama_file,lampiran');
        $this->db->from($this->table);


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
            $row[] = $aRow[$this->pk_name].'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';
            $row[] = $aRow['nama_file'];
            $tipe_file = pathinfo(base_url().'upload/file_menu/'.$aRow['lampiran'], PATHINFO_EXTENSION);
            $icon_file = '<i class="fa fa-file-pdf-o"></i>';
            $aksi  = empty($aRow['lampiran']) ? NULL : '<a class="btn btn-xs btn-success" href="'.base_url().'upload/file_menu/'.$aRow['lampiran'].'" target="_blank">'.$icon_file.' Lampiran</a>  ';
            $aksi  .= empty($aRow['lampiran']) ? NULL : '<p style="display:none" id="link_copy'.$i.'">'.base_url().'upload/file_menu/'.$aRow['lampiran'].'</p><button onclick="copyToClipboard(\'#link_copy'.$i.'\')" class="btn btn-xs btn-info">Copy Link</button>';

            // $row[] = '';
            //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (08 Mei 2024)
            if ( $this->is_write ) {
                $row[] .= "<center>
                $aksi
                <a href='".base_url().strtolower($this->module).'/edit/'.$aRow[$this->pk_name]."'><span class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Edit</span></a>
                <a href='".base_url().strtolower($this->module).'/delete/'.$aRow[$this->pk_name]."' onclick='return confirm(\"Apa anda yakin menghapus data ini?\")'><span class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</span></a>
				</center>";
            }
            //Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (08 Mei 2024)

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
