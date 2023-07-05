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
