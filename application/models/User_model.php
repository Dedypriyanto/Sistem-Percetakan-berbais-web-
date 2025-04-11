<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function login($username, $password) {
        $user = $this->db->get_where('users', ['username' => $username])->row();

        // Bandingkan password input dengan hash dari database
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    public function insert($data) {
        return $this->db->insert('users', $data);
    }
}
