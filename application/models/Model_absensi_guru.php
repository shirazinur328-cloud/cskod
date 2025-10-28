<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_absensi_guru extends CI_Model {

    public function get_absensi_by_guru($id_guru)
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->order_by('tanggal', 'desc');
        $query = $this->db->get('absensi_guru');
        return $query->result();
    }

    public function get_absensi_by_date($tanggal)
    {
        $this->db->select('absensi_guru.*, guru.nama_guru');
        $this->db->from('absensi_guru');
        $this->db->join('guru', 'guru.id_guru = absensi_guru.id_guru');
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get();
        // Return result as an array indexed by id_guru for easier lookup in the view
        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->id_guru] = $row;
        }
        return $result;
    }

    public function simpan_absensi($id_guru, $tanggal, $status, $keterangan)
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->where('tanggal', $tanggal);
        $q = $this->db->get('absensi_guru');

        if ($q->num_rows() > 0) {
            // Data already exists, update it
            $this->db->where('id_guru', $id_guru);
            $this->db->where('tanggal', $tanggal);
            $this->db->update('absensi_guru', array('status' => $status, 'keterangan' => $keterangan));
        } else {
            // Data doesn't exist, insert it
            $this->db->set('id_guru', $id_guru);
            $this->db->set('tanggal', $tanggal);
            $this->db->set('status', $status);
            $this->db->set('keterangan', $keterangan);
            $this->db->insert('absensi_guru');
        }
    }

    public function get_statistik_absensi($bulan, $tahun)
    {
        $this->db->select('id_guru, 
            SUM(CASE WHEN status = \'Hadir\' THEN 1 ELSE 0 END) as hadir,
            SUM(CASE WHEN status = \'Sakit\' THEN 1 ELSE 0 END) as sakit,
            SUM(CASE WHEN status = \'Izin\' THEN 1 ELSE 0 END) as izin,
            SUM(CASE WHEN status = \'Alpa\' THEN 1 ELSE 0 END) as alpa
        ');
        $this->db->from('absensi_guru');
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->group_by('id_guru');
        $query = $this->db->get();
        
        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->id_guru] = $row;
        }
        return $result;
    }

    public function get_absensi_by_month($bulan, $tahun)
    {
        $this->db->select('absensi_guru.*, guru.nama_guru');
        $this->db->from('absensi_guru');
        $this->db->join('guru', 'guru.id_guru = absensi_guru.id_guru');
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->order_by('tanggal', 'asc');
        $this->db->order_by('guru.nama_guru', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
}
