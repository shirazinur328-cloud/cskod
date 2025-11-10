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
        $id_guru = $this->session->userdata('id_guru');
        $data['title'] = 'Daftar Mata Pelajaran';
        $this->load->model('Model_guru');
        $data['mapel_kelas_list'] = $this->Model_guru->get_mapel_kelas_by_guru($id_guru);
        
        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
        $this->load->view('guru/mapel/list', $data);
        $this->load->view('templates/guru/footer');
    }
    
    public function classroom($id_mapel, $id_kelas)
    {
        $data['title'] = 'Ruang Pembelajaran';
        $data['id_mapel'] = $id_mapel;
        $data['id_kelas'] = $id_kelas;
        $data['mapel'] = $this->Model_mapel_kelas->get_mapel_by_id($id_mapel);
        $data['kelas'] = $this->Model_mapel_kelas->get_kelas_by_id($id_kelas);
        $data['pertemuan_list'] = $this->Model_mapel_kelas->get_pertemuan_by_mapel_kelas($id_mapel, $id_kelas);
        
        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
        $this->load->view('guru/mapel/classroom', $data);
        $this->load->view('templates/guru/footer');
    }
    
    public function create_pertemuan($id_mapel, $id_kelas)
    {
        if ($this->input->post()) {
            $data = [
    'judul_pertemuan' => $this->input->post('judul_pertemuan'),
    'waktu_mulai' => $this->input->post('waktu_mulai'),
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
        
        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
        $this->load->view('guru/mapel/create_pertemuan', $data);
        $this->load->view('templates/guru/footer');
    }
}