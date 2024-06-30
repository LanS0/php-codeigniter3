<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function indexMember()
    {
        // Contoh data untuk seeding
        $data = array(
            array(
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => password_hash('adminpassword', PASSWORD_DEFAULT),
                'role'     => 1,
            ),
            array(
                'username' => 'user',
                'email'    => 'user@example.com',
                'password' => password_hash('userpassword', PASSWORD_DEFAULT),
                'role'     => 2,
                'is_valid' => true,
            ),
            array(
                'username' => 'user1',
                'email'    => 'user1@example.com',
                'password' => password_hash('userpassword', PASSWORD_DEFAULT),
                'role'     => 2,
                'is_valid' => false,
            ),
            array(
                'username' => 'user2',
                'email'    => 'user2@example.com',
                'password' => password_hash('userpassword', PASSWORD_DEFAULT),
                'role'     => 2,
                'is_valid' => true,
            )
        );

        // Menggunakan $this->db untuk batch insert
        foreach ($data as $user) {
            $this->db->insert('member', $user);
        }
    }

    public function indexKelas()
    {
        // Contoh data untuk seeding
        $data = array(
            array(
                'name' => 'KELAS BEGINNER',
                'harga'    => 15,
            ),
            array(
                'name' => 'KELAS NEXT LEVEL',
                'harga'    => 20,
            ),
        );

        // Menggunakan $this->db untuk batch insert
        foreach ($data as $user) {
            $this->db->insert('kelas', $user);
        }
    }
}
