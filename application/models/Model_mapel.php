<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mapel extends CI_Model {

    public function total_mapel()
    {
        return $this->db->count_all('mapel');
    }

    public function list_mapel()
    {
        $this->db->select('mapel.*, guru.nama_guru as guru');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru', 'left');
        $this->db->order_by('mapel.id_mapel', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function single_mapel($id_mapel)
    {
        $this->db->select('mapel.*, guru.nama_guru as guru');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->row();
    }

    public function add_mapel($data)
    {
        $this->db->insert('mapel', $data);
        return $this->db->insert_id();
    }

    public function update_mapel($id_mapel, $data)
    {
        $this->db->where('id_mapel', $id_mapel);
        $this->db->update('mapel', $data);
        $this->db->reset_query();
    }

    public function delete_mapel($id_mapel)
    {
        $this->db->where('id_mapel', $id_mapel);
        $this->db->delete('mapel');
        $this->db->reset_query();
    }
}
