<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('ReservasiModel');
	}

	public function index()
	{
		$kamar = $this->ReservasiModel->where('status', '1')->getKamar();
		$data =
		[	
			'judul' => 'Reservasi Kamar',
			'content' => 'test/reservasi_form',
			'datakamar' => $kamar,
			'form_action' => 'reservasi/insert',
		];
		$this->load->view('layout_admin/home',$data);
	}

	public function reservasidata()
	{
		$pesan = $this->ReservasiModel->getAllJoin();
		$data =
		[	
			'judul' => 'Reservasi Kamar',
			'content' => 'test/reservasi',
			'pesanan' => $pesan,
		];
		$this->load->view('layout_admin/home',$data);
	}

	public function insert()
	{
		$input = (object) $this->input->post(null, true);

		$idkamar = $this->input->post('kamar_id');
		$kamar = $this->ReservasiModel->where('id_kamar', $idkamar)->getKamarrow();
		// $kamar = $this->ReservasiModel->where('id_kamar', $idkamar)->getKamar();

		$harga = $kamar->harga_kamar ;

		// $harga = '10';

		$tgl1 = date($this->input->post('check_in'));
    	$tgl2 = date($this->input->post('check_out'));
    	$selisih = strtotime($tgl2) -  strtotime($tgl1);
    	$hari = $selisih/(60*60*24);

    	$input->harga=$harga*$hari;


		$save = $this->ReservasiModel->insert($input);
		$this->session->set_flashdata('success', '<strong>Success</strong>, Data Pemesanan berhasil disave.');
		redirect('pesankamar','refresh');
	}

	public function update($a, $b)
	{

		$id= base64_decode($a);
		$status= base64_decode($b);

		$pesan = $this->ReservasiModel->where('id_transaksi', $id)->get();

		if ($status == '1') {
			$this->ReservasiModel->where('id_transaksi', $pesan->id_transaksi)->update(array('status_transaksi'=>'0'));
			$this->session->set_flashdata('success', '<strong>Success</strong>, Data telah diupdate.');
		}else{
			$this->ReservasiModel->where('id_transaksi', $pesan->id_transaksi)->update(array('status_transaksi'=>'1'));
			$this->session->set_flashdata('success', '<strong>Success</strong>, Data telah diupdate.');
		}

			redirect('pesankamar','refresh');
	}

}

/* End of file Reservasi.php */
/* Location: ./application/controllers/Reservasi.php */