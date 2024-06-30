<?php

class modelMember extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getMember(){
        $sql = "
            SELECT *,
            COUNT(*) AS total
            FROM member
        ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getAll(){
        $sql = "
            SELECT *
            FROM member
        ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getMemberByString($string)
    {
        $this->db->where("CONCAT(username, email) LIKE '%".$string."%' ");
        $query = $this->db->get('member');
        return $query->row_array();
    }

    public function createMember($table, $data) {
        $this->db->insert($table,$data);
    }

    public function updateMembers($table, $id, $data)
    {
        $this->db->where(array('id' => $id));
        $this->db->update($table, $data);
    }

    public function deleteMembers($table, $id)
    {
        $this->db->delete($table, array('id' => $id));
    }
}