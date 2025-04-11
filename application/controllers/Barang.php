<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('session');
        $this->load->helper('url');

        // ✅ Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url()); // redirect ke halaman utama saja
        }

        // ✅ Cek role: hanya operator dan karyawan yang bisa akses modul ini
        $role = $this->session->userdata('role');
        if (!in_array($role, ['operator', 'karyawan'])) {
            show_error('Anda tidak memiliki izin untuk mengakses halaman ini.', 403);
        }
    }

    public function index() {
        $data['title'] = "Data Barang";
        $data['barang'] = $this->Barang_model->get_all();
        $this->load->view('barang/index', $data);
    }

    public function tambah() {
        $data['title'] = "Tambah Barang";
        $this->load->view('barang/tambah', $data);
    }

    public function simpan() {
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'harga' => $this->input->post('harga')
        ];
        $this->Barang_model->insert($data);
        redirect('index.php/barang');
    }

    public function edit($id) {
        $barang = $this->Barang_model->get_by_id($id);
        if (!$barang) {
            show_404();
        }

        $data['title'] = "Edit Barang";
        $data['barang'] = $barang;
        $this->load->view('barang/edit', $data);
    }

    public function update($id) {
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'harga' => $this->input->post('harga')
        ];
        $this->Barang_model->update($id, $data);
        redirect('index.php/barang');
    }

    public function hapus($id) {
        // ✅ Hapus hanya untuk operator
        if ($this->session->userdata('role') !== 'operator') {
            show_error('Anda tidak memiliki izin untuk menghapus data.', 403);
        }

        $this->Barang_model->delete($id);
        redirect('index.php/barang');
    }
}
