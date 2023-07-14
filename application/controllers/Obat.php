<?php

class Obat extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->model('Obat_model');
    $this->session->set_flashdata('jenisobat', '');
    $this->session->set_flashdata('obat', 'active');
    $this->session->set_flashdata('dashboard', '');
    is_login();
  }

  public function index()
  {
    $cari = $this->input->get('cari');
    $base_url = base_url('index.php/obat/index');
    $total_rows = $this->Obat_model->get_obat_count($cari);
    $per_page = 10; // Jumlah data per halaman

    initialize_pagination($base_url, $total_rows, $per_page);

    // Ambil data obat dengan pagination
    $data['obat'] = $this->Obat_model->get_obat_list($cari, $per_page, $this->uri->segment(3));

    $this->load->view('layout/menu');
    $this->load->view('pages/obat/index', $data);
    $this->load->view('layout/footer');
  }

  public function get_obat_list()
  {
    $postData = $this->input->post();

    $data = $this->Obat_model->get_data_ajax($postData);

    echo json_encode($data);
  }


  public function tambah()
  {
    $data['jenisobat'] = $this->db->get('jenis_obat')->result_array();
    $this->load->view('pages/obat/tambah', $data);
  }

  public function store()
  {
    $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
    $this->form_validation->set_rules('id_jenis_obat', 'Jenis Obat', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required');
    $this->form_validation->set_rules('stok', 'Stok', 'required');
    $this->form_validation->set_rules('tgl_exp', 'Tanggal Exp', 'required');
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('errors', validation_errors());
    } else {
      $data = [
        'nama_obat' => $this->input->post('nama_obat'),
        'id_jenis_obat' => $this->input->post('id_jenis_obat'),
        'satuan' => $this->input->post('satuan'),
        'harga' => $this->input->post('harga'),
        'stok' => $this->input->post('stok'),
        'tgl_exp' => $this->input->post('tgl_exp'),
      ];
      $this->Obat_model->insert_obat($data);
      $this->session->set_flashdata('success', 'Data obat berhasil ditambahkan.');
    }
    redirect('obat/index');
  }

  public function edit($id)
  {
    $data['obat'] = $this->Obat_model->get_obat_by_id($id);
    $data['jenisobat'] = $this->db->get('jenis_obat')->result_array();
    $this->load->view('pages/obat/edit', $data);
  }

  public function update()
  {
    $id = $this->input->post('id');
    $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
    $this->form_validation->set_rules('id_jenis_obat', 'Jenis Obat', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required');
    $this->form_validation->set_rules('stok', 'Stok', 'required');
    $this->form_validation->set_rules('tgl_exp', 'Tanggal Exp', 'required');
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('errors', validation_errors());
    } else {
      $data = [
        'nama_obat' => $this->input->post('nama_obat'),
        'id_jenis_obat' => $this->input->post('id_jenis_obat'),
        'satuan' => $this->input->post('satuan'),
        'harga' => $this->input->post('harga'),
        'stok' => $this->input->post('stok'),
        'tgl_exp' => $this->input->post('tgl_exp'),
      ];
      $this->Obat_model->update_obat($id, $data);
      $this->session->set_flashdata('success', 'Data obat berhasil diupdate.');
    }
    redirect('obat/index');
  }

  public function delete($id)
  {
    $this->Obat_model->delete_obat($id);
    $this->session->set_flashdata('success', 'Data obat berhasil dihapus.');
    redirect('obat/index');
  }
}
