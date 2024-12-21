<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */

class Services extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('global_model');
    }

    public function get_detail_layanan() {
        $curr_lang = $this->session->userdata('language');
        $this->lang->load('backend/service_request/complete', $curr_lang);

        $result = array('layanan' => array(), 'addform', 'addformlayanan');

        // layanan
        $where = array(
          'id_layanan' => $this->input->get('id_layanan'),
        );

        $this->db->select('*')->from('m_layanan')->where($where);
        $query              = $this->db->get();
        $list_layanan       = $query->row();

        $data_layanan = [
            'layanan' => $curr_lang === 'indonesia' ? $list_layanan->layanan : $list_layanan->layanan_en,
            'satuan' => $list_layanan->satuan,
            'harga' => $list_layanan->harga,
            'penanggung_jawab' => $this->db->get_where('tbl_role', ['id_role' => $list_layanan->penanggung_jawab])->row('role'),
            'berat' => $list_layanan->berat,
            'satuan_berat' => $list_layanan->satuan_berat,
            'estimasi' => $list_layanan->estimasi,
        ];
        $result['layanan']  = $data_layanan;

        $result['note'] = null;
        if(!empty($list_layanan) && $list_layanan->id_jenis_layanan == 2) {
            $result['note'] = '<div id="note" class="alert alert-info alert-dismissible" role="alert" style="margin:5px 0 0; padding: 5px 10px">Harga belum termasuk biaya akomodasi dan transportasi.</div>';
        }

        // strlayanan
        $addformlayanan = '<input type="hidden" name="layanan" id="layanan" value="'.$list_layanan->layanan.'" required>';
        $result['addformlayanan']  = $addformlayanan;

        // append form
        $addform = '<div id="content_form"><h4 class="box-title">' . $this->lang->line('form.product.title')  . '</h4><hr>';

        $display_column_lang = $curr_lang === 'indonesia' ? $list_layanan->display_coloumn : $list_layanan->display_coloumn_en;
        $display_coloumn = json_decode($display_column_lang, true);
        foreach ($display_coloumn as $key => $value) {
            //format tanggal
            if($key == 'tanggal_mulai' || $key == 'tanggal_selesai') {
                $addform .= '
                          <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$value.' * </label>
                            <div class="input-group date col-md-9 col-sm-9 col-xs-12">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="'.$key.'" name="'.$key.'" required>
                            </div>
                          </div>
                ';
            }
            // format number
            else if($key == 'jumlah') {
                $addform .= '
                        <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$value.' * </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="'.$key.'" id="'.$key.'" max_length="100" required>
                            </div>
                        </div>
                ';
            }
            // format tahun
            else if($key == 'tahun') {
                $addform .= '
                        <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$value.' * </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="'.$key.'" name="'.$key.'" required>
                                    <option value=""> - Pilih Tahun - </option>
                ';

                $now    = date('Y');
                // Awal script yang diedit Rahmat, 1 September 2020, asalnya "$now - 10" dirubah menjadi "$now - 61"
                $dari   = $now - 61;
                // Akhir script yang diedit Rahmat, 1 September 2020
                $sampai = $now + 10;
                for ($x = $dari; $x <= $sampai; $x++) {
                    $addform .= '<option value="'.$x.'">'.$x.'</option>';
                }

                $addform .= '
                                </select>
                            </div>
                        </div>
                ';
            }
            // format bulan
            else if($key == 'bulan') {
                $addform .= '
                        <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$value.' * </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="'.$key.'" name="'.$key.'" required>
                                    <option value=""> - Pilih '.$value.' - </option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                ';
            }
            // Awal script yang ditambahkan Rahmat, 10 Agustus 2020 => format pendidikan
            else if($key == 'id_pendidikan') {
                $addform .= '
                        <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$value.' * </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="'.$key.'" name="'.$key.'" required>
                                    <option value=""> - Pilih '.$value.' - </option>
                ';

                $list_pendidikan = $this->global_model->get_list('m_pendidikan');
                foreach ($list_pendidikan as $pendidikan) {
                    $addform .= '<option value="'.$pendidikan->id_pendidikan.'">'.$pendidikan->pendidikan.'</option>';
                }

                $addform .= '
                                </select>
                            </div>
                        </div>
                ';
            }
            // Akhir script yang ditambahkan Rahmat, 10 Agustus 2020
            // format provinsi
            else if($key == 'provinsi') {
                $addform .= '
                        <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$value.' * </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="'.$key.'" name="'.$key.'" required>
                                    <option value=""> - Pilih '.$value.' - </option>
                ';

                $list_provinsi = $this->global_model->get_list('m_provinsi');
                foreach ($list_provinsi as $provinsi) {
                    $addform .= '<option value="'.$provinsi->id_provinsi.'">'.$provinsi->provinsi.'</option>';
                }

                $addform .= '
                                </select>
                            </div>
                        </div>
                ';
            }
            // format kabkot
            else if($key == 'kabupaten') {
                $addform .= '
                        <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$value.' * </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="'.$key.'" name="'.$key.'" required>
                                    <option value=""> - Pilih '.$value.' - </option>
                ';

                $list_kabkot = $this->global_model->get_list('m_kabkot');
                foreach ($list_kabkot as $kabkot) {
                    $addform .= '<option value="'.$kabkot->id_kabkot.'">'.$kabkot->kabkot.'</option>';
                }

                $addform .= '
                                </select>
                            </div>
                        </div>
                ';
            }
            // format upt
            else if($key == 'upt') {
                $addform .= '
                        <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$value.' * </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="'.$key.'" name="'.$key.'" required>
                                    <option value=""> - Pilih '.$value.' - </option>
                ';

                $list_upt = $this->global_model->get_list('m_upt');
                foreach ($list_upt as $upt) {
                    $addform .= '<option value="'.$upt->id_upt.'">'.$upt->upt.'</option>';
                }

                $addform .= '
                                </select>
                            </div>
                        </div>
                ';
            }
            // format text
            else {
                $str_placeholder = '';
                if($key=='koordinat'){
                    $str_placeholder = '41 24.2028, 2 10.4418';
                }
                $addform .= '
                        <div class="form-group" id="addform">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">'. $value.' * </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="'.$key.'" id="'.$key.'" max_length="100"  placeholder="'.$str_placeholder.'" required>
                            </div>
                        </div>
                ';
            }
        }
        $addform .= '</div>';
        $result['addform']  = $addform;

        echo json_encode($result);
    }

    // Awal script yang ditambahkan Rahmat, 10 Agustus 2020
    function id_pendidikan() {
        $s = $this->input->get('s', TRUE);
        $this->db->select('id_pendidikan as id, pendidikan as text');
        $this->db->from('m_pendidikan');
        $this->db->where('id_pendidikan IS NOT NULL');
        if(!empty($s)) {
            $this->db->like('pendidikan', $s, 'both');
        }
        $this->db->order_by('id_pendidikan ASC');
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            $data = $result->result();
        }
        $this->output->set_status_header(200)->set_content_type('application/json','utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }
    // Akhir script yang ditambahkan Rahmat, 10 Agustus 2020

    function provinsi() {
        $s = $this->input->get('s', TRUE);
        $this->db->select('id_provinsi as id, provinsi as text');
        $this->db->from('m_provinsi');
        $this->db->where('id_provinsi IS NOT NULL');
        if(!empty($s)) {
            $this->db->like('provinsi', $s, 'both');
        }
        $this->db->order_by('provinsi ASC');
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            $data = $result->result();
        }
        $this->output->set_status_header(200)->set_content_type('application/json','utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }

    function kab_kota() {
        $q = $this->input->get('q', TRUE);
        $s = $this->input->get('s', TRUE);
        $this->db->select('id_kabkot as id, kabkot as text');
        $this->db->from('m_kabkot');
        $this->db->where('id_provinsi', $q);
        if(!empty($s)) {
            $this->db->like('kabkot', $s, 'both');
        }
        $this->db->order_by('kabkot ASC');
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            $data = $result->result();
        }
        $this->output->set_status_header(200)->set_content_type('application/json','utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }

    function kecamatan() {
        $q = $this->input->get('q', TRUE);
        $s = $this->input->get('s', TRUE);
        $this->db->select('id_kecamatan as id, kecamatan as text');
        $this->db->from('m_kecamatan');
        $this->db->where('id_kabkot', $q);
        if(!empty($s)) {
            $this->db->like('kecamatan', $s, 'both');
        }
        $this->db->order_by('kecamatan ASC');
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            $data = $result->result();
        }
        $this->output->set_status_header(200)->set_content_type('application/json','utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }

    function kelurahan() {
        $q = $this->input->get('q', TRUE);
        $s = $this->input->get('s', TRUE);
        $this->db->select('id_kelurahan as id, kelurahan as text, kode_pos as kode');
        $this->db->from('m_kelurahan');
        $this->db->where('id_kecamatan', $q);
        if(!empty($s)) {
            $this->db->like('kelurahan', $s, 'both');
        }
        $this->db->order_by('kelurahan ASC');
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            $data = $result->result();
        }
        $this->output->set_status_header(200)->set_content_type('application/json','utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }

    function kodepos() {
        $q = $this->input->get('q', TRUE);
        $this->db->select('id_kelurahan as id, kelurahan as text, kode_pos as kode');
        $this->db->from('m_kelurahan');
        $this->db->where('id_kecamatan', $q);
        if(!empty($s)) {
            $this->db->like('kelurahan', $s, 'both');
        }
        $this->db->order_by('kelurahan ASC');
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            $data = $result->result();
        }
        $this->output->set_status_header(200)->set_content_type('application/json','utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }

    function get_data_kabkot() {
        $this->load->model('global_model');
        $id_provinsi = $this->input->get('id_provinsi');
        $list_kabkot = $this->db->get_where('m_kabkot', ['id_provinsi' => $id_provinsi])->result_array();
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json','utf-8')
        ->set_output(json_encode(['result' => $list_kabkot], JSON_PRETTY_PRINT));
    }

    function get_data_kecamatan() {
        $this->load->model('global_model');
        $id_kabkot = $this->input->get('id_kabkot');
        $list_kecamatan = $this->global_model->get_list('m_kecamatan', array('id_kabkot' => $id_kabkot));
        echo json_encode(array('result' => (array)$list_kecamatan));
    }

    function get_data_kelurahan() {
        $this->load->model('global_model');
        $id_kecamatan = $this->input->get('id_kecamatan');
        $list_kelurahan = $this->global_model->get_list('m_kelurahan', array('id_kecamatan' => $id_kecamatan));
        echo json_encode(array('result' => (array)$list_kelurahan));
    }

    public function get_data_kodepos() {
        $result = array('kodepos' => array());

        // kabkot
        $where = array(
          'id_kelurahan' => $this->input->get('id_kelurahan'),
        );

        $this->db->select('*')
               ->from('m_kelurahan')
               ->where($where);
        $query                = $this->db->get();
        $list_kodepos         = $query->row();
        $result['kodepos']    = $list_kodepos;

        echo json_encode($result);
    }

    function validasi_username($username = NULL) {
        if ($username != '') {
            $this->db->select('username')
               ->from('tbl_admin')
               ->where('username',$username);
            $result_username = $this->db->count_all_results();
            if ($result_username == 0) {
                echo '<p style="margin:0px">Username bisa digunakan</p>';
            }else{
                echo '<p style="margin:0px">Username sudah digunakan!</p>';
            }
        }
    }

    function validasi_password($pass1 = NULL, $pass2 = NULL) {
        if ($pass1 != NULL) {
            if ($pass1 != $pass2) {
                echo '<p style="margin:0px">Password tidak sama!</p>';
            } else {
                echo '<p style="margin:0px">Password Benar</p>';
            }
        }
    }
}
