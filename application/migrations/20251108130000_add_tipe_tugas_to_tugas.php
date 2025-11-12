<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_tipe_tugas_to_tugas extends CI_Migration {

    public function up()
    {
        $fields = array(
            'tipe_tugas' => array(
                'type' => 'ENUM("file","coding")',
                'default' => 'file',
                'null' => FALSE,
                'after' => 'status'
            ),
            'template_kode' => array(
                'type' => 'TEXT',
                'null' => TRUE,
                'after' => 'tipe_tugas'
            )
        );
        $this->dbforge->add_column('tugas', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('tugas', 'tipe_tugas');
        $this->dbforge->drop_column('tugas', 'template_kode');
    }
}
