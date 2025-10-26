<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Murid extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_murid');
        $this->load->model('Model_kelas'); // Load Model_kelas to get list of classes
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
        $data['title'] = 'Data Murid';
        $data['total_murid'] = $this->Model_murid->total_murid();
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/murid/murid_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function murid_daftar()
    {
        $list = $this->Model_murid->list_murid();
        $data = array();
        $no = 1;
        foreach ($list as $murid) {
            $row = array();
            $id_murid = isset($murid->id_murid) ? $murid->id_murid : '';
            $row['id_murid'] = $id_murid;
            $row['no'] = $no++;
            $row['nama_murid'] = isset($murid->nama_murid) ? $murid->nama_murid : '';
            $row['email'] = isset($murid->email) ? $murid->email : '';
            $row['no_telp'] = isset($murid->no_telp) ? $murid->no_telp : '';
            $row['nama_kelas'] = isset($murid->nama_kelas) ? $murid->nama_kelas : 'Belum Ada Kelas';
            $row['aksi'] = '<button class="btn btn-info btn-sm btn-murid-detail" data-id="'.$id_murid.'"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span></button>
                           <button class="btn btn-warning btn-sm btn-murid-edit" data-id="'.$id_murid.'"><i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit</span></button>
                           <button class="btn btn-danger btn-sm btn-murid-hapus" data-id="'.$id_murid.'"><i class="fas fa-trash"></i> <span class="d-none d-md-inline">Hapus</span></button>';
            $data[] = $row;
        }

        $response = array("data" => $data);
        $this->set_output($response);
    }

    public function murid_add()
    {
        $data['kelas'] = $this->Model_kelas->list_kelas();
        $this->load->view('admin/murid/murid_add', $data);
    }

    public function murid_addsave()
    {
        $data_murid = array(
            'nama_murid' => $this->input->post('nama_murid'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        );
        $id_kelas = $this->input->post('id_kelas');

        $insert = $this->Model_murid->add_murid($data_murid, $id_kelas);

        if ($insert) {
            $response = array(
                'status' => 'sukses',
                'pesan'  => 'Data murid berhasil ditambahkan'
            );
        } else {
            $response = array(
                'status' => 'gagal',
                'pesan'  => 'Gagal menambahkan data murid'
            );
        }
        $this->set_output($response);
    }

    public function murid_edit($id_murid)
    {
        if(!$id_murid) exit;

        $check_murid = $this->Model_murid->single_murid($id_murid);

        if(!$check_murid) {
            echo '<div class="modal-body"><p class="text-center">Data murid tidak ditemukan!</p></div>';
            exit;
        }

        $data['murid'] = $check_murid;
        $data['kelas'] = $this->Model_kelas->list_kelas();
        $this->load->view('admin/murid/murid_edit', $data);
    }

    public function murid_editsave()
    {
        $id_murid = $this->input->post('id_murid');

        $data_murid = array(
            'nama_murid'   => $this->input->post('nama_murid'),
            'email'       => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'username' => $this->input->post('username')
        );

        // Check if password is provided
        if ($this->input->post('password')) {
            $data_murid['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
        $id_kelas = $this->input->post('id_kelas');

        $update = $this->Model_murid->update_murid($id_murid, $data_murid, $id_kelas);

        if ($update) {
            $response = array(
                'status' => 'sukses',
                'pesan'  => 'Data murid berhasil diperbarui'
            );
        } else {
            $response = array(
                'status' => 'gagal',
                'pesan'  => 'Gagal memperbarui data murid'
            );
        }
        $this->set_output($response);
    }

    public function murid_delete_post()
    {
        $id_murid = $this->input->post('id_murid');

        if ($id_murid) {
            $delete = $this->Model_murid->delete_murid($id_murid);
            if ($delete) {
                $response = array(
                    'status' => 'sukses',
                    'pesan'  => 'Data murid berhasil dihapus'
                );
            } else {
                $response = array(
                    'status' => 'gagal',
                    'pesan'  => 'Gagal menghapus data murid'
                );
            }
        } else {
            $response = array(
                'status' => 'gagal',
                'pesan'  => 'ID murid tidak ditemukan'
            );
        }

        $this->set_output($response);
    }
    
    public function murid_detail($id_murid)
    {
        if(!$id_murid) exit;

        $check_murid = $this->Model_murid->single_murid($id_murid);

        if(!$check_murid) {
            echo '<div class="modal-body"><p class="text-center">Data murid tidak ditemukan!</p></div>';
            exit;
        }

        $data['murid'] = $check_murid;
        $this->load->view('admin/murid/murid_detail', $data);
    }

    public function export_pdf()
    {
        // Load Dompdf library
        require_once APPPATH.'../vendor/autoload.php';
        $dompdf = new Dompdf\Dompdf();

        // Fetch murid data
        $data['murid_data'] = $this->Model_murid->list_murid();

        // Load view for PDF content
        $html = $this->load->view('admin/murid/export_pdf', $data, true);

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("data_murid.pdf", array("Attachment" => 0));
    }

    public function export_excel()
    {
        $data['murid_data'] = $this->Model_murid->list_murid();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="data_murid.xls"');
        header('Cache-Control: max-age=0');
        $this->load->view('admin/murid/export_excel', $data);
    }

    public function export_word()
    {
        $data['murid_data'] = $this->Model_murid->list_murid();
        header('Content-Type: application/vnd.ms-word');
        header('Content-Disposition: attachment;filename="data_murid.doc"');
        header('Cache-Control: max-age=0');
        $this->load->view('admin/murid/export_word', $data);
    }
}