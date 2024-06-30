<?php

class modelKelas extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll(){
        $sql = "
            SELECT *
            FROM kelas
        ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
}