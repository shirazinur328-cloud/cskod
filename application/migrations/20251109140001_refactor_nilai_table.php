<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Refactor_nilai_table extends CI_Migration {

    public function up() {
        // Drop id_submission
        $this->dbforge->drop_column('nilai', 'id_submission');

        // Add id_tugas_murid
        $fields = array(
            'id_tugas_murid' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'after' => 'id_mapel' // Place it after id_mapel
            ),
            'id_guru' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE, // Allow null if grade is not yet assigned by a teacher
                'after' => 'id_tugas_murid'
            ),
            'komentar_guru' => array(
                'type' => 'TEXT',
                'null' => TRUE,
                'after' => 'nilai'
            ),
        );
        $this->dbforge->add_column('nilai', $fields);
    }

    public function down() {
        // Revert id_submission
        $fields = array(
            'id_submission' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
        );
        $this->dbforge->add_column('nilai', $fields);

        // Drop new columns
        $this->dbforge->drop_column('nilai', 'id_tugas_murid');
        $this->dbforge->drop_column('nilai', 'id_guru');
        $this->dbforge->drop_column('nilai', 'komentar_guru');
    }
}
?>
