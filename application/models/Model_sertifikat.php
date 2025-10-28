<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sertifikat extends CI_Model {

    public function total_sertifikat()
    {
        return $this->db->count_all('sertifikat');
    }

    public function list_sertifikat()
    {
        $this->db->select('sertifikat.*, mapel.nama_mapel, (SELECT COUNT(id_sertifikat_murid) FROM sertifikat_murid sm WHERE sm.id_sertifikat = sertifikat.id_sertifikat) as jumlah_keluar');
        $this->db->from('sertifikat');
        $this->db->join('mapel', 'mapel.id_mapel = sertifikat.id_mapel', 'left');
        $this->db->order_by('sertifikat.id_sertifikat', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function single_sertifikat($id_sertifikat)
    {
        $this->db->select('sertifikat.*, mapel.nama_mapel');
        $this->db->from('sertifikat');
        $this->db->join('mapel', 'mapel.id_mapel = sertifikat.id_mapel', 'left');
        $this->db->where('sertifikat.id_sertifikat', $id_sertifikat);
        $query = $this->db->get();
        return $query->row();
    }

    public function add_sertifikat($data)
    {
        $this->db->insert('sertifikat', $data);
        return $this->db->insert_id();
    }

    public function update_sertifikat($id_sertifikat, $data)
    {
        $this->db->where('id_sertifikat', $id_sertifikat);
        $this->db->update('sertifikat', $data);
        $this->db->reset_query();
    }

    public function delete_sertifikat($id_sertifikat)
    {
        $this->db->where('id_sertifikat', $id_sertifikat);
        $this->db->delete('sertifikat');
        $this->db->reset_query();
    }

    public function get_issued_certificates($id_sertifikat)
    {
        $this->db->select('sm.*, m.nama_murid, m.email');
        $this->db->from('sertifikat_murid sm');
        $this->db->join('murid m', 'm.id_murid = sm.id_murid');
        $this->db->where('sm.id_sertifikat', $id_sertifikat);
        $query = $this->db->get();
        return $query->result();
    }
}
