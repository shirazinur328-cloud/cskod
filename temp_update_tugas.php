<?php
// temp_update_tugas.php
// This script is for one-off database update.
// It should be removed after execution.

// Define BASEPATH to satisfy CodeIgniter's index.php
define('BASEPATH', true);

// Include CodeIgniter's main index.php to bootstrap the framework
require_once 'index.php';

$CI =& get_instance();
$CI->load->database();

$data = array(
    'expected_output' => '12'
);

$CI->db->where('id_tugas', 16);
$CI->db->update('tugas', $data);

if ($CI->db->affected_rows() > 0) {
    echo "Successfully updated expected_output for tugas ID 16.\n";
} else {
    echo "No rows updated for tugas ID 16. It might already be '12' or ID 16 does not exist.\n";
}

// Optionally, you can remove this file after execution
// unlink(__FILE__); 
?>
