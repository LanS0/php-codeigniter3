<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Kelas extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'harga' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
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
        $this->dbforge->create_table('kelas');
    }

    public function down()
    {
        $this->dbforge->drop_table('kelas');
    }
}