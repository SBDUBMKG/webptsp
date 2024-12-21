<?php
class Survey_model extends CI_Model
{
    var $survey_table = "tbl_survey";
    var $category_survey_table = "m_kategori_survey";

    function __construct()
    {
        parent::__construct();
        $this->load->helper('skm_helper');
    }

    function insert_data($data)
    {
        $this->db->insert($this->category_survey_table, $data);
        return $this->db->insert_id();
    }

    function update_data($id, $data)
    {
        if (count($data)) {
            $this->db->where($this->pk_name, $id);
            $update = $this->db->update($this->category_survey_table, $data);
            return $update;
        }
    }

    function delete_data($id = "")
    {
        $this->db->where($this->pk_name, $id);
        $delete = $this->db->delete($this->category_survey_table);
        if ($delete) {
            return true;
        }
        return false;
    }

    function count_survey_respondent($year = "") {
        return $this->db
            ->select('a.survey')
            ->from('tbl_survey a')
            ->join('tbl_detail_permohonan b', 'a.id_detail_permohonan = b.id_detail_permohonan', 'left')
            ->join('tbl_permohonan c', 'b.id_permohonan = c.id_permohonan', 'left')
            ->join('tbl_admin d', 'c.id_pemohon = d.id_admin', 'left')
            ->join('m_pendidikan e', 'd.id_pendidikan = e.id_pendidikan', 'left')
            ->where('b.is_survey = "Sudah"')
            ->where('YEAR(c.tanggal_permohonan) = ' . $year)
            ->get()
            ->num_rows();
    }

    function data_factor_by_year($year = "")
    {
        $query = $this->db
            ->select('a.survey')
            ->from('tbl_survey a')
            ->join('tbl_detail_permohonan b', 'a.id_detail_permohonan = b.id_detail_permohonan', 'left')
            ->join('tbl_permohonan c', 'b.id_permohonan = c.id_permohonan', 'left')
            ->join('tbl_admin d', 'c.id_pemohon = d.id_admin', 'left')
            ->join('m_pendidikan e', 'd.id_pendidikan = e.id_pendidikan', 'left')
            ->where('b.is_survey = "Sudah"')
            ->where('YEAR(c.tanggal_permohonan) = ' . $year)
            ->get();

        $surveys = $query->result();

        $respondens = [];
        foreach ($surveys as $row) {
            $respondent = get_skm_factor_per_row($row->survey);
            array_push($respondens, $respondent);
        }

        $result = [];
        for($i = 0; $i < 9; $i++) {
            $result[] = get_skm_factor($respondens, $i);
        }


        return $result;
    }

    function skm_data_per_year(string $start_year) {
        $skm_per_year = [];

        for($i = 0; $i < 5; $i++) {
            $current_year = $start_year - $i;
            $factors = $this->data_factor_by_year($current_year);
            $value = get_skm_value($factors);

            $skm_per_year[$current_year] = $value;
        }

        return $skm_per_year;
    }
}
