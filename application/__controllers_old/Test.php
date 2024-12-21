<?php

class Test extends CI_Controller {	
	function __construct(){
		parent::__construct();
	}
	public function index() {
		$this->load->library('email');
		$_host = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 1);
		$_user = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 2);
		$_pass = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 3);
		$_port = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 4);
		$_type = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 5);
    $config['smtp_host']   = $_host->value_task;
    $config['smtp_user']   = $_user->value_task;
    $config['smtp_pass']   = $_pass->value_task;
    $config['smtp_port']   = $_port->value_task;
    $config['smtp_crypto'] = $_type->value_task;
    $this->email->initialize($config);

		$data['no_permohonan'] = 1234;
    $data['text_paragraph'] = "Informasi/Jasa yang dibutuhkan";
    $data['information'] = "TERSEDIA";
    $data['text_action'] = "PROSES SELANJUTNYA";
    $data['link_action'] = site_url();
    $message = $this->load->view('email/_header', '', true);
    $message .= $this->load->view('email/informasi_ketersediaan', $data, true);
    $message .= $this->load->view('email/_footer', '', true);
    $this->email->from('test@baitlagu.com', 'Test Mail');
    $this->email->reply_to('noreply@baitlagu.com', 'Test Mail');
		$this->email->to('jodisetiawan@fisip-untirta.ac.id');
		$this->email->cc('setdjod@gmail.com');
		$this->email->bcc('gunadiahmad949@gmail.com');
		$this->email->subject('Email Test');
		$this->email->message($message);
		$this->email->send(FALSE);

		echo $this->email->print_debugger();

		// $this->output->set_status_header(200);
		// $this->output->set_status_header(200);
		// $this->output->set_content_type('application/json','utf-8');
		// $this->output->set_output(json_encode($this->email->print_debugger(), JSON_PRETTY_PRINT));
	}
	public function test()
	{
		$data['no_permohonan'] = 1234;
    $data['text_paragraph'] = "Informasi/Jasa yang dibutuhkan";
    $data['information'] = "TERSEDIA";
    $data['text_action'] = "PROSES SELANJUTNYA";
    $data['link_action'] = site_url();

		$this->load->view('email/_header');
		$this->load->view('email/konfirmasi_pembayaran', $data);
		$this->load->view('email/_footer');
	}
	public function test_2()
	{
		$data = $this->db->get_where('tbl_survey', ['id_survey' => 8])->row();

		$survey = json_decode($data->survey);
		foreach ($survey as $key => $val) {
		$pertanyaan_survey = $this->db->select('pertanyaan_survey')->get_where('m_pertanyaan_survey', ['id_pertanyaan_survey' => $key])->row();
			echo $pertanyaan_survey->pertanyaan_survey . "  Jawaban: ".$val."<br>";
		}

		// $this->output->set_status_header(200);
		// $this->output->set_status_header(200);
		// $this->output->set_content_type('application/json','utf-8');
		// $this->output->set_output($data->survey);
	}
}