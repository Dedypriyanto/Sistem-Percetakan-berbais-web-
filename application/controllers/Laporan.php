<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Laporan_model');

        // ✅ Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url()); // arahkan ke halaman utama jika belum login
        }

        // ✅ Hanya operator yang boleh akses
        if ($this->session->userdata('role') !== 'operator') {
            redirect('home');
        }
    }

    public function index() {
        $data['title'] = "Laporan Transaksi";
        $data['laporan'] = $this->Laporan_model->get_laporan();
        $this->load->view('laporan/index', $data);
    }

    public function cetak() {
        $data['title'] = "Cetak Laporan Transaksi";
        $data['laporan'] = $this->Laporan_model->get_laporan();
        $this->load->view('laporan/cetak', $data);
    }
}
