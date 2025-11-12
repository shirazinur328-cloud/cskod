<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_nilai_and_komentar_to_tugas_murid extends CI_Migration {

    public function up()
    {
        $fields = array(
            'nilai' => array(
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => TRUE,
                'default' => NULL,
            ),
            'komentar_guru' => array(
                'type' => 'TEXT',
                'null' => TRUE,
                'default' => NULL,
            ),
        );
        $this->dbforge->add_column('tugas_murid', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('tugas_murid', 'nilai');
        $this->dbforge->drop_column('tugas_murid', 'komentar_guru');
    }
}
