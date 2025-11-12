<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notifikasi extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_notifikasi($id_murid) {
        $this->db->where('id_murid', $id_murid);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('notifikasi')->result_array();
    }

    public function get_unread_notifikasi($id_murid) {
        $this->db->where('id_murid', $id_murid);
        $this->db->where('is_read', 0);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('notifikasi')->result_array();
    }

    public function insert_notifikasi($data) {
        return $this->db->insert('notifikasi', $data);
    }

    public function mark_as_read($id_notifikasi) {
        $this->db->where('id_notifikasi', $id_notifikasi);
        return $this->db->update('notifikasi', array('is_read' => 1));
    }

    public function delete_notifikasi($id_notifikasi) {
        $this->db->where('id_notifikasi', $id_notifikasi);
        return $this->db->delete('notifikasi');
    }
}
?>