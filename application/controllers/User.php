<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->session->set_flashdata('user', 'ative');
        $this->session->set_flashdata('user', '');
        $this->session->set_flashdata('obat', '');
        $this->session->set_flashdata('dashboard', '');
        is_login();
        is_admin();
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
        $data['user'] = $this->db->query('SELECT * FROM users')->result_array();
        $this->load->view('layout/menu', $data);
        $this->load->view('pages/user/index', $data);
        $this->load->view('layout/footer', $data);
    }
    function tambah()
    {

        $this->load->view('pages/user/tambah');
    }
    function store()
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
            redirect('user/index');
        }
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $data = [
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'password' => $password,
            'is_active' => 0,
            'role' => 'user',
        ];
        $this->db->insert('users', $data);
        redirect('user/index');
    }
    function edit($id)
    {
        $sql = "SELECT * FROM users where id = " . $id;
        $data['user'] = $this->db->query($sql)->row_array();
        $this->load->view('pages/user/edit', $data);
    }
    function update()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
            redirect('user/index');
        }
        $user = $this->db->query('SELECT * FROM users where id =' . $id)->row_array();
        if ($user['password'] == $this->input->post('password')) {
            $password = $this->input->post('password');
        } else {

            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
        $data = [
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'password' => $password,
            'is_active' => $this->input->post('is_active'),
            'role' => $this->input->post('role'),
        ];

        $this->db->where('id', $id);
        $this->db->update('users', $data);


        redirect('user/index');
    }
    function delete($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('users');
        redirect('user/index');
    }
}
