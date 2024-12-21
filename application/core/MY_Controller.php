<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	var $data = array();
    var $is_write = true;
    var $is_read  = true;
    var $id_role        = NULL;
    var $active_kategori_menu = NULL;

    function __construct(){
        parent::__construct();
        $this->authentificate();
    }
    private function authentificate() {
        $current_class = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();
        $username = $this->session->userdata('username');
        $id_role = $this->session->userdata('id_role');
        $is_super_admin = $this->session->userdata('is_super_admin');
        $this->id_role = $id_role;
        if ( empty($username) || empty($id_role) ) {
            $current_url = str_replace('index.php/', '', current_url());
            $this->session->set_userdata('last_page', $current_url);
            redirect(base_url() . 'backend/login');
        } else if ( $is_super_admin == 1 ) {
            $this->is_read = true;
            $this->is_write = true;
            $this->db->select('A.*, B.kategori_menu')
                ->from('tbl_menu A')
                ->join('tbl_kategori_menu B', 'A.id_kategori_menu = B.id_kategori_menu', 'left')
                ->where('A.cname', $current_class);
            $query = $this->db->get();
            if ( is_object($query) ) {
                $row = $query->row();
                if ( is_object($row) ) {
                    $this->active_kategori_menu = $row->kategori_menu;
                }
            }
        } else {
            $accept = false;
            if ( in_array($current_class, array('home', 'services')) ) {
                $accept = true;
                $this->is_read = true;
                $this->is_write = false;
            } else {
                $this->db->select('A.*, B.is_read, B.is_write, C.kategori_menu, D.is_super_admin')
                    ->from('tbl_menu A')
                    ->join('tbl_hak_akses B', 'A.id_menu = B.id_menu AND B.id_role = '.$id_role, 'left')
                    ->join('tbl_role D', 'B.id_role = D.id_role', 'left')
                    ->join('tbl_kategori_menu C', 'A.id_kategori_menu = C.id_kategori_menu', 'left')
                    ->where('A.cname', $current_class);
                $query = $this->db->get();
                if ( is_object($query) ) {
                    $row = $query->row();
                    if ( is_object($row) ) {
                        $this->active_kategori_menu = $row->kategori_menu;
                        $is_read = empty($row->is_read) ? 0 : $row->is_read;
                        $is_write = empty($row->is_write) ? 0 : $row->is_write;
                        if ( preg_match('/add|edit|delete|eod|eom|setup_initial_data/',$current_method) && !$is_write ) {
                            redirect(base_url().$current_class);
                            $accept = true;
                        } else if ( !$is_read ) {
                            redirect(base_url().'backend/home');
                        } else {
                            $this->is_read = ($is_read == 1) ? true : false;
                            $this->is_write = ($is_write == 1) ? true : false;
                            $accept = true;
                        }
                    }
                }
                if ( $accept == false ) {
                    redirect(base_url().'backend/home');
                }
            }
        }
    }
}