<?php

Class Fungsi {
    protected $ci;

    public function __construct(){
        $this->ci =& get_instance();
    }

    function user_login() {
        $this->ci->load->model('m_login');
        $id_akun = $this->ci->session->userdata('id_akun');
        $user_data = $this->ci->m_login->get($id_akun)->row();
        return $user_data;
    }
}