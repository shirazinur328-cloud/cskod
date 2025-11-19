<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->model('Model_auth');
		if ($this->input->method() === 'post') {
			
				$role = $this->input->post('role');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$adauser = $this->Model_auth->login($username, $password, $role);
			if ($adauser){

				if ($role == 'murid') {
					$this->session->set_userdata('murid', $adauser);
					redirect('murid');

				} elseif ($role == 'guru') {
					$this->session->set_userdata('guru', $adauser);
					redirect('guru');

				} elseif ($role == 'admin') {
					$this->session->set_userdata('admin', $adauser);
					redirect('admin');
				}

			}else{
				$this->session->set_flashdata('error', 'user tidak ditemukan');
			}
		}
		$this->load->view('login');
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('auth');
	}
}