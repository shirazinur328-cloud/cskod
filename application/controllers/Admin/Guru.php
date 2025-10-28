<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
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
        $data['title'] = 'Data Guru';
        $data['total_guru'] = $this->Model_guru->total_guru();
        $data['mapel_list'] = $this->Model_mapel->list_mapel(); // Fetch all subjects
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/guru/guru_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function guru_daftar()
    {
        $id_mapel = $this->input->get('id_mapel');
        $list = $this->Model_guru->list_guru($id_mapel);
        $data = array();
        $no = 1;
        foreach ($list as $guru) {
            $row = array();
            $id_guru = isset($guru->id_guru) ? $guru->id_guru : '';
            $row['id_guru'] = $id_guru;
            $row['no'] = $no++;
            $row['nama_guru'] = isset($guru->nama_guru) ? $guru->nama_guru : '';
            $row['email'] = isset($guru->email) ? $guru->email : '';
            $row['no_telp'] = isset($guru->no_telp) ? $guru->no_telp : '';

            // Mapel
            $row['mapel'] = isset($guru->mapel_diajarkan) ? $guru->mapel_diajarkan : '-';

            // Status
            $status_value = isset($guru->status) ? $guru->status : 'nonaktif'; // Default to 'nonaktif' if status column doesn't exist
            $status = ($status_value == 'aktif') ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Nonaktif</span>';
            $row['status'] = $status;

            $row['aksi'] = '<button class="btn btn-info btn-sm btn-guru-detail" data-id="'.$id_guru.'"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span></button>
                           <button class="btn btn-warning btn-sm btn-guru-edit" data-id="'.$id_guru.'"><i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit</span></button>
                           <button class="btn btn-danger btn-sm btn-guru-hapus" data-id="'.$id_guru.'"><i class="fas fa-trash"></i> <span class="d-none d-md-inline">Hapus</span></button>';
            $data[] = $row;
        }

        $response = array("data" => $data);
        $this->set_output($response);
    }

    public function guru_add()
    {
        $this->load->view('admin/guru/guru_add');
    }

    public function guru_addsave()
    {
        $data = array(
            'nama_guru' => $this->input->post('nama_guru'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'status' => $this->input->post('status')
        );

        $this->Model_guru->add_guru($data);

        $response = array(
            'status' => 'sukses',
            'pesan'  => 'Data guru berhasil ditambahkan'
        );
        $this->set_output($response);
    }

    public function guru_edit($id_guru)
    {
        if(!$id_guru) exit;

        $check_guru = $this->Model_guru->single_guru($id_guru);

        if(!$check_guru) {
            echo '<div class="modal-body"><p class="text-center">Data guru tidak ditemukan!</p></div>';
            exit;
        }

        $data['guru'] = $check_guru;
        $this->load->view('admin/guru/guru_edit', $data);
    }

    public function guru_editsave()
    {
        $id_guru = $this->input->post('id_guru');

        $data = array(
            'nama_guru'   => $this->input->post('nama_guru'),
            'email'       => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'username' => $this->input->post('username'),
            'status' => $this->input->post('status')
        );

        // Check if password is provided
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->Model_guru->update_guru($id_guru, $data);

        $response = array(
            'status' => 'sukses',
            'pesan'  => 'Data guru berhasil diperbarui'
        );
        $this->set_output($response);
    }

    public function guru_delete_post()
    {
        $id_guru = $this->input->post('id_guru');

        if ($id_guru) {
            $this->Model_guru->delete_guru($id_guru);
            $response = array(
                'status' => 'sukses',
                'pesan'  => 'Data guru berhasil dihapus'
            );
        } else {
            $response = array(
                'status' => 'gagal',
                'pesan'  => 'ID guru tidak ditemukan'
            );
        }

        $this->set_output($response);
    }
    
    public function guru_detail($id_guru)
    {
        if(!$id_guru) exit;

        $this->load->model('Model_absensi_guru'); // Assuming this model exists or will be created

        $check_guru = $this->Model_guru->single_guru($id_guru);

        if(!$check_guru) {
            echo '<div class="modal-body"><p class="text-center">Data guru tidak ditemukan!</p></div>';
            exit;
        }

        $data['guru'] = $check_guru;
        $data['absensi_data'] = $this->Model_absensi_guru->get_absensi_by_guru($id_guru); // Assuming this method exists
        $data['performa_kelas'] = $this->Model_guru->get_performa_kelas($id_guru); // New line for class performance
        $this->load->view('admin/guru/guru_detail', $data);
    }

    public function export_pdf()
    {
        // Load Dompdf library
        require_once APPPATH.'../vendor/autoload.php';
        $dompdf = new Dompdf\Dompdf();

        // Fetch guru data
        $data['guru_data'] = $this->Model_guru->list_guru();

        // Load view for PDF content
        $html = $this->load->view('admin/guru/export_pdf', $data, true);

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("data_guru.pdf", array("Attachment" => 0));
    }

    public function export_excel()
    {
        $data['guru_data'] = $this->Model_guru->list_guru();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="data_guru.xls"');
        header('Cache-Control: max-age=0');
        $this->load->view('admin/guru/export_excel', $data);
    }

    public function export_word()
    {
        $data['guru_data'] = $this->Model_guru->list_guru();
        header('Content-Type: application/vnd.ms-word');
        header('Content-Disposition: attachment;filename="data_guru.doc"');
        header('Cache-Control: max-age=0');
        $this->load->view('admin/guru/export_word', $data);
    }

}