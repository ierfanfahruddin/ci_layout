<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->session->set_flashdata('dashboard', 'active');
        $this->session->set_flashdata('obat', '');
        $this->session->set_flashdata('jenisobat', '');
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
        $currentDate = date('Y-m-d');

        $data['obat'] = $this->db->get('obat')->num_rows();
        $data['jenis_obat'] = $this->db->get('jenis_obat')->num_rows();
        $data['obatexp'] = $this->db->query("SELECT * from obat where tgl_exp < '$currentDate'")->num_rows();
        $data['users'] = $this->db->get('users')->num_rows();
        $data['usersactive'] = $this->db->query('SELECT * FROM users where is_active = 1')->num_rows();
        $data['usersnonactive'] = $this->db->query('SELECT * FROM users where is_active = 0')->num_rows();
        // echo $data;
        $data['dataobat'] = $this->db->query('SELECT o.id, o.nama_obat, o.satuan, o.harga, o.stok, o.tgl_exp, j.nama_jenis_obat
        FROM obat o
        JOIN jenis_obat j ON o.id_jenis_obat = j.id
        ORDER BY o.tgl_exp ASC')->result_array();
        // var_dump($data);
        $this->load->view('index', $data);
    }
}
