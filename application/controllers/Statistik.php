<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller {

    var $folder ='';

    function __construct(){
        parent::__construct();
        $this->load->model('global_model');
    }

    public function index() {
		$ip      = $_SERVER['REMOTE_ADDR'];
		$tanggal = date("Y-m-d");
		$waktu   = time();
 
		// cek data ip
		$query = "SELECT * FROM tbl_statistik WHERE ip = '".$ip."' AND tanggal = '".$tanggal."'";
		$query = $this->db->query($query);
		$result = $query->result();
		$rows = $query->num_rows();		

		// kalo belom ada insert
		if($rows <= 0){
			$data = array(
			        'ip' 		=> $ip,
			        'tanggal' 	=> $tanggal,
			        'hit' 		=> 1,
			        'online' 	=> $waktu,
			);
			$this->db->insert('tbl_statistik', $data);
		}
		// kalo udah ada update
		else{
			$query = "UPDATE tbl_statistik SET hit = hit + 1, online ='".$waktu."' WHERE ip ='".$ip."' AND tanggal = '".$tanggal."'";
			$query = $this->db->query($query);
		}

		$pengunjung 		= '-';
		$totalpengunjung 	= '-';
		$pengunjungonline 	= '-';

		// jumlah pengunjung
		$query_jp 			= "SELECT * FROM tbl_statistik WHERE tanggal = '".$tanggal."' GROUP BY ip";
		$query_jp 			= $this->db->query($query_jp);
		$pengunjung 		= $query_jp->num_rows();		
		// $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM tstatistika WHERE tanggal='$tanggal' GROUP BY ip"));

		// total pengunjung
		$query_tp				= "SELECT COUNT(hit) AS jp FROM tbl_statistik";
		$query_tp 				= $this->db->query($query_tp);
		$totalpengunjung 		= $query_tp->result_array();
		$totalpengunjung 		= $totalpengunjung[0]['jp'];

		// pengunjung online
		$bataswaktu       		= time() - 300;
		$query_po				= "SELECT * FROM tbl_statistik WHERE online > ".$bataswaktu;
		$query_po 				= $this->db->query($query_po);
		$pengunjungonline 		= $query_po->num_rows();
		// $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM tstatistika WHERE online > '$bataswaktu'"));

		echo 'Jumlah pengunjung hari ini : '.$pengunjung;
		echo "<br>"; 
		echo 'Total pengunjung : '.$totalpengunjung;
		echo "<br>"; 
		echo 'Pengunjung Online : '.$pengunjungonline;
    }
}