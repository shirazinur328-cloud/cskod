<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_admin extends CI_Model {

    public function single_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        $query = $this->db->get('admin');
        return $query->row();
    }

    public function update_profile($id_admin, $data)
    {
        $this->db->where('id_admin', $id_admin);
        return $this->db->update('admin', $data);
    }

    public function update_password($id_admin, $new_password)
    {
        $this->db->where('id_admin', $id_admin);
        return $this->db->update('admin', ['password' => $new_password]);
    }
}
