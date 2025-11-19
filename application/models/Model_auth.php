<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model {
	public function login($username, $password, $role)
	{
		if (!$username || !$password) {
			return FALSE;
		}

		if ($role == 'murid') {
			$this->db->where('username',$username);
			$user = $this->db->get('murid')->row();

		} elseif ($role == 'guru') {

			$this->db->where('username',$username);
			$user = $this->db->get('guru')->row();

		} elseif ($role == 'admin') {
			$this->db->where('username',$username);
			$user = $this->db->get('admin')->row();
		}

		
		if (!$user) {
            return FALSE;
        } else {
            if (!password_verify($password, $user->password)) {
                return FALSE;
            } else {
                return $user;
            } 
        } 
	}
}