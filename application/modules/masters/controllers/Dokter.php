<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dokter extends MX_Controller
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
        $data['js'] = 'js_dokter';
        $data['css'] = 'css';
        $data['content'] = 'dokter';
        $this->load->view('default', $data);
    }

    public function insert_data()
    {
        $param = $this->input->post();
        $param['dokter_code'] = $this->model->get_dokter_code();
        $hasil = $this->model->insert_data($param, "tb_dokter");
        echo json_encode($hasil);
    }

    public function update_data()
    {
        $param = $this->input->post();
        $hasil = $this->model->update_data($param, 'tb_dokter');
        echo json_encode($hasil);
    }

    public function get_data($id)
    {
        $data = $this->model->get_data($id, 'tb_dokter');
        if (isset($data->id)) {
            echo json_encode(array(
                'status' => 200,
                'data' => $data
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
        $data = $this->model->list_dokter();
        echo json_encode(array("data" => $data));
    }

    public function delete_data($id)
    {
        $data = $this->model->delete_data($id, 'tb_dokter');
        echo json_encode($data);
    }
}