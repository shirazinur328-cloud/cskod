<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Remove_nilai_from_tugas_murid extends CI_Migration {

    public function up() {
        $this->dbforge->drop_column('tugas_murid', 'nilai');
    }

    public function down() {
        $fields = array(
            'nilai' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column('tugas_murid', $fields);
    }
}
?>
