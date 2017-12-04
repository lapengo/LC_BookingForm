<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {  

    private $table = "users";
    private $table1 = "levels";
    private $table2 = "admins";
    private $id = 'idUsers';
    private $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function getAllJoin()
    {
        return $this->db
                    ->join('levels', 'levels.idLevels = users.levelID')
                    ->join('admins', 'admins.userID = users.idUsers')
                    ->get($this->table)->result();

    }

    function getAllJoin1()
    {
        return $this->db
                    ->join('levels', 'levels.idLevels = users.levelID')
                    ->join('admins', 'admins.userID = users.idUsers')
                    ->where('users.username !=' , $_SESSION['username'])
                    ->get($this->table)->result();

    }

    function getLevels()
    {
        return $this->db->get('levels')->result();
    }

    public function insert($data)
    {
        $me = $this->db->insert($this->table, $data);
        $id = $this->db->insert_id($me);
        $data =['userID' => $id];
        return $this->db->insert('admins', $data);
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

    public function update($data)
    {
        return $this->db->update($this->table, $data);
    }

    public function is_LoggedIn()
    {
        if(!isset($_SESSION['logged_in'])) {
            return false;
        }

        return true;
    }
    

}

/* End of file ModelName.php */
