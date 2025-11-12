<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_materi extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_materi' => array(
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
            'judul_materi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'konten' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'file_materi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'urutan' => array(
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0,
            ),
        ));
        $this->dbforge->add_key('id_materi', TRUE);
        $this->dbforge->add_field("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->create_table('materi');
    }

    public function down() {
        $this->dbforge->drop_table('materi');
    }
}
?>