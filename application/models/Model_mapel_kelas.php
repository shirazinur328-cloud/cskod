<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mapel_kelas extends CI_Model {


    
    public function get_mapel_by_id($id_mapel)
    {
        $query = $this->db->get_where('mapel', array('id_mapel' => $id_mapel));
        return $query->row();
    }
    
    public function get_kelas_by_id($id_kelas)
    {
        $query = $this->db->get_where('kelas', array('id_kelas' => $id_kelas));
        return $query->row();
    }
    
    public function get_pertemuan_by_mapel_kelas($id_mapel, $id_kelas)
    {
        $this->db->select('*');
        $this->db->from('pertemuan');
        $this->db->where('id_mapel', $id_mapel);
        $this->db->where('id_kelas', $id_kelas);
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function create_pertemuan($data)
    {
        $this->db->insert('pertemuan', $data);
        return $this->db->insert_id();
    }
    
    public function get_pertemuan_by_id($id_pertemuan)
    {
        $this->db->select('id_pertemuan, id_mapel, id_kelas, nama_pertemuan, tanggal');
        $this->db->from('pertemuan');
        $this->db->where('id_pertemuan', $id_pertemuan);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_materi_by_pertemuan($id_pertemuan)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('id_pertemuan', $id_pertemuan);
        $this->db->where('status', 'aktif');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_tugas_by_pertemuan($id_pertemuan)
    {
        $this->db->select('*');
        $this->db->from('tugas');
        $this->db->where('id_pertemuan', $id_pertemuan);
        $this->db->where('status', 'aktif');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function create_materi($data)
    {
        $data['status'] = 'aktif'; // Set default status for materi
        $this->db->insert('materi', $data);
        return $this->db->insert_id();
    }
    
    public function create_tugas($data)
    {
        $data['status'] = 'aktif'; // Set default status for tugas
        $this->db->insert('tugas', $data);
        return $this->db->insert_id();
    }
    

}