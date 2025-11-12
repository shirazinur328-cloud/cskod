<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_guru');
        $this->load->model('Model_tugas');
    }

    public function index()
    {
        // Hardcoded guru ID for now, replace with session data in a real app
        $id_guru = 2; 

        $data['title'] = 'Tugas & Penilaian';
        $data['daftar_tugas'] = $this->Model_guru->get_all_tugas_by_guru($id_guru);

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
        $this->load->view('guru/penilaian/list', $data);
        $this->load->view('templates/guru/footer');
    }

    public function jawaban($id_tugas)
    {
        $data['tugas'] = $this->Model_tugas->get_tugas_by_id($id_tugas);

        if (!$data['tugas']) {
            show_404();
        }

        $data['title'] = 'Jawaban Tugas: ' . $data['tugas']['judul_tugas'];
        $data['daftar_jawaban'] = $this->Model_tugas->get_jawaban_by_tugas($id_tugas);

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
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

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
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
}
