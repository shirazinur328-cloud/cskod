<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_tugas_murid extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_tugas_murid' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_tugas' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'id_murid' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'status' => array(
                'type' => 'ENUM("Belum Dikerjakan","Selesai","Dinilai")',
                'default' => 'Belum Dikerjakan',
                'null' => FALSE,
            ),
            'file_jawaban' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'nilai' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ),
            'submitted_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id_tugas_murid', TRUE);
        $this->dbforge->add_field("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->create_table('tugas_murid');
    }

    public function down() {
        $this->dbforge->drop_table('tugas_murid');
    }
}
?>