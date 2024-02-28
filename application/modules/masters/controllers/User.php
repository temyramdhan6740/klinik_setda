<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('m_master', 'model');
        if (!is_logged_in()) {
            redirect('login');
        }

        if ($_SESSION['role'] != 'admin') {
            redirect('login');
        }
    }

    public function index()
    {
        $data['js'] = 'js_user';
        $data['css'] = 'css';
        $data['content'] = 'user';
        $this->load->view('default', $data);
    }

    public function insert_data()
    {
        $param = $this->input->post();
        $param['password'] = enkrip($param['password']);
        $hasil = $this->model->insert_data($param, "tb_user");
        echo json_encode($hasil);
    }

    public function update_data()
    {
        $param = $this->input->post();
        $param['password'] = enkrip($param['password']);
        $hasil = $this->model->update_data($param, 'tb_user');
        echo json_encode($hasil);
    }

    public function get_data($id)
    {
        $data = $this->model->get_data($id, 'tb_user');
        if (isset($data->id)) {
            echo json_encode(array(
                'status' => 200,
                'data' => array(
                    'id' => $data->id,
                    'username' => $data->username,
                    'nama' => $data->nama,
                    'kode_dokter' => $data->kode_dokter
                )
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'data' => null
            ));
        }
    }

    public function list_data()
    {
        $data = $this->model->list_user();
        echo json_encode(array("data" => $data));
    }

    public function delete_data($id)
    {
        $data = $this->model->delete_data($id, 'tb_user');
        echo json_encode($data);
    }
}