<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    /**
     * Mengambil seluruh data transaksi yang bergabung dengan data barang
     * Digunakan untuk laporan umum
     */
    public function get_laporan() {
        $this->db->select('transaksi.*, barang.nama_barang');
        $this->db->from('transaksi');
        $this->db->join('barang', 'barang.id = transaksi.id_barang');
        $this->db->order_by('transaksi.tanggal_pesan', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Mengambil data laporan transaksi berdasarkan rentang tanggal
     * @param string $start_date - format: YYYY-MM-DD
     * @param string $end_date   - format: YYYY-MM-DD
     */
    public function get_laporan_by_date($start_date, $end_date) {
        $this->db->select('transaksi.*, barang.nama_barang');
        $this->db->from('transaksi');
        $this->db->join('barang', 'barang.id = transaksi.id_barang');
        $this->db->where('transaksi.tanggal_pesan >=', $start_date);
        $this->db->where('transaksi.tanggal_pesan <=', $end_date);
        $this->db->order_by('transaksi.tanggal_pesan', 'DESC');
        return $this->db->get()->result();
    }

}
?>
