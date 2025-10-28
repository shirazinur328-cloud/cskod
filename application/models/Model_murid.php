<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_murid extends CI_Model {

    public function total_murid()
    {
        return $this->db->count_all('murid');
    }

    public function list_murid()
    {
        $this->db->select(
            'murid.*, kelas.nama_kelas, '
            . '(SELECT COUNT(DISTINCT t.id_tugas) FROM tugas t JOIN murid_mapel mm ON t.id_mapel = mm.id_mapel WHERE mm.id_murid = murid.id_murid) as total_tugas, '
            . '(SELECT COUNT(DISTINCT s.id_tugas) FROM submission s WHERE s.id_murid = murid.id_murid AND s.status = "submitted") as completed_tugas'
        );
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

    public function get_progress_per_mapel($id_murid)
    {
        $this->db->select(
            'm.id_mapel, m.nama_mapel, '
            . '(SELECT COUNT(t.id_tugas) FROM tugas t WHERE t.id_mapel = m.id_mapel) as total_tugas_mapel, '
            . '(SELECT COUNT(s.id_submission) FROM submission s JOIN tugas t ON s.id_tugas = t.id_tugas WHERE s.id_murid = '.$id_murid.' AND t.id_mapel = m.id_mapel AND s.status = "submitted") as completed_tugas_mapel'
        );
        $this->db->from('murid_mapel mm');
        $this->db->join('mapel m', 'mm.id_mapel = m.id_mapel');
        $this->db->where('mm.id_murid', $id_murid);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_daftar_nilai($id_murid)
    {
        $this->db->select('mapel.nama_mapel, tugas.judul_tugas, nilai.nilai, nilai.tanggal_nilai');
        $this->db->from('nilai');
        $this->db->join('submission', 'nilai.id_submission = submission.id_submission');
        $this->db->join('tugas', 'submission.id_tugas = tugas.id_tugas');
        $this->db->join('mapel', 'tugas.id_mapel = mapel.id_mapel');
        $this->db->where('submission.id_murid', $id_murid);
        $this->db->order_by('mapel.nama_mapel', 'asc');
        $this->db->order_by('nilai.tanggal_nilai', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_sertifikat($id_murid)
    {
        $this->db->select('s.nama_sertifikat, sm.tanggal_dikeluarkan, sm.status_validasi');
        $this->db->from('sertifikat_murid sm');
        $this->db->join('sertifikat s', 'sm.id_sertifikat = s.id_sertifikat');
        $this->db->where('sm.id_murid', $id_murid);
        $this->db->order_by('sm.tanggal_dikeluarkan', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}