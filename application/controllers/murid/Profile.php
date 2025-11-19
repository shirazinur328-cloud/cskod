<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Pastikan murid sudah login
        if (!$this->session->userdata('murid')) {
            redirect('auth');
        }
        $this->load->model('Model_murid');
        $this->load->model('Model_tugas');
        $this->load->model('Model_dashboard');
        $this->load->model('Model_notifikasi');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Ambil data murid dari session
        $id_murid = $this->session->userdata('murid')->id_murid;
        
        // Data utama murid
        $data['murid'] = $this->Model_murid->single_murid($id_murid);
        
        // Data untuk sidebar
        $data['mapel_murid'] = $this->Model_murid->get_mapel_by_kelas($id_murid);

        // Data untuk notifikasi
        $data['notifikasi'] = $this->Model_notifikasi->get_unread_notifikasi($id_murid);

        // Data untuk statistik
        $data['stats']['mapel_aktif'] = count($data['mapel_murid']);
        $data['stats']['tugas_selesai'] = $this->Model_tugas->count_tugas_selesai($id_murid);
        $data['stats']['nilai_rata_rata'] = $this->Model_murid->get_average_grade($id_murid);
        $data['stats']['sertifikat'] = count($this->Model_murid->get_sertifikat($id_murid));

        // Data untuk aktivitas terakhir
        $data['last_activity'] = $this->Model_dashboard->get_recent_activities($id_murid, 5); // Ambil 5 aktivitas terakhir

        // Hitung progress keseluruhan
        $assignment_stats = $this->Model_murid->get_assignment_completion_stats($id_murid);
        if ($assignment_stats && $assignment_stats->total_assignments > 0) {
            $data['overall_progress'] = round(($assignment_stats->completed_assignments / $assignment_stats->total_assignments) * 100);
        } else {
            $data['overall_progress'] = 0;
        }

        // Set judul halaman
        $data['title'] = 'Profil Saya';

        // Memuat view
        $this->load->view('templates/siswa/head', $data);
        $this->load->view('templates/siswa/navbar', $data);
        $this->load->view('templates/siswa/topbar', $data);
        $this->load->view('murid/profile', $data);
        $this->load->view('templates/siswa/footer');
    }

    public function update_profile()
    {
        $id_murid = $this->session->userdata('murid')->id_murid;

        $this->form_validation->set_rules('nama_murid', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil. Periksa kembali data yang Anda masukkan.');
            redirect('murid/profile');
        } else {
            $data = [
                'nama_murid' => $this->input->post('nama_murid'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'username' => $this->input->post('username'),
            ];

            if ($this->Model_murid->update_profile($id_murid, $data)) {
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            }
            redirect('murid/profile');
        }
    }
}