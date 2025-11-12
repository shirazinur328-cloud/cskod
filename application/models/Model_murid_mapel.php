<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_murid_mapel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all subjects for a specific student based on their class
     * This function joins murid -> murid_kelas -> kelas -> mapel to get subjects assigned to the class
     */
    public function get_subjects_by_student_id($id_murid)
    {
        $this->db->select('m.id_mapel, m.nama_mapel, m.deskripsi, g.nama_guru, g.id_guru');
        $this->db->from('mapel m');
        $this->db->join('guru g', 'm.id_guru = g.id_guru', 'left');
        $this->db->join('murid_mapel mm', 'm.id_mapel = mm.id_mapel', 'inner');
        $this->db->where('mm.id_murid', $id_murid);
        $this->db->order_by('m.nama_mapel', 'asc');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Alternative function that gets subjects through class relationship
     * This joins murid -> murid_kelas -> kelas -> mapel for subjects assigned to the class
     */
    public function get_subjects_by_student_class($id_murid)
    {
        $this->db->select('DISTINCT m.id_mapel, m.nama_mapel, m.deskripsi, g.nama_guru, g.id_guru');
        $this->db->from('mapel m');
        $this->db->join('guru g', 'm.id_guru = g.id_guru', 'left');
        $this->db->join('murid_mapel mm', 'm.id_mapel = mm.id_mapel', 'inner');
        $this->db->where('mm.id_murid', $id_murid);
        $this->db->order_by('m.nama_mapel', 'asc');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get a specific subject by ID for a student to ensure access
     */
    public function get_subject_by_id_for_student($id_mapel, $id_murid)
    {
        // Subquery to get the class IDs the student is enrolled in
        $this->db->select('km.id_mapel');
        $this->db->from('murid_kelas mk');
        $this->db->join('kelas_mapel km', 'mk.id_kelas = km.id_kelas');
        $this->db->where('mk.id_murid', $id_murid);
        $sub_query = $this->db->get_compiled_select();

        // Main query to get the subject details
        $this->db->select('m.id_mapel, m.nama_mapel, m.deskripsi, m.status_aktif, g.nama_guru, g.id_guru');
        $this->db->from('mapel m');
        $this->db->join('guru g', 'm.id_guru = g.id_guru', 'left');
        $this->db->where('m.id_mapel', $id_mapel);
        // Ensure the requested mapel is in the list of subjects accessible to the student
        $this->db->where("m.id_mapel IN ($sub_query)", NULL, FALSE);
        
        $query = $this->db->get();
        return $query->row_array();
    }
    
    /**
     * Get meetings for a specific subject
     */
    public function get_meetings_by_subject($id_mapel, $id_murid)
    {
        // First, get the student's class ID
        $this->db->select('id_kelas')->from('murid_kelas')->where('id_murid', $id_murid);
        $sub_query = $this->db->get_compiled_select();

        // Now, get meetings for the mapel that are in the student's class
        $this->db->select('p.id_pertemuan, p.nama_pertemuan, p.tanggal, p.deskripsi');
        $this->db->from('pertemuan p');
        $this->db->join('kelas_mapel km', 'p.id_mapel = km.id_mapel');
        $this->db->where('p.id_mapel', $id_mapel);
        $this->db->where("km.id_kelas IN ($sub_query)", NULL, FALSE);
        //$this->db->order_by('p.tanggal', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * Get materials for a specific meeting
     */
    public function get_materials_by_meeting($id_pertemuan)
    {
        $this->db->select('m.id_materi, m.judul_materi, m.deskripsi, m.file_materi, m.tipe_file, m.status, m.updated_at');
        $this->db->from('materi m');
        $this->db->where('m.id_pertemuan', $id_pertemuan);
        $this->db->where('m.status', 'aktif');
        $this->db->order_by('m.updated_at', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * Get assignments for a specific meeting
     */
    public function get_assignments_by_meeting($id_pertemuan)
    {
        $this->db->select('t.id_tugas, t.judul_tugas, t.deskripsi, t.deadline, t.status, t.updated_at');
        $this->db->from('tugas t');
        $this->db->where('t.id_pertemuan', $id_pertemuan);
        $this->db->where('t.status', 'aktif');
        $this->db->order_by('t.deadline', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }
}
