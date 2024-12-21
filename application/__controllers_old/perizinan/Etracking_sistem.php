<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etracking_sistem extends CI_Controller {
    var $folder         = 'perizinan';
    var $column_datatable = array('id', 'judul','judul_en','keterangan','keterangan_en','lampiran','hit');
    var $page_title = 'Etracking Perizinan';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $this->load->model('perizinan/format_surat_model','app_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index()
	{
        $data['bahasa']   = $this->session->userdata('bahasa');
        $module =$this->module;

        $data['tracking'] = $this->tracking_perizinan();

        
        $data['title'] = $this->page_title;

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_etracking_sistem', $data, true);
        $this->template->render();
	}

    public function tracking_perizinan() {
        $nilai="";
        $svrurl = $_SERVER['REQUEST_URI'];
        $_GET = array();
        $filter = explode('.', $svrurl);
        $url = $filter[0];
        $f = explode('?nomor-permohonan=', $svrurl);
        $u = isset($f[1]) ? $f[1] : NULL;

        foreach ($filter as $pair) {
            list($key, $value) = explode('/', $pair);
            $value = urldecode($value);
            $hasil[$key] = $value; 
        }

        $U=$this->config->item('rpiit_uri').'publikasi/etracking.php?nomor-permohonan='.$u;
        $file=file_get_contents($U);
        // var_dump($file);exit();

        $nomor_permohonan = explode('[nomor-permohonan]', $file); 
        $nama_perusahaan = explode('[nama-perusahaan]', $file); 
        $jenis_permohonan = explode('[jenis-permohonan]', $file); 
        $perkiraan_dapat_diambil = explode('[perkiraan-dapat-diambil]', $file); 
        $status_permohonan = explode('[status-permohonan]', $file);

        $front_officer = explode('[front-officer]', $file); 

        $surat_dirjen = explode('[surat-dirjen]', $file); 
        $surat_keterangan_dirjen = explode('[surat-keterangan-dirjen]', $file); 

        $surat_direktur = explode('[surat-direktur]', $file); 
        $surat_keterangan_direktur = explode('[surat-keterangan-direktur]', $file); 

        $surat_kasubdit = explode('[surat-kasubdit]', $file); 

        $direktur = array("batubara","mineral","program","teknik");
        $surat_keterangan_kasubdit = "";
        $surat_keterangan_kasubdit_="";
        for($dir=0; $dir<count($direktur); $dir++){
            $surat_keterangan_kasubdit_ .= explode('[surat-keterangan-kasubdit-'.$direktur[$dir].']', $file)[1]; 
        }
        $surat_keterangan_kasubdit = array("",$surat_keterangan_kasubdit_);

        $surat_kasi = explode('[surat-kasi]', $file);  
        $surat_keterangan_kasi = "";
        $surat_keterangan_kasi_ = "";
        for($dir=0; $dir<count($direktur); $dir++){
            $surat_keterangan_kasi_ .= explode('[surat-keterangan-kasi-'.$direktur[$dir].']', $file)[1]; 
        }
        $surat_keterangan_kasi = array("",$surat_keterangan_kasi_);
 
        $koordinator = explode('[koordinator]', $file); 

        $evaluator = explode('[evaluator]', $file); 
        $dokumen_evaluator_keterangan = explode('[dokumen-evaluator-keterangan]', $file); 

        $dokumen_kasi = explode('[dokumen-kasi]', $file); 
        $dokumen_keterangan_kasi = explode('[dokumen-keterangan-kasi]', $file); 

        $dokumen_kasubdit = explode('[dokumen-kasubdit]', $file); 
        $dokumen_keterangan_kasubdit = explode('[dokumen-keterangan-kasubdit]', $file); 

        $dokumen_direktur = explode('[dokumen-direktur]', $file); 
        $dokumen_keterangan_direktur = explode('[dokumen-keterangan-direktur]', $file); 

        $dokumen_dirjen = explode('[dokumen-dirjen]', $file); 
        $dokumen_keterangan_dirjen = explode('[dokumen-keterangan-dirjen]', $file); 

        function des($nilai){
            if (strlen($nilai) <= 5){
                $nilai = "-";
            }
            return $nilai;
        } 

        // $view .= '<table width="700px" class="tracking-perizinan">
        // <tr style="position:absolute; left:60%;"><td><input type="text" name="nomor-permohonan" id="nomor-permohonan" value="'.$u.'" size="20"> <input type="button" value="Proses" class="etracking-submit" onclick="document.location=\'http://'.$_SERVER['HTTP_HOST'].'/perizinan/etracking_sistem?nomor-permohonan=\'+document.getElementById(\'nomor-permohonan\').value;"></td></tr>
        // <tbody>
        // <tr class="etracking-line1"><td class="etracking-label">Nomor Permohonan</td><td colspan="2" class="etracking-label-isi">: '.des($nomor_permohonan[1]).'</td></tr>

        // <tr class="etracking-line2"><td class="etracking-label">Nama Perusahaan</td><td colspan="2" class="etracking-label-isi">: '.des($nama_perusahaan[1]).'</td></tr>

        // <tr class="etracking-line1"><td class="etracking-label">Jenis Permohonan</td><td colspan="2" class="etracking-label-isi">: '.des($jenis_permohonan[1]).'</td></tr>';

        $view .= '<div style="max-width: 100%; padding: 0 0 10px 0;"><div class="input-group">
            <input type="text" name="nomor-permohonan" id="nomor-permohonan" value="'.$u.'" size="20" class="form-control" placeholder="Masukan nomor permohonan">

            <span type="button" value="Proses" class="input-group-addon etracking-submit" onclick="document.location=\'http://'.$_SERVER['HTTP_HOST'].'/perizinan/etracking_sistem?nomor-permohonan=\'+document.getElementById(\'nomor-permohonan\').value;">Proses</span>
        </div>
        </div>

        <table class="table tracking-perizinan">
        <tbody>
        <colgroup>
        <col style="width:40%">
        </colgroup>
        <tr class="etracking-line1"><td class="etracking-label">Nomor Permohonan</td><td colspan="2" class="etracking-label-isi"> '.des($nomor_permohonan[1]).'</td></tr>

        <tr class="etracking-line2"><td class="etracking-label">Nama Perusahaan</td><td colspan="2" class="etracking-label-isi"> '.des($nama_perusahaan[1]).'</td></tr>

        <tr class="etracking-line1"><td class="etracking-label">Jenis Permohonan</td><td colspan="2" class="etracking-label-isi"> '.des($jenis_permohonan[1]).'</td></tr>';

        /*<tr class="etracking-line2"><td class="etracking-label">Perkiraan dapat diambil</td><td colspan="2" class="etracking-label-isi">: '.des($perkiraan_dapat_diambil[1]).'</td></tr>*/

        $view .= '
        <tr class="etracking-line1"><td class="etracking-label">Status Permohonan</td><td colspan="2" class="etracking-label-isi"> '.des($status_permohonan[1]).'</td></tr>
        <tr class="etracking-line2"><td class="etracking-label">Proses Permohonan</td><td colspan="2" class="etracking-label-isi"> </td></tr>
         
        </table>

        <table class="table tracking-proses-permohonan">
        <tr class="etracking-line1" >
        <th class="etracking-label1" align="center" width="5%">No</th>
        <th class="etracking-label" align="center" width="20%">Tanggal</th>
        <th class="etracking-label" align="center" width="10%">Status</th>
        <th class="etracking-label" align="center" width="25%">Aksi</th>
        <th class="etracking-label" align="center" width="40%">Keterangan</th>
        </tr>

        <tr class="etracking-line-isi">
        <td align="center">1</td>
        <td  align="center">'.$front_officer[1].'</td>
        <td  align="center" Proses>-</td>
        <td >Front Officer</td>
        <td >-</td>
        </tr>

        <tr style="display:none;">
        <td class="etracking-line-isi">SURAT</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">1</td>
        <td  align="center" id="surat-dirjen">'.$surat_dirjen[1].'</td>
        <td  align="center">-</td>
        <td >Dirjen</td>
        <td >'.$surat_keterangan_dirjen[1].'</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">2</td>
        <td  align="center" id="surat-direktur">'.$surat_direktur[1].'</td>
        <td  align="center">-</td>
        <td>Direktur</td>
        <td id="surat-keterangan-direktur">'.$surat_keterangan_direktur[1].'</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">3</td>
        <td  align="center" id="surat-kasubdit">'.$surat_kasubdit[1].'</td>
        <td  align="center">-</td>
        <td >Kasubdit</td>
        <td id="surat-keterangan-kasubdit">'.$surat_keterangan_kasubdit[1].'</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">4</td>
        <td  align="center" 13-09-2013 10:09:11 id="surat-kasi">'.$surat_kasi[1].'</td>
        <td  align="center">-</td>
        <td >Kasi</td>
        <td id="surat-keterangan-kasi">'.$surat_keterangan_kasi[1].'</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td class="etracking-line-isi">DOKUMEN</td>
        </tr>

        <tr class="etracking-line-isi">
        <td align="center">2</td>
        <td  align="center">'.$koordinator[1].'</td>
        <td  align="center">-</td>
        <td >Koordinator</td>
        <td >-</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">2</td>
        <td  align="center">'.$evaluator[1].'</td>
        <td  align="center">-</td>
        <td valign="top"> Evaluator</td>
        <td >'.$dokumen_evaluator_keterangan[1].'</td>
        </tr>

        <tr class="etracking-line-isi">
        <td align="left" colspan="5">
        <b>Keterangan Evaluator:</b>
        </td>
        </tr>

        <tr class="etracking-line-isi">
        <td align="left" colspan="5">
        './*$evaluator[1]*/$dokumen_evaluator_keterangan[1].'
        </td>
        </tr> 

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">3</td>
        <td  align="center" id="dokumen-kasi">'.$dokumen_kasi[1].'</td>
        <td  align="center">-</td>
        <td >Kasi</td>
        <td >'.$dokumen_keterangan_kasi[1].'</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">4</td>
        <td  align="center" id="dokumen-kasubdit">'.$dokumen_kasubdit[1].'</td>
        <td  align="center">-</td>
        <td >Kasubdit</td>
        <td >'.$dokumen_keterangan_kasubdit[1].'</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">5</td>
        <td  align="center" id="dokumen-direktur">'.$dokumen_direktur[1].'</td>
        <td  align="center">-</td>
        <td >Direktur</td>
        <td>'.$dokumen_keterangan_direktur[1].'</td>
        </tr>

        <tr class="etracking-line-isi" style="display:none;">
        <td align="center">6</td>
        <td  align="center" id="dokumen-dirjen">'.$dokumen_dirjen[1].'</td>
        <td  align="center">-</td>
        <td >Dirjen</td>
        <td >'.$dokumen_keterangan_dirjen[1].'</td>
        </tr>

        <tr class="etracking-line-isi" style="height:150px;">
        <td colspan="10" style=" vertical-align:bottom;">
        </td>
        </tr>
        </tbody>
        </table>
        </form>';
        //<sub>*Perkiraan dapat diambil dalam Waktu 14 Hari Kerja, Apabila Dokumen Sudah Lengkap dan Benar</sub>

        //<span id="isiData"></span>
        //<marquee loop="1" scrollamount="5"> 

        /*<sub>*Perkiraan dapat diambil dalam Waktu 14 Hari Kerja, Apabila Dokumen Sudah Lengkap dan Benar</sub>*/

        //    $view .= " </div><div><sub>*Perkiraan dapat diambil dalam Waktu 14 Hari Kerja, Apabila Dokumen Sudah Lengkap dan Benar</sub></div>";
        return $view;
    }
}