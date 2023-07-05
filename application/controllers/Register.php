<?php
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
    function index()
    {
        $username = $this->session->userdata('username');

        if ($username) {
            redirect('/');
        }
        $this->load->view('auth/register');
    }
    function store()
    {

        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('fullname', 'fullname', 'trim|required|min_length[1]|max_length[255]');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $fullname = $this->input->post('fullname');
            $data_user = array(
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'fullname' => $fullname,
                'is_active' => 0,
                'role' => 'user'
            );
            $this->db->insert('users', $data_user);
            $this->session->set_flashdata('success_register', 'Proses Pendaftaran User Berhasil');
            redirect('login');
        } else {
            $this->session->set_flashdata('errors', validation_errors());
            // var_dump($_SESSION['errors']);
            redirect('register');
        }
    }
}
