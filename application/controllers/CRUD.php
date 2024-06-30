<?php
use CI_Controller;

class CRUD extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('modelMember'); // Pastikan model sudah ada
        $this->load->model('modelKelas'); // Pastikan model sudah ada
    }

    public function create(){
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'role' => $_POST['role'],
            'membership' => 0,
            'is_valid' => false ,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->modelMember->createMember('member', $data);
        return redirect(base_url(""));
    }

    public function createMember(){
        $data_insert=array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            'membership' => 0,
            'is_valid' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $this->modelMember->createMember('member', $data_insert);
        return redirect('/ViewController/listMember');
    }

    public function createPW(){
        $data = [
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->modelMember->updateMembers('member', $_POST['id'], $data);
        return redirect(base_url(""));
    }

    public function createKelas(){
        $data = [
            'name' => $_POST['name'],
            'harga' => $_POST['harga'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->modelMember->createMember('kelas', $data);
        return redirect('/ViewController/listKelas');
    }

    public function updateMember(){
        $dataUpdate=array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            'membership' => $_POST['membership'],
            'is_valid' => $_POST['is_valid'],
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $this->modelMember->updateMembers('member', $_POST['id'], $dataUpdate);
        return redirect('/ViewController/listMember');
    }

    public function updateMembership(){
        $data = [
            'membership' => $_POST['kelas-id'],
            'updated_at' => date('Y-m-d H:i:s') ,
        ];

        $this->modelMember->updateMembers('member', $_POST['member-id'], $data);
        return redirect('/ViewController/dashboardMember');
    }

    public function updateKelas(){
        $dataUpdate=array(
            'name' => $_POST['name'],
            'harga' => $_POST['harga'],
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $this->modelMember->updateMembers('kelas', $_POST['id'], $dataUpdate);
        return redirect('/ViewController/listKelas');
    }


    public function deleteMember($id = 0){
		$this->modelMember->deleteMembers('member', $id);
        return redirect('/ViewController/listMember');
    }

    public function deleteKelas($id = 0){
        $this->modelMember->deleteMembers('kelas', $id);
        return redirect('/ViewController/listKelas');
    }

}

?>