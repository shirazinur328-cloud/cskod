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

    public function get_last_activity($id_murid)
    {
        // Get last completed assignment
        $this->db->select('
            "tugas" as type,
            t.judul_tugas as title,
            m.nama_mapel as mapel_name,
            tm.submitted_at as timestamp
        ');
        $this->db->from('tugas_murid tm');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->where('tm.id_murid', $id_murid);
        $this->db->where('tm.status', 'Selesai'); // Assuming 'Selesai' means completed
        $this->db->order_by('tm.submitted_at', 'DESC');
        $this->db->limit(1);
        $last_tugas = $this->db->get()->row_array();

        // Get last completed material
        $this->db->select('
            "materi" as type,
            mt.judul_materi as title,
            m.nama_mapel as mapel_name,
            mm.completed_at as timestamp
        ');
        $this->db->from('materi_murid mm');
        $this->db->join('materi mt', 'mm.id_materi = mt.id_materi');
        $this->db->join('mapel m', 'mt.id_mapel = m.id_mapel');
        $this->db->where('mm.id_murid', $id_murid);
        $this->db->where('mm.status', 'Selesai'); // Assuming 'Selesai' means completed
        $this->db->order_by('mm.completed_at', 'DESC');
        $this->db->limit(1);
        $last_materi = $this->db->get()->row_array();

        // Compare and return the most recent one
        if ($last_tugas && $last_materi) {
            return ($last_tugas['timestamp'] > $last_materi['timestamp']) ? $last_tugas : $last_materi;
        } elseif ($last_tugas) {
            return $last_tugas;
        } elseif ($last_materi) {
            return $last_materi;
        }
        return null;
    }

    public function get_recent_activities($id_murid, $limit = 5)
    {
        // Get last completed assignments
        $this->db->select('
            "tugas" as type,
            t.judul_tugas as title,
            m.nama_mapel as mapel_name,
            tm.submitted_at as timestamp
        ');
        $this->db->from('tugas_murid tm');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->where('tm.id_murid', $id_murid);
        $this->db->where('tm.status', 'Selesai');
        $last_tugas_query = $this->db->get_compiled_select();

        // Get last completed materials
        $this->db->select('
            "materi" as type,
            mt.judul_materi as title,
            m.nama_mapel as mapel_name,
            mm.completed_at as timestamp
        ');
        $this->db->from('materi_murid mm');
        $this->db->join('materi mt', 'mm.id_materi = mt.id_materi');
        $this->db->join('mapel m', 'mt.id_mapel = m.id_mapel');
        $this->db->where('mm.id_murid', $id_murid);
        $this->db->where('mm.status', 'Selesai');
        $last_materi_query = $this->db->get_compiled_select();

        $query = $this->db->query($last_tugas_query . ' UNION ALL ' . $last_materi_query . ' ORDER BY timestamp DESC LIMIT ' . $limit);
        $activities = $query->result();

        // Format the activities
        $formatted_activities = [];
        foreach ($activities as $activity) {
            $formatted_activity = new stdClass();
            if ($activity->type == 'tugas') {
                $formatted_activity->icon = 'fa-tasks';
                $formatted_activity->icon_color = 'text-primary';
                $formatted_activity->description = 'Mengerjakan tugas <strong>' . htmlspecialchars($activity->title) . '</strong>';
            } else {
                $formatted_activity->icon = 'fa-book-reader';
                $formatted_activity->icon_color = 'text-info';
                $formatted_activity->description = 'Membaca materi <strong>' . htmlspecialchars($activity->title) . '</strong>';
            }
            $formatted_activity->time_ago = $this->time_ago($activity->timestamp);
            $formatted_activities[] = $formatted_activity;
        }

        return $formatted_activities;
    }

    private function time_ago($timestamp) {
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
        $minutes      = round($seconds / 60 );
        $hours           = round($seconds / 3600);
        $days          = round($seconds / 86400);
        $weeks          = round($seconds / 604800);
        $months      = round($seconds / 2629440);
        $years          = round($seconds / 31553280);

        if($seconds <= 60) return "Baru saja";
        else if($minutes <=60) return ($minutes==1) ? "1 menit lalu" : "$minutes menit lalu";
        else if($hours <=24) return ($hours==1) ? "1 jam lalu" : "$hours jam lalu";
        else if($days <= 7) return ($days==1) ? "Kemarin" : "$days hari lalu";
        else if($weeks <= 4.3) return ($weeks==1) ? "1 minggu lalu" : "$weeks minggu lalu";
        else if($months <=12) return ($months==1) ? "1 bulan lalu" : "$months bulan lalu";
        else return ($years==1) ? "1 tahun lalu" : "$years tahun lalu";
    }
}
?>