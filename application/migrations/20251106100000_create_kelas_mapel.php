<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_kelas_mapel extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_kelas_mapel' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_kelas' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'id_mapel' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id_kelas_mapel', TRUE);
        $this->dbforge->create_table('kelas_mapel');
    }

    public function down() {
        $this->dbforge->drop_table('kelas_mapel');
    }
}
?>