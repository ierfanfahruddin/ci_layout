<?php
defined('BASEPATH') or exit('No direct script access allowed');

class obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->session->set_flashdata('jenisobat', '');
        $this->session->set_flashdata('obat', 'active');
        $this->session->set_flashdata('dashboard', '');
        is_login();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $cari = $this->input->get('cari'); // Menggunakan input dari CodeIgniter untuk mendapatkan nilai dari parameter 'cari'

        if (!empty($cari)) {
            $data['obat'] = $this->db->select('o.id, o.nama_obat, o.satuan, o.harga, o.stok, o.tgl_exp, j.nama_jenis_obat')
                ->from('obat o')
                ->join('jenis_obat j', 'o.id_jenis_obat = j.id')
                ->like('o.nama_obat', $cari, 'both')
                ->order_by('o.tgl_exp', 'ASC')
                ->get()
                ->result_array();
        } else {

            $data['obat'] = $this->db->query('SELECT o.id, o.nama_obat, o.satuan, o.harga, o.stok, o.tgl_exp, j.nama_jenis_obat
        FROM obat o
        JOIN jenis_obat j ON o.id_jenis_obat = j.id
        ORDER BY o.tgl_exp ASC')->result_array();
        }
        $this->load->view('layout/menu', $data);
        $this->load->view('pages/obat/index', $data);
        $this->load->view('layout/footer', $data);
    }
    function tambah()
    {
        $sql = "SELECT * FROM jenis_obat ";
        $data['jenisobat'] = $this->db->query($sql)->result_array();
        $this->load->view('pages/obat/tambah', $data);
    }
    function store()
    {
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
        $this->form_validation->set_rules('id_jenis_obat', 'Jenis Obat', 'required');
        $this->form_validation->set_rules('satuan', 'satuan', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        $this->form_validation->set_rules('stok', 'stok', 'required');
        $this->form_validation->set_rules('tgl_exp', 'tgl_exp', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
            redirect('obat/index');
        }
        $data = [
            'nama_obat' => $this->input->post('nama_obat'),
            'id_jenis_obat' => $this->input->post('id_jenis_obat'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'tgl_exp' => $this->input->post('tgl_exp'),
        ];
        $this->session->set_flashdata('success', 'berhasil');
        $this->db->insert('obat', $data);
        redirect('obat/index');
    }
    function edit($id)
    {
        $sql = "SELECT * FROM obat where id = " . $id;
        $data['obat'] = $this->db->query($sql)->row_array();
        $sql2 = "SELECT * FROM jenis_obat ";
        $data['jenisobat'] = $this->db->query($sql2)->result_array();
        $this->load->view('pages/obat/edit', $data);
    }
    function update()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
        $this->form_validation->set_rules('id_jenis_obat', 'Jenis Obat', 'required');
        $this->form_validation->set_rules('satuan', 'satuan', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        $this->form_validation->set_rules('stok', 'stok', 'required');
        $this->form_validation->set_rules('tgl_exp', 'tgl_exp', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
            redirect('obat/index');
        }
        $data = [
            'nama_obat' => $this->input->post('nama_obat'),
            'id_jenis_obat' => $this->input->post('id_jenis_obat'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'tgl_exp' => $this->input->post('tgl_exp'),
        ];

        $this->session->set_flashdata('success', 'berhasil');
        $this->db->where('id', $id);
        $this->db->update('obat', $data);


        redirect('obat/index');
    }
    function delete($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('obat');
        $this->session->set_flashdata('success', 'berhasil');
        redirect('obat/index');
    }
}
