<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_guru');
        $this->load->model('Model_mapel_kelas');
        // Ensure teacher is logged in
        // if (!$this->session->userdata('id_guru')) {
        //     redirect('auth/login'); // Adjust to your login path
        // }
    }

    public function index($tingkat = null)
    {
        if (is_null($tingkat) || !in_array($tingkat, ['X', 'XI', 'XII'])) {
            // Redirect to dashboard or show an error if no/invalid tingkat is provided
            redirect('guru/dashboard');
        }

        $data['title'] = 'Kelas ' . $tingkat;
        $id_guru = 2; // Hardcoded for now, replace with session data
        // $id_guru = $this->session->userdata('id_guru');

        // Data for the view
        $data['tingkat'] = $tingkat;
        $data['mapel_list'] = $this->Model_mapel_kelas->get_mapel_kelas_by_guru_and_tingkat($id_guru, $tingkat);

        // Data for the sidebar (to keep it consistent)
        $data['tingkatan_kelas_list'] = $this->Model_guru->get_tingkatan_kelas_by_guru($id_guru);

        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar', $data);
        $this->load->view('guru/kelas_detail', $data);
        $this->load->view('templates/guru/footer');
    }
}
