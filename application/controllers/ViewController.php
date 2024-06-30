<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewController extends CI_Controller 
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('modelMember'); // Pastikan model sudah ada
        $this->load->model('modelKelas'); // Pastikan model sudah ada
    }

    public function logout()
    {
        // Hapus semua session
        $session = $this->session;
        $session->sess_destroy();

        return redirect(base_url(""));
    }

    public function checkLogin() {
        // Ambil data dari form
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Query database
        $this->db->from('member')->where("CONCAT(username, email) LIKE '%".$email."%' ");
        $query = $this->db->get(); // Asumsi nama tabel adalah 'members'
        $data['member'] = $query->row_array(); // Mengambil data baris pertama
  
        if ($data['member'] && password_verify($password, $data['member']['password'])) {
            // Password cocok, set session
            $this->session->set_userdata(array(
                'logged_in' => true,
                'username' => $data['member']['username']
            ));

            // Redirect berdasarkan peran
            if ($data['member']['role'] == 1) {
                redirect('ViewController/dashboard');
            } else if ($data['member']['role'] == 2) {
                redirect('ViewController/dashboardMember');
            }

        } else {
            if ($data['member']['password'] == '' && $data['member']) {
                $this->session->set_userdata(array(
                    'username' => $data['member']['username']
                ));

                redirect('ViewController/createPassword');
            } else {
                // Password tidak cocok atau pengguna tidak ditemukan
                redirect(base_url(""));
            }
        }
    }

    public function createPassword()
    {
        // Ambil informasi pengguna dari session
        $username = $this->session->userdata('username');
    
        // Query database
        $this->db->like('CONCAT(username, email)', $username);
        $query = $this->db->get('member'); // Asumsi nama tabel adalah 'members'
        $data['member'] = $query->row_array(); // Mengambil data baris pertama

        return $this->load->view('project-uas/createPassword', $data);
    }

    public function register()
    {
        return $this->load->view('project-uas/register');
    }

    public function dashboard()
    {
        if (! $this->session->userdata('logged_in')) {
            // Jika belum login, redirect ke halaman login
            return redirect('ctl_login');
        }
    
        // Ambil informasi pengguna dari session
        $username = $this->session->userdata('username');
    
        // Tampilkan halaman dashboard dengan informasi pengguna
        $data['member'] = $this->modelMember->getMemberByString($username);
        $data['total'] = $this->modelMember->getMember();
        
        return $this->load->view('project-uas/dashboard',  $data);
    }

    public function dashboardMember()
    {
        if (! $this->session->userdata('logged_in')) {
            // Jika belum login, redirect ke halaman login
            return redirect('ctl_login');
        }
    
        // Ambil informasi pengguna dari session
        $username = $this->session->userdata('username');
        
        $data['member'] = $this->modelMember->getMemberByString($username);
        $data['kelas'] = $this->modelKelas->getAll();

        return $this->load->view('project-uas/dashboardMember', $data);
    }

    public function listMember()
    {
        // Tampilkan halaman dashboard dengan informasi pengguna
        $data['member'] = $this->modelMember->getAll();
        return $this->load->view('project-uas/sidebar/listMember', $data);
    }

    public function listKelas()
    {
        $data['kelas'] = $this->modelKelas->getAll();
        return $this->load->view('project-uas/sidebar/listKelas', $data);
    }
}
