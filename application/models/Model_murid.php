<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_murid extends CI_Model {

    public function total_murid()
    {
        return $this->db->count_all('murid');
    }

    public function list_murid()
    {
        $this->db->select('murid.*, kelas.nama_kelas');
        $this->db->from('murid');
        $this->db->join('murid_kelas', 'murid_kelas.id_murid = murid.id_murid', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = murid_kelas.id_kelas', 'left');
        $this->db->order_by('murid.id_murid', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function single_murid($id_murid)
    {
        $this->db->select('murid.*, kelas.nama_kelas, kelas.id_kelas');
        $this->db->from('murid');
        $this->db->join('murid_kelas', 'murid_kelas.id_murid = murid.id_murid', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = murid_kelas.id_kelas', 'left');
        $this->db->where('murid.id_murid', $id_murid);
        $query = $this->db->get();
        return $query->row();
    }

    public function add_murid($data, $id_kelas)
    {
        $this->db->trans_start();
        $this->db->insert('murid', $data);
        $id_murid = $this->db->insert_id();

        if ($id_murid && $id_kelas) {
            $this->db->insert('murid_kelas', array('id_murid' => $id_murid, 'id_kelas' => $id_kelas));
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_murid($id_murid, $data, $id_kelas)
    {
        $this->db->trans_start();
        $this->db->where('id_murid', $id_murid);
        $this->db->update('murid', $data);

        if ($id_kelas) {
            // Check if entry exists in murid_kelas
            $this->db->where('id_murid', $id_murid);
            $query = $this->db->get('murid_kelas');
            if ($query->num_rows() > 0) {
                $this->db->where('id_murid', $id_murid);
                $this->db->update('murid_kelas', array('id_kelas' => $id_kelas));
            } else {
                $this->db->insert('murid_kelas', array('id_murid' => $id_murid, 'id_kelas' => $id_kelas));
            }
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_murid($id_murid)
    {
        $this->db->trans_start();
        $this->db->where('id_murid', $id_murid);
        $this->db->delete('murid');
        $this->db->where('id_murid', $id_murid);
        $this->db->delete('murid_kelas');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}