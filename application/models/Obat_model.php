<?php class Obat_model extends CI_Model {
  
  public function get_obat_list($cari = '') {
    $this->db->select('o.id, o.nama_obat, o.satuan, o.harga, o.stok, o.tgl_exp, j.nama_jenis_obat');
    $this->db->from('obat o');
    $this->db->join('jenis_obat j', 'o.id_jenis_obat = j.id');
    if (!empty($cari)) {
      $this->db->like('o.nama_obat', $cari);
    }
    $this->db->order_by('o.tgl_exp', 'ASC');
    return $this->db->get()->result_array();
  }
  
  public function insert_obat($data) {
    $this->db->insert('obat', $data);
  }
  
  public function get_obat_by_id($id) {
    $this->db->where('id', $id);
    return $this->db->get('obat')->row_array();
  }
  
  public function update_obat($id, $data) {
    $this->db->where('id', $id);
    $this->db->update('obat', $data);
  }
  
  public function delete_obat($id) {
    $this->db->where('id', $id);
    $this->db->delete('obat');
  }
  
}
