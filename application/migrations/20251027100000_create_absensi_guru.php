<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_absensi_guru extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_absensi' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_guru' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'status' => array(
                'type' => 'ENUM("Hadir","Sakit","Izin","Alpa")',
                'default' => 'Hadir',
            ),
            'tanggal' => array(
                'type' => 'DATE',
            ),
            'keterangan' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id_absensi', TRUE);
        $this->dbforge->create_table('absensi_guru');

        // Add timestamp column separately to avoid default value issues on some MySQL versions
        $this->db->query('ALTER TABLE absensi_guru ADD COLUMN timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');

        // Adding foreign key constraint
        // Note: Assumes the 'guru' table and 'id_guru' column exist.
        $this->db->query('ALTER TABLE absensi_guru ADD CONSTRAINT fk_absensi_guru FOREIGN KEY (id_guru) REFERENCES guru(id_guru) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('absensi_guru');
    }
}