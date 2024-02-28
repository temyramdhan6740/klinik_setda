<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Register extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("m_login", "login");
        $this->load->library('session');
    }

    public function index()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'register';
        $this->load->view('default', $data);
    }

    public function insert_register()
    {
        $param = $this->input->post();
        $param['password'] = enkrip($param['password']);
        $res = $this->login->insert_register($param);
        echo json_encode($res);
        # code...
    }
}