<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Addchat_init Controller
 *
 * This class handles addChat's complete functionality
 *
 * @package     addchat
 * @author      classiebit
*/

class Addchat_init extends CI_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // Chat Init
        $this->load->library('addchat_lib');
    }

    public function get_users()
    {
        $this->addchat_lib->get_users();
    }

    public function search_users()
    {
        $this->addchat_lib->search_users();
    }

    public function upload_profile_pic()
    {
        $this->addchat_lib->upload_profile_pic();
    }

    public function get_updates()
    {
        $this->addchat_lib->get_updates();
    }

    public function change_status()
    {
        $this->addchat_lib->change_status();
    }

    public function block_user()
    {
        $this->addchat_lib->block_user();
    }

    public function delete_chat()
    {
        $this->addchat_lib->delete_chat();
    }

    public function send_message()
    {
        $this->addchat_lib->send_message();
    }

    public function get_messages()
    {
        $this->addchat_lib->get_messages();
    }

}

/* Addchat_init controller ends */