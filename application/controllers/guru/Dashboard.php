<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('guru')) {
        	redirect('auth');
        }
        $this->load->model('Model_guru');
        $this->load->model('Model_kelas');
        $this->load->model('Model_mapel');
        $this->load->model('Model_tugas');
        // $this->load->model('Model_jadwal'); // Assuming a schedule model exists or will be created
    }

    public function index()
    {
        $data['title'] = 'Dashboard Guru';
        $id_guru = $this->session->userdata('guru')->id_guru;

        // --- 1. Fetch data for Statistic Cards ---
        $data['jumlah_kelas'] = $this->Model_guru->total_kelas_by_guru($id_guru);
        $data['jumlah_mapel'] = $this->Model_guru->total_mapel_by_guru($id_guru);
        $data['tugas_belum_dinilai'] = $this->Model_tugas->count_tugas_belum_dinilai($id_guru);
        // For "Jadwal Hari Ini", we'll count the results from the schedule fetch
        
        // --- 2. Fetch data for "Jadwal Mengajar" ---
        // Assuming a method get_jadwal_hari_ini exists
        $data['jadwal_hari_ini'] = $this->Model_guru->get_jadwal_hari_ini($id_guru);
        $data['jumlah_jadwal_hari_ini'] = count($data['jadwal_hari_ini']);

        // --- 3. Fetch data for "Progres Siswa" ---
        // This would likely involve getting all classes, then for each class, calculating the average progress.
        $data['progres_siswa'] = $this->Model_guru->get_progres_kelas($id_guru);

        // --- 4. Fetch data for "Tugas Belum Dinilai" ---
        $data['list_tugas_belum_dinilai'] = $this->Model_tugas->get_tugas_belum_dinilai($id_guru, 5); // Get top 5

        // Data untuk Sidebar (Tingkatan Kelas dan Mapel/Kelas)
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $data['mapel_kelas_by_tingkatan'] = [];
        foreach ($data['tingkatan_kelas_list'] as $tingkatan) {
            $data['mapel_kelas_by_tingkatan'][$tingkatan->tingkatan_kelas] = $this->Model_guru->get_mapel_kelas_by_guru($id_guru, $tingkatan->tingkatan_kelas);
        }

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data); // Pass $data to navbar
        $this->load->view('guru/dashboard', $data);
        $this->load->view('templates/guru/footer');
    }
}