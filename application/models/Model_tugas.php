<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tugas extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_tugas() {
        return $this->db->get('tugas')->result_array();
    }

    public function get_tugas_by_id($id_tugas) {
        $this->db->select('t.*, m.status_aktif');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel', 'left');
        $this->db->where('t.id_tugas', $id_tugas);
        return $this->db->get()->row_array();
    }

    public function insert_tugas($data) {
        return $this->db->insert('tugas', $data);
    }

    public function update_tugas($id_tugas, $data) {
        $this->db->where('id_tugas', $id_tugas);
        return $this->db->update('tugas', $data);
    }

    public function delete_tugas($id_tugas) {
        $this->db->where('id_tugas', $id_tugas);
        return $this->db->delete('tugas');
    }

    // --- Tugas Murid specific methods ---

    public function get_tugas_murid_by_murid_id($id_murid) {
        $this->db->select('tm.*, t.judul_tugas, t.deadline, m.nama_mapel');
        $this->db->from('tugas_murid tm');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->where('tm.id_murid', $id_murid);
        return $this->db->get()->result_array();
    }

    public function get_jumlah_tugas_belum_dikerjakan($id_murid) {
        $this->db->where('id_murid', $id_murid);
        $this->db->where('status', 'Belum Dikerjakan');
        return $this->db->count_all_results('tugas_murid');
    }

    public function insert_tugas_murid($data) {
        // Check if a submission already exists for this student and assignment
        $this->db->where('id_tugas', $data['id_tugas']);
        $this->db->where('id_murid', $data['id_murid']);
        $query = $this->db->get('tugas_murid');

        if ($query->num_rows() > 0) {
            // Submission exists, so update it
            $this->db->where('id_tugas', $data['id_tugas']);
            $this->db->where('id_murid', $data['id_murid']);
            return $this->db->update('tugas_murid', $data);
        } else {
            // No submission exists, so insert a new one
            return $this->db->insert('tugas_murid', $data);
        }
    }

    public function update_tugas_murid($id_tugas_murid, $data) {
        $this->db->where('id_tugas_murid', $id_tugas_murid);
        return $this->db->update('tugas_murid', $data);
    }

    public function get_tugas_murid_by_tugas_id_and_murid_id($id_tugas, $id_murid) {
        $this->db->where('id_tugas', $id_tugas);
        $this->db->where('id_murid', $id_murid);
        return $this->db->get('tugas_murid')->row_array();
    }

    public function get_assignments_by_mapel($id_mapel) {
        $this->db->where('id_mapel', $id_mapel);
        $this->db->order_by('deadline', 'ASC');
        return $this->db->get('tugas')->result_array();
    }

    public function get_tugas_by_pertemuan($id_pertemuan, $id_murid) {
        $this->db->select('t.*, tm.status as submission_status, tm.nilai as grade, tm.komentar_guru');
        $this->db->from('tugas t');
        $this->db->where('t.id_pertemuan', $id_pertemuan);
        $this->db->join('tugas_murid tm', 't.id_tugas = tm.id_tugas AND tm.id_murid = ' . $this->db->escape($id_murid), 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_tugas_detail_for_murid($id_tugas, $id_murid) {
        $this->db->select('t.*, tm.kode_jawaban, tm.status, tm.nilai, tm.komentar_guru');
        $this->db->from('tugas t');
        $this->db->join('tugas_murid tm', 't.id_tugas = tm.id_tugas AND tm.id_murid = ' . $this->db->escape($id_murid), 'left');
        $this->db->where('t.id_tugas', $id_tugas);
        return $this->db->get()->row_array();
    }

    public function submit_tugas_coding($data) {
        // Check if a submission already exists
        $this->db->where('id_tugas', $data['id_tugas']);
        $this->db->where('id_murid', $data['id_murid']);
        $query = $this->db->get('tugas_murid');

        if ($query->num_rows() > 0) {
            // Submission exists, so update it
            $this->db->where('id_tugas', $data['id_tugas']);
            $this->db->where('id_murid', $data['id_murid']);
            return $this->db->update('tugas_murid', $data);
        } else {
            // No submission exists, so insert a new one
            return $this->db->insert('tugas_murid', $data);
        }
    }

    public function submit_tugas_file($data) {
        // Check if a submission already exists
        $this->db->where('id_tugas', $data['id_tugas']);
        $this->db->where('id_murid', $data['id_murid']);
        $query = $this->db->get('tugas_murid');

        if ($query->num_rows() > 0) {
            // Submission exists, so update it
            $this->db->where('id_tugas', $data['id_tugas']);
            $this->db->where('id_murid', $data['id_murid']);
            return $this->db->update('tugas_murid', $data);
        } else {
            // No submission exists, so insert a new one
            return $this->db->insert('tugas_murid', $data);
        }
    }

    public function submit_tugas_text($data) {
        // Check if a submission already exists
        $this->db->where('id_tugas', $data['id_tugas']);
        $this->db->where('id_murid', $data['id_murid']);
        $query = $this->db->get('tugas_murid');

        if ($query->num_rows() > 0) {
            // Submission exists, so update it
            $this->db->where('id_tugas', $data['id_tugas']);
            $this->db->where('id_murid', $data['id_murid']);
            return $this->db->update('tugas_murid', $data);
        } else {
            // No submission exists, so insert a new one
            return $this->db->insert('tugas_murid', $data);
        }
    }

    public function get_jawaban_by_tugas($id_tugas) {
        $this->db->select('tm.id_tugas_murid, tm.submitted_at, tm.status, tm.nilai, tm.komentar_guru, m.nama_murid');
        $this->db->from('tugas_murid tm');
        $this->db->join('murid m', 'tm.id_murid = m.id_murid');
        $this->db->where('tm.id_tugas', $id_tugas);
        $this->db->order_by('tm.submitted_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_jawaban_detail($id_tugas_murid) {
        $this->db->select('
            tm.*, 
            t.judul_tugas, 
            t.deskripsi, 
            t.tipe_tugas,
            t.bahasa,
            m.nama_murid
        ');
        $this->db->from('tugas_murid tm');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('murid m', 'tm.id_murid = m.id_murid');
        $this->db->where('tm.id_tugas_murid', $id_tugas_murid);
        $query = $this->db->get();
        return $query->row();
    }

    public function count_tugas_belum_dinilai($id_guru)
    {
        $this->db->select('COUNT(tm.id_tugas_murid) as total');
        $this->db->from('tugas_murid tm');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->where('m.id_guru', $id_guru);
        $this->db->where('tm.status', 'Terkirim');
        $this->db->where('tm.nilai IS NULL');
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function get_tugas_belum_dinilai($id_guru, $limit = 5)
    {
        $this->db->select('
            tm.id_tugas_murid,
            t.judul_tugas,
            m.nama_murid,
            k.nama_kelas,
            tm.submitted_at
        ');
        $this->db->from('tugas_murid tm');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('murid m', 'tm.id_murid = m.id_murid');
        $this->db->join('murid_kelas mk', 'm.id_murid = mk.id_murid', 'left');
        $this->db->join('kelas k', 'mk.id_kelas = k.id_kelas', 'left');
        $this->db->join('mapel map', 't.id_mapel = map.id_mapel');
        $this->db->where('map.id_guru', $id_guru);
        $this->db->where('tm.status', 'Terkirim');
        $this->db->where('tm.nilai IS NULL');
        $this->db->order_by('tm.submitted_at', 'ASC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_tugas_selesai($id_murid)
    {
        $this->db->where('id_murid', $id_murid);
        $this->db->where('status', 'Selesai');
        return $this->db->count_all_results('tugas_murid');
    }

    public function get_tugas_mendatang($id_murid, $limit = 2)
    {
        $this->db->select('t.judul_tugas, t.deadline, m.nama_mapel');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->join('murid_mapel mm', 'm.id_mapel = mm.id_mapel');
        $this->db->where('mm.id_murid', $id_murid);
        $this->db->where('t.deadline >=', date('Y-m-d'));
        $this->db->order_by('t.deadline', 'ASC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_average_nilai_by_tugas($id_tugas)
    {
        $this->db->select('AVG(nilai) as average_nilai');
        $this->db->from('tugas_murid');
        $this->db->where('id_tugas', $id_tugas);
        $this->db->where('nilai IS NOT NULL'); // Hanya hitung yang sudah dinilai
        $query = $this->db->get();
        $result = $query->row();
        return $result->average_nilai ? round($result->average_nilai, 2) : null;
    }
}
?>