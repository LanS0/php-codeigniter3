<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Member extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'role' => array(
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0,
            ),
            'membership' => array(
                'type' => 'INT',
            ),
            'is_valid' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'default' => date('Y-m-d H:i:s'),
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'default' => date('Y-m-d H:i:s'),
            ),
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('member');
    }

    public function down()
    {
        $this->dbforge->drop_table('member');
    }
}