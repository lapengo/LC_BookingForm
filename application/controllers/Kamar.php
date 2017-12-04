<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kamar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('KamarModel');
	}

	public function index()
	{

		$kamar = $this->KamarModel->getAll();
		$data =
		[	
			'judul' => 'Data Kamar',
			'judul2' => 'Input Data Admin',
			'content' => 'test/index',
			'datakamar' => $kamar,
			'form_action' => 'kamar/insert',
		];
		$this->load->view('layout_admin/home',$data);

	}

	public function insert()
	{
		$input = (object) $this->input->post(null, true);
		// $input = $this->input->post('status');
		$save = $this->KamarModel->insert($input);
		redirect('kamar','refresh');
	}

	public function delete($data = null)
	{
		$id= base64_decode($data);

		$kamar = $this->KamarModel->where('id_kamar', $id)->get();
        if (!$kamar) {
            $this->session->set_flashdata('info', 'Data Kamar tidak ada.');
        }

        if ($this->KamarModel->where('id_kamar', $id)->delete()) {
			$this->session->set_flashdata('success', '<strong>Success</strong>, Data Kamar berhasil dihapus.');
		} else {
            $this->session->set_flashdata('error', '<strong>Error</strong>, Data Kamar gagal dihapus.');
        }
		redirect('kamar','refresh');
	}

	public function edit($data = null)
	{
		$id= base64_decode($data);

        $kamar = $this->KamarModel->where('id_kamar', $id)->get();

		
		$data =
		[	
			'judul' => 'Edit Data Kamar',
			'content' => 'test/kamar_form',
			'id' => $id,
			'row' => $kamar,
			'form_action' => 'kamar/update/'.$id,
		];
		$this->load->view('layout_admin/home',$data);
	}

	public function update($id = null)
	{

		$kamar = $this->KamarModel->where('id_kamar', $id)->get();
		$input = (object) $this->input->post(null, true);
        if (!$kamar) {
            $this->session->set_flashdata('info', 'Data Kamar tidak ada.');
        }
        if ($this->KamarModel->where('id_kamar', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data Kamar berhasil diupdate.');
        } else {
            $this->session->set_flashdata('error', 'Data Kamar gagal diupdate.');
        }
		redirect('kamar','refresh');
	}

}

/* End of file Kamar.php */
/* Location: ./application/controllers/Kamar.php */