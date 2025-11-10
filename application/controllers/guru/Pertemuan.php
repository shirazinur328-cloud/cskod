<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertemuan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_mapel_kelas');
        $this->load->model('Model_guru');
    }

    public function detail($id_pertemuan)
    {
        $data['title'] = 'Detail Pertemuan';
        $data['pertemuan'] = $this->Model_mapel_kelas->get_pertemuan_by_id($id_pertemuan);
        $data['materi_list'] = $this->Model_mapel_kelas->get_materi_by_pertemuan($id_pertemuan);
        $data['tugas_list'] = $this->Model_mapel_kelas->get_tugas_by_pertemuan($id_pertemuan);
        
        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
        $this->load->view('guru/pertemuan/detail', $data);
        $this->load->view('templates/guru/footer');
    }
    
    public function add_materi($id_pertemuan)
    {
        if ($this->input->post()) {
            // Handle file upload
            $config['upload_path'] = './uploads/materi/';
            $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|jpg|jpeg|png|gif|mp4|avi|mov';
            $config['max_size'] = 100000; // 100MB
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('file_materi')) {
                $upload_data = $this->upload->data();
                
                // Determine file type based on extension
                $file_ext = strtolower($upload_data['file_ext']);
                if(in_array($file_ext, ['.jpg', '.jpeg', '.png', '.gif'])) {
                    $tipe_file = 'gambar';
                } elseif(in_array($file_ext, ['.mp4', '.avi', '.mov'])) {
                    $tipe_file = 'video';
                } else {
                    $tipe_file = 'pdf'; // Default for document files
                }
                
                $data = [
                    'judul_materi' => $this->input->post('judul_materi'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'file_materi' => $upload_data['file_name'],
                    'id_pertemuan' => $id_pertemuan,
                    'tipe_file' => $tipe_file
                ];
                
                $this->Model_mapel_kelas->create_materi($data);
                
                // Set success message
                $this->session->set_flashdata('success', 'Materi berhasil ditambahkan');
                
                // Redirect back to the same pertemuan
                redirect('guru/pertemuan/detail/' . $id_pertemuan);
            } else {
                $data['error'] = $this->upload->display_errors();
            }
        }
        
        $data['title'] = 'Tambah Materi';
        $data['id_pertemuan'] = $id_pertemuan;
        $data['pertemuan'] = $this->Model_mapel_kelas->get_pertemuan_by_id($id_pertemuan);
        
        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
        $this->load->view('guru/pertemuan/add_materi', $data);
        $this->load->view('templates/guru/footer');
    }
    
    public function add_tugas($id_pertemuan)
    {
        if ($this->input->post()) {
            $data = [
                'judul_tugas' => $this->input->post('judul_tugas'),
                'deskripsi' => $this->input->post('deskripsi'),
                'deadline' => $this->input->post('deadline'),
                'id_pertemuan' => $id_pertemuan,
                'id_mapel' => $this->input->post('id_mapel')
            ];
            
            $this->Model_mapel_kelas->create_tugas($data);
            
            // Set success message
            $this->session->set_flashdata('success', 'Tugas berhasil ditambahkan');
            
            // Redirect back to the same pertemuan
            redirect('guru/pertemuan/detail/' . $id_pertemuan);
        }
        
        $data['title'] = 'Tambah Tugas';
        $data['id_pertemuan'] = $id_pertemuan;
        $data['pertemuan'] = $this->Model_mapel_kelas->get_pertemuan_by_id($id_pertemuan);
        
        $this->load->view('templates/guru/head', $data);
        $this->load->view('templates/guru/navbar');
        $this->load->view('guru/pertemuan/add_tugas', $data);
        $this->load->view('templates/guru/footer');
    }
}