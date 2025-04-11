<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // tambahkan helper untuk base_url()
        $this->load->model('Transaksi_model');
        $this->load->model('Barang_model');

        // ✅ Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url()); // arahkan ke halaman utama
        }
    }

    public function index() {
        $data['title'] = "Data Transaksi";
        $data['transaksi'] = $this->Transaksi_model->get_all();
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        $this->load->view('transaksi/index', $data);
    }

    public function tambah() {
        $data['title'] = "Tambah Transaksi";
        $data['barang'] = $this->Barang_model->get_all();
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        $this->load->view('transaksi/tambah', $data);
    }

    public function simpan() {
        $id_barang = $this->input->post('id_barang');
        $barang = $this->Barang_model->get_by_id($id_barang);
        $jumlah = (int) $this->input->post('jumlah');

        if (!$barang) {
            show_error('Barang tidak ditemukan', 404);
        }

        $harga_total = $barang->harga * $jumlah;
        $dp = (int) $this->input->post('dp');
        $status_lunas = $this->input->post('status_lunas');

        $data = [
            'id_barang' => $id_barang,
            'jumlah' => $jumlah,
            'harga_total' => $harga_total,
            'tanggal_pesan' => $this->input->post('tanggal_pesan'),
            'tanggal_ambil' => $this->input->post('tanggal_ambil'),
            'dp' => $dp,
            'status_lunas' => $status_lunas
        ];

        $this->Transaksi_model->insert($data);
        $this->session->set_flashdata('success', 'Transaksi berhasil disimpan.');
        redirect('index.php/transaksi');
    }

    public function edit($id) {
        $transaksi = $this->Transaksi_model->get_by_id($id);
        if (!$transaksi) {
            show_404();
        }

        $data['title'] = "Edit Transaksi";
        $data['transaksi'] = $transaksi;
        $data['barang'] = $this->Barang_model->get_all();
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        $this->load->view('transaksi/edit', $data);
    }

    public function update($id) {
        $id_barang = $this->input->post('id_barang');
        $barang = $this->Barang_model->get_by_id($id_barang);
        $jumlah = (int) $this->input->post('jumlah');

        if (!$barang) {
            show_error('Barang tidak ditemukan', 404);
        }

        $harga_total = $barang->harga * $jumlah;
        $dp = (int) $this->input->post('dp');
        $status_lunas = $this->input->post('status_lunas');

        $data = [
            'id_barang' => $id_barang,
            'jumlah' => $jumlah,
            'harga_total' => $harga_total,
            'tanggal_pesan' => $this->input->post('tanggal_pesan'),
            'tanggal_ambil' => $this->input->post('tanggal_ambil'),
            'dp' => $dp,
            'status_lunas' => $status_lunas
        ];

        $this->Transaksi_model->update($id, $data);
        $this->session->set_flashdata('success', 'Transaksi berhasil diperbarui.');
        redirect('index.php/transaksi');
    }

    public function cetak($id) {
        $transaksi = $this->Transaksi_model->get_by_id($id);
        if (!$transaksi) {
            show_404();
        }

        $data['title'] = "Cetak Transaksi";
        $data['transaksi'] = $transaksi;
        $this->load->view('transaksi/cetak', $data);
    }

    public function hapus($id) {
        if ($this->session->userdata('role') !== 'operator') {
            show_error('Anda tidak memiliki izin untuk menghapus data.', 403, 'Akses Ditolak');
        }

        $this->Transaksi_model->hapus($id);
        redirect('index.php/transaksi');
    }
}
?>
