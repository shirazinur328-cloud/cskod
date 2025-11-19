<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin')) {
            redirect('auth');
        }
        $this->load->model('Model_admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id_admin = $this->session->userdata('admin')->id_admin;

        $data['title'] = 'Profil Admin';
        $data['admin'] = $this->Model_admin->single_admin($id_admin);

        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/admin/footer');
    }

    public function update_profile()
    {
        $id_admin = $this->session->userdata('admin')->id_admin;

        $this->form_validation->set_rules('username', 'Username', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil. Periksa kembali data yang Anda masukkan.');
            redirect('admin/profile');
        } else {
            $data = [
                'username' => $this->input->post('username'),
            ];

            if ($this->Model_admin->update_profile($id_admin, $data)) {
                // Update session data if username is changed
                $admin_session_data = $this->session->userdata('admin');
                $admin_session_data->username = $this->input->post('username');
                $this->session->set_userdata('admin', $admin_session_data);

                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            }
            redirect('admin/profile');
        }
    }

    public function ubah_password()
    {
        $id_admin = $this->session->userdata('admin')->id_admin;

        $this->form_validation->set_rules('current_password', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules(
            'new_password', 
            'Password Baru', 
            'required|trim|min_length[6]',
            ['min_length' => 'Password kurang dari 6 karakter!']
        );
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|trim|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the profile page to show the errors
            $this->index();
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            $admin = $this->Model_admin->single_admin($id_admin);

            if (password_verify($current_password, $admin->password)) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                if ($this->Model_admin->update_password($id_admin, $hashed_new_password)) {
                    $this->session->set_flashdata('success', 'Password berhasil diubah.');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengubah password.');
                }
            } else {
                $this->session->set_flashdata('error', 'Password lama yang Anda masukkan salah.');
            }
            redirect('admin/profile');
        }
    }
}
