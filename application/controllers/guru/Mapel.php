<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_mapel_kelas');
        $this->load->model('Model_guru');
    }

    public function index()
    {
        // sementara pakai id_guru = 1
        $id_guru = 2;
        // $id_guru = $this->session->userdata('id_guru');
        $data['title'] = 'Daftar Mata Pelajaran';
        $data['mapel_kelas_list'] = $this->Model_guru->get_mapel_kelas_by_guru($id_guru); // Pastikan ini dipanggil
        
        // Data untuk Sidebar (Tingkatan Kelas dan Mapel/Kelas)
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $data['mapel_kelas_by_tingkatan'] = [];
        foreach ($data['tingkatan_kelas_list'] as $tingkatan) {
            $data['mapel_kelas_by_tingkatan'][$tingkatan->tingkatan_kelas] = $this->Model_guru->get_mapel_kelas_by_guru($id_guru, $tingkatan->tingkatan_kelas);
        }

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/mapel/list', $data);
        $this->load->view('templates/guru/footer');
    }

    public function list_by_tingkatan($tingkatan)
    {
        $id_guru = 2; // Hardcoded for now
        $data['title'] = 'Daftar Mata Pelajaran Kelas ' . $tingkatan;
        $data['active_tingkatan'] = $tingkatan; // Set active tingkatan for sidebar
        $data['mapel_kelas_list'] = $this->Model_guru->get_mapel_kelas_by_guru($id_guru, $tingkatan);

        // Data untuk Sidebar (Tingkatan Kelas dan Mapel/Kelas)
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $data['mapel_kelas_by_tingkatan'] = [];
        foreach ($data['tingkatan_kelas_list'] as $tingkatan_obj) {
            $data['mapel_kelas_by_tingkatan'][$tingkatan_obj->tingkatan_kelas] = $this->Model_guru->get_mapel_kelas_by_guru($id_guru, $tingkatan_obj->tingkatan_kelas);
        }

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/mapel/list', $data);
        $this->load->view('templates/guru/footer');
    }
    
    public function classroom($id_mapel, $id_kelas)
    {
        $data['title'] = 'Ruang Pembelajaran';
        $data['id_mapel'] = $id_mapel;
        $data['id_kelas'] = $id_kelas;
        $data['mapel'] = $this->Model_mapel_kelas->get_mapel_by_id($id_mapel);

        if (!$data['mapel'] || $data['mapel']->status_aktif !== 'aktif') {
            show_404();
        }

        $data['kelas'] = $this->Model_mapel_kelas->get_kelas_by_id($id_kelas);
        $data['active_tingkatan'] = $data['kelas']->tingkatan_kelas; // Set active tingkatan for sidebar
        $data['pertemuan_list'] = $this->Model_mapel_kelas->get_pertemuan_by_mapel_kelas($id_mapel, $id_kelas);
        $data['siswa_list'] = $this->Model_mapel_kelas->get_siswa_by_mapel_kelas($id_mapel, $id_kelas);
        
        // Data untuk Sidebar (Tingkatan Kelas dan Mapel/Kelas)
        $id_guru = 2; // Hardcoded for now
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $data['mapel_kelas_by_tingkatan'] = [];
        foreach ($data['tingkatan_kelas_list'] as $tingkatan) {
            $data['mapel_kelas_by_tingkatan'][$tingkatan->tingkatan_kelas] = $this->Model_guru->get_mapel_kelas_by_guru($id_guru, $tingkatan->tingkatan_kelas);
        }

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/mapel/classroom', $data);
        $this->load->view('templates/guru/footer');
    }
    
    public function create_pertemuan($id_mapel, $id_kelas)
    {
        if ($this->input->post()) {
            $data = [
                'nama_pertemuan' => $this->input->post('nama_pertemuan'),
                'tanggal' => $this->input->post('tanggal'),
                'id_mapel' => $this->input->post('id_mapel'),
                'id_kelas' => $this->input->post('id_kelas')
            ];
            
            $id_pertemuan = $this->Model_mapel_kelas->create_pertemuan($data);
            
            // Set success message
            $this->session->set_flashdata('success', 'Pertemuan berhasil dibuat');
            
            redirect('guru/pertemuan/detail/' . $id_pertemuan);
        }
        
        $data['title'] = 'Buat Pertemuan Baru';
        $data['id_mapel'] = $id_mapel;
        $data['id_kelas'] = $id_kelas;

        // --- Data for Sidebar and Active State ---
        $id_guru = 2; // Hardcoded for now
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $kelas = $this->Model_mapel_kelas->get_kelas_by_id($id_kelas);
        $data['active_tingkatan'] = $kelas->tingkatan_kelas;
        
        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/mapel/create_pertemuan', $data);
        $this->load->view('templates/guru/footer');
    }

    public function list_siswa($id_mapel, $id_kelas)
    {
        $data['title'] = 'Daftar Siswa Kelas';
        $data['id_mapel'] = $id_mapel;
        $data['id_kelas'] = $id_kelas;
        $data['mapel'] = $this->Model_mapel_kelas->get_mapel_by_id($id_mapel);
        $data['kelas'] = $this->Model_mapel_kelas->get_kelas_by_id($id_kelas);
        
        $data['siswa_list'] = $this->Model_mapel_kelas->get_siswa_by_mapel_kelas($id_mapel, $id_kelas);

        // --- Data for Sidebar and Active State ---
        $id_guru = 2; // Hardcoded for now
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $data['active_tingkatan'] = $data['kelas']->tingkatan_kelas;

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/mapel/list_siswa', $data);
        $this->load->view('templates/guru/footer');
    }

    public function form_pengumuman($id_mapel, $id_kelas)
    {
        $data['title'] = 'Kirim Pengumuman';
        $data['id_mapel'] = $id_mapel;
        $data['id_kelas'] = $id_kelas;
        $data['mapel'] = $this->Model_mapel_kelas->get_mapel_by_id($id_mapel);
        $data['kelas'] = $this->Model_mapel_kelas->get_kelas_by_id($id_kelas);

        // --- Data for Sidebar and Active State ---
        $id_guru = 2; // Hardcoded for now
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $data['active_tingkatan'] = $data['kelas']->tingkatan_kelas;

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/mapel/form_pengumuman', $data);
        $this->load->view('templates/guru/footer');
    }

    public function send_pengumuman()
    {
        $this->load->model('Model_notifikasi');
        $id_mapel = $this->input->post('id_mapel');
        $id_kelas = $this->input->post('id_kelas');
        $pesan = $this->input->post('pesan_pengumuman');
        $link = $this->input->post('link_pengumuman'); // Opsional

        if (empty($pesan)) {
            $this->session->set_flashdata('error', 'Pesan pengumuman tidak boleh kosong.');
            redirect('guru/mapel/form_pengumuman/' . $id_mapel . '/' . $id_kelas);
        }

        $result = $this->Model_notifikasi->insert_pengumuman_kelas($id_mapel, $id_kelas, $pesan, $link);

        if ($result) {
            $this->session->set_flashdata('success', 'Pengumuman berhasil dikirim ke semua siswa di kelas ini.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim pengumuman.');
        }

        redirect('guru/mapel/classroom/' . $id_mapel . '/' . $id_kelas);
    }
}