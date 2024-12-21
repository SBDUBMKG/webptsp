<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bantuan extends MY_Controller {

	
	public function index()
	{	
		$data = array();
		$data['page_title'] = "Panduan Penggunaan Aplikasi PTSP Online";
	    $this->template->write_view('content', 'bantuan', $data, true);
        $this->template->write('title', 'Manual Penggunaan Aplikasi PTSP BMKG');
        $this->template->render();
	}
}
