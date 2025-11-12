<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_notifikasi extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_notifikasi' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_murid' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'pesan' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'link' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'is_read' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ),
        ));
        $this->dbforge->add_key('id_notifikasi', TRUE);
        $this->dbforge->add_field("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->create_table('notifikasi');
    }

    public function down() {
        $this->dbforge->drop_table('notifikasi');
    }
}
?>