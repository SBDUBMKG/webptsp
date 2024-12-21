<?php

defined("BASEPATH") or exit("No direct script access allowed");
class Language extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(['session']);
    }

    public function change()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            show_error('Unable to process request, invalid method', 403);
        }

        $lang = $this->input->get("lang");
        $this->session->set_userdata('language', $lang);

        redirect($_SERVER['HTTP_REFERER']);
    }
}
