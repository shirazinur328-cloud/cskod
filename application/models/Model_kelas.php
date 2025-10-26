<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kelas extends CI_Model {

    public function total_kelas()
    {
        return $this->db->count_all('kelas');
    }

    public function list_kelas()
    {
        $this->db->order_by('id_kelas', 'desc');
        $query = $this->db->get('kelas');
        return $query->result();
    }

    public function single_kelas($id_kelas)
    {
        $this->db->where('id_kelas', $id_kelas);
        $query = $this->db->get('kelas');
        return $query->row();
    }

    public function add_kelas($data)
    {
        $this->db->insert('kelas', $data);
        return $this->db->insert_id();
    }

    public function update_kelas($id_kelas, $data)
    {
        $this->db->where('id_kelas', $id_kelas);
        $this->db->update('kelas', $data);
        $this->db->reset_query();
    }

    public function delete_kelas($id_kelas)
    {
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('kelas');
        $this->db->reset_query();
    }
}