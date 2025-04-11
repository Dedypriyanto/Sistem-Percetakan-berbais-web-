<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
    }

    public function login() {
        $data['error'] = $this->session->flashdata('error');
        $this->load->view('auth/login', $data);
    }

    public function do_login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            // Cek ke model login
            $user = $this->User_model->login($username, $password);

            if ($user) {
                // Jika login sukses, set session
                $this->session->set_userdata([
                    'username' => $user->username,
                    'role'     => $user->role,
                    'logged_in'=> true
                ]);
                redirect('index.php/home');
            } else {
                // Jika gagal login
                $this->session->set_flashdata('error', 'Username atau password salah!');
                redirect('index.php/auth/login');
            }
        }
    }

    public function register() {
        $this->load->view('auth/register');
    }

    public function do_register() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $this->load->view('auth/register', $data);
        } else {
            $username = $this->input->post('username');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Hash password
            $role     = $this->input->post('role');

            $insert = $this->User_model->insert([
                'username' => $username,
                'password' => $password,
                'role'     => $role
            ]);

            if ($insert) {
                $data['success'] = 'Registrasi berhasil! Silakan login.';
            } else {
                $data['error'] = 'Terjadi kesalahan saat registrasi.';
            }

            $this->load->view('auth/register', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('index.php/auth/login');
    }
}
