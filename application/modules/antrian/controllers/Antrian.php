<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Antrian extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('m_antrian', 'antrian');
        if (!is_logged_in()) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'login';
        $this->load->view('default_login', $data);
    }


    public function list_antrian()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'list_antrian';
        $data['poli'] = $this->antrian->get_list_poli();
        $data['dokter'] = $this->antrian->get_list_dokter();
        $this->load->view('default', $data);
    }

    public function get_pasien()
    {
        $no_rm = $this->input->post('no_rm');
        if (isset($no_rm)) {
            $no_rm = str_replace('-', '', $no_rm);
            $data = $this->antrian->get_pasien($no_rm);
            if (isset($data->no_rm)) {
                echo json_encode(array('status' => 200, 'data' => $data));
            } else {
                echo json_encode(array('status' => 0, 'data' => null));
            }
        }
    }

    public function insert_antrian()
    {
        $param = $this->input->post();
        $param['no_struck'] = $this->antrian->get_struck_no();
        $antrian = $this->antrian->get_antrian($param['poli'], $param['reg_date']);
        if (isset($antrian->antrian)) {
            $param['antrian'] = $antrian->antrian + 1;
        } else {
            $param['antrian'] = 1;
        }
        $hasil = $this->antrian->insert_antrian($param);
        echo json_encode($hasil);
    }

    public function insert_antrian_pasien_baru()
    {
        $param_pasien = $this->input->post();
        unset($param_pasien['poli']);
        unset($param_pasien['dokter']);
        unset($param_pasien['poli']);
        unset($param_pasien['bpjs']);
        unset($param_pasien['anamnesa']);
        unset($param_pasien['reg_date']);
        unset($param_pasien['reg_time']);

        $hasil_pasien = $this->antrian->insert_pasien_baru($param_pasien);
        if ($hasil_pasien['status'] == 200) {
            $param_antrian = $this->input->post();
            // $param_antrian['no_rm'] = $hasil_pasien['no_rm'];
            $param_antrian['no_struck'] = $this->antrian->get_struck_no();
            $antrian = $this->antrian->get_antrian($param_antrian['poli'], $param_antrian['reg_date']);
            if (isset($antrian->antrian)) {
                $param_antrian['antrian'] = $antrian->antrian + 1;
            } else {
                $param_antrian['antrian'] = 1;
            }
            $hasil_antrian = $this->antrian->insert_antrian($param_antrian);
            echo json_encode($hasil_antrian);
        } else {
            echo json_encode($hasil_pasien);
        }
    }

    public function get_list_antrian()
    {
        $tgl_antrian = $this->input->post('tgl_antrian');
        $poli_antrian = $this->input->post('poli_antrian');
        $data = $this->antrian->get_list_antrian($tgl_antrian, $poli_antrian);
        echo json_encode(array("data" => $data));
    }

    public function generate_custcode()
    {
        $hasil = $this->antrian->get_no_rm();
        if ($hasil) {
            echo json_encode(array(
                'status' => 200,
                'data' => $hasil
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'data' => null
            ));
        }
    }

    public function batal($id)
    {
        $data = $this->antrian->batal_antrian($id);
        echo json_encode($data);
    }
}