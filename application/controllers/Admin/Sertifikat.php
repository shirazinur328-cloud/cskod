<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin')) {
        	redirect('auth');
        }
        $this->load->model('Model_sertifikat');
        $this->load->model('Model_mapel');
        $this->load->helper('form');
        $this->load->library('upload');
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
        $data['title'] = 'Manajemen Sertifikat';
        $data['total_sertifikat'] = $this->Model_sertifikat->total_sertifikat();
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/sertifikat/sertifikat_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function sertifikat_daftar()
    {
        $list = $this->Model_sertifikat->list_sertifikat();
        $data = array();
        $no = 1;
        foreach ($list as $sertifikat) {
            $row = array();
            $id_sertifikat = isset($sertifikat->id_sertifikat) ? $sertifikat->id_sertifikat : '';
            $row['id_sertifikat'] = $id_sertifikat;
            $row['no'] = $no++;
            $row['nama_sertifikat'] = isset($sertifikat->nama_sertifikat) ? $sertifikat->nama_sertifikat : '';
            $row['nama_mapel'] = isset($sertifikat->nama_mapel) ? $sertifikat->nama_mapel : '-';
            $row['jumlah_keluar'] = isset($sertifikat->jumlah_keluar) ? $sertifikat->jumlah_keluar : 0;
            $row['aksi'] = '<button class="btn btn-sm btn-detail rounded" style="background-color: #3B82F6; border-color: #3B82F6; color: white; margin: 0 2px;" data-id="'.$id_sertifikat.'"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span></button>
                           <button class="btn btn-sm btn-edit rounded" style="background-color: #F59E0B; border-color: #F59E0B; color: white; margin: 0 2px;" data-id="'.$id_sertifikat.'"><i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit</span></button>
                           <button class="btn btn-sm btn-hapus rounded" style="background-color: #EF4444; border-color: #EF4444; color: white; margin: 0 2px;" data-id="'.$id_sertifikat.'"><i class="fas fa-trash"></i> <span class="d-none d-md-inline">Hapus</span></button>';
            $data[] = $row;
        }

        $response = array("data" => $data);
        $this->set_output($response);
    }

    public function sertifikat_add()
    {
        $data['mapel_list'] = $this->Model_mapel->list_mapel();
        $this->load->view('admin/sertifikat/sertifikat_add', $data);
    }

    public function sertifikat_addsave()
    {
        // Ensure upload directory exists
        $upload_dir = './uploads/sertifikat_templates/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $config['upload_path'] = $upload_dir;
        $config['allowed_types'] = 'png|PNG';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;
        $config['detect_mime'] = TRUE; // Additional security to validate file type

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('template_file')) {
            $response = array(
                'status' => 'gagal',
                'pesan'  => $this->upload->display_errors()
            );
        } else {
            $upload_data = $this->upload->data();
            $data = array(
                'id_mapel' => $this->input->post('id_mapel'),
                'nama_sertifikat' => $this->input->post('nama_sertifikat'),
                'tanggal_diterbitkan' => date('Y-m-d'), // Auto set current date
                'template_file' => $upload_data['file_name']
            );

            $this->Model_sertifikat->add_sertifikat($data);

            $response = array(
                'status' => 'sukses',
                'pesan'  => 'Sertifikat berhasil ditambahkan'
            );
        }
        $this->set_output($response);
    }

    public function sertifikat_edit($id_sertifikat)
    {
        if(!$id_sertifikat) exit;

        $check_sertifikat = $this->Model_sertifikat->single_sertifikat($id_sertifikat);

        if(!$check_sertifikat) {
            echo '<div class="modal-body"><p class="text-center">Data sertifikat tidak ditemukan!</p></div>';
            exit;
        }

        $data['sertifikat'] = $check_sertifikat;
        $data['mapel_list'] = $this->Model_mapel->list_mapel();
        $this->load->view('admin/sertifikat/sertifikat_edit', $data);
    }

    public function sertifikat_editsave()
    {
        $id_sertifikat = $this->input->post('id_sertifikat');

        $data = array(
            'id_mapel' => $this->input->post('id_mapel'),
            'nama_sertifikat' => $this->input->post('nama_sertifikat')
        );

        // Handle template file update if a new one is uploaded
        if (!empty($_FILES['template_file']['name'])) {
            // Ensure upload directory exists
            $upload_dir = './uploads/sertifikat_templates/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'png|PNG';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;
            $config['detect_mime'] = TRUE; // Additional security to validate file type

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('template_file')) {
                $response = array(
                    'status' => 'gagal',
                    'pesan'  => $this->upload->display_errors()
                );
                $this->set_output($response);
            } else {
                // Delete old file
                $old_sertifikat = $this->Model_sertifikat->single_sertifikat($id_sertifikat);
                if ($old_sertifikat && $old_sertifikat->template_file) {
                    unlink('./uploads/sertifikat_templates/' . $old_sertifikat->template_file);
                }
                $upload_data = $this->upload->data();
                $data['template_file'] = $upload_data['file_name'];
            }
        }

        $this->Model_sertifikat->update_sertifikat($id_sertifikat, $data);

        $response = array(
            'status' => 'sukses',
            'pesan'  => 'Sertifikat berhasil diperbarui'
        );
        $this->set_output($response);
    }

    public function sertifikat_delete_post()
    {
        $id_sertifikat = $this->input->post('id_sertifikat');

        if ($id_sertifikat) {
            // Delete associated template file
            $sertifikat = $this->Model_sertifikat->single_sertifikat($id_sertifikat);
            if ($sertifikat && $sertifikat->template_file) {
                unlink('./uploads/sertifikat_templates/' . $sertifikat->template_file);
            }
            $this->Model_sertifikat->delete_sertifikat($id_sertifikat);
            $response = array(
                'status' => 'sukses',
                'pesan'  => 'Data sertifikat berhasil dihapus'
            );
        } else {
            $response = array(
                'status' => 'gagal',
                'pesan'  => 'ID sertifikat tidak ditemukan'
            );
        }

        $this->set_output($response);
    }
    
    public function sertifikat_detail($id_sertifikat)
    {
        if(!$id_sertifikat) exit;

        $check_sertifikat = $this->Model_sertifikat->single_sertifikat($id_sertifikat);

        if(!$check_sertifikat) {
            echo '<div class="modal-body"><p class="text-center">Data sertifikat tidak ditemukan!</p></div>';
            exit;
        }

        $data['sertifikat'] = $check_sertifikat;
        $data['issued_certificates'] = $this->Model_sertifikat->get_issued_certificates($id_sertifikat);
        $this->load->view('admin/sertifikat/sertifikat_detail', $data);
    }

    public function preview_sertifikat($id_sertifikat)
    {
        $sertifikat = $this->Model_sertifikat->single_sertifikat($id_sertifikat);
        if ($sertifikat && $sertifikat->template_file) {
            $file_path = FCPATH . 'uploads/sertifikat_templates/' . $sertifikat->template_file;
            if (file_exists($file_path)) {
                header('Content-type: application/pdf');
                header('Content-Disposition: inline; filename="' . $sertifikat->template_file . '"');
                @readfile($file_path);
            } else {
                echo 'Template file not found.';
            }
        } else {
            echo 'Sertifikat atau template tidak ditemukan.';
        }
    }

    public function download_log($id_sertifikat)
    {
        $issued_certificates = $this->Model_sertifikat->get_issued_certificates($id_sertifikat);

        if (empty($issued_certificates)) {
            echo "No issued certificates to log.";
            return;
        }

        $filename = "log_sertifikat_" . $id_sertifikat . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID Sertifikat Murid', 'ID Murid', 'Nama Murid', 'Email Murid', 'Tanggal Dikeluarkan', 'Status Validasi'));

                foreach ($issued_certificates as $cert) {

                    fputcsv($output, array($cert->id_sertifikat_murid, $cert->id_murid, $cert->nama_murid, $cert->email, $cert->tanggal_dikeluarkan, $cert->status_validasi));

                }

                fclose($output);

            }

        

            // Placeholder for certificate issuance (e.g., from murid_detail or mapel_detail)

            public function issue_certificate()

            {

                // Logic to issue a certificate to a student for a specific mapel

                // Requires id_sertifikat (template), id_murid, and potentially other data

                // Insert into sertifikat_murid table

            }

        

        }
