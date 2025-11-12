<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load models and helpers needed for this controller
        $this->load->model('Model_tugas');
        $this->load->model('Model_murid');
        $this->load->helper('url');
        $this->load->library('session');
    }

    /**
     * Display the assignment submission page.
     */
    public function kerjakan($id_tugas = NULL)
    {
        // Get student ID from session (hardcoded for now)
        $id_murid = 2;

        // Fetch assignment details
        $data['tugas'] = $this->Model_tugas->get_tugas_by_id($id_tugas);
        if (empty($data['tugas']) || $data['tugas']['status_aktif'] !== 'aktif') {
            show_404();
            return;
        }

        // Fetch existing submission for this student and assignment
        $data['submission'] = $this->Model_tugas->get_tugas_murid_by_tugas_id_and_murid_id($id_tugas, $id_murid);

        // Fetch student's subjects for the sidebar
        $data['mapel_murid'] = $this->Model_murid->get_mapel_by_kelas($id_murid);
        $data['current_mapel_id'] = $data['tugas']['id_mapel'];

        // Load the view for assignment submission based on type
        if ($data['tugas']['tipe_tugas'] == 'coding') {
            $this->load->view('murid/kerjakan_tugas_coding', $data);
        } elseif ($data['tugas']['tipe_tugas'] == 'text') {
            $this->load->view('murid/kerjakan_tugas_text', $data);
        } else {
            $this->load->view('murid/kerjakan_tugas', $data);
        }
    }

    /**
     * Handle the assignment submission.
     */
    public function submit_tugas()
    {
        // Get student ID from session (hardcoded for now)
        $id_murid = 2;
        $id_tugas = $this->input->post('id_tugas');

        // Configure file upload
        $config['upload_path']          = './uploads/tugas_murid/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 102400; // 100MB
        $config['encrypt_name']         = TRUE; // Encrypt file name for security

        // Create the directory if it doesn't exist
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_jawaban')) {
            // If upload fails, show error
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect('murid/tugas/kerjakan/' . $id_tugas);
        } else {
            // If upload is successful
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            // Prepare data for insertion into 'tugas_murid' table
            $submission_data = [
                'id_tugas' => $id_tugas,
                'id_murid' => $id_murid,
                'status' => 'Selesai', // Or 'Terkirim'
                'file_jawaban' => $file_name,
                'submitted_at' => date('Y-m-d H:i:s')
            ];

            // Insert the submission into the database
            $this->Model_tugas->insert_tugas_murid($submission_data);

            // Set success message and redirect
            $this->session->set_flashdata('success', 'Tugas berhasil dikumpulkan!');
            
            // Redirect to the subject detail page
            $tugas_info = $this->Model_tugas->get_tugas_by_id($id_tugas);
            redirect('murid/dashboard/subject_detail/' . $tugas_info['id_mapel']);
        }
    }

    /**
     * Handle the coding assignment submission.
     */
    public function submit_coding()
    {
        // Get student ID from session (hardcoded for now)
        $id_murid = 2;
        $id_tugas = $this->input->post('id_tugas');
        $kode_jawaban = $this->input->post('kode_jawaban');

        // Prepare data for insertion into 'tugas_murid' table
        $submission_data = [
            'id_tugas' => $id_tugas,
            'id_murid' => $id_murid,
            'status' => 'Selesai',
            'kode_jawaban' => $kode_jawaban,
            'submitted_at' => date('Y-m-d H:i:s')
        ];

        // Insert or update the submission in the database
        $this->Model_tugas->insert_tugas_murid($submission_data);

        // Set success message and redirect
        $this->session->set_flashdata('success', 'Tugas coding berhasil dikumpulkan!');
        
        // Redirect to the subject detail page
        $tugas_info = $this->Model_tugas->get_tugas_by_id($id_tugas);
        redirect('murid/dashboard/subject_detail/' . $tugas_info['id_mapel']);
    }

    /**
     * Handle the text assignment submission.
     */
    public function submit_text()
    {
        // Get student ID from session (hardcoded for now)
        $id_murid = 2;
        $id_tugas = $this->input->post('id_tugas');
        $jawaban_teks = $this->input->post('jawaban_teks');

        // Prepare data for insertion into 'tugas_murid' table
        $submission_data = [
            'id_tugas' => $id_tugas,
            'id_murid' => $id_murid,
            'status' => 'Selesai',
            'kode_jawaban' => $jawaban_teks, // Re-use the 'kode_jawaban' column
            'submitted_at' => date('Y-m-d H:i:s')
        ];

        // Insert or update the submission in the database
        $this->Model_tugas->insert_tugas_murid($submission_data);

        // Set success message and redirect
        $this->session->set_flashdata('success', 'Jawaban berhasil dikumpulkan!');
        
        // Redirect to the subject detail page
        $tugas_info = $this->Model_tugas->get_tugas_by_id($id_tugas);
        redirect('murid/dashboard/subject_detail/' . $tugas_info['id_mapel']);
    }
}
