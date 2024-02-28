<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Soap_gigi extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('m_soap', 'soap');
        if (!is_logged_in()) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['js'] = 'js_gigi';
        $data['css'] = 'css_gigi';
        $data['poli'] = $this->soap->get_list_poli();
        $data['content'] = 'soap_gigi';
        $this->load->view('default', $data);
    }


    public function list_pasien()
    {
        $param = $this->input->post();
        $data = $this->soap->get_list_pasien($param);
        echo json_encode(array("data" => $data));
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
        $antrian = $this->antrian->get_antrian($param['poli']);
        if (isset($antrian->antrian)) {
            $param['antrian'] = $antrian->antrian + 1;
        } else {
            $param['antrian'] = 1;
        }
        $hasil = $this->antrian->insert_antrian($param);
        echo json_encode($hasil);
    }

    public function get_list_antrian()
    {
        $data = $this->antrian->get_list_antrian();
        echo json_encode(array("data" => $data));
    }

    public function get_soap($no_struck)
    {
        $data = $this->soap->get_soap($no_struck);
        if (isset($data->no_struck)) {
            $data->edukasi = json_decode($data->edukasi, true);
            $data->elemen_gigi = json_decode($data->elemen_gigi, true);
            echo json_encode(array('status' => 200, 'data' => $data));
        } else {
            echo json_encode(array('status' => 0, 'data' => null));
        }
    }

    public function ttd()
    {
        $ttd = $this->input->post('ttd');
        $no_struck = $this->input->post('no_struck');

        $image_name = $no_struck . '.png';
        $path = 'assets/soap_ttd/' . $image_name;
        $save = $this->base64_to_jpeg($ttd, $path);
        if ($save) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failed"));
        }
    }

    public function insert_soap()
    {
        $param = $this->input->post();
        $param['edukasi'] = json_encode($param['edukasi'], JSON_UNESCAPED_SLASHES);
        $param['elemen_gigi'] = json_encode($param['elemen_gigi'], JSON_UNESCAPED_SLASHES);
        $response = $this->soap->insert_soap($param);
        echo json_encode($response);
    }

    public function print($no_struck)
    {
        $data = $this->soap->get_soap($no_struck);
        if (isset($data->no_struck)) {
            $param['data'] = $data;
            $this->load->view('soap/print_soap_gigi', $param);
        }
    }

    function base64_to_jpeg($base64_string, $output_file)
    {
        // open the output file for writing
        $ifp = fopen($output_file, 'wb');

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode(',', $base64_string);

        // we could add validation here with ensuring count( $data ) > 1
        fwrite($ifp, base64_decode($data[1]));

        // clean up the file resource
        fclose($ifp);

        return $output_file;
    }
}