<?php
class Barang_model extends CI_Model {

    public function __construct() {
        parent::__construct(); // wajib dipanggil agar $this->db aktif
    }

    public function get_all() {
        return $this->db->get('barang')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('barang', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('barang', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('barang', $data);
    }

    public function delete($id) {
        return $this->db->delete('barang', ['id' => $id]);
    }

    // ✅ Tambahan: Hitung total barang
    public function get_total_barang() {
        return $this->db->count_all('barang');
    }
}
?>
