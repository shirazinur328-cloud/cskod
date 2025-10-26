<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load models
        $this->load->model('Model_guru');
        $this->load->model('Model_murid');
        $this->load->model('Model_kelas');
        $this->load->model('Model_mapel');
        // You might want to add authentication check here
    }

    public function index()
    {
        $data['total_guru'] = $this->Model_guru->count_all_guru();
        $data['total_murid'] = $this->Model_murid->count_all_murid();
        $data['total_kelas'] = $this->Model_kelas->count_all_kelas();
        $data['total_mapel'] = $this->Model_mapel->count_all_mapel();

        // Placeholder for more complex data
        $data['progress_per_kelas'] = $this->get_progress_per_kelas();
        $data['absensi_guru_stats'] = $this->get_absensi_guru_stats();
        $data['top_productive_murid'] = $this->get_top_productive_murid();

        $this->load->view('admin/dashboard_view', $data);
    }

    // Placeholder functions for data retrieval
    private function get_progress_per_kelas()
    {
        // Implement logic to fetch average progress per class
        // For now, return dummy data
        return [
            ['class' => 'Kelas A', 'progress' => 85],
            ['class' => 'Kelas B', 'progress' => 70],
            ['class' => 'Kelas C', 'progress' => 90],
        ];
    }

    private function get_absensi_guru_stats()
    {
        // Implement logic to fetch teacher attendance statistics
        // For now, return dummy data
        return [
            'present' => 95,
            'absent' => 5,
            'late' => 10,
        ];
    }

    private function get_top_productive_murid()
    {
        // Implement logic to fetch top 3 productive students
        // For now, return dummy data
        return [
            ['name' => 'Budi Santoso', 'score' => 98],
            ['name' => 'Siti Aminah', 'score' => 95],
            ['name' => 'Joko Susilo', 'score' => 92],
        ];
    }
}