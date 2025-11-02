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
        
        // Add authentication check if needed
        // $this->check_login();
    }

    public function index()
    {
        // Get the student ID from session (assuming student is logged in)
        // For now, I'll use a placeholder - in real implementation, get from session
        $id_murid = $this->session->userdata('id_murid'); // Adjust based on your session variable name
        
        // For testing purposes, if no session is set, we can use a default ID
        // In real application, redirect to login if not authenticated
        if (!$id_murid) {
            // For demonstration purposes, I'll use a default ID
            // In a real application, redirect to login page
            $id_murid = 1; // This should come from the logged-in user session
        }
        
        // Fetch subjects data for the student based on their class/assignment
        $data['mapel'] = $this->Model_murid_mapel->get_subjects_by_student_id($id_murid);
        
        // Also get student's info for display
        $data['murid'] = $this->Model_murid->single_murid($id_murid);
        
        // Load the student dashboard view with data
        $this->load->view('murid/dashboard', $data);
    }

    /**
     * Show detailed view of a specific subject
     */
    public function subject_detail($id_mapel = NULL)
    {
        if ($id_mapel === NULL) {
            show_404();
            return;
        }

        // Get the student ID from session
        $id_murid = $this->session->userdata('id_murid');
        if (!$id_murid) {
            // Redirect to login or show error
            $id_murid = 1; // For testing purposes only
        }

        // Fetch the specific subject data ensuring the student has access to it
        $data['subject'] = $this->Model_murid_mapel->get_subject_by_id_for_student($id_mapel, $id_murid);
        
        if (empty($data['subject'])) {
            show_404();
            return;
        }

        // Fetch meetings for the subject
        $data['meetings'] = $this->Model_murid_mapel->get_meetings_by_subject($id_mapel, $id_murid);
        
        // For each meeting, fetch its materials and assignments
        foreach ($data['meetings'] as $key => $meeting) {
            $data['meetings'][$key]['materials'] = $this->Model_murid_mapel->get_materials_by_meeting($meeting['id_pertemuan']);
            $data['meetings'][$key]['assignments'] = $this->Model_murid_mapel->get_assignments_by_meeting($meeting['id_pertemuan']);
        }

        // Load the subject detail view
        $this->load->view('murid/subject_detail', $data);
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