<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_guru extends CI_Model {

    public function total_guru()
    {
        return $this->db->count_all('guru');
    }

    public function list_guru()
    {
        $this->db->order_by('id_guru', 'desc');
        $query = $this->db->get('guru');
        return $query->result();
    }

    public function single_guru($id_guru)
    {
        $this->db->where('id_guru', $id_guru);
        $query = $this->db->get('guru');
        return $query->row();
    }

    public function add_guru($data)
    {
        $this->db->insert('guru', $data);
        return $this->db->insert_id();
    }

    public function update_guru($id_guru, $data)
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->update('guru', $data);
        $this->db->reset_query();
    }

    public function delete_guru($id_guru)
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->delete('guru');
        $this->db->reset_query();
    }
}