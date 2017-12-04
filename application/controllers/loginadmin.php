<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loginadmin extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout_admin/login');
    }


    public function proses_login()
	{
        $email = $this->input->post(htmlentities(htmlentities('email')));
        $password = md5($this->input->post(htmlspecialchars(htmlentities('password'))));

        $count = $this->db->count_all_results('admin')
                            ->where('email',$email)
                            ->get();
        echo $count;

    }
    

}
