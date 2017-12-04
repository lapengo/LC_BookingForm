<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users');
        
    }

    public function index()
    {     
        if ($this->Users->is_LoggedIn()) {
            redirect('users');
        }
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $username = $this->input->post('username',TRUE);
        $pwd = md5($this->input->post('password',TRUE));
        
        if ($this->form_validation->run() == FALSE) 
        {
            $data =
            [
                'form_action' => 'login',
            ];
            $this->load->view('auth/index',$data);
        } 
        else 
        {
            $user = $this->db->select('*')
                            ->from('users')
                            ->join('levels', 'levels.idLevels = users.levelID')
                            ->join('admins', 'admins.userID = users.idUsers')
                            ->where('username', $username)
                            ->where('password', $pwd)
                            ->get()->row();

            if($user->statususers == 1)
            {
                $this->session->set_flashdata('error', '<strong>Kesalahan,</strong> Akun anda diblokir');
                redirect('login');
            }

            if($user->username != $username AND $user->password != $pwd)
            {                
                $this->session->set_flashdata('error', '<strong>Kesalahan,</strong> Username atau Password Salah');
                redirect('login');
            }
            else
            {
                $newdata = array(
                        'username'  => $user->username,
                        'email'     => $user->email,
                        'nama'     => $user->fullname,
                        'logged_in' => TRUE
                );
                
                $this->session->set_userdata($newdata);
                //     echo "$pwd". "</br>";
                // echo $_SESSION['email'] . "</br>";
                // echo $_SESSION['nama'] . "</br>";
                // var_dump($user);
                // exit();
                // $this->load->view('arif');
                
			    $this->Users->where('username', $user->username)->update(array('logindate'=>date("Y/m/d h:i:sa")));
                redirect('users');
            }
            
        }                
    }

    public function logout()
    {
        $newdata = array(
                'username', 'email', 'nama'
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        redirect('login','refresh');
    }
    
}



/* End of file filename.php */
