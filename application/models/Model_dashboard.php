<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model {

    public function get_average_progress_per_class()
    {
        $this->db->select('k.nama_kelas, AVG(n.nilai) as rata_rata_nilai');
        $this->db->from('kelas k');
        $this->db->join('murid_kelas mk', 'k.id_kelas = mk.id_kelas');
        $this->db->join('murid m', 'mk.id_murid = m.id_murid');
        $this->db->join('nilai n', 'm.id_murid = n.id_murid', 'left');
        $this->db->group_by('k.id_kelas');
        $this->db->order_by('k.nama_kelas', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_top_productive_students($limit = 3)
    {
        $this->db->select('m.nama_murid, AVG(n.nilai) as rata_rata_nilai');
        $this->db->from('murid m');
        $this->db->join('nilai n', 'm.id_murid = n.id_murid');
        $this->db->group_by('m.id_murid');
        $this->db->order_by('rata_rata_nilai', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_statistik_absensi()
    {
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('absensi_guru');
        $this->db->group_by('status');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_recent_absensi_guru($limit = 5)
    {
        $this->db->select('ag.tanggal, ag.status, ag.keterangan, g.nama_guru');
        $this->db->from('absensi_guru ag');
        $this->db->join('guru g', 'ag.id_guru = g.id_guru');
        $this->db->order_by('ag.tanggal', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
}
