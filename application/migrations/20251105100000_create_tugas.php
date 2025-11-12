<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_tugas extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_tugas' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_mapel' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'judul_tugas' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'deskripsi' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'deadline' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_field("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id_tugas', TRUE);
        $this->dbforge->create_table('tugas');
    }

    public function down() {
        $this->dbforge->drop_table('tugas');
    }
}
?>