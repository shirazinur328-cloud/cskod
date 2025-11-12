<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_id_mapel_to_materi extends CI_Migration {

    public function up() {
        $fields = array(
            'id_mapel' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'after' => 'id_materi' // Place it after the primary key
            )
        );
        $this->dbforge->add_column('materi', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('materi', 'id_mapel');
    }
}
?>