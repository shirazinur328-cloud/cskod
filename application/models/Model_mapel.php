<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mapel extends CI_Model {

    public function total_mapel()
    {
        return $this->db->count_all('mapel');
    }

    public function list_mapel()
    {
        $this->db->select('mapel.*, guru.nama_guru as guru, (SELECT COUNT(id_pertemuan) FROM pertemuan WHERE id_mapel = mapel.id_mapel) as total_pertemuan');
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

    public function get_pertemuan_by_mapel($id_mapel)
    {
        $this->db->where('id_mapel', $id_mapel);
        $this->db->order_by('id_pertemuan', 'asc'); // Assuming id_pertemuan is the correct column
        $query = $this->db->get('pertemuan');
        return $query->result();
    }

    public function get_tugas_by_mapel($id_mapel)
    {
        $this->db->where('id_mapel', $id_mapel);
        $this->db->order_by('deadline', 'asc');
        $query = $this->db->get('tugas');
        return $query->result();
    }

    public function get_average_progress_by_mapel($id_mapel)
    {
        $this->db->select(
            '(COUNT(DISTINCT s.id_submission) / COUNT(DISTINCT t.id_tugas)) * 100 as average_progress'
        );
        $this->db->from('tugas t');
        $this->db->join('murid_mapel mm', 'mm.id_mapel = t.id_mapel', 'inner');
        $this->db->join('submission s', 's.id_tugas = t.id_tugas AND s.id_murid = mm.id_murid AND s.status = "submitted"', 'left');
        $this->db->where('t.id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->row()->average_progress;
    }

    public function single_mapel_detail($id_mapel)
    {
        $this->db->select('mapel.*, guru.nama_guru as guru, (SELECT COUNT(id_pertemuan) FROM pertemuan WHERE id_mapel = mapel.id_mapel) as total_pertemuan');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_daftar_murid($id_mapel)
    {
        $this->db->select('murid.id_murid, murid.nama_murid');
        $this->db->from('murid_mapel');
        $this->db->join('murid', 'murid.id_murid = murid_mapel.id_murid');
        $this->db->where('murid_mapel.id_mapel', $id_mapel);
        $this->db->order_by('murid.nama_murid', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_statistik_nilai($id_mapel)
    {
        $this->db->select('AVG(nilai.nilai) as rata_rata, MAX(nilai.nilai) as tertinggi, MIN(nilai.nilai) as terendah');
        $this->db->from('nilai');
        $this->db->join('submission', 'nilai.id_submission = submission.id_submission');
        $this->db->join('tugas', 'submission.id_tugas = tugas.id_tugas');
        $this->db->where('tugas.id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->row();
    }
}
