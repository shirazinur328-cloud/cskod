<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load models, helpers, etc.
        $this->load->model('Model_guru');
        $this->load->model('Model_mapel'); // Mungkin diperlukan untuk statistik
        $this->load->model('Model_tugas'); // Mungkin diperlukan untuk statistik
    }

    public function index()
    {
        // Hardcoded guru ID for now, replace with session data in a real app
        $id_guru = 2; 

        $data['title'] = 'Profil Guru';
        $data['guru'] = $this->Model_guru->single_guru($id_guru);
        
        // Data untuk Tab Aktivitas Mengajar
        $data['total_kelas_diajar'] = $this->Model_guru->total_kelas_by_guru($id_guru);
        $data['total_tugas_dibuat'] = $this->Model_guru->total_tugas_by_guru($id_guru);
        $data['statistik_nilai_siswa'] = $this->Model_guru->get_performa_kelas($id_guru);

        // Data untuk Sidebar
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/profile/profile', $data);
        $this->load->view('templates/guru/footer');
    }

    // Method untuk edit profil, ganti password, dll. akan ditambahkan nanti
}
