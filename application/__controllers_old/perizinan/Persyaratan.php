<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persyaratan extends CI_Controller {
    var $folder         = 'perizinan';
    var $column_datatable = array('id', 'judul','judul_en','keterangan','keterangan_en','lampiran','hit');
    var $page_title = 'Persyaratan Perizinan';
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
        /*$data['bahasa']   = $this->session->userdata('bahasa');
        $module =$this->module;
        $persyaratan = $this->tabel();
        $data['tabel'] = $this->tabel();

        $data['title'] = $this->page_title;

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_persyaratan', $data, true);
        $this->template->render();*/
        $data['bahasa']   = $this->session->userdata('bahasa');
        $module =$this->module;
        $script = '
            $(function () {
                var oTable = $("#datatable").DataTable();
            });
            ';
        $persyaratan = $this->tabel();
        $data['persyaratan'] = $persyaratan;
        $data['title'] = $this->page_title;
        $this->template->add_css('resources/plugins/datatables/dataTables.bootstrap.css');
        $this->template->add_css('resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css');
        $this->template->add_js('resources/plugins/datatables/jquery.dataTables.min.js');
        $this->template->add_js('resources/plugins/datatables/dataTables.bootstrap.min.js');
        $this->template->add_js('resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js');

        $this->template->add_js($script,'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_persyaratan', $data, true);
        $this->template->render();
	}

    public function tabel() {      
    $nilai=""; 
    $svrurl = $_SERVER['REQUEST_URI']; 
    $_GET = array();
    $filter = explode('.', $svrurl); 
    $url = $filter[0]; 
    $val = isset($filter[1]) ? explode('/', $filter[1]) : array(0 => NULL); 
    if (!empty($val[0])){
        $nilai=$val[0];
    }
    $sub = "";
    $view="";
    $folder = "directory.png"; if ($nilai){$folder = "folder_open.png";}

    $kode=$nilai;
    $U = $this->config->item('rpiit_uri').'publikasi/persyaratan.php?kode='.$kode;
    $file=file_get_contents($U); 

    $jumlah_record = explode("[jumlah-record]", $file); $jumlah_record = $jumlah_record[1];
    $jumlah_field = explode("[jumlah-field]", $file); $jumlah_field = $jumlah_field[1];
    $field = explode("[field]", $file); $field = $field[1];
    $nama_field = explode(",", $field);
    $persyaratan_perizinan = explode("[persyaratan-perizinan]", $file); 
    $persyaratan = $persyaratan_perizinan[1];
    $track = array();
    if (empty($kode)){
        for($i = 1; $i<=$jumlah_record; $i++){
            $y = "P".($i)."-";
            $kode = explode("[".$y."kode]", $persyaratan); $kode = $kode[1];
            $judul = explode("[".$y."judul]", $persyaratan); $judul = $judul[1];
            $kategori = explode("[".$y."kategori]", $persyaratan); $kategori = $kategori[1];
            $kod[] = array("kode" => $kode, "judul" => $judul, "kategori" => $kategori);
        }
        $track = $kod;
        $su = "";
        if (!empty($track)) {
            $dv = ""; $ta = "";
            if (!empty($val[1])){
                $ta = "TAHUN ".$val[1];
            }
            $l = "<div class='normal-Header'> <span class='normal-HeadingLeft'> Persyaratan Perizinan</span> </div> "; 
            
            foreach ($track as $key2 => $value2) {
                if($key2 > 9){
                    $sub .= "<tr class='rpiit-tr' id='rpiit-tr".$key2."' style='display:none;'><td width='5%' align='center' valign='top'>".($key2+1)."</td>";
                }else{
                    $sub .= "<tr class='rpiit-tr' id='rpiit-tr".$key2."'><td width='5%' align='center' valign='top'>".($key2+1)."</td>";
                }
                $sub .= "<td><a href='http://".$_SERVER['HTTP_HOST']."/library/rpiit/?data=".$value2['kode']."' class='".$value2['kode']."' id='rpiit-hit' title='download' style='font-size:12px;font-weight:bold;' onclick=\"window.open(this.href, 'auth', 'width=800,height=400'); return false;\">".$value2['kategori']."</a><br> Berisi ".ucfirst(strtolower($value2['judul']))."</td>";
                $sub .= "<td width='20%' align='center' title='download'><a href='http://".$_SERVER['HTTP_HOST']."/library/rpiit/?data=".$value2['kode']."' class='".$value2['kode']."' id='rpiit-hit' onclick=\"window.open(this.href, 'auth', 'width=800,height=400'); return false;\"><img src='/library/capsule/x_rpiit/image/download.png' width='25px'></a> </td>";
                $sub .= "<td width='10%' align='center'> 0 </td></tr>";
                $jml [] = $value2['kode'];
                $startHal[] = $key2;
            }
            $su .= "<span style='margin-left:10px;'> Jumlah : <font class='rpiit-jml' name='".$startHal[0]."-".($startHal[0]+count($startHal))."'>".count($jml)."</font> record, Urutkan berdasarkan: <a href='' onclick=''>Judul</a> | <a href='' onclick=''>Hit</a></span> "; 
            $su .= "<tr style='height:30px; background-color:#cccccc;' ><th>No</th><th align='left'>&nbsp;&nbsp; Judul </th><th> Download </th><th> Hit </th></tr>";                             
        }
        $view .= "<table style='width:100%'>";
        $view .= $l.$dv.$su.$sub;
        $view .= "</table>";

        $nilai = "";
        $hal = 1;

        $c = count($jml)/10; $c = ceil($c);
        if ($c>0){
            $view .= "               <div class='clear'></div>";
            $view .= "               <div class='paging margtop'>";
            $view .= "                 <ul class='left'>";
            $view .= "                     <li class='rpiit-li-hal' id='".$c."-1-10'><h5 class='bold' >Halaman</h5></li>";
            $display = "";
            for($a=1; $a<=$c; $a++){
                $d = $hal; $b[$a]=""; $b[$d]="backcolr";
                $e[$a]="rpiit-li"; $e[$d]="rpiit-li-select";
                $view .= '                       <li id="'.$e[$a].'" class="rpiit-li-'.$a.'" '.$display.'><a href="#'.$a.'" class="backcolrhover '.$b[$a].'" id="rpiit-hal" name="#'.$a.'">'.$a.'</a></li>';
            }
            $view .= "                   </ul>";
            $view .= "                   <ul class='right'>";
            $view .= "                     <li><a href='#-' style='display:none;' class='prevbtn backcolrhover' id='rpiit-sebelumnya' name='#-'>Sebelumnya</a></li>";
            $view .= "                       <li><a href='#+' style='display:none;' class='nextbtn backcolrhover' id='rpiit-berikutnya' name='#+'>Berikutnya</a></li>";
            $view .= "                   </ul>";
            $view .= "               </div>";
            $view .= "           </div>";
        }
    } else {
        for($i = 1; $i<=$jumlah_record; $i++){
            $y = "P".($i)."-";
            $kode = explode("[".$y."kode]", $persyaratan); $kode = $kode[1];
            $judul = explode("[".$y."judul]", $persyaratan); $judul = $judul[1];
            $dokumen_persyaratan = explode("[".$y."dokumen-persyaratan]", $persyaratan); $dokumen_persyaratan = $dokumen_persyaratan[1];
            $kod[] = array("kode" => $kode, "dokumen-persyaratan" => $dokumen_persyaratan, "judul" => $judul);
        }
        $track = $kod;
        if (!empty($track)) {
            $dv = ""; $ta = "";
            if (!empty($val[1])){ 
                $ta = "TAHUN ".$val[1]; 
            }
            $l = "<div class='normal-Header'>".$track[0]['judul']."</div> "; 
            foreach ($track as $key2 => $value2) {
                $sub .= "<tr><td width='1%' align='center' valign='top'>".$value2['kode']."</td>";
                $sub .= "<td align='left'>".$value2['dokumen-persyaratan']."</td></tr>";
            }
            $su .= "<tr style='height:30px; background-color:#cccccc;' ><th>No</th><th align='left'>&nbsp;&nbsp; Persyaratan </th></tr>";                   
        }
        $view .= "<table style='width:100%'>";
//      $view .= $l.$dv.$su.$sub;
        $view .= $l;
        $view .= "</table>";
    }

        // $track = $this->fetchContentData($nilai);
        $view .= " </div>";
        //echo $view; 
        return $track;
    }
}