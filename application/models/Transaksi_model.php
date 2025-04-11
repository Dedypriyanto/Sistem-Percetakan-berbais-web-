<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    // Ambil semua transaksi dengan join barang
    public function get_all() {
        $this->db->select('transaksi.*, barang.nama_barang, barang.harga');
        $this->db->from('transaksi');
        $this->db->join('barang', 'barang.id = transaksi.id_barang');
        return $this->db->get()->result();
    }

    // Simpan transaksi baru
    public function insert($data) {
        return $this->db->insert('transaksi', $data);
    }

    // Ambil transaksi berdasarkan ID untuk cetak/detail
    public function get_by_id($id) {
        $this->db->select('transaksi.*, barang.nama_barang, barang.harga as harga_satuan');
        $this->db->from('transaksi');
        $this->db->join('barang', 'barang.id = transaksi.id_barang');
        $this->db->where('transaksi.id', $id);
        return $this->db->get()->row();
    }

    // Update transaksi berdasarkan ID
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('transaksi', $data);
    }

    // Hapus transaksi berdasarkan ID
    public function hapus($id) {
        $this->db->where('id', $id)->delete('transaksi');
    }

    // Hitung total semua transaksi
    public function get_total_transaksi() {
        return $this->db->count_all('transaksi');
    }

    // Hitung total laporan (misalnya transaksi yang sudah lunas)
    public function get_total_laporan() {
        $this->db->where('LOWER(status_lunas)', 'lunas');
        return $this->db->count_all_results('transaksi');
    }

    // Ambil data barang terlaris untuk chart batang
    public function get_barang_terlaris() {
        $this->db->select('barang.nama_barang, SUM(transaksi.jumlah) AS total_terjual');
        $this->db->from('transaksi');
        $this->db->join('barang', 'barang.id = transaksi.id_barang');
        $this->db->group_by('barang.nama_barang');
        $this->db->order_by('total_terjual', 'DESC');
        $this->db->limit(5); // ambil 5 barang paling laris
        return $this->db->get()->result();
    }

    // Ambil data status lunas untuk chart donat
    public function get_status_lunas_chart() {
        $this->db->select('LOWER(status_lunas) as status_lunas, COUNT(*) as jumlah');
        $this->db->group_by('status_lunas');
        $query = $this->db->get('transaksi');
        $result = $query->result();

        // Siapkan default data jika status tidak ada
        $data = ['lunas' => 0, 'belum' => 0];
        foreach ($result as $row) {
            $status = strtolower($row->status_lunas);
            if (isset($data[$status])) {
                $data[$status] = $row->jumlah;
            }
        }
        return $data;
    }
}
