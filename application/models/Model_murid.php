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
            . '(SELECT COUNT(DISTINCT tm.id_tugas) FROM tugas_murid tm WHERE tm.id_murid = murid.id_murid AND tm.status = "Selesai") as completed_tugas'
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

    public function update_profile($id_murid, $data)
    {
        $this->db->where('id_murid', $id_murid);
        return $this->db->update('murid', $data);
    }

    public function get_progress_per_mapel($id_murid)
    {
        $this->db->select(
            'm.id_mapel, m.nama_mapel, '
            . '(SELECT COUNT(t.id_tugas) FROM tugas t WHERE t.id_mapel = m.id_mapel) as total_tugas_mapel, '
            . '(SELECT COUNT(tm.id_tugas_murid) FROM tugas_murid tm JOIN tugas t ON tm.id_tugas = t.id_tugas WHERE tm.id_murid = '.$id_murid.' AND t.id_mapel = m.id_mapel AND tm.status = "Selesai") as completed_tugas_mapel'
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
        $this->db->join('tugas_murid', 'nilai.id_tugas_murid = tugas_murid.id_tugas_murid');
        $this->db->join('tugas', 'tugas_murid.id_tugas = tugas.id_tugas');
        $this->db->join('mapel', 'tugas.id_mapel = mapel.id_mapel');
        $this->db->where('tugas_murid.id_murid', $id_murid);
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

    public function get_mapel_by_kelas($id_murid)
    {
        if (empty($id_murid)) {
            return [];
        }

        $this->db->select('map.id_mapel, map.nama_mapel, map.status_aktif, g.nama_guru, COUNT(m.id_materi) as total_materi, SUM(CASE WHEN mm.status = "Selesai" THEN 1 ELSE 0 END) as materi_selesai');
        $this->db->from('murid_kelas mk');
        $this->db->join('kelas_mapel km', 'mk.id_kelas = km.id_kelas');
        $this->db->join('mapel map', 'km.id_mapel = map.id_mapel');
        $this->db->join('guru g', 'map.id_guru = g.id_guru', 'left');
        $this->db->join('materi m', 'map.id_mapel = m.id_mapel', 'left');
        $this->db->join('materi_murid mm', 'm.id_materi = mm.id_materi AND mm.id_murid = ' . (int)$id_murid, 'left');
        $this->db->where('mk.id_murid', (int)$id_murid);
        $this->db->where('map.status_aktif', 'aktif'); // Filter for active subjects
        $this->db->group_by('map.id_mapel, map.nama_mapel, map.status_aktif, g.nama_guru');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_grades_by_murid($id_murid)
    {
        $this->db->select('
            t.judul_tugas,
            m.nama_mapel,
            k.nama_kelas,
            tm.nilai,
            tm.status,
            tm.komentar_guru,
            tm.submitted_at
        ');
        $this->db->from('tugas_murid tm');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->join('pertemuan p', 't.id_pertemuan = p.id_pertemuan');
        $this->db->join('kelas k', 'p.id_kelas = k.id_kelas');
        $this->db->where('tm.id_murid', $id_murid);
        $this->db->where_in('tm.status', ['Dinilai', 'Revisi']); // Only show graded or revised assignments
        $this->db->order_by('tm.submitted_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_assignment_completion_stats($id_murid)
    {
        $this->db->select('
            COUNT(DISTINCT t.id_tugas) as total_assignments,
            COUNT(DISTINCT CASE WHEN tm.status = "Selesai" THEN t.id_tugas END) as completed_assignments
        ');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->join('kelas_mapel km', 'm.id_mapel = km.id_mapel');
        $this->db->join('murid_kelas mk', 'km.id_kelas = mk.id_kelas');
        $this->db->join('tugas_murid tm', 't.id_tugas = tm.id_tugas AND tm.id_murid = mk.id_murid', 'left');
        $this->db->where('mk.id_murid', $id_murid);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_average_grade($id_murid)
    {
        $this->db->select('AVG(tm.nilai) as average_grade');
        $this->db->from('tugas_murid tm');
        $this->db->where('tm.id_murid', $id_murid);
        $this->db->where('tm.status', 'Dinilai'); // Only consider graded assignments
        $query = $this->db->get();
        return $query->row()->average_grade;
    }

    public function list_murid_filtered($filter_kelas = null, $search_nama = null, $filter_status = null)
    {
        $this->db->select(
            'murid.*, kelas.nama_kelas, '
            . '(SELECT COUNT(DISTINCT t.id_tugas) FROM tugas t JOIN murid_mapel mm ON t.id_mapel = mm.id_mapel WHERE mm.id_murid = murid.id_murid) as total_tugas, '
            . '(SELECT COUNT(DISTINCT tm.id_tugas) FROM tugas_murid tm WHERE tm.id_murid = murid.id_murid AND tm.status = "Selesai") as completed_tugas'
        );
        $this->db->from('murid');
        $this->db->join('murid_kelas', 'murid_kelas.id_murid = murid.id_murid', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = murid_kelas.id_kelas', 'left');

        // Apply filters
        if ($filter_kelas) {
            $this->db->where('kelas.id_kelas', $filter_kelas);
        }
        if ($search_nama) {
            $this->db->like('murid.nama_murid', $search_nama);
        }
        if ($filter_status) {
            $this->db->where('murid.status', $filter_status);
        }

        $this->db->order_by('murid.id_murid', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}