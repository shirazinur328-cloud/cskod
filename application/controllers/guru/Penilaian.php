<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('guru')) {
        	redirect('auth');
        }
        $this->load->model('Model_guru');
        $this->load->model('Model_tugas');
    }

    public function index()
    {
        // Hardcoded guru ID for now, replace with session data in a real app
        $id_guru = 2; 

        $data['title'] = 'Tugas & Penilaian';
        $data['daftar_tugas'] = $this->Model_guru->get_all_tugas_by_guru($id_guru);
        foreach ($data['daftar_tugas'] as $tugas) {
            $tugas->rata_rata_nilai = $this->Model_tugas->get_average_nilai_by_tugas($tugas->id_tugas);
        }
        $data['student_performance_data'] = $this->Model_guru->get_student_performance_data($id_guru);
        
        // --- Data for Sidebar ---
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/penilaian/list', $data);

    }

    public function jawaban($id_tugas)
    {
        $data['tugas'] = $this->Model_tugas->get_tugas_by_id($id_tugas);

        if (!$data['tugas']) {
            show_404();
        }

        $data['title'] = 'Jawaban Tugas: ' . $data['tugas']['judul_tugas'];
        $data['daftar_jawaban'] = $this->Model_tugas->get_jawaban_by_tugas($id_tugas);

        // --- Data for Sidebar and Active State ---
        $id_guru = 2; // Hardcoded for now
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $data['active_tingkatan'] = $this->Model_tugas->get_tingkatan_by_tugas($id_tugas);

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/penilaian/jawaban_list', $data);
        $this->load->view('templates/guru/footer');
    }

    public function beri_nilai($id_tugas_murid)
    {
        $data['jawaban'] = $this->Model_tugas->get_jawaban_detail($id_tugas_murid);

        if (!$data['jawaban']) {
            show_404();
        }

        $data['title'] = 'Beri Nilai: ' . $data['jawaban']->judul_tugas;

        // --- Data for Sidebar and Active State ---
        $id_guru = 2; // Hardcoded for now
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);
        $data['active_tingkatan'] = $this->Model_tugas->get_tingkatan_by_tugas($data['jawaban']->id_tugas);

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/penilaian/beri_nilai', $data);
        $this->load->view('templates/guru/footer');
    }

    public function simpan_nilai()
    {
        $id_tugas_murid = $this->input->post('id_tugas_murid');
        $id_tugas = $this->input->post('id_tugas');
        $submit_action = $this->input->post('submit_action');

        $data_update = [
            'nilai' => $this->input->post('nilai'),
            'komentar_guru' => $this->input->post('komentar_guru')
        ];

        if ($submit_action == 'revisi') {
            $data_update['status'] = 'Revisi';
        } else {
            $data_update['status'] = 'Dinilai';
        }

        $this->Model_tugas->update_tugas_murid($id_tugas_murid, $data_update);

        $this->session->set_flashdata('success', 'Nilai berhasil disimpan.');
        redirect('guru/penilaian/jawaban/' . $id_tugas);
    }

    public function export_excel()
    {
        $id_guru = 2; // Hardcoded guru ID
        $daftar_tugas = $this->Model_guru->get_all_tugas_by_guru($id_guru);

        // Tambahkan rata-rata nilai ke setiap tugas
        foreach ($daftar_tugas as $tugas) {
            $tugas->rata_rata_nilai = $this->Model_tugas->get_average_nilai_by_tugas($tugas->id_tugas);
        }

        // Set header untuk file CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="Laporan_Tugas_Penilaian_Guru.csv"');
        header('Cache-Control: max-age=0');

        $output = fopen('php://output', 'w');

        // Header CSV
        fputcsv($output, array('No', 'Judul Tugas', 'Mata Pelajaran', 'Kelas', 'Rata-rata Nilai'));

        // Data
        $no = 1;
        foreach ($daftar_tugas as $tugas) {
            fputcsv($output, array(
                $no++,
                $tugas->judul_tugas,
                $tugas->nama_mapel,
                $tugas->nama_kelas,
                $tugas->rata_rata_nilai ?? 'Belum ada nilai'
            ));
        }

        fclose($output);
        exit();
    }

    public function export_pdf()
    {
        $this->load->library('dompdf_gen'); // Load library dompdf

        $id_guru = 2; // Hardcoded guru ID
        $data['daftar_tugas'] = $this->Model_guru->get_all_tugas_by_guru($id_guru);

        // Tambahkan rata-rata nilai ke setiap tugas
        foreach ($data['daftar_tugas'] as $tugas) {
            $tugas->rata_rata_nilai = $this->Model_tugas->get_average_nilai_by_tugas($tugas->id_tugas);
        }

        $data['title'] = 'Laporan Tugas & Penilaian Guru';

        // Load view untuk konten PDF
        $html = $this->load->view('guru/penilaian/laporan_pdf', $data, true);

        $this->dompdf_gen->load_html($html);
        $this->dompdf_gen->render();
        $this->dompdf_gen->stream("Laporan_Tugas_Penilaian_Guru.pdf", array("Attachment" => 0)); // Stream to browser
        exit();
    }
}
