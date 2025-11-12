<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_nilai extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_nilai_by_id($id_nilai) {
        return $this->db->get_where('nilai', array('id_nilai' => $id_nilai))->row_array();
    }

    public function get_nilai_by_tugas_murid($id_tugas_murid) {
        return $this->db->get_where('nilai', array('id_tugas_murid' => $id_tugas_murid))->row_array();
    }

    public function insert_nilai($data) {
        return $this->db->insert('nilai', $data);
    }

    public function update_nilai($id_nilai, $data) {
        $this->db->where('id_nilai', $id_nilai);
        return $this->db->update('nilai', $data);
    }

    public function delete_nilai($id_nilai) {
        $this->db->where('id_nilai', $id_nilai);
        return $this->db->delete('nilai');
    }

    // Get all grades for a specific student
    public function get_all_nilai_by_murid($id_murid) {
        $this->db->select('n.*, tm.id_tugas, t.judul_tugas, m.nama_mapel, g.nama_guru');
        $this->db->from('nilai n');
        $this->db->join('tugas_murid tm', 'n.id_tugas_murid = tm.id_tugas_murid');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->join('guru g', 'n.id_guru = g.id_guru', 'left');
        $this->db->where('tm.id_murid', $id_murid);
        $this->db->order_by('n.tanggal_nilai', 'DESC');
        return $this->db->get()->result_array();
    }

    // Get all grades for a specific assignment submission
    public function get_nilai_detail_by_tugas_murid($id_tugas_murid) {
        $this->db->select('n.*, tm.id_tugas, tm.id_murid, t.judul_tugas, t.deskripsi, t.tipe_tugas, t.bahasa, m.nama_mapel, g.nama_guru, tm.file_jawaban, tm.kode_jawaban');
        $this->db->from('nilai n');
        $this->db->join('tugas_murid tm', 'n.id_tugas_murid = tm.id_tugas_murid');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->join('guru g', 'n.id_guru = g.id_guru', 'left');
        $this->db->where('n.id_tugas_murid', $id_tugas_murid);
        return $this->db->get()->row_array();
    }
}