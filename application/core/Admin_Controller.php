<?php
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // $username   = $this->session->userdata('username'); 
        // $level      = $this->session->userdata('levelID');
        // if (!isset($username)&&!isset($level)) {
        //     redirect(base_url('login'));
        //     exit(); 
        // }

        if(!isset($_SESSION['logged_in'])) {
            redirect(base_url('login'));
            return false;
        }

        return true;

        // $username = $this->session->userdata('username');
        // $level    = $this->session->userdata('level');
        // $is_login = $this->session->userdata('is_login');

        // if (!$is_login) {
        //     redirect('login');
        //     return;
        // }

        // if ($level !== 'admin') {
        //     redirect('login');
        //     return;
        // }
    }
}
