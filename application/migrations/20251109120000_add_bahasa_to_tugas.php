<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_bahasa_to_tugas extends CI_Migration {

    public function up() {
        $fields = array(
            'bahasa' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
                'after' => 'tipe_tugas'
            )
        );
        $this->dbforge->add_column('tugas', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('tugas', 'bahasa');
    }
}
?>
