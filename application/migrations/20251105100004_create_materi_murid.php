<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_materi_murid extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_materi_murid' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_materi' => array(
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
                'type' => 'ENUM("Belum Selesai","Selesai")',
                'default' => 'Belum Selesai',
                'null' => FALSE,
            ),
        ));
        $this->dbforge->add_key('id_materi_murid', TRUE);
        $this->dbforge->add_field("completed_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->create_table('materi_murid');
    }

    public function down() {
        $this->dbforge->drop_table('materi_murid');
    }
}
?>