<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_kelas');
        $this->load->model('Model_guru');
        $this->load->model('Model_mapel');
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
        $data['title'] = 'Data Kelas';
        $data['total_kelas'] = $this->Model_kelas->total_kelas();
        $data['list'] = $this->Model_kelas->list_kelas(); // Pass list of classes for statistics
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/kelas/kelas_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function kelas_daftar()
    {
        $list = $this->Model_kelas->list_kelas();
        $data = array();
        $no = 1;
        foreach ($list as $kelas) {
            $row = array();
            $id_kelas = isset($kelas->id_kelas) ? $kelas->id_kelas : '';
            $row['id_kelas'] = $id_kelas;
            $row['no'] = $no++;
            $row['nama_kelas'] = isset($kelas->nama_kelas) ? $kelas->nama_kelas : '';
            $row['tahun_ajaran'] = isset($kelas->tahun_ajaran) ? $kelas->tahun_ajaran : '';
            $row['jumlah_murid'] = isset($kelas->jumlah_murid) ? $kelas->jumlah_murid : 0;
            $row['guru_wali'] = isset($kelas->guru_wali) ? $kelas->guru_wali : 'Belum Ditentukan';
            $row['aksi'] = '<button class="btn btn-info btn-sm btn-kelas-detail" data-id="'.$id_kelas.'"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span></button>
                           <button class="btn btn-warning btn-sm btn-kelas-edit" data-id="'.$id_kelas.'"><i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit</span></button>
                           <button class="btn btn-danger btn-sm btn-kelas-hapus" data-id="'.$id_kelas.'"><i class="fas fa-trash"></i> <span class="d-none d-md-inline">Hapus</span></button>';
            $data[] = $row;
        }

        $response = array("data" => $data);
        $this->set_output($response);
    }

    public function kelas_add()
    {
        $data['guru_list'] = $this->Model_guru->list_guru();
        $data['all_mapel'] = $this->Model_mapel->list_mapel();
        $this->load->view('admin/kelas/kelas_add', $data);
    }

    public function kelas_addsave()
    {
        $data = array(
            'nama_kelas' => $this->input->post('nama_kelas'),
            'tahun_ajaran' => $this->input->post('tahun_ajaran'),
            'id_guru_wali' => $this->input->post('id_guru_wali')
        );

        $new_kelas_id = $this->Model_kelas->add_kelas($data);

        // Save the associated mapel
        $mapel_ids = $this->input->post('mapel_ids');
        if ($new_kelas_id && !empty($mapel_ids)) {
            $this->Model_kelas->update_kelas_mapel($new_kelas_id, $mapel_ids);
        }

        $response = array(
            'status' => 'sukses',
            'pesan'  => 'Data kelas berhasil ditambahkan'
        );
        $this->set_output($response);
    }

    public function kelas_edit($id_kelas)
    {
        if(!$id_kelas) exit;

        $check_kelas = $this->Model_kelas->single_kelas($id_kelas);

        if(!$check_kelas) {
            echo '<div class="modal-body"><p class="text-center">Data kelas tidak ditemukan!</p></div>';
            exit;
        }

        $data['kelas'] = $check_kelas;
        $data['guru_list'] = $this->Model_guru->list_guru();
        $data['all_mapel'] = $this->Model_mapel->list_mapel();
        $data['kelas_mapel_ids'] = $this->Model_kelas->get_mapel_ids_by_kelas($id_kelas);
        $this->load->view('admin/kelas/kelas_edit', $data);
    }

    public function kelas_editsave()
    {
        $id_kelas = $this->input->post('id_kelas');

        $data = array(
            'nama_kelas'   => $this->input->post('nama_kelas'),
            'tahun_ajaran'       => $this->input->post('tahun_ajaran'),
            'id_guru_wali' => $this->input->post('id_guru_wali')
        );

        $this->Model_kelas->update_kelas($id_kelas, $data);

        // Save the associated mapel
        $mapel_ids = $this->input->post('mapel_ids');
        $this->Model_kelas->update_kelas_mapel($id_kelas, $mapel_ids);

        $response = array(
            'status' => 'sukses',
            'pesan'  => 'Data kelas berhasil diperbarui'
        );
        $this->set_output($response);
    }

    public function kelas_delete_post()
    {
        $id_kelas = $this->input->post('id_kelas');

        if ($id_kelas) {
            $this->Model_kelas->delete_kelas($id_kelas);
            $response = array(
                'status' => 'sukses',
                'pesan'  => 'Data kelas berhasil dihapus'
            );
        } else {
            $response = array(
                'status' => 'gagal',
                'pesan'  => 'ID kelas tidak ditemukan'
            );
        }

        $this->set_output($response);
    }
    
    public function kelas_detail($id_kelas)
    {
        if(!$id_kelas) exit;

        $check_kelas = $this->Model_kelas->single_kelas_detail($id_kelas);

        if(!$check_kelas) {
            echo '<div class="modal-body"><p class="text-center">Data kelas tidak ditemukan!</p></div>';
            exit;
        }

        $data['kelas'] = $check_kelas;
        $data['mapel_progress'] = $this->Model_kelas->get_mapel_with_avg_progress($id_kelas);
        $data['daftar_murid'] = $this->Model_kelas->get_daftar_murid($id_kelas);
        $this->load->view('admin/kelas/kelas_detail', $data);
    }

    public function export_pdf()
    {
        // Load Dompdf library
        require_once APPPATH.'../vendor/autoload.php';
        $dompdf = new Dompdf\Dompdf();

        // Fetch kelas data
        $data['kelas_data'] = $this->Model_kelas->list_kelas();

        // Load view for PDF content
        $html = $this->load->view('admin/kelas/export_pdf', $data, true);

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("data_kelas.pdf", array("Attachment" => 0));
    }

    public function export_excel()
    {
        $data['kelas_data'] = $this->Model_kelas->list_kelas();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="data_kelas.xls"');
        header('Cache-Control: max-age=0');
        $this->load->view('admin/kelas/export_excel', $data);
    }

    public function export_word()
    {
        $data['kelas_data'] = $this->Model_kelas->list_kelas();
        header('Content-Type: application/vnd.ms-word');
        header('Content-Disposition: attachment;filename="data_kelas.doc"');
        header('Cache-Control: max-age=0');
        $this->load->view('admin/kelas/export_word', $data);
    }
}