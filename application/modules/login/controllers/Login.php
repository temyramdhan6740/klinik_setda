<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('m_login', 'login');
    }

    public function index()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'login';
        $this->load->view('default_login', $data);
    }

    public function doLogin()
    {

        $username = $this->input->post('username');
        $password = enkrip($this->input->post('password'));
        $hasil = $this->login->login($username, $password);

        if (isset($hasil->username)) {
            $sess_data['kudaliar'] = TRUE;
            $sess_data['id'] = $hasil->username;
            $sess_data['nama'] = $hasil->nama;
            $sess_data['role'] = $hasil->role_user;
            $sess_data['kode_dokter'] = $hasil->kode_dokter;
            $this->session->set_userdata($sess_data);
            // redirect('dashboard');
            echo json_encode(array('status' => 200, 'message' => 'Login berhasil'));
        } else {
            echo json_encode(array('status' => 0, 'message' => 'Username / Password Salah'));
        }
    }

    public function doOut()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}