<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_guru');
        $this->load->model('Model_mapel_kelas');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Guru';
        $id_guru = $this->session->userdata('id_guru');
        if ($id_guru) {
            $data['total_mapel'] = $this->Model_guru->total_mapel_by_guru($id_guru);
        } else {
            $data['total_mapel'] = 0;
        }
        
        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
        $this->load->view('guru/dashboard', $data);
        $this->load->view('templates/guru/footer');
    }
}