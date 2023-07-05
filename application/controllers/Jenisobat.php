<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenisobat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->session->set_flashdata('jenisobat', 'active');
        $this->session->set_flashdata('obat', '');
        $this->session->set_flashdata('dashboard', '');
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
        $data['jenisobat'] = $this->db->query('SELECT * FROM jenis_obat')->result_array();
        $this->load->view('layout/menu', $data);
        $this->load->view('pages/jenisobat/index', $data);
        $this->load->view('layout/footer', $data);
    }
    function tambah()
    {

        $this->load->view('pages/jenisobat/tambah');
    }
    function store()
    {
        $this->form_validation->set_rules('nama_jenis_obat', 'nama_jenis_obat', 'required|is_unique[jenis_obat.nama_jenis_obat]');
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
            redirect('jenisobat/index');
        }
        $nama_jenis_obat = $this->input->post('nama_jenis_obat');
        $data = [
            'nama_jenis_obat' => $nama_jenis_obat
        ];
        $this->db->insert('jenis_obat', $data);
        $this->session->set_flashdata('success', 'berhasil');
        redirect('jenisobat/index');
    }
    function edit($id)
    {
        $sql = "SELECT * FROM jenis_obat where id = " . $id;
        $data['jenisobat'] = $this->db->query($sql)->row_array();
        $this->load->view('pages/jenisobat/edit', $data);
    }
    function update()
    {
        $id = $this->input->post('id');
        $nama_jenis_obat = $this->input->post('nama_jenis_obat');
        $this->form_validation->set_rules('nama_jenis_obat', 'nama_jenis_obat', 'required|is_unique[jenis_obat.nama_jenis_obat]');
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
            redirect('jenisobat/index');
        }
        $data = [
            'nama_jenis_obat' => $nama_jenis_obat
        ];

        $this->db->where('id', $id);
        $this->db->update('jenis_obat', $data);

        $this->session->set_flashdata('success', 'berhasil');

        redirect('jenisobat/index');
    }
    function delete($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('jenis_obat');
        $this->session->set_flashdata('success', 'berhasil');
        redirect('jenisobat/index');
    }
}
