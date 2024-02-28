<?php
defined('BASEPATH') or exit('No direct script access allowed');


class GantiPassword extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("m_login", "login");
        $this->load->library('session');
        if (!is_logged_in()) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'ganti_password';
        $this->load->view('default', $data);
    }

    public function ubah()
    {
        $param = $this->input->post();
        $param['password'] = enkrip($param['password']);
        $res = $this->login->insert_register($param);
        echo json_encode($res);
        # code...
    }

    public function update()
    {

        $password_lama = enkrip($this->input->post('password_lama'));
        $password_baru = enkrip($this->input->post('password_baru'));
        $cek = $this->login->cek_pass($password_lama);
        if (isset($cek->username)) {
            $update = $this->login->update_pass($password_baru);
            echo json_encode($update);
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Password Lama Salah'
            ));
        }
    }
}