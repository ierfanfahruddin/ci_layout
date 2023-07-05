<?php
class Login extends CI_Controller
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
        } else {
            $this->load->view('auth/login');
        }
    }
    function storelogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $query = $this->db->get_where('users', array('username' => $username))->row_array();
        // var_dump($password);
        if ($query != NULL) {
            if ($query['is_active'] == 0) {
                $this->session->set_flashdata('errors', 'Akun Belum Aktif');
                redirect('/login');
            }
            if (password_verify($password, $query['password'])) {
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('fullname', $query['fullname']);
                $this->session->set_userdata('role', $query['role']);
                $this->session->set_userdata('is_login', TRUE);
                redirect('/');
            } else {
                redirect('/login');
            }
        } else {
            redirect('/login');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('fullname');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('is_login');
        redirect('login');
    }
}
