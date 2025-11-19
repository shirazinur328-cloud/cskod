<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kelas extends CI_Model {

    public function total_kelas()
    {
        return $this->db->count_all('kelas');
    }

    public function list_kelas()
    {
        $this->db->select(
            'kelas.id_kelas, kelas.nama_kelas, kelas.tahun_ajaran, kelas.id_guru_wali, '
            . '(SELECT COUNT(mk.id_murid) FROM murid_kelas mk WHERE mk.id_kelas = kelas.id_kelas) as jumlah_murid, '
            . 'guru.nama_guru as guru_wali'
        );
        $this->db->from('kelas');
        $this->db->join('guru', 'guru.id_guru = kelas.id_guru_wali', 'left');
        $this->db->order_by('kelas.id_kelas', 'desc');
        $query = $this->db->get();
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

    public function single_kelas_detail($id_kelas)
    {
        $this->db->select(
            'kelas.id_kelas, kelas.nama_kelas, kelas.tahun_ajaran, kelas.id_guru_wali, '
            . '(SELECT COUNT(mk.id_murid) FROM murid_kelas mk WHERE mk.id_kelas = kelas.id_kelas) as jumlah_murid, '
            . 'guru.nama_guru as guru_wali'
        );
        $this->db->from('kelas');
        $this->db->join('guru', 'guru.id_guru = kelas.id_guru_wali', 'left');
        $this->db->where('kelas.id_kelas', $id_kelas);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_mapel_with_avg_progress($id_kelas)
    {
        $this->db->select(
            'm.id_mapel, m.nama_mapel, ' .
            // Menghitung total tugas unik untuk mata pelajaran ini
            'COUNT(DISTINCT t.id_tugas) as total_tugas_mapel, ' .
            // Menghitung tugas yang selesai dikerjakan oleh murid di kelas ini
            'COUNT(DISTINCT CASE WHEN tm.status = "Selesai" THEN tm.id_tugas_murid ELSE NULL END) as completed_tugas_mapel, ' .
            // Menghitung total murid di kelas ini (subquery agar tidak terpengaruh JOIN)
            '(SELECT COUNT(id_murid) FROM murid_kelas WHERE id_kelas = ' . $this->db->escape($id_kelas) . ') as total_murid_in_class'
        );
        // Mulai dari tabel relasi kelas dan mapel, ini adalah sumber kebenaran
        $this->db->from('kelas_mapel km');
        // Join untuk mendapatkan nama mapel
        $this->db->join('mapel m', 'km.id_mapel = m.id_mapel', 'left');
        // Join untuk mendapatkan semua tugas yang terkait dengan mapel
        $this->db->join('tugas t', 't.id_mapel = m.id_mapel', 'left');
        
        // Join untuk mendapatkan semua murid di kelas ini
        $this->db->join('murid_kelas mk', 'mk.id_kelas = km.id_kelas', 'left');
        
        // Join untuk mendapatkan status pengerjaan tugas oleh murid-murid tersebut
        $this->db->join('tugas_murid tm', 'tm.id_tugas = t.id_tugas AND tm.id_murid = mk.id_murid', 'left');

        // Filter utama berdasarkan ID kelas
        $this->db->where('km.id_kelas', $id_kelas);
        // Grouping hasil berdasarkan mapel
        $this->db->group_by('m.id_mapel, m.nama_mapel');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_daftar_murid($id_kelas)
    {
        $this->db->select('murid.id_murid, murid.nama_murid');
        $this->db->from('murid_kelas');
        $this->db->join('murid', 'murid.id_murid = murid_kelas.id_murid');
        $this->db->where('murid_kelas.id_kelas', $id_kelas);
        $this->db->order_by('murid.nama_murid', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_mapel_ids_by_kelas($id_kelas)
    {
        $this->db->select('id_mapel');
        $this->db->from('kelas_mapel');
        $this->db->where('id_kelas', $id_kelas);
        $query = $this->db->get();
        
        $ids = array();
        foreach ($query->result() as $row) {
            $ids[] = $row->id_mapel;
        }
        return $ids;
    }

    public function update_kelas_mapel($id_kelas, $mapel_ids)
    {
        $this->db->trans_start();

        // First, delete existing relations for this class
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('kelas_mapel');

        // Then, insert the new relations if any are provided
        if (!empty($mapel_ids)) {
            $data_to_insert = array();
            foreach ($mapel_ids as $id_mapel) {
                $data_to_insert[] = array(
                    'id_kelas' => $id_kelas,
                    'id_mapel' => $id_mapel
                );
            }
            $this->db->insert_batch('kelas_mapel', $data_to_insert);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function list_kelas_with_details()
    {
        $this->db->select(
            'kelas.id_kelas, kelas.nama_kelas, kelas.tahun_ajaran, '
            . 'guru.nama_guru as nama_guru_wali, '
            . '(SELECT COUNT(mk.id_murid) FROM murid_kelas mk WHERE mk.id_kelas = kelas.id_kelas) as jumlah_murid, '
            . '(SELECT COUNT(km.id_mapel) FROM kelas_mapel km WHERE km.id_kelas = kelas.id_kelas) as jumlah_mapel'
        );
        $this->db->from('kelas');
        $this->db->join('guru', 'guru.id_guru = kelas.id_guru_wali', 'left');
        $this->db->order_by('kelas.id_kelas', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}