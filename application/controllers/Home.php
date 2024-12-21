<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $folder         = '';

	function __construct(){
		parent::__construct();
		$this->template->set_template('frontend_ptsp');
		$this->load->model([
			'berita/minerba_model',
			'frontend/pengumuman_model',
			'galeri/galeri_foto_model',
			'global_model'
		]);
		$this->load->model('frontend/survey_model', 'survey');
		$this->load->helper(['form', 'url', 'captcha']);
		$this->load->helper('skm_helper');

		$module = $this->folder.'/'.$this->router->fetch_class();
		$this->module = $module;
	}

	public function index() {
		$this->load->helper(['date', 'status', 'tgl_indo']);
        $this->load->library('highcharts');

        // $vals = [
        //   'word'          => random_word(5, false, true,true),
        //   'img_path'      => './captcha/',
        //   'img_url'       => base_url().'captcha/',
        //   'font_path'     => './system/fonts/texb.ttf',
        //   'img_width'     => '150',
        //   'img_height'    => 33,
        //   'expiration'    => 7200,
        //   'word_length'   => 5,
        //   'font_size'     => 16,
        //   'colors'        => [
        //     'background' => array(200, 200, 200),
        //     'border' => array(0, 0, 0),
        //     'text' => array(0, 0, 0),
        //     'grid' => array(255, 255, 20)
        //     ]
        // ];

        // $cap = create_captcha($vals);
        // $err = $this->session->flashdata('login_message');
        // $this->session->set_userdata('mycaptcha', $cap['word']);

        $data = [
          // 'captcha_image' => $cap['image'],
          // 'err'           => $err,
          'title'         => "Home",
          'bahasa'        => $this->session->userdata('bahasa'),
        ];

        $lang_code = 'id';
		if($lang_code == '_en'){
          	$lang_code = 'en';
		}

		$data['lang_code'] = $lang_code;

		// unsur skm tahun berjalan
		$skm_factors = $this->survey->data_factor_by_year(date('Y') - 1);
		$skm_factor_json = json_encode([
		    [
				'name' => 'Unsur SKM',
				'data' => $skm_factors,
				'dataLabels' => [
				    'enabled' => true,
					'color' => '#FFFFFF',
					'align' => 'right',
					'inside' => true,
					'format' => '{point.y}',
					'style' => [
					    'textOutline' => 'none'
					]
				]
			]
		]);
	    $skm_script= "
                   document.addEventListener('DOMContentLoaded', function() {
                       const unsur_skm = Highcharts.chart('unsur_skm',{
                         exporting: { enabled: false },
                         chart: { type: 'bar' },
                         colors: ['#00CADC'],
                         series:" . $skm_factor_json . ",
                         title: {
                          style : {
                            fontSize : '16px'
                          },
                          text: 'UNSUR SKM ". ((int)date('Y') - 1) ."'
                         },
                         xAxis: {
                           categories: ['Persyaratan', 'Prosedur', 'Waktu Pelayanan', 'Kompetensi', 'Sarana dan Prasarana', 'Biaya', 'Produk', 'Perilaku', 'Penanganan'],
                           gridLineWidth: 0,
                           lineWidth: 0,
                           labels: {
                            style: {
                              whiteSpace: 'nowrap'
                            }
                           },
                         },
                         yAxis: {
                           min: 0,
                           title: { text: null },
                           labels: { overflow: 'justify' },
                           gridLineWidth: 0,
                         },
                         plotOptions: {
                           bar: {
                             borderRadius: '0%',
                             dataLabels: { enabled: true },
                             groupPadding: 0.05
                           }
                         },
                         legend: { enabled: false },
                         credits: { enabled: false },
                         tooltip: {
                           formatter: function() {
                                const performances = {
                                    'Tidak Baik': [1.0, 2.5996],
                                    'Kurang Baik': [2.6, 3.064],
                                    'Baik': [3.0644, 3.532],
                                    'Baik Sekali': [3.5324, 4.0]
                                };

                                for(let key in performances) {
                                    if(this.y >= performances[key][0] && this.y <= performances[key][1]) {
                                        return '<span>' + this.series.name + '</span>: <b>' + this.y + '</b><br/><span>Kinerja</span>: ' + key;
                                    }
                                }

                                return '<span>' + this.series.name + '</span>: <b>' + this.x + '</b><br/>';
                           }
                         },
                       })
                   });
        ";

        // nilai skm dan jumlah responden
        $skm_value = get_skm_value($skm_factors);
        $skm_predicate = get_skm_predicate($skm_value);
        $skm_respondent = $this->survey->count_survey_respondent(date('Y') - 1);

        $data['skm_value'] = $skm_value;
        $data['skm_predicate'] = $skm_predicate;
        $data['skm_respondent'] = $skm_respondent;

		// hasil skm ptsp per tahun
		$skm_per_year = $this->survey->skm_data_per_year(date('Y') - 1);
		$skm_per_year_labels = array_keys($skm_per_year);
		$skm_per_year_values = array_map(function($num) { return (float) number_format($num, 2); }, array_values($skm_per_year));

		$skm_per_year_json = json_encode([
            [
                'name' => 'Nilai SKM',
                'data' => array_reverse($skm_per_year_values),
                'dataLabels' => [
				    'enabled' => true,
					'color' => '#FFFFFF',
					'align' => 'center',
					'inside' => true,
					'format' => '{point.y:.2f}',
					'verticalAlign' => 'top',
					'style' => [
					    'textOutline' => 'none'
					]
				]
            ]
        ]);
		$skm_per_year_script= "
                   document.addEventListener('DOMContentLoaded', function() {
                       const unsur_skm = Highcharts.chart('skm_per_tahun',{
                         exporting: { enabled: false },
                         chart: { type: 'column' },
                         colors: ['#00CADC'],
                         series: $skm_per_year_json,
                         title: {
                          style: {
                            fontSize: '16px',
                          },
                          text: 'HASIL SKM PTSP BMKG PER TAHUN'
                         },
                         xAxis: {
                           categories: " . json_encode(array_reverse($skm_per_year_labels)) .",
                           gridLineWidth: 0,
                           lineWidth: 0
                         },
                         yAxis: {
                           min: 0,
                           title: { text: null },
                           labels: { overflow: 'justify' },
                           gridLineWidth: 1
                         },
                         plotOptions: {
                           column: {
                                pointWidth: Math.max(1, Math.floor(300 / 6)),
                                dataLabels: { enabled: false},
                                groupPadding: 0.1,
                                borderWidth: 0
                           }
                         },
                         legend: { enabled: false },
                         credits: { enabled: false },
                         tooltip: {
                          formatter: function() {
                               const performances = {
                                   'Tidak Baik': [25.00, 64.99],
                                   'Kurang Baik': [65.00, 76.60],
                                   'Baik': [76.61, 88.30],
                                   'Baik Sekali': [88.31, 100.00]
                               };

                               for(let key in performances) {
                                   if(this.y >= performances[key][0] && this.y <= performances[key][1]) {
                                       return '<span>' + this.series.name + '</span>: <b>' + this.y + '</b><br/><span>Hasil</span>: ' + key;
                                   }
                               }

                               return '<span>' + this.series.name + '</span>: <b>' + this.x + '</b><br/>';
                          }
                        },
                       })
                   });
        ";

		// statistik pengunjung
		$ip				= $this->input->ip_address();
		$ua				= $_SERVER['HTTP_USER_AGENT'];
		$tanggal	= date("Y-m-d");
		$online		= time();

		// cek data ip dan usa
		$query		= $this->db->get_where('tbl_statistik', [ 'ip' => $ip, 'ua' => $ua, 'tanggal' => $tanggal ]);
		$result		= $query->result();
		$rows		= $query->num_rows();

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
		$query_hi             = "SELECT * FROM tbl_statistik WHERE tanggal = '".$tanggal."' GROUP BY ip";
		$query_hi             = $this->db->query($query_hi);
		$pengunjung_hi        = $query_hi->num_rows();

		// pengunjung bulan ini
		$query_bi				= "SELECT * FROM tbl_statistik WHERE MONTH(tanggal) = '".date("m")."' and YEAR(tanggal) = '".date("Y")."' GROUP BY ip";
		$query_bi				= $this->db->query($query_bi);
		$pengunjung_bi	        = $query_bi->num_rows();

		// pengunjung tahun ini
		$query_ti				= "SELECT * FROM tbl_statistik WHERE YEAR(tanggal) = '".date("Y")."' GROUP BY ip";
		$query_ti				= $this->db->query($query_ti);
		$pengunjung_ti          = $query_ti->num_rows();

		// total pengunjung
		$query_tp				= "SELECT COUNT(hit) AS jp FROM tbl_statistik";
		$query_tp				= $this->db->query($query_tp);
		$pengunjung_all	        = $query_tp->result_array();
		$pengunjung_all	        = $pengunjung_all[0]['jp'];

		// pengunjung online
		$bataswaktu			   = time() - 300;
		$query_po			   = "SELECT * FROM tbl_statistik WHERE online > ".$bataswaktu;
		$query_po			   = $this->db->query($query_po);
		$pengunjung_on	       = $query_po->num_rows();

		$data['pengunjung_hi']	= $pengunjung_hi;
		$data['pengunjung_bi']	= $pengunjung_bi;
		$data['pengunjung_ti']	= $pengunjung_ti;
		$data['pengunjung_on']	= $pengunjung_on;
		$data['pengunjung_all']	= $pengunjung_all;

        $this->db->select('EXTRACT(MONTH FROM tanggal_permohonan) AS bulan, COUNT(*) AS jumlah');
		$this->db->from('v_lap_pelayanan');
		$this->db->where('EXTRACT(YEAR FROM tanggal_permohonan)=', date("Y"));
		$this->db->group_by('EXTRACT(MONTH FROM tanggal_permohonan)');
		$this->db->order_by('EXTRACT(MONTH FROM tanggal_permohonan)');

        $permohonan_get = $this->db->get();
        $permohonan_res = $permohonan_get->result();
        $permohonan_series = [];
        $permohonan_judul_grafik = translate(104). " " . date('Y');

        $total_permohonan_perbulan = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($permohonan_res as $row) {
            $bulan = $row->bulan;
            $bulan_index = $bulan-1;

            $total_permohonan_perbulan[$bulan_index]+=$row->jumlah;
        }

        $permohonan_series[0]['name'] = translate(107);
        $permohonan_series[0]['data'] = $total_permohonan_perbulan;
        $permohonan_series_encode     = json_encode($permohonan_series);

        $jumlah_permohonan_layanan_script = "
                   document.addEventListener('DOMContentLoaded', function() {
                       const jmlh_permohonan_layanan= Highcharts.chart('jumlah_permohonan_layanan',{
                         exporting: { enabled: false },
                         chart: { type: 'bar' },
                         colors: ['#0097B1'],
                         series:". $permohonan_series_encode .",
                         title: { text: '". $permohonan_judul_grafik ."' },
                         xAxis: {
                           categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                           gridLineWidth: 0,
                           lineWidth: 0
                         },
                         yAxis: {
                           min: 0,
                           title: { text: null },
                           labels: { overflow: 'justify' },
                           gridLineWidth: 0
                         },
                         plotOptions: {
                           bar: {
                             borderRadius: '50%',
                             dataLabels: { enabled: true },
                             groupPadding: 0.2
                           }
                         },
                         legend: { enabled: false },
                         credits: { enabled: false },
                       })
                   });
        ";

        // kalender pengumuman
        $pengumuman  = $this->db
            ->where('is_publish = 1 AND EXTRACT(MONTH from expired_date) = '. date('m') . ' AND EXTRACT(YEAR from expired_date) = ' . date('Y'))
            ->get('tbl_pengumuman')
            ->result();

        $pengumuman_content = '';
        foreach($pengumuman as $p) {
           $content = '
                <a role="button" data-bs-id="' . $p->id_pengumuman . '"
                   class="d-flex align-items-center w-100 btn-show-pengumuman">
                   <span class="d-inline-block text-truncate relative" style="max-width: 90%"> ' .
                       format_datetime($p->expired_date) . ' - '.
                       $p->judul
                   . '</span>
                   <img src="' . base_url() .'resources/themes/frontend_ptsp/images/calender-more.png' . '" class="img-fluid" alt="">
                </a>
           ' ;

           $pengumuman_content .= $content;
        }

        $data['pengumuman_content'] = $pengumuman_content;


        // statistic pengunjung tahunan
        $this->db->select('EXTRACT(YEAR FROM tanggal) as tahun, COUNT(*) AS jumlah');
        $this->db->from('tbl_statistik');
        $this->db->where('EXTRACT(YEAR FROM tanggal) >= ' . ((int) date('Y') - 4));
        $this->db->group_by('EXTRACT(YEAR FROM tanggal)');
        $this->db->order_by('EXTRACT(YEAR FROM tanggal)');

        $statistic_get = $this->db->get();
        $statistic_res = $statistic_get->result();
        $statistic_series = [];

        $statistic_total_pertahun = [];
        $statistic_label_pertahun = [];
        foreach($statistic_res as $row) {
            $tahun = $row->tahun;
            array_push($statistic_label_pertahun, $tahun);
            array_push($statistic_total_pertahun, (int) $row->jumlah);
        }

        $statistic_series[0]['name'] = translate();
        $statistic_series[0]['data'] = $statistic_total_pertahun;
        $statistic_series_encode     = json_encode($statistic_series);
        $statistic_labels_encode     = json_encode($statistic_label_pertahun);

        $statistik_pengunjung_tahunan_script = "
                  document.addEventListener('DOMContentLoaded', function() {
                      const jmlh_permohonan_layanan= Highcharts.chart('statistik_pengunjung_tahunan',{
                        exporting: { enabled: false },
                        chart: { type: 'column' },
                        colors: ['#EDB461'],
                        series:". $statistic_series_encode .",
                        title: { text: null },
                        xAxis: {
                          categories: ". $statistic_labels_encode .",
                          gridLineWidth: 0,
                          lineWidth: 0
                        },
                        yAxis: {
                            labels: { enabled: false },
                            lineWidth: 0,
                            title: { text: null }
                        },
                        plotOptions: {
                          column: {
                           pointWidth: 40,
                           dataLabels: { enabled: false},
                           groupPadding: 0.1
                          }
                        },
                        legend: { enabled: false },
                        credits: { enabled: false },
                      })
                  });
        ";


		$data['list_slider']          = $this->global_model->get_list_array('tbl_slider','is_active=1','is_active, (urutan * -1)','desc');
		$data['list_pengumuman']      = $this->global_model->get_list_array('tbl_pengumuman','	is_publish=1','id_pengumuman','ASC');
		$data['list_layanan_publik']  = $this->global_model->get_list_array('tbl_tautan','id_jenis_tautan = 2','urutan','DESC');

		$data['pengaduan']            = $this->global_model->get_list_array('tbl_pengaduan','is_publish = 1','id_pengaduan','desc', 3);
		$data['kontak_kami']          = $this->global_model->get_by_id_array('tbl_halaman_menu', 'id', 14);

		$this->template->add_css('resources/plugins/zabuto_calendar/zabuto_calendar_new.css');
		$this->template->add_css('resources/plugins/jcarousellite/jcarousellite.css');

		$this->template->add_js('resources/plugins/jcarousellite/jcarousellite.js');
		$this->template->add_js('resources/plugins/zabuto_calendar/zabuto_calendar_new.js');
		$this->template->add_js('resources/plugins/highcharts/highcharts-latest.js');
        $this->template->add_js('resources/plugins/highcharts/highcharts-3d.js');
        $this->template->add_js('resources/plugins/highcharts/exporting.js');
        $this->template->add_js('resources/plugins/highcharts/export-csv.js');

        $this->template->add_js($skm_script, 'embed');
        $this->template->add_js($skm_per_year_script, 'embed');
        $this->template->add_js($jumlah_permohonan_layanan_script, 'embed');
        $this->template->add_js($statistik_pengunjung_tahunan_script, 'embed');

        $this->template->add_js('
            $(document).ready(function () {
              $("#kalender_pengumuman").zabuto_calendar({
                header_format: "[month]",
                classname: "clickable",
                navigation_prev: false,
                navigation_next: false,
                navigation_markup: {
                    prev: "",
                    next: ""
                },
                ajax: {
                  url: "' .site_url('home/show_pengumuman'). '",
                  modal: true,
                },
                language: "en"
              });

              // Untuk bagian bawah kalender
              $(".btn-show-pengumuman").click(function(e) {
                e.preventDefault();
                var id = $(this).attr("data-bs-id");
                $.ajax({
                    url: "' . site_url('home/detail_pengumuman/') . '" + id,
                    success: function(data) {
                        const date = document.getElementById("modal_pengumuman_tanggal");
                        date.innerHTML = data[0].title.split(":")[1];

                        const content = document.getElementById("modal_pengumuman_content");
                        content.innerHTML = data[0].body;

                        const modal = new bootstrap.Modal(document.getElementById("modal_pengumuman"), { keyboard: false });
                        modal.toggle();
                    }
                })
              });

              // Menyamakan tinggi kolom permohonan layanan dan statistik pengunjung dengan tinggi kolom kalender pengumuman
              var pengumumanHeight = $("#pengumumanCol").outerHeight();
              $("#permohonanCol").css("height", pengumumanHeight);
              $("#pengunjungCol").css("height", pengumumanHeight);
              $("#statistik_pengunjung_tahunan").css("height", (pengumumanHeight / 2.6))
            });

       ', 'embed');

       $this->template->add_js('
            var $el = $("#kalender_pengumuman");
            $el.on("zabuto:calendar:init", function () {});

            // Ketika klik pada tanggal langsung
            $el.on("zabuto:calendar:day", function (e) {
                if (e.hasEvent) {
                    const date = document.getElementById("modal_pengumuman_tanggal");
                    date.innerHTML = e.eventdata.events[0].title.split(":")[1];

                    const content = document.getElementById("modal_pengumuman_content");
                    content.innerHTML = e.eventdata.events[0].body;

                    const modal = new bootstrap.Modal(document.getElementById("modal_pengumuman"), { keyboard: false });
                    modal.toggle();
                }
            });
       ', 'embed');

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

	public function show_pengumuman()	{
		$bahasa = $this->session->userdata('bahasa');
		$pengumuman = $this->pengumuman_model->list_pengumuman();

		// var_dump($pengumuman);

		foreach($pengumuman as $key => $val){
			$tanggal			= date('Y-m-d', strtotime($val['expired_date']));
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
				'title'		=> 'pengumuman : ' . format_datetime($val['expired_date']),
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

	public function detail_pengumuman($id = "") {
	       $bahasa     = $this->session->userdata('bahasa');
	       $val        = $this->pengumuman_model->detil_pengumuman($id);

	       $tanggal			= date('Y-m-d', strtotime($val['expired_date']));
        $isi_konten = '
        <div class="alert alert-success alert-dismissible" role="alert">
          <strong class="text-uppercase">'.$val['judul'.$bahasa].'</strong>
          <p>'. $val['isi'.$bahasa] .'</p>
        </div>
        ';
        if($val['gambar'] != ''){
        $isi_konten .='<br><div style="text-align: center;"><img src="'.site_url('upload/pengumuman/').$val['gambar'].'" width="250"></div>';
        }
	      $konten[] = [
	       	'date'		=> $tanggal,
	       	'badge'		=> false,
	       	'title'		=> 'pengumuman : ' . format_datetime($val['expired_date']),
	       	'body'		=> $isi_konten,
	       	'footer'	=> '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
	       ];

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
        //Merubah subjek email. Perubahan oleh Nurhayati Rahayu (23092021)
        $subject = '[PTSP BMKG]-Reset Password'. translate('txt_subjek_email_reset');
        //Baris terakhir perubahan oleh Nurhayati Rahayu (23092021)
        $data['hash'] = $username.'/'.$hash_pass;
        $data['name'] = $result->nama;
        $message = '';
        $message = $this->load->view('email/_header', '', true);
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
    	//$_SESSION['msg'] = 'Username tidak valid';
	// perbaikan tulisan 'Username' menjadi email (Nurhayati Rahayu 22/06/2022)
		$_SESSION['msg'] = 'Username tidak valid'; // diubah Rahmat 09/02/2023 dari keterangan 'Email tidak valid' menjadi 'Username tidak valid'
		// baris terakhir perbaikan tulisan 'Username' menjadi email (Nurhayati Rahayu 22/06/2022)

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

	public function verifikasi($username,$kode){
	$query = $this->db->get_where('tbl_admin', array('username' => $username));
	$result = $query->row();

	$kata = 'verify';
	$hash_pass = sha1($kata);
		if ($kode == $hash_pass) {
			$data_update = array(
				'status' => 1,
			);
		$this->db->where('username',$username);
		$this->db->update('tbl_admin',$data_update);
		redirect(site_url('login'));
		}
		else {
			show_404();
      		die();
		}
	}
}
