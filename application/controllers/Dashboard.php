<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obat_model');
        $this->session->set_flashdata('dashboard', 'active');
        $this->session->set_flashdata('obat', '');
        $this->session->set_flashdata('jenisobat', '');
    }

    public function index()
    {
        $currentDate = date('Y-m-d');

        $data['obat'] = $this->db->count_all('obat');
        $data['jenis_obat'] = $this->db->count_all('jenis_obat');
        $data['obatexp'] = $this->db->where('tgl_exp <', $currentDate)->count_all_results('obat');
        $data['users'] = $this->db->count_all('users');
        $data['usersactive'] = $this->db->where('is_active', 1)->count_all_results('users');
        $data['usersnonactive'] = $this->db->where('is_active', 0)->count_all_results('users');
        $data['dataobat'] = $this->Obat_model->get_data_obat();

        $this->load->view('index', $data);
    }
}
