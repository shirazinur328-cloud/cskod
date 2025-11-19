<?php

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin')) {
        	redirect('auth');
        }
        // TODO: Add authentication check here
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        // 1. Get counts
        $this->load->model('Model_guru');
        $this->load->model('Model_murid');
        $this->load->model('Model_kelas');
        $this->load->model('Model_mapel');
        $this->load->model('Model_dashboard');

        $data['total_guru'] = $this->Model_guru->total_guru();
        $data['total_murid'] = $this->Model_murid->total_murid();
        $data['total_kelas'] = $this->Model_kelas->total_kelas();
        $data['total_mapel'] = $this->Model_mapel->total_mapel();

        // 2. Get real data for Graph
        $progress_kelas = $this->Model_dashboard->get_average_progress_per_class();
        $chart_labels = [];
        $chart_data = [];
        foreach ($progress_kelas as $row) {
            $chart_labels[] = $row['nama_kelas'];
            $chart_data[] = round($row['rata_rata_nilai'], 2);
        }
        $data['chart_labels'] = $chart_labels;
        $data['chart_data'] = $chart_data;

        // 3. Get real data for Teacher Attendance
        $absensi_raw = $this->Model_dashboard->get_statistik_absensi();
        $statistik_absensi = [
            'hadir' => 0,
            'sakit' => 0,
            'izin' => 0,
            'alpa' => 0,
        ];
        $total_absensi = 0;
        foreach ($absensi_raw as $row) {
            $statistik_absensi[strtolower($row['status'])] = (int)$row['jumlah'];
            $total_absensi += (int)$row['jumlah'];
        }

        $data['statistik_absensi_persen'] = [];
        if ($total_absensi > 0) {
            foreach ($statistik_absensi as $status => $jumlah) {
                $data['statistik_absensi_persen'][$status] = round(($jumlah / $total_absensi) * 100);
            }
        } else {
            foreach ($statistik_absensi as $status => $jumlah) {
                $data['statistik_absensi_persen'][$status] = 0;
            }
        }

        $data['statistik_absensi'] = $statistik_absensi;

        // 4. Get real data for Top 3 Students
        $murid_produktif = $this->Model_dashboard->get_top_productive_students(3);
        $data['murid_produktif'] = [];
        foreach ($murid_produktif as $row) {
            $data['murid_produktif'][] = [
                'nama' => $row['nama_murid'],
                'progress' => round($row['rata_rata_nilai'], 2)
            ];
        }

        // 5. Get recent teacher absences
        $data['recent_absensi_guru'] = $this->Model_dashboard->get_recent_absensi_guru(5);

        // 6. Get weekly submission data for chart
        $weekly_data = $this->Model_dashboard->get_weekly_submission_data();
        $data['weekly_submissions'] = [];
        for($i = 0; $i < 7; $i++) {
            $data['weekly_submissions'][$i] = 0;
        }
        foreach($weekly_data as $day_data) {
            $data['weekly_submissions'][(int)$day_data['hari']] = (int)$day_data['jumlah'];
        }

        // 7. Get top subjects by activity
        $data['top_subjects_by_activity'] = $this->Model_dashboard->get_top_subjects_by_activity(5);

        // Load view through template
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/admin/footer');
    }
}