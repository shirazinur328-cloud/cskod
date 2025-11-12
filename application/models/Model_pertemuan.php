<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pertemuan extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_pertemuan() {
        return $this->db->get('pertemuan')->result_array();
    }

    public function get_pertemuan_by_id($id_pertemuan) {
        return $this->db->get_where('pertemuan', array('id_pertemuan' => $id_pertemuan))->row_array();
    }

    public function insert_pertemuan($data) {
        return $this->db->insert('pertemuan', $data);
    }

    public function update_pertemuan($id_pertemuan, $data) {
        $this->db->where('id_pertemuan', $id_pertemuan);
        return $this->db->update('pertemuan', $data);
    }

    public function delete_pertemuan($id_pertemuan) {
        $this->db->where('id_pertemuan', $id_pertemuan);
        return $this->db->delete('pertemuan');
    }

    public function get_pertemuan_terdekat($id_murid) {
        // Assuming a student is linked to subjects via Model_murid_mapel
        // And meetings are linked to subjects
        $this->db->select('p.*, m.nama_mapel');
        $this->db->from('pertemuan p');
        $this->db->join('mapel m', 'p.id_mapel = m.id_mapel');
        $this->db->join('murid_mapel mm', 'm.id_mapel = mm.id_mapel');
        $this->db->where('mm.id_murid', $id_murid);
        $this->db->where('p.tanggal > NOW()'); // Only future meetings
        $this->db->order_by('p.tanggal', 'ASC');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }
}
?>