<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_model extends CI_Model
{

  public function get_obat_list($cari, $limit, $offset)
  {
    $this->db->select('*');
    $this->db->from('obat');
    $this->db->join('jenis_obat', 'obat.id_jenis_obat = jenis_obat.id', 'left');
    $this->db->like('nama_obat', $cari);
    $this->db->order_by('obat.id', 'ASC');
    $this->db->limit($limit, $offset);
    return $this->db->get()->result_array();
  }

  public function get_obat_count($cari)
  {
    $this->db->from('obat');
    $this->db->join('jenis_obat', 'obat.id_jenis_obat = jenis_obat.id', 'left');
    $this->db->like('nama_obat', $cari);
    return $this->db->count_all_results();
  }

  public function insert_obat($data)
  {
    $this->db->insert('obat', $data);
  }

  public function get_obat_by_id($id)
  {
    $this->db->where('id', $id);
    return $this->db->get('obat')->row_array();
  }

  public function update_obat($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('obat', $data);
  }

  public function delete_obat($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('obat');
  }
}