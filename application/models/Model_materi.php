<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_materi extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_materi() {
        return $this->db->get('materi')->result_array();
    }

    public function get_materi_by_id($id_materi) {
        return $this->db->get_where('materi', array('id_materi' => $id_materi))->row_array();
    }

    public function insert_materi($data) {
        return $this->db->insert('materi', $data);
    }

    public function update_materi($id_materi, $data) {
        $this->db->where('id_materi', $id_materi);
        return $this->db->update('materi', $data);
    }

    public function delete_materi($id_materi) {
        $this->db->where('id_materi', $id_materi);
        return $this->db->delete('materi');
    }

    // --- Materi Murid specific methods ---

    public function get_materi_murid_by_murid_id($id_murid) {
        $this->db->select('mm.*, m.judul_materi, map.nama_mapel');
        $this->db->from('materi_murid mm');
        $this->db->join('materi m', 'mm.id_materi = m.id_materi');
        $this->db->join('mapel map', 'm.id_mapel = map.id_mapel');
        $this->db->where('mm.id_murid', $id_murid);
        return $this->db->get()->result_array();
    }

    public function get_progress_per_mapel($id_murid) {
        $this->db->select('map.id_mapel, map.nama_mapel, guru.nama_guru, COUNT(m.id_materi) as total_materi, SUM(CASE WHEN mm.status = "Selesai" THEN 1 ELSE 0 END) as materi_selesai');
        $this->db->from('mapel map');
        $this->db->join('guru', 'guru.id_guru = map.id_guru', 'left');
        $this->db->join('materi m', 'map.id_mapel = m.id_mapel', 'left');
        $this->db->join('materi_murid mm', 'm.id_materi = mm.id_materi AND mm.id_murid = ' . $id_murid, 'left');
        $this->db->join('murid_mapel mmap', 'map.id_mapel = mmap.id_mapel AND mmap.id_murid = ' . $id_murid);
        $this->db->group_by('map.id_mapel, map.nama_mapel, guru.nama_guru');
        return $this->db->get()->result();
    }

    public function insert_materi_murid($data) {
        return $this->db->insert('materi_murid', $data);
    }

    public function update_materi_murid($id_materi_murid, $data) {
        $this->db->where('id_materi_murid', $id_materi_murid);
        return $this->db->update('materi_murid', $data);
    }

    public function get_subject_progress($id_mapel, $id_murid)
    {
        // Count total materials for the subject
        $total_materi = $this->db->where('id_mapel', $id_mapel)->count_all_results('materi');

        if ($total_materi == 0) {
            return 100; // If no materials, consider it 100% complete
        }

        // Count completed materials for the student in this subject
        $completed_materi = $this->db->from('materi_murid mm')
                                     ->join('materi m', 'mm.id_materi = m.id_materi')
                                     ->where('m.id_mapel', $id_mapel)
                                     ->where('mm.id_murid', $id_murid)
                                     ->where('mm.status', 'Selesai')
                                     ->count_all_results();

        return round(($completed_materi / $total_materi) * 100);
    }

    public function is_material_completed($id_materi, $id_murid)
    {
        $this->db->where('id_materi', $id_materi);
        $this->db->where('id_murid', $id_murid);
        $this->db->where('status', 'Selesai');
        $query = $this->db->get('materi_murid');
        return $query->num_rows() > 0;
    }

    public function mark_materi_as_complete($id_materi, $id_murid)
    {
        $data = [
            'id_materi' => $id_materi,
            'id_murid' => $id_murid,
            'status' => 'Selesai',
            'completed_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_materi', $id_materi);
        $this->db->where('id_murid', $id_murid);
        $query = $this->db->get('materi_murid');

        if ($query->num_rows() > 0) {
            // Record exists, update it
            $this->db->where('id_materi', $id_materi);
            $this->db->where('id_murid', $id_murid);
            return $this->db->update('materi_murid', $data);
        } else {
            // No record, insert new one
            return $this->db->insert('materi_murid', $data);
        }
    }

    public function get_materials_by_mapel($id_mapel) {
        $this->db->where('id_mapel', $id_mapel);
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get('materi')->result_array();
    }

    public function get_materi_by_pertemuan($id_pertemuan) {
        $this->db->where('id_pertemuan', $id_pertemuan);
        return $this->db->get('materi')->result_array();
    }

    public function get_materi_lanjutan($id_murid)
    {
        $this->db->select('m.id_materi, m.judul_materi, map.nama_mapel, (SELECT COUNT(id_materi) FROM materi WHERE id_mapel = m.id_mapel) as total_materi_mapel');
        $this->db->from('materi m');
        $this->db->join('mapel map', 'm.id_mapel = map.id_mapel');
        $this->db->join('murid_mapel mm', 'm.id_mapel = mm.id_mapel');
        $this->db->where('mm.id_murid', $id_murid);
        $this->db->where("m.id_materi NOT IN (SELECT id_materi FROM materi_murid WHERE id_murid = $id_murid AND status = 'Selesai')", NULL, FALSE);
        $this->db->order_by('m.id_materi', 'ASC'); // Order by ID as 'urutan' is missing
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
}
?>