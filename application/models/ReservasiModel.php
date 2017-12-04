<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReservasiModel extends CI_Model {

	private $table = "transaksi";

	public function __construct()
	{
		parent::__construct();
		
	}

	function getKamar()
    {
        return $this->db->get('kamar')->result();
    }

    function getAllJoin()
    {
        return $this->db
                    ->join('kamar', 'kamar.id_kamar = transaksi.kamar_id')
                    ->get($this->table)->result();

    }

    public function get()
    {
        return $this->db->get($this->table)->row();
    }

    public function getKamarrow()
    {
        return $this->db->get('kamar')->row();
    }

    public function where($column, $condition)
    {
        $this->db->where($column, $condition);
        return $this;
    }

	public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data)
    {
        return $this->db->update($this->table, $data);
    }

}

/* End of file ReservasiModel.php */
/* Location: ./application/models/ReservasiModel.php */