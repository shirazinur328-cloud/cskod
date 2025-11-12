<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_pertemuan extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_pertemuan' => array(
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
            'judul_pertemuan' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'deskripsi' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'waktu_mulai' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
            ),
            'link_meeting' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id_pertemuan', TRUE);
        $this->dbforge->add_field("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->create_table('pertemuan');
    }

    public function down() {
        $this->dbforge->drop_table('pertemuan');
    }
}
?>