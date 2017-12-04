<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('string');
		$this->load->model('Users');
	}
	
	public function index()
	{
		$userdata = $this->Users->getAllJoin1();
		$level = $this->Users->getLevels();

		
		$data =
		[
			'tittle' => 'Data Admins',
			'title2' => 'Input Data Admin',
			'content' => 'users/show',
			'dataku' => $userdata,
			'level' => $level,
			'form_action' => 'users/create',
		];



		$this->load->view('layout_admin/home',$data);
	}

	public function create()
	{
		$input = (object) $this->input->post(null, true); //mengambil semua inputan dari form
		$input->createdate   = date("Y/m/d h:i:sa"); //input type data timestime
		$input->username     = "salahuddin" .  date("ym") . rand(10,100); //input username otomatis dengan format yang sudah dibuat


		$passwordcrypt      = random_string('alnum',8);
		$input->password    = md5($passwordcrypt);
		// $input->password    = password_hash($passwordcrypt, PASSWORD_DEFAULT);
		$_SESSION['token']  = random_string('alnum',16);
		$input->tokenme = $_SESSION['token'];
		$input->statususers = "2";
		$this->Users->insert($input);

		$this->send_email_verfy(base64_encode($this->input->post('email')), base64_encode($input->tokenme), $this->input->post('email'), $input->username, $passwordcrypt);
		$this->session->set_flashdata('info', '<strong>Success</strong>, Berhasil mengirim email.');
		
		redirect('users','refresh');
	}

	public function send_email_verfy($email, $token, $mail, $user, $pass)
	{
		$this->email->from('ariflapengo.com', 'Arif Lapengo');
		$this->email->to($mail);
		$this->email->subject('Register Localhost');
		$this->email->message("
			Akun anda adalah sebagai berikut </br>
			<p>Username : $user</p>
			<p>Password : $pass</p>
			<p>Email anda : $mail</p>
			Klik Untuk Konfirmasi Email
			<a href='" . base_url() . "registeradm/verify/$email/$token'>konfirmasi Email</a>
		");
		$this->email->set_mailtype('html');
		$this->email->send();
	}

	public function verify($email, $token)
	{
		$emailme = base64_decode($email);
		$tokenme = base64_decode($token);

		$user = $this->Users->where('email', $emailme)->get();
		
		if (!$user) {
			// die('Mail is not exists');
			$this->session->set_flashdata('error', '<strong>Email</strong> is not exists.');
		}
		else if ($user->tokenme == "invalite") {
			// die('Toket is not match');
			$this->session->set_flashdata('error', 'Your Token is expire');
		}
		else if ($user->tokenme !== $tokenme) {
			// die('Toket is not match');
			$this->session->set_flashdata('error', '<strong>Token</strong> is not match.');
		}
		else{
			$a= $this->Users->where('idUsers', $user->idUsers)->update(array('statususers'=>'0', 'tokenme'=>'invalite'));
			$this->session->set_flashdata('success', '<strong>Success,</strong> Akun anda telah diaktivasi. Silahkan Login');
		}
		redirect('login','refresh');

	}

	public function updatestatus($id,$status)
	{
		$dataid		= base64_decode($id);
		$datastatus = base64_decode($status);

		$user = $this->Users->where('idUsers', $dataid)->get();

		if ($datastatus == '1') {
			$this->Users->where('idUsers', $user->idUsers)->update(array('statususers'=>'0'));
			$this->session->set_flashdata('success', '<strong>Success</strong>, User status Aktif.');
			redirect('users','refresh');
		}else{
			$this->Users->where('idUsers', $user->idUsers)->update(array('statususers'=>'1'));
			$this->session->set_flashdata('error', '<strong>Success</strong>, User telah Terblokir.');
			redirect('users','refresh');
		}

	}
	



}
