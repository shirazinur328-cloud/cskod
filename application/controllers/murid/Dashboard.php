<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load required libraries, helpers, and models
        $this->load->helper('url');
        $this->load->model('Model_murid_mapel');
        $this->load->model('Model_murid'); // For student information
        $this->load->model('Model_materi');
        $this->load->model('Model_tugas'); // Load Model_tugas
        $this->load->model('Model_nilai'); // Load Model_nilai

        // Add authentication check if needed
        // $this->check_login();
    }

    public function index()
    {
        // Use a hardcoded student ID for testing, as requested.
        $id_murid = 2;
        
        // Load the main dashboard model
        $this->load->model('Model_dashboard');
        $this->load->model('Model_notifikasi');

        // Fetch the bulk of the dashboard data from the dedicated model method
        $data = $this->Model_dashboard->get_student_dashboard_data($id_murid);

        // Fetch essential data not included in the dashboard model method
        $data['murid'] = $this->Model_murid->single_murid($id_murid);
        $data['mapel_murid'] = $this->Model_murid->get_mapel_by_kelas($id_murid);
        $data['notifikasi'] = $this->Model_notifikasi->get_unread_notifikasi($id_murid);
        
        // Calculate overall progress (reusing logic from Profile controller)
        $assignment_stats = $this->Model_murid->get_assignment_completion_stats($id_murid);
        if ($assignment_stats && $assignment_stats->total_assignments > 0) {
            $data['overall_progress'] = round(($assignment_stats->completed_assignments / $assignment_stats->total_assignments) * 100);
        } else {
            $data['overall_progress'] = 0;
        }
        
        // Load the student dashboard view with all the collected data
        $this->load->view('murid/dashboard', $data);
    }

    /**
     * Show detailed view of a specific subject
     */
    public function subject_detail($id_mapel = NULL)
    {
        // For testing, hardcode student ID. In production, use session.
        $id_murid = 2; // Temporarily hardcoded for testing purposes

        if ($id_mapel === NULL) {
            show_404();
            return;
        }
        $data['subject'] = $this->Model_murid_mapel->get_subject_by_id_for_student($id_mapel, $id_murid);
        if (empty($data['subject']) || $data['subject']['status_aktif'] !== 'aktif') {
            show_404(); // Student does not have access or subject is not active
            return;
        }

        // 2. Fetch overall progress for the subject
        $data['progress_details'] = $this->Model_materi->get_subject_progress_details($id_mapel, $id_murid);

        // 3. Fetch meetings for the subject
        $meetings = $this->Model_murid_mapel->get_meetings_by_subject($id_mapel, $id_murid);
        
        // 4. For each meeting, fetch its materials and assignments
        foreach ($meetings as $key => $meeting) {
            // Fetch materials for this meeting
            $meetings[$key]['materials'] = $this->Model_materi->get_materi_by_pertemuan($meeting['id_pertemuan']);
            
            // Fetch assignments for this meeting
            $meetings[$key]['assignments'] = $this->Model_tugas->get_tugas_by_pertemuan($meeting['id_pertemuan'], $id_murid);

            // Determine completion status (optional, can be enhanced later)
            $meetings[$key]['status'] = 'Belum dikerjakan'; // Placeholder status
        }

        $data['meetings'] = $meetings;

        // Pass mapel list for sidebar and current mapel ID for highlighting
        $data['mapel_murid'] = $this->Model_murid->get_mapel_by_kelas($id_murid);
        $data['current_mapel_id'] = $id_mapel;

        // Load the subject detail view with all the prepared data
        $this->load->view('murid/subject_detail', $data);
    }

    /**
     * Show detailed view of a specific material
     */
    public function materi_detail($id_materi = NULL)
    {
        if ($id_materi === NULL) {
            show_404();
            return;
        }

        // For testing, hardcode student ID. In production, use session.
        $id_murid = 2; // Temporarily hardcoded for testing purposes

        // 1. Fetch material details
        $data['materi'] = $this->Model_materi->get_materi_by_id($id_materi);
        if (empty($data['materi'])) {
            show_404();
            return;
        }

        // 2. Pass mapel list for sidebar
        $data['mapel_murid'] = $this->Model_murid->get_mapel_by_kelas($id_murid);
        $data['current_mapel_id'] = $data['materi']['id_mapel']; // For highlighting active subject

        // 3. Load the material detail view
        $this->load->view('murid/materi_detail', $data);
    }

    public function detail_pertemuan($id_pertemuan)
    {
        $id_murid = 2; // Hardcoded student ID for now

        $data['materi'] = $this->Model_materi->get_materi_by_pertemuan($id_pertemuan);
        $data['tugas'] = $this->Model_tugas->get_tugas_by_pertemuan($id_pertemuan, $id_murid); // Pass id_murid to get submission status
        $this->load->view('murid/materi_detail', $data);
    }

    public function mark_materi_complete()
    {
        $id_materi = $this->input->post('id_materi');
        $id_murid = 2; // Hardcoded student ID for now

        if ($id_materi) {
            $this->load->model('Model_materi');
            $result = $this->Model_materi->mark_materi_as_complete($id_materi, $id_murid);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Materi berhasil ditandai selesai.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menandai materi selesai.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID Materi tidak valid.']);
        }
    }

    public function my_grades()
    {
        $this->load->model('Model_murid'); // For sidebar mapel and grades
        // $this->load->model('Model_nilai'); // No longer needed for this function

        $id_murid = 2; // Hardcoded student ID for now

        $data['daftar_nilai'] = $this->Model_murid->get_all_grades_by_murid($id_murid);
        $data['mapel_murid'] = $this->Model_murid->get_mapel_by_kelas($id_murid); // For sidebar

        $this->load->view('templates/siswa/head', ['title' => 'Nilai Saya']);
        $this->load->view('templates/siswa/navbar', $data); // Pass $data here
        $this->load->view('templates/siswa/topbar');
        $this->load->view('murid/my_grades', $data);
        $this->load->view('templates/siswa/footer');
    }

    /**
     * Private method to check if user is logged in as a student
     * This assumes you have authentication logic in place
     */
    private function check_login()
    {
        // Check if the user is logged in as a student
        // If not logged in, redirect to login page
        // Example:
        /*
        if (!$this->session->userdata('logged_in') || 
            $this->session->userdata('user_type') !== 'murid') {
            redirect('login');
        }
        */
    }
}