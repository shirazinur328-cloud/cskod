<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_guru extends CI_Model {

    public function total_guru()
    {
        return $this->db->count_all('guru');
    }

    public function list_guru($id_mapel = null)
    {
        $this->db->select('guru.*, GROUP_CONCAT(DISTINCT mapel.nama_mapel SEPARATOR ", ") as mapel_diajarkan');
        $this->db->from('guru');
        $this->db->join('mapel', 'mapel.id_guru = guru.id_guru', 'left');
        if ($id_mapel) {
            $this->db->where('mapel.id_mapel', $id_mapel);
        }
        $this->db->group_by('guru.id_guru');
        $this->db->order_by('guru.id_guru', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function single_guru($id_guru)
    {
        $this->db->select('*'); // Pilih kolom yang ada
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

    public function update_profile($id_guru, $data)
    {
        $this->db->where('id_guru', $id_guru);
        return $this->db->update('guru', $data);
    }

    public function update_password($id_guru, $new_password)
    {
        $this->db->where('id_guru', $id_guru);
        return $this->db->update('guru', ['password' => $new_password]);
    }

    public function get_all_guru()
    {
        $this->db->where('status', 'aktif');
        $this->db->order_by('nama_guru', 'asc');
        $query = $this->db->get('guru');
        return $query->result();
    }

    public function get_performa_kelas($id_guru)
    {
        $this->db->select(
            'mapel.id_mapel, 
            mapel.nama_mapel, 
            COUNT(DISTINCT tugas.id_tugas) as jumlah_tugas, 
            COUNT(DISTINCT tugas_murid.id_tugas_murid) as jumlah_submission, 
            AVG(nilai.nilai) as rata_rata_nilai'
        );
        $this->db->from('mapel');
        $this->db->join('tugas', 'mapel.id_mapel = tugas.id_mapel', 'left');
        $this->db->join('tugas_murid', 'tugas.id_tugas = tugas_murid.id_tugas', 'left');
        $this->db->join('nilai', 'tugas_murid.id_tugas_murid = nilai.id_tugas_murid', 'left');
        $this->db->where('mapel.id_guru', $id_guru);
        $this->db->group_by('mapel.id_mapel');
        $this->db->order_by('mapel.nama_mapel', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_mapel_by_guru($id_guru)
    {
        $this->db->from('mapel');
        $this->db->where('id_guru', $id_guru);
        return $this->db->count_all_results();
    }

    public function get_mapel_kelas_by_guru($id_guru, $tingkatan = null)
    {
        $this->db->select('
            m.id_mapel,
            m.nama_mapel,
            m.status_aktif,
            k.id_kelas,
            k.nama_kelas,
            k.tahun_ajaran
        ');
        $this->db->from('mapel m');
        $this->db->join('kelas_mapel km', 'm.id_mapel = km.id_mapel');
        $this->db->join('kelas k', 'km.id_kelas = k.id_kelas');
        $this->db->where('m.id_guru', $id_guru);
        $this->db->where('m.status_aktif', 'aktif');
        if ($tingkatan !== null) {
            $this->db->like('k.nama_kelas', $tingkatan . '%', 'after');
        }
        $this->db->order_by('m.nama_mapel, k.nama_kelas', 'asc');
        $query = $this->db->get();

        $result = [];
        foreach ($query->result() as $row) {
            $result[] = $row;
        }
        return $result;
    }

    public function get_all_tugas_by_guru($id_guru)
    {
        $this->db->select('
            tugas.id_tugas,
            tugas.judul_tugas,
            mapel.nama_mapel,
            kelas.nama_kelas
        ');
        $this->db->from('tugas');
        $this->db->join('mapel', 'tugas.id_mapel = mapel.id_mapel');
        $this->db->join('pertemuan', 'tugas.id_pertemuan = pertemuan.id_pertemuan');
        $this->db->join('kelas', 'pertemuan.id_kelas = kelas.id_kelas');
        $this->db->where('mapel.id_guru', $id_guru);
        $this->db->order_by('tugas.updated_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_kelas_by_guru($id_guru)
    {
        $this->db->select('COUNT(DISTINCT km.id_kelas) as total_kelas');
        $this->db->from('mapel m');
        $this->db->join('kelas_mapel km', 'm.id_mapel = km.id_mapel');
        $this->db->where('m.id_guru', $id_guru);
        $query = $this->db->get();
        return $query->row()->total_kelas;
    }

    public function get_jadwal_hari_ini($id_guru)
    {
        $this->db->select('
            p.id_pertemuan,
            p.nama_pertemuan as judul_pertemuan,
            p.tanggal,
            k.nama_kelas,
            m.nama_mapel
        ');
        $this->db->from('pertemuan p');
        $this->db->join('kelas k', 'p.id_kelas = k.id_kelas');
        $this->db->join('kelas_mapel km', 'k.id_kelas = km.id_kelas');
        $this->db->join('mapel m', 'km.id_mapel = m.id_mapel');
        $this->db->where('m.id_guru', $id_guru);
        $this->db->where('p.tanggal', date('Y-m-d')); // Filter for today's date
        $this->db->order_by('p.tanggal', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_student_performance_data($id_guru)
    {
        $this->db->select('
            m.id_murid,
            m.nama_murid,
            AVG(tm.nilai) as average_nilai_siswa
        ');
        $this->db->from('murid m');
        $this->db->join('tugas_murid tm', 'm.id_murid = tm.id_murid');
        $this->db->join('tugas t', 'tm.id_tugas = t.id_tugas');
        $this->db->join('mapel map', 't.id_mapel = map.id_mapel');
        $this->db->where('map.id_guru', $id_guru);
        $this->db->where('tm.nilai IS NOT NULL'); // Hanya siswa yang sudah dinilai
        
        $this->db->group_by('m.id_murid, m.nama_murid');
        $this->db->order_by('m.nama_murid', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_tugas_by_guru($id_guru)
    {
        $this->db->select('COUNT(t.id_tugas) as total_tugas');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 't.id_mapel = m.id_mapel');
        $this->db->where('m.id_guru', $id_guru);
        $query = $this->db->get();
        return $query->row()->total_tugas;
    }

        public function get_tingkatan_kelas_by_guru($id_guru)

        {

            $this->db->select('DISTINCT SUBSTRING_INDEX(k.nama_kelas, " ", 1) as tingkatan_kelas');

            $this->db->from('kelas k');

            $this->db->join('kelas_mapel km', 'k.id_kelas = km.id_kelas');

            $this->db->join('mapel m', 'km.id_mapel = m.id_mapel');

            $this->db->where('m.id_guru', $id_guru);

            $this->db->order_by('tingkatan_kelas', 'ASC');

            $query = $this->db->get();

            return $query->result();

        }

    

        public function get_progres_kelas($id_guru)

        {

            $this->db->select('k.nama_kelas, ROUND(AVG(tm.nilai), 0) as progress');

            $this->db->from('kelas k');

            $this->db->join('kelas_mapel km', 'k.id_kelas = km.id_kelas');

            $this->db->join('mapel m', 'km.id_mapel = m.id_mapel');

            $this->db->join('tugas t', 'm.id_mapel = t.id_mapel');

            $this->db->join('tugas_murid tm', 't.id_tugas = tm.id_tugas');

            $this->db->where('m.id_guru', $id_guru);

            $this->db->where('tm.nilai IS NOT NULL');

            $this->db->group_by('k.id_kelas, k.nama_kelas');

            $this->db->order_by('k.nama_kelas', 'ASC');

            $query = $this->db->get();

            return $query->result();

        }

    }

    