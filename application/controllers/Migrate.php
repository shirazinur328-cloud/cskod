<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{

    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->latest() === FALSE)
        {
            show_error($this->migration->error_string());
        }
        else
        {
            echo "<p>Database migration successful!</p>";
            // echo "<p>Current version: " . $this->migration->get_version() . "</p>";
        }
    }

    public function describe_tables()
    {
        $this->load->database();

        $tables = ['submission', 'nilai', 'tugas_murid'];

        foreach ($tables as $table) {
            echo "<h3>Table: $table</h3>";
            try {
                $query = $this->db->query("DESCRIBE $table");
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $row) {
                        echo $row['Field'] . "\n";
                    }
                } else {
                    echo "Table '$table' exists but has no columns or could not be described.\n";
                }
            } catch (Exception $e) {
                echo "Error describing table '$table': " . $e->getMessage() . "\n";
            }
            echo "<br>\n";
        }
    }

}
