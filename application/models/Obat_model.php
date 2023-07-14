<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_model extends CI_Model
{

  public function get_obat_list($cari, $limit, $offset)
  {
    $this->db->select('o.id, o.nama_obat, o.satuan, o.harga, o.stok, o.tgl_exp, j.nama_jenis_obat');
    $this->db->from('obat o');
    $this->db->join('jenis_obat j', 'o.id_jenis_obat = j.id', 'left');
    $this->db->like('nama_obat', $cari);
    $this->db->order_by('o.id', 'ASC');
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
  public function get_data_obat()
  {
    $this->db->select('o.id, o.nama_obat, o.satuan, o.harga, o.stok, o.tgl_exp, j.nama_jenis_obat');
    $this->db->from('obat o');
    $this->db->join('jenis_obat j', 'o.id_jenis_obat = j.id');
    $this->db->order_by('o.tgl_exp', 'ASC');
    return $this->db->get()->result_array();
  }
  function get_data_ajax($postData)
  {
    $this->db->select('o.id, o.nama_obat, o.satuan, o.harga, o.stok, o.tgl_exp, j.nama_jenis_obat');
    $this->db->from('obat o');
    $this->db->join('jenis_obat j', 'o.id_jenis_obat = j.id');
    $this->db->order_by('o.tgl_exp', 'ASC');
    $response = array();
    $draw = $postData['draw'];
    $start = $postData['start'];
    $rowperpage = $postData['lenght'];
    $coloumnIndex = $postData['order'][0]['coloumn'];
    $coloumnName = $postData['coloumns'][$coloumnIndex]['data'];
    $coloumnSortOrder = $postData['order'][0]['dir'];
    $searchValue = $postData['search']['value'];

    $searchQuery = '';
    if ($searchValue != '') {
      $searchQuery = "(o.nama_obat like '%" . $searchValue . "%')";
    }
    //total tanpa filter
    $this->db->select('count(*) as allcount');
    $record = $this->db->get()->result_array();
    $totalRecord = $record[0]->allcount;

    //total dengan filter
    $this->db->select('count(*) as allcount)');
    if ($searchQuery != '') {
      $this->db->where($searchQuery);
    }
    $record = $this->db->get()->result_array();
    $totalRecordWithFilter = $record[0]->allcount;

    if ($searchQuery != '') {
      $this->db->where($searchQuery);
      $this->db->order_by($coloumnName, $coloumnSortOrder);
      $this->db->limit($rowperpage, $start);
    }
    $data = array();
    foreach ($record as $row) {
      $data[] =  array(
        'id' => $row->id,
        'nama_obat' => $row->nama_obat,
        'satuan' => $row->satuan,
        'harga' => $row->harga,
        'stok' => $row->stok,
        'tgl_exp' => $row->tgl_exp,
        'nama_jenis_obat' => $row->nama_jenis_obat,

      );
    }
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecord,
      "iTotalDisplayRecords" => $totalRecordWithFilter,
      "aaData" => $data
    );

    return $response;
  }
}
