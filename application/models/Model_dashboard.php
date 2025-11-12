<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        // Load necessary models for student dashboard data
        $this->load->model('Model_tugas');
        $this->load->model('Model_pertemuan');
        $this->load->model('Model_materi');
        $this->load->model('Model_notifikasi');
        $this->load->model('Model_murid');
        $this->load->model('Model_sertifikat');
    }

    public function get_student_dashboard_data($id_murid) {
        $data = [];

        // --- Statistic Cards Data ---
        $data['total_mapel'] = count($this->Model_murid->get_mapel_by_kelas($id_murid));
        $data['tugas_selesai'] = $this->Model_tugas->count_tugas_selesai($id_murid);
        $data['jumlah_sertifikat'] = $this->Model_sertifikat->count_sertifikat_by_murid($id_murid);
        // Poin/XP is a placeholder for now
        $data['poin_xp'] = 1250; 

        // --- Main Content Data ---
        $data['lanjutkan_belajar'] = $this->Model_materi->get_materi_lanjutan($id_murid);
        $data['tugas_mendatang'] = $this->Model_tugas->get_tugas_mendatang($id_murid, 2);
        $data['sertifikat_terbaru'] = $this->Model_sertifikat->get_sertifikat_terbaru($id_murid);
        
        // Existing data fetches
        $data['progress_mapel'] = $this->Model_materi->get_progress_per_mapel($id_murid);
        $data['tugas_belum_dikerjakan'] = $this->Model_tugas->get_jumlah_tugas_belum_dikerjakan($id_murid);
        $data['pertemuan_terdekat'] = $this->Model_pertemuan->get_pertemuan_terdekat($id_murid);
        $data['notifikasi_terbaru'] = $this->Model_notifikasi->get_unread_notifikasi($id_murid);

        return $data;
    }

    // --- Admin Dashboard Functions ---

    public function get_average_progress_per_class()
    {
        $this->db->select('k.nama_kelas, AVG(n.nilai) as rata_rata_nilai');
        $this->db->from('kelas k');
        $this->db->join('murid_kelas mk', 'k.id_kelas = mk.id_kelas');
        $this->db->join('tugas_murid tm', 'mk.id_murid = tm.id_murid');
        $this->db->join('nilai n', 'tm.id_tugas_murid = n.id_tugas_murid', 'left');
        $this->db->where('tm.status', 'Selesai'); // Only consider completed assignments for progress
        $this->db->group_by('k.nama_kelas');
        $this->db->order_by('rata_rata_nilai', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_statistik_absensi()
    {
        $this->db->select('status, COUNT(id_absensi) as jumlah');
        $this->db->from('absensi_guru');
        $this->db->where('MONTH(tanggal)', date('m')); // Current month
        $this->db->where('YEAR(tanggal)', date('Y'));  // Current year
        $this->db->group_by('status');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_top_productive_students($limit = 3)
    {
        $this->db->select('m.nama_murid, AVG(n.nilai) as rata_rata_nilai');
        $this->db->from('murid m');
        $this->db->join('tugas_murid tm', 'm.id_murid = tm.id_murid');
        $this->db->join('nilai n', 'tm.id_tugas_murid = n.id_tugas_murid');
        $this->db->where('tm.status', 'Selesai');
        $this->db->group_by('m.nama_murid');
        $this->db->order_by('rata_rata_nilai', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_recent_absensi_guru($limit = 5)
    {
        $this->db->select('ag.*, g.nama_guru');
        $this->db->from('absensi_guru ag');
        $this->db->join('guru g', 'ag.id_guru = g.id_guru');
        $this->db->order_by('ag.tanggal', 'DESC');
        $this->db->order_by('ag.timestamp', 'DESC'); // Use timestamp for tie-breaking
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>