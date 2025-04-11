<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load session, model, dan helper yang diperlukan
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Barang_model');
        $this->load->model('Transaksi_model');

        // ✅ Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url()); // arahkan ke halaman utama (login)
        }

        // ❗ Tidak ada pembatasan role di sini karena semua role boleh akses dashboard
    }

    public function index() {
        $data['total_barang'] = $this->Barang_model->get_total_barang();
        $data['total_transaksi'] = $this->Transaksi_model->get_total_transaksi();
        $data['total_laporan'] = $this->Transaksi_model->get_total_laporan();
        $data['barang_terlaris'] = $this->Transaksi_model->get_barang_terlaris();
        $data['status_lunas_chart'] = $this->Transaksi_model->get_status_lunas_chart();


        // Tambahkan data session ke view
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');

        $this->load->view('home/index', $data);
    }
}
