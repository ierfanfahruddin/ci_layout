<?php
function is_login()
{
    if (!$_SESSION['username']) {
        redirect('/login');
    }
}
function is_admin()
{

    if ($_SESSION['role'] != 'admin') {
        redirect('/');
    }
}
if (!function_exists('initialize_pagination')) {
    function initialize_pagination($base_url, $total_rows, $per_page)
    {
        $CI = &get_instance();
        $CI->load->library('pagination');

        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;

        // Styling pagination menggunakan Bootstrap
        $config['full_tag_open'] = '<nav aria-label="Pagination"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = '&laquo;';
        $config['last_link'] = '&raquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        // Inisialisasi pagination
        $CI->pagination->initialize($config);
    }
}
