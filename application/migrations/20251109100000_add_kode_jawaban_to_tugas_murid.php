<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_kode_jawaban_to_tugas_murid extends CI_Migration {

    public function up() {
        $fields = array(
            'kode_jawaban' => array(
                'type' => 'TEXT',
                'null' => TRUE,
                'after' => 'file_jawaban'
            )
        );
        $this->dbforge->add_column('tugas_murid', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('tugas_murid', 'kode_jawaban');
    }
}
?>
