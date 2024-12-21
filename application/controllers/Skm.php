<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skm extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend_ptsp');
    }
    
    public function index()
	{
        $data['title']  = "SKM";
        $data['bahasa'] = $this->session->userdata('bahasa');


        //paging pengumuman
        $config = array();
        $config["base_url"] = base_url() . "skm/index";

        $data['entries'] = $this->db->query("SELECT * FROM m_skm ORDER BY tahun DESC")->result();

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_skm', $data, true);
        $this->template->render();
	}

    function download($fileEncrypt = false) {
        try {
            $file = decrypt(base64_decode(urldecode($fileEncrypt)));

            $filepath = FCPATH . '/' . $file;

            // $content = file_get_contents();
            
            if (!file_exists($filepath)) {
                throw new Exception("File $filepath does not exist");
            }
            if (!is_readable($filepath)) {
                throw new Exception("File $filepath is not readable");
            }

            http_response_code(200);
            header('Content-Length: '.filesize($filepath));
            header("Content-Type: application/pdf");
            header('Content-Disposition: attachment; filename="SurveiKepuasanMasyarakat.pdf"');
            readfile($filepath);
            
            exit;

        } catch (\Throwable $th) {
            throw $th;
            show_404();
        }
       
    }



    function embed($fileEncrypt = false) {
        try {
            $file = decrypt(base64_decode(urldecode($fileEncrypt)));

            $filepath = FCPATH . '/' . $file;

            // $content = file_get_contents();
            
            if (!file_exists($filepath)) {
                throw new Exception("File $filepath does not exist");
            }
            if (!is_readable($filepath)) {
                throw new Exception("File $filepath is not readable");
            }

            http_response_code(200);
            header('Content-Length: '.filesize($filepath));
            header("Content-Type: application/pdf");
            header('Content-Disposition: inline; filename="downloaded.pdf"');
            readfile($filepath);
            
            exit;

        } catch (\Throwable $th) {
            throw $th;
            show_404();
        }
    }
}