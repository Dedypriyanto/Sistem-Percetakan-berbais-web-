<?php
function cek_login() {
    $CI = &get_instance();
    if (!$CI->session->userdata('logged_in')) {
        redirect('auth/login');
    }
}

function cek_role($roles = []) {
    $CI = &get_instance();
    if (!in_array($CI->session->userdata('role'), $roles)) {
        show_error('Akses ditolak. Anda tidak memiliki izin.', 403);
    }
}
