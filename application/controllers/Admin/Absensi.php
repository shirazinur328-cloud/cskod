<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin')) {
        	redirect('auth');
        }
        $this->load->model('Model_absensi_guru');
        $this->load->model('Model_guru');
    }

    public function index()
    {
        $data['title'] = 'Absensi Guru';
        
        // Get today's date
        $tanggal = $this->input->get('tanggal') ? $this->input->get('tanggal') : date('Y-m-d');
        $data['tanggal'] = $tanggal;

        $data['daftar_hadir'] = $this->Model_absensi_guru->get_absensi_by_date($tanggal);
        $data['daftar_guru'] = $this->Model_guru->get_all_guru(); // Assumes this method exists

        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/absensi/absensi_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function simpan_absensi()
    {
        $absensi_data = $this->input->post('absensi');
        $tanggal = $this->input->post('tanggal');

        if ($absensi_data) {
            foreach ($absensi_data as $id_guru => $data) {
                $this->Model_absensi_guru->simpan_absensi($id_guru, $tanggal, $data['status'], $data['keterangan']);
            }
        }

        $this->session->set_flashdata('sukses', 'Absensi berhasil disimpan.');
        redirect('admin/absensi?tanggal=' . $tanggal);
    }

    public function statistik()
    {
        $data['title'] = 'Statistik Absensi Guru';

        $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['statistik'] = $this->Model_absensi_guru->get_statistik_absensi($bulan, $tahun);
        $data['daftar_guru'] = $this->Model_guru->get_all_guru();

        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/absensi/absensi_statistik', $data);
        $this->load->view('templates/admin/footer');
    }

    public function export_laporan($bulan, $tahun)
    {
        $absensi_data = $this->Model_absensi_guru->get_absensi_by_month($bulan, $tahun);

        if (empty($absensi_data)) {
            $this->session->set_flashdata('gagal', 'Tidak ada data absensi untuk diekspor pada periode yang dipilih.');
            redirect('admin/absensi/statistik?bulan='.$bulan.'&tahun='.$tahun);
            return;
        }

        $filename = "laporan_absensi_" . $bulan . "_" . $tahun . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID Guru', 'Nama Guru', 'Tanggal', 'Status', 'Keterangan'));

        foreach ($absensi_data as $row) {
            fputcsv($output, array($row->id_guru, $row->nama_guru, $row->tanggal, $row->status, $row->keterangan));
        }
        fclose($output);
    }
}
