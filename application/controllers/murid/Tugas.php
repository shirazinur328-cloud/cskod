<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Pastikan murid sudah login
        // if ($this->session->userdata('role') != 'murid') {
        //     redirect('auth/login');
        // }
        $this->load->model('Model_tugas');
        $this->load->model('Model_murid');
        $this->load->model('Model_notifikasi');
        $this->load->library('user_agent');
    }

    public function kerjakan($tipe = 'file', $id_tugas = 0)
    {
        if ($id_tugas == 0) {
            show_404();
            return;
        }

                $id_murid = $this->session->userdata('murid')->id_murid;
 // Temporarily hardcoded for testing purposes
        $data['tugas'] = $this->Model_tugas->get_tugas_detail_for_murid($id_tugas, $id_murid);

        if (empty($data['tugas'])) {
            show_404();
            return;
        }

        // Ambil data murid dari session
        $data['murid'] = $this->Model_murid->single_murid($id_murid);
        $data['title'] = 'Kerjakan Tugas: ' . htmlspecialchars($data['tugas']['judul_tugas']);
        $data['notifikasi'] = $this->Model_notifikasi->get_unread_notifikasi($id_murid);
        $data['mapel_murid'] = $this->Model_murid->get_mapel_by_kelas($id_murid);
        $data['current_mapel_id'] = $data['tugas']['id_mapel'];

        // Tentukan view berdasarkan tipe tugas
        $view_name = '';
        switch ($tipe) {
            case 'coding':
                $view_name = 'murid/kerjakan_tugas_coding';
                break;
            case 'text':
                $view_name = 'murid/kerjakan_tugas_text';
                break;
            case 'file':
            default:
                $view_name = 'murid/kerjakan_tugas';
                break;
        }

        $this->load->view('templates/siswa/head', $data);

        $this->load->view($view_name, $data);
    }

    public function submit_coding()
    {
        $id_tugas = $this->input->post('id_tugas');
                $id_murid = $this->session->userdata('murid')->id_murid;
 // Temporarily hardcoded for testing purposes
        $kode_jawaban = $this->input->post('kode_jawaban');
        if (empty($id_tugas) || empty($kode_jawaban)) {
            $this->session->set_flashdata('error', 'Gagal mengirimkan tugas. Data tidak lengkap.');
            redirect($this->agent->referrer());
        }

        // Simpan jawaban
        $submission_data = [
            'id_tugas' => $id_tugas,
            'id_murid' => $id_murid,
            'kode_jawaban' => $kode_jawaban,
            'submitted_at' => date('Y-m-d H:i:s'),
            'status' => 'Terkirim'
        ];

        $this->Model_tugas->submit_tugas_coding($submission_data);

        // Redirect atau berikan pesan sukses
        $this->session->set_flashdata('success', 'Tugas coding berhasil dikumpulkan!');
        redirect('murid/dashboard/subject_detail/' . $this->input->post('id_mapel'));
    }

    public function submit_file()
    {
        $id_tugas = $this->input->post('id_tugas');
                $id_murid = $this->session->userdata('murid')->id_murid;
 // Temporarily hardcoded for testing purposes
        $id_mapel = $this->input->post('id_mapel');

        if (empty($id_tugas) || empty($id_mapel)) {
            $this->session->set_flashdata('error', 'Gagal mengirimkan tugas. Data tidak lengkap.');
            redirect($this->agent->referrer());
        }

        // Konfigurasi upload file
        $config['upload_path']          = './uploads/tugas_murid/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx|zip|rar';
        $config['max_size']             = 5000; // 5MB
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_jawaban'))
        {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Gagal mengupload file: ' . strip_tags($error));
            redirect($this->agent->referrer());
        }
        else
        {
            $upload_data = $this->upload->data();
            $file_jawaban = $upload_data['file_name'];

            $submission_data = [
                'id_tugas' => $id_tugas,
                'id_murid' => $id_murid,
                'file_jawaban' => $file_jawaban,
                'submitted_at' => date('Y-m-d H:i:s'),
                'status' => 'Terkirim'
            ];

            $this->Model_tugas->submit_tugas_file($submission_data);

            $this->session->set_flashdata('success', 'Tugas file berhasil dikumpulkan!');
            redirect('murid/dashboard/subject_detail/' . $id_mapel);
        }
    }

    public function submit_text()
    {
        $id_tugas = $this->input->post('id_tugas');
                $id_murid = $this->session->userdata('murid')->id_murid;
 // Temporarily hardcoded for testing purposes
        $id_mapel = $this->input->post('id_mapel');
        $text_jawaban = $this->input->post('jawaban_teks');

        if (empty($id_tugas) || empty($id_mapel) || empty($text_jawaban)) {
            $this->session->set_flashdata('error', 'Gagal mengirimkan tugas. Data tidak lengkap.');
            redirect($this->agent->referrer());
        }

        $submission_data = [
            'id_tugas' => $id_tugas,
            'id_murid' => $id_murid,
            'kode_jawaban' => $text_jawaban,
            'submitted_at' => date('Y-m-d H:i:s'),
            'status' => 'Terkirim'
        ];

        $this->Model_tugas->submit_tugas_text($submission_data);

        $this->session->set_flashdata('success', 'Tugas teks berhasil dikumpulkan!');
        redirect('murid/dashboard/subject_detail/' . $id_mapel);
    }
}