<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_guru extends CI_Model {

    public function total_guru()
    {
        return $this->db->count_all('guru');
    }

    public function list_guru($id_mapel = null)
    {
        $this->db->select('guru.*');
        $this->db->from('guru');
        $this->db->join('mapel', 'mapel.id_guru = guru.id_guru', 'left');
        if ($id_mapel) {
            $this->db->where('mapel.id_mapel', $id_mapel);
        }
        $this->db->group_by('guru.id_guru');
        $this->db->order_by('guru.id_guru', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function single_guru($id_guru)
    {
        $this->db->where('id_guru', $id_guru);
        $query = $this->db->get('guru');
        return $query->row();
    }

    public function add_guru($data)
    {
        $this->db->insert('guru', $data);
        return $this->db->insert_id();
    }

    public function update_guru($id_guru, $data)
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->update('guru', $data);
        $this->db->reset_query();
    }

    public function delete_guru($id_guru)
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->delete('guru');
        $this->db->reset_query();
    }

    public function get_all_guru()
    {
        $this->db->where('status', 'aktif');
        $this->db->order_by('nama_guru', 'asc');
        $query = $this->db->get('guru');
        return $query->result();
    }

    public function get_performa_kelas($id_guru)
    {
        $this->db->select(
            'mapel.id_mapel, 
            mapel.nama_mapel, 
            COUNT(DISTINCT tugas.id_tugas) as jumlah_tugas, 
            COUNT(DISTINCT submission.id_submission) as jumlah_submission, 
            AVG(nilai.nilai) as rata_rata_nilai'
        );
        $this->db->from('mapel');
        $this->db->join('tugas', 'mapel.id_mapel = tugas.id_mapel', 'left');
        $this->db->join('submission', 'tugas.id_tugas = submission.id_tugas', 'left');
        $this->db->join('nilai', 'submission.id_submission = nilai.id_submission', 'left');
        $this->db->where('mapel.id_guru', $id_guru);
        $this->db->group_by('mapel.id_mapel');
        $this->db->order_by('mapel.nama_mapel', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_mapel_by_guru($id_guru)
    {
        $this->db->from('guru_mapel_kelas');
        $this->db->where('id_guru', $id_guru);
        return $this->db->count_all_results();
    }
    
    public function get_mapel_by_guru($id_guru)
    {
        $this->db->select('mapel.*');
        $this->db->from('guru_mapel_kelas');
        $this->db->join('mapel', 'guru_mapel_kelas.id_mapel = mapel.id_mapel');
        $this->db->where('guru_mapel_kelas.id_guru', $id_guru);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_mapel_kelas_by_guru($id_guru)
    {
        $this->db->select('mapel.id_mapel, mapel.nama_mapel, kelas.id_kelas, kelas.nama_kelas');
        $this->db->from('guru_mapel_kelas');
        $this->db->join('mapel', 'guru_mapel_kelas.id_mapel = mapel.id_mapel');
        $this->db->join('kelas', 'guru_mapel_kelas.id_kelas = kelas.id_kelas');
        $this->db->where('guru_mapel_kelas.id_guru', $id_guru);
        $query = $this->db->get();
        return $query->result();
    }
}