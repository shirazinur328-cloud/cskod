<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_text_type_to_tugas extends CI_Migration {

    public function up()
    {
        $fields = array(
            'tipe_tugas' => array(
                'name' => 'tipe_tugas',
                'type' => 'ENUM("file","coding","text")',
                'default' => 'file',
                'null' => FALSE,
            ),
        );
        $this->dbforge->modify_column('tugas', $fields);
    }

    public function down()
    {
        $fields = array(
            'tipe_tugas' => array(
                'name' => 'tipe_tugas',
                'type' => 'ENUM("file","coding")',
                'default' => 'file',
                'null' => FALSE,
            ),
        );
        $this->dbforge->modify_column('tugas', $fields);
    }
}
