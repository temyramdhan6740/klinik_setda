<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kasir extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_kasir', 'kasir');
		if (!is_logged_in()) {
			redirect('login');
		}
	}

	public function index()
	{
		$data['js'] = 'js';
		$data['css'] = 'css';
		$data['content'] = 'kasir';
		$this->load->view('default', $data);
	}

	public function get_tindakan()
	{
		$getTindakan = $this->kasir->getTindakan();
		if ($getTindakan->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getTindakan->result()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	public function get_tindakan_selected()
	{
		$getTindakan = $this->kasir->getTindakanSelected($_POST['actcode']);
		if ($getTindakan->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getTindakan->row()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	// PRIVATE

	private function ResponseAPI($code, $message, $response = null)
	{
		return array(
			"metaData" => array(
				'code' => $code,
				'message' => $message
			),
			"response" => $response
		);
	}
}
