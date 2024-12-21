<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan_model extends CI_Model
{
    var $table      = 'tbl_pengaduan';
    var $pk_name    = 'id_pengaduan';
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

    public function show_datatable($column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch) {
        $is_user_role = (int) $this->session->userdata('id_role') === 7;
        $current_lang = $this->session->userdata('language');
        $this->lang->load('backend/complaint/datatable', $current_lang);

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
        $where .= $_SESSION['id_role']==7 ? ' AND id_admin='.$_SESSION['id_admin'] : NULL;
        if(isset($sSearch) && !empty($sSearch['value']))
        {
            $where .= " AND (";
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

                // Individual column filtering
                if( $columns[$i]['searchable'] == 'true')
                {
                    $where .= "LOWER(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_like_str($sSearch['value']))."%' OR ";
                }
            }
            $where  = substr($where, 0, strlen($where)-4);
            $where .= ")";
        }
        $this->db->where($where);

        // Select Data
        $this->db->select('id_pengaduan, nama, email, waktu_pengaduan, pengaduan, avatar, is_response, is_publish, response');
        $this->db->from($this->table);


        $rResult = $this->db->get();

        // Data set length after filtering
        $this->db->where($where);
        $this->db->select('id_pengaduan, nama, email, waktu_pengaduan, pengaduan, avatar, is_response, is_publish, response');
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
            $row[] = $nomor.'<input type="hidden" class="selectedrow" value="'.$aRow[$this->pk_name].'">';
            $row[] = $aRow['waktu_pengaduan'];
            $row[] = $aRow['nama'];
            $row[] = $aRow['email'];

            $row[] = substr($aRow['pengaduan'],0,550);

            //publish tidak diperlukan lagi
            /*if ($aRow['is_publish'] == 1){
                $row[] = $this->lang->line('datatable.publish.true');
            } else{
                $row[] = $this->lang->line('datatable.publish.false');
            }*/

            $row[] = $aRow['is_response'] ? '<center><font color="green" size="4"><i class="fa fa-fw fa-check-circle"></i></font></center>' : '<center><font color="orange" size="4"><i class="fa fa-fw fa-times-circle"></i></font></center>' ;



            if ( $this->is_write && !$is_user_role ) {
                if(($aRow['is_response']==0)) {
                    $row[] .= ("<center>
                    <a target=\"_blank\" href='" .
                        base_url().strtolower($this->module) .
                        '/response/' .
                        $aRow[$this->pk_name].
                        "'><span class='btn btn-xs btn-success'><i class='fa fa-pencil'></i>&nbsp;" .
                        $this->lang->line('datatable.navigation.respond') .
                        "</span>
                    </a>
                    <a href='" .
                        base_url().strtolower($this->module).'/delete/' .
                        $aRow[$this->pk_name] .
                        "' onclick='return confirm(\"" . $this->lang->line('navigation.delete.text')  . "\")'><span class='btn btn-xs btn-danger'><i class='fa fa-trash'></i>
                        " . $this->lang->line('datatable.navigation.delete') . "
                        </span>
                    </a>
                    </center>");
                } else {
                    $row[] .= ("<center>
                    <a target=\"_blank\" href='" .
                        base_url().strtolower($this->module) .
                        '/response/' .
                        $aRow[$this->pk_name].
                        "'><span class='btn btn-xs btn-warning btn-block'><i class='fa fa-eye'></i>&nbsp;View                        
                        </span>
                    </a>
                    </center>");
                }
            }

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
