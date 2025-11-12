<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_expected_output_to_tugas extends CI_Migration {

    public function up() {
        $fields = array(
            'expected_output' => array(
                'type' => 'TEXT',
                'null' => TRUE,
                'after' => 'deskripsi'
            )
        );
        $this->dbforge->add_column('tugas', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('tugas', 'expected_output');
    }
}
?>
