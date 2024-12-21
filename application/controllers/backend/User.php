<?php
defined("BASEPATH") or exit("No direct script access allowed");

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load any required models, libraries, etc. here
        $this->load->library("session");
    }

    public function index()
    {
    }

    public function role()
    {
        $role = $this->session->userdata("id_role");
        return $this->output
            ->set_content_type("application/json")
            ->set_status_header(200)
            ->set_output(json_encode(["role" => $role]));
    }
}
?>
