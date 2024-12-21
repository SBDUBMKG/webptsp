<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $folder         = '';

	function __construct(){
		parent::__construct();
		$this->template->set_template('frontend');
		$this->load->model([
			'berita/minerba_model',
			'frontend/pengumuman_model',
			'galeri/galeri_foto_model',
			'global_model'
		]);
		
		$module = $this->folder.'/'.$this->router->fetch_class();
		$this->module = $module;
	}

	public function index() {
		$data['title']  = "Home";
		$data['bahasa'] = $this->session->userdata('bahasa');
		
		// statistik pengunjung
		$ip				= $this->input->ip_address();
		$ua				= $_SERVER['HTTP_USER_AGENT'];
		$tanggal	= date("Y-m-d");
		$online		= time();
 
		// cek data ip dan usa
		$query		= $this->db->get_where('tbl_statistik', [ 'ip' => $ip, 'ua' => $ua, 'tanggal' => $tanggal ]);
		$result		= $query->result();
		$rows			= $query->num_rows();

		// insert atau update statistik
		if($rows <= 0) { // kalo belom ada insert
			$data_update = [ 'ip' => $ip, 'ua' => $ua, 'tanggal' => $tanggal, 'hit' => 1, 'online' => $online ];
			$this->db->insert('tbl_statistik', $data_update);
		} else { // kalo udah ada update
			$this->db->set('hit', '`hit` + 1', FALSE);
			$this->db->set('online', $online);
			$this->db->where([ 'ip' => $ip, 'ua' => $ua, 'tanggal' => $tanggal ]);
			$this->db->update('tbl_statistik');
		}

		$pengunjung_hi	= '-';
		$pengunjung_all	= '-';
		$pengunjung_on	= '-';

		// pengunjung hari ini
		$query_hi				= "SELECT * FROM tbl_statistik WHERE tanggal = '".$tanggal."' GROUP BY ip";
		$query_hi				= $this->db->query($query_hi);
		$pengunjung_hi	= $query_hi->num_rows();

		// pengunjung bulan ini
		$query_bi				= "SELECT * FROM tbl_statistik WHERE MONTH(tanggal) = '".date("m")."' GROUP BY ip";
		$query_bi				= $this->db->query($query_bi);
		$pengunjung_bi	= $query_bi->num_rows();

		// pengunjung tahun ini
		$query_ti				= "SELECT * FROM tbl_statistik WHERE YEAR(tanggal) = '".date("Y")."' GROUP BY ip";
		$query_ti				= $this->db->query($query_ti);
		$pengunjung_ti	= $query_ti->num_rows();
		
		// total pengunjung
		$query_tp				= "SELECT COUNT(hit) AS jp FROM tbl_statistik";
		$query_tp				= $this->db->query($query_tp);
		$pengunjung_all	= $query_tp->result_array();
		$pengunjung_all	= $pengunjung_all[0]['jp'];

		// pengunjung online
		$bataswaktu			= time() - 300;
		$query_po				= "SELECT * FROM tbl_statistik WHERE online > ".$bataswaktu;
		$query_po				= $this->db->query($query_po);
		$pengunjung_on	= $query_po->num_rows();

		$data['pengunjung_hi']	= $pengunjung_hi;
		$data['pengunjung_bi']	= $pengunjung_bi;
		$data['pengunjung_ti']	= $pengunjung_ti;
		$data['pengunjung_on']	= $pengunjung_on;
		$data['pengunjung_all']	= $pengunjung_all;

		// $data['list_foto']		= $this->galeri_foto_model->list_slider_foto();
		// $data['top_berita']   	= $this->minerba_model->list_berita(5);
		// $data['list_agenda']  	= $this->agenda_model->list_agenda();
		// $data['list_video']  	= $this->global_model->get_list_array('tbl_video','','id_video','desc','5');
		// $data['list_link_terkait'] = $this->global_model->get_list_array('tbl_tautan','id_jenis_tautan = 1','urutan');

		$data['list_slider']  	= $this->global_model->get_list_array('tbl_slider','is_active=1','id_slider','DESC');
		$data['list_layanan_publik'] = $this->global_model->get_list_array('tbl_tautan','id_jenis_tautan = 2','urutan','DESC');

		$kontak_kami = $this->global_model->get_by_id_array('tbl_halaman_menu', 'id', 14);
		$data['kontak_kami'] = $kontak_kami;
		$pengaduan = $this->global_model->get_list_array('tbl_pengaduan','is_publish = 1','id_pengaduan','desc', 3);
		$data['pengaduan'] = $pengaduan;

		$this->template->add_css('resources/plugins/zabuto_calendar/zabuto_calendar.css');
		$this->template->add_css('resources/plugins/jcarousellite/jcarousellite.css');
		$this->template->add_js('resources/plugins/jcarousellite/jcarousellite.js');
		$this->template->add_js('resources/plugins/zabuto_calendar/zabuto_calendar.js');

		// $this->template->add_js($script,'embed');
		$this->template->write('title', $data['title']);
		$this->template->write_view('content', 'v_home', $data, true);
		$this->template->render();
	}

	public function ganti_bahasa($bahasa = '') {
		$this->session->set_userdata('bahasa', $bahasa);
		if(!empty($_SERVER['HTTP_REFERER'])) redirect($_SERVER['HTTP_REFERER']);
		redirect(site_url());
		die();
	}

	public function show_data()	{
		$bahasa = $this->session->userdata('bahasa');
		$pengumuman = $this->pengumuman_model->list_pengumuman();

		foreach($pengumuman as $key => $val){
			$tanggal			= date('Y-m-d', strtotime($val['created_date']));
			$detil_pengumuman	= $this->pengumuman_model->detil_pengumuman_c($tanggal);
			foreach($detil_pengumuman as $key => $val){
				$isi_konten = '
					<div class="alert alert-success alert-dismissible" role="alert">
						<strong class="text-uppercase">'.$val['judul'.$bahasa].'</strong>
						<p>'. $val['isi'.$bahasa] .'</p>
					</div>
				';
				if($val['gambar'] != ''){
					$isi_konten .='<br><div style="text-align: center;"><img src="'.site_url('upload/pengumuman/').$val['gambar'].'" width="250"></div>';	
				}
			}
			$konten[] = [
				'date'		=> $tanggal,
				'badge'		=> false,
				'title'		=> 'pengumuman : ' . format_datetime($val['created_date']),
				'body'		=> $isi_konten,
				'footer'	=> '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
			];
		}
		// $konten[$i] = ['date'   => date('Y')."-".date('m')."-".date('d')];
		$this->output
		->set_status_header(200)
		->set_content_type('application/json','utf-8')
		->set_output(json_encode($konten, JSON_PRETTY_PRINT));
	}

	public function forget_pass(){
		// $this->template->add_js($script,'embed');
		//if post
		if(isset($_POST['recover-submit'])){
		$username = $this->input->post('username');
		//cek email
		//jika email valid
		// rand

		// UPDATE tbl_admin SET has_forget = '$hash_pass' WHERE username = '$username';
		// get data user
		$query = $this->db->get_where('tbl_admin', array('username' => $username));
		$result = $query->row();
		if(!empty($result)){
		// link update pass
		// send email;
		$rand = mt_rand();
		$hash_pass = sha1($rand);
		$to = $result->email;
        $subject = '[PTSP] '. translate('txt_subjek_email_reset');
        $data['hash'] = $username.'/'.$hash_pass;
        $data['name'] = $result->nama; 
        $message = '';
       // $message = $this->load->view('email/_header', '', true);
        $message .= $this->load->view('email/forget_password',$data, true);
        $message .= $this->load->view('email/_footer', '', true);

        if(send_email($to,$subject,$message)){
        //update kolom hash password
        	$data=array('hash_forget'=>$hash_pass);
			$this->db->where('username',$username);
			$this->db->update('tbl_admin',$data);
        	$_SESSION['msg'] = 'Silakan cek email Anda untuk link ubah password';
        }
    	} else {
    	$_SESSION['msg'] = 'Username tidak valid';
    }
    	}
		$data = array();
		$this->template->write('title','Lupa Password');
		$this->template->write_view('content', 'v_forget_password', $data, true);
		$this->template->render();
	}

	public function reset_pass($username,$kode){
		$query = $this->db->get_where('tbl_admin', array('username' => $username,'hash_forget'=>$kode));
		$result = $query->row();
		if(!empty($result)){
		} else {
			echo 'Kode tidak valid';
			exit();
		}
		if(isset($_POST['reset-pass'])){
			$new_pass = strrev(md5($this->input->post('new_password')));
			$data=array('hash_forget'=>'','password'=>$new_pass);
			$this->db->where('username',$username);
			$this->db->update('tbl_admin',$data);
			$_SESSION['msg'] = 'Password berhasil dirubah';	
		}
		$data = array();
		$this->template->write('title','Lupa Password');
		$this->template->write_view('content', 'v_password_reset', $data, true);
		$this->template->render();
		//get username data

		//validasi code

		//if valid simpan password baru


	}
}