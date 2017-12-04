<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KamarModel extends CI_Model {

	private $table = "kamar";

	public function __construct()
	{
		parent::__construct();
		
	}

	function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get()
    {
        return $this->db->get($this->table)->row();
    }

    public function where($column, $condition)
    {
        $this->db->where($column, $condition);
        return $this;
    }

    public function delete()
    {
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function update($data)
    {
        return $this->db->update($this->table, $data);
    }

}

/* End of file KamarModel.php */
/* Location: ./application/models/KamarModel.php */