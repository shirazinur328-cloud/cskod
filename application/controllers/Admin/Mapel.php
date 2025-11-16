<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        // {
        //     redirect('auth/login');
        // }
        $this->load->model('Model_mapel');
        $this->load->model('Model_guru');
    }

    private function set_output($data)
    {
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
        exit;
    }

    public function index()
    {
        $data['title'] = 'Data Mata Pelajaran';
        $data['total_mapel'] = $this->Model_mapel->total_mapel();
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/mapel/mapel_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function mapel_daftar()
    {
        $list = $this->Model_mapel->list_mapel();
        $data = array();
        $no = 1;
        foreach ($list as $mapel) {
            $row = array();
            $id_mapel = isset($mapel->id_mapel) ? $mapel->id_mapel : '';
            $row['id_mapel'] = $id_mapel;
            $row['no'] = $no++;
            $row['nama_mapel'] = isset($mapel->nama_mapel) ? $mapel->nama_mapel : '';
            $row['deskripsi'] = isset($mapel->deskripsi) ? $mapel->deskripsi : '';
            $row['guru'] = isset($mapel->guru) ? $mapel->guru : '';
            $row['total_pertemuan'] = isset($mapel->total_pertemuan) ? $mapel->total_pertemuan : 0;
            $status_aktif_value = isset($mapel->status_aktif) ? $mapel->status_aktif : 'nonaktif';
            $row['status_aktif'] = ($status_aktif_value == 'aktif') ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Nonaktif</span>';
            $row['aksi'] = '<button class="btn btn-sm btn-detail rounded" style="background-color: #3B82F6; border-color: #3B82F6; color: white; margin: 0 2px;" data-id="'.$id_mapel.'"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span></button>
                           <button class="btn btn-sm btn-edit rounded" style="background-color: #F59E0B; border-color: #F59E0B; color: white; margin: 0 2px;" data-id="'.$id_mapel.'"><i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit</span></button>
                           <button class="btn btn-sm btn-hapus rounded" style="background-color: #EF4444; border-color: #EF4444; color: white; margin: 0 2px;" data-id="'.$id_mapel.'"><i class="fas fa-trash"></i> <span class="d-none d-md-inline">Hapus</span></button>';
            $data[] = $row;
        }

        $response = array("data" => $data);
        $this->set_output($response);
    }

    public function mapel_add()
    {
        $data['gurus'] = $this->Model_guru->list_guru();
        $this->load->view('admin/mapel/mapel_add', $data);
    }

    public function mapel_addsave()
    {
        $data = array(
            'nama_mapel' => $this->input->post('nama_mapel'),
            'id_guru' => $this->input->post('id_guru'),
            'status_aktif' => $this->input->post('status_aktif')
        );

        $this->Model_mapel->add_mapel($data);

        $response = array(
            'status' => 'sukses',
            'pesan'  => 'Data mata pelajaran berhasil ditambahkan'
        );
        $this->set_output($response);
    }

    public function mapel_edit($id_mapel)
    {
        if(!$id_mapel) exit;

        $check_mapel = $this->Model_mapel->single_mapel($id_mapel);

        if(!$check_mapel) {
            echo '<div class="modal-body"><p class="text-center">Data mata pelajaran tidak ditemukan!</p></div>';
            exit;
        }

        $data['mapel'] = $check_mapel;
        $data['gurus'] = $this->Model_guru->list_guru();
        $this->load->view('admin/mapel/mapel_edit', $data);
    }

    public function mapel_editsave()
    {
        $id_mapel = $this->input->post('id_mapel');

        $data = array(
            'nama_mapel'   => $this->input->post('nama_mapel'),
            'deskripsi'       => $this->input->post('deskripsi'),
            'id_guru' => $this->input->post('id_guru'),
            'status_aktif' => $this->input->post('status_aktif')
        );

        $this->Model_mapel->update_mapel($id_mapel, $data);

        $response = array(
            'status' => 'sukses',
            'pesan'  => 'Data mata pelajaran berhasil diperbarui'
        );
        $this->set_output($response);
    }

    public function mapel_delete_post()
    {
        $id_mapel = $this->input->post('id_mapel');

        if ($id_mapel) {
            $this->Model_mapel->delete_mapel($id_mapel);
            $response = array(
                'status' => 'sukses',
                'pesan'  => 'Data mata pelajaran berhasil dihapus'
            );
        } else {
            $response = array(
                'status' => 'gagal',
                'pesan'  => 'ID mata pelajaran tidak ditemukan'
            );
        }

        $this->set_output($response);
    }
    
    public function mapel_detail($id_mapel)
    {
        if(!$id_mapel) exit;

        $check_mapel = $this->Model_mapel->single_mapel_detail($id_mapel);

        if(!$check_mapel) {
            echo '<div class="modal-body"><p class="text-center">Data mata pelajaran tidak ditemukan!</p></div>';
            exit;
        }

        $data['mapel'] = $check_mapel;
        $data['pertemuan_list'] = $this->Model_mapel->get_pertemuan_by_mapel($id_mapel);
        $data['tugas_list'] = $this->Model_mapel->get_tugas_by_mapel($id_mapel);
        $data['average_progress'] = $this->Model_mapel->get_average_progress_by_mapel($id_mapel);
        $data['daftar_murid'] = $this->Model_mapel->get_daftar_murid($id_mapel);
        $data['statistik_nilai'] = $this->Model_mapel->get_statistik_nilai($id_mapel);
        $this->load->view('admin/mapel/mapel_detail', $data);
    }

    public function export_pdf()
    {
        // Load Dompdf library
        require_once APPPATH.'../vendor/autoload.php';
        $dompdf = new Dompdf\Dompdf();

        // Fetch mapel data
        $data['mapel_data'] = $this->Model_mapel->list_mapel();

        // Load view for PDF content
        $html = $this->load->view('admin/mapel/export_pdf', $data, true);

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("data_mapel.pdf", array("Attachment" => 0));
    }

    public function export_excel()
    {
        $data['mapel_data'] = $this->Model_mapel->list_mapel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="data_mapel.xls"');
        header('Cache-Control: max-age=0');
        $this->load->view('admin/mapel/export_excel', $data);
    }

    public function export_word()
    {
        $data['mapel_data'] = $this->Model_mapel->list_mapel();
        header('Content-Type: application/vnd.ms-word');
        header('Content-Disposition: attachment;filename="data_mapel.doc"');
        header('Cache-Control: max-age=0');
        $this->load->view('admin/mapel/export_word', $data);
    }
}