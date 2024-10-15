<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Api extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_kasir', 'kasir');
		if (!is_logged_in()) {
			header('Content-Type: application/json');
			$this->output->set_status_header(401);
			echo json_encode($this->ResponseAPI(401, 'Anda harus login terlebih dahulu'));
			die;
		}
	}

	public function insert_tindakan_awal()
	{
		// POST CONTENT
		// - no_medrek
		// - poli
		// - no_struk
		switch ($_POST['poli']) {
			case '001':
				$getTindakan = $this->kasir->getTindakanSelected("TDK0009377");
				$getAct = array(
					"act_code" => "TDK0009377",
					"act_name" => $getTindakan->row()->actname,
					"act_fee" => $getTindakan->row()->fee
				);
				break;
			case '002':
				$getTindakan = $this->kasir->getTindakanSelected("TDK0009378");
				$getAct = array(
					"act_code" => "TDK0009378",
					"act_name" => $getTindakan->row()->actname,
					"act_fee" => $getTindakan->row()->fee
				);
				break;
			default:
				echo json_encode($this->ResponseAPI(201, 'Poli tidak ditemukan', $_POST));
				die;
				break;
		}

		$row = array(
			'no_struck' => $_POST['no_struk'],
			'no_rm' => $_POST['no_medrek'],
			'tindakan_code' => $getAct['act_code'],
			'nama_tindakan' => $getAct['act_name'],
			'harga' => intval($getAct['act_fee']),
			'created_by' => (!$this->session->userdata('id')) ? 'admin' : $this->session->userdata('id'),
			'is_paid' => 1,
			'tran_date' => date('Y-m-d H:i:s')
		);

		$query = $this->kasir->insertTindakanAwal($row);
		if ($query == 0) {
			echo json_encode($this->ResponseAPI(201, 'Ada masalah saat input tindakan', $_POST));
			die;
		}
		echo json_encode($this->ResponseAPI(200, 'Tindakan awal berhasil dimasukan', $_POST));
	}

	public function get_list_rekap()
	{
		$getData = $this->kasir->getListRekap($_POST['tgl_antrian'], $_POST['poli'], $_POST['dokter']);
		if ($getData->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getData->result()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	public function get_list_antrian()
	{
		// cek POST variabel jika pencarian berdasarkan no rm maka hasilnya 0
		$checkNull = count(array_filter([@$_POST['tgl_antrian'], @$_POST['poli_antrian'], @$_POST['dokter_antrian']], function ($value) {
			return isset($value) && $value !== null;
		}));

		$getData = $this->kasir->getListAntrian(@$_POST['tgl_antrian'], @$_POST['poli_antrian'], @$_POST['dokter_antrian'], @$_POST['no_rm']);
		if ($checkNull == 0) {
			$getData = $this->kasir->getListAntrian_ByRM(@$_POST['no_rm']);
		}

		if ($getData->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getData->result()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	public function get_tindakan()
	{
		$getTindakan = $this->kasir->getTindakan($_POST['poli']);
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

	public function get_rm()
	{
		$getData = $this->kasir->getRM($_POST['struck_no']);
		$getData_LastPayment = $this->kasir->getLastPay();
		$getData_Payment = $this->kasir->getPay_ByStruk($_POST['struck_no'], $_POST['tran_type']);
		if ($getData->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', array(
				"data_rm" => $getData->row(),
				"data_payment" => ($getData_Payment->num_rows() > 0) ? $getData_Payment->row() : NULL,
				"data_generate_payment" => $this->generate_payment_code($_POST['struck_no'])
			)));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	public function get_list_dokter()
	{
		$getData = $this->kasir->getListDokter();
		if ($getData->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getData->result()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	public function get_list_tindakan_perda()
	{
		$getData = $this->kasir->getListTindakanPerda();
		if ($getData->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getData->result()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	public function get_tindakan_perda_by_struk()
	{
		$getData = $this->kasir->getTindakanByStruk($_POST['struck_no']);
		if ($getData->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getData->result()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	public function get_resep_by_struk()
	{
		$getData = $this->kasir->getResepByStruk($_POST['struck_no']);
		if ($getData->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getData->result()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	public function confirm_checkout()
	{
		if ($_POST['amount_paid'] == "") {
			echo json_encode($this->ResponseAPI(202, 'Jumlah pembayaran kosong'));
			die;
		}

		$data = array(
			"payment_code" => $this->generate_payment_code($_POST['struck_no']),
			"cust_code" => $_POST['cust_code'],
			"struck_no" => $_POST['struck_no'],
			"tran_type" => "Rawat Jalan",
			"payment_type" => "TUNAI",
			"amount_total" => $_POST['amount_total'],
			"amount_total_rounding" => $_POST['amount_total_rounding'],
			"amount_paid" => $_POST['amount_paid'],
			"amount_change" => $_POST['amount_change'],
			"amount_outstanding" => $_POST['amount_outstanding'],
			"deleted" => 0
		);
		$query = $this->kasir->insertPayment($data);
		if ($query == 0) {
			$return = $this->ResponseAPI(201, 'Ada masalah saat input data.', $_POST);
		} else {
			$return = $this->ResponseAPI(200, 'Sukses', $_POST);
		}
		echo json_encode($return);
	}

	public function simpan_tindakan()
	{
		$result_non_db = array();
		$result_db = array();

		// Data Non DB
		$data_non_db = json_decode($_POST['data_non_db']);
		foreach ($data_non_db as $req) {
			$row = array(
				'no_struck' => $_POST['struck_no'],
				'no_rm' => $_POST['cust_code'],
				'tindakan_code' => $req->act_code,
				'nama_tindakan' => $req->nama_tindakan,
				'harga' => intval(str_replace(['Rp.', ' ', '.'], '', $req->price)),
				'created_by' => $this->session->userdata('id'),
				'is_paid' => 1,
				'tran_date' => date('Y-m-d H:i:s')
			);
			$result_non_db[] = $row;
		}

		// Data DB
		$data_db = json_decode($_POST['data_db']);
		foreach ($data_db as $req) {
			$row = array(
				'id' => $req->id,
				'created_by' => $this->session->userdata('id'),
				'is_paid' => 1,
				'tran_date' => date('Y-m-d H:i:s')
			);
			$result_db[] = $row;
		}

		$query = $this->kasir->insertTindakan($result_non_db);
		if ($query == 0) {
			$return = $this->ResponseAPI(201, 'Ada masalah saat input tindakan.', $_POST);
		}

		$query_db = $this->kasir->updateTindakan($result_db);
		if ($query_db == 0) {
			$return = $this->ResponseAPI(201, 'Ada masalah saat update tindakan.', $_POST);
		} else {
			$return = $this->ResponseAPI(200, 'Sukses', array(
				'insert' => $result_non_db,
				'update' => $result_db
			));
		}
		echo json_encode($return);
	}

	public function get_payment()
	{
		$getData = $this->kasir->getPay_ByStruk($_POST['struck_no'], $_POST['tran_type']);
		if ($getData->num_rows() > 0) {
			echo json_encode($this->ResponseAPI(200, 'success', $getData->row()));
			die;
		}
		echo json_encode($this->ResponseAPI(201, 'Data Tidak Ada'));
		die;
	}

	// PRIVATE
	private function generate_payment_code($struckNo, $tranType = "Rawat Jalan")
	{
		$timezone = new DateTimeZone('Asia/Jakarta');
		$date = new DateTime();
		$date->setTimeZone($timezone);
		$dateNow = $date->format('y/m');

		$getData_LastPayment = ($this->kasir->getLastPay()->num_rows() > 0) ? (intval($this->kasir->getLastPay()->row()->id) + 1) : 1;
		$lastPayment_Result = sprintf('%05d', $getData_LastPayment);
		$getData_Payment = $this->kasir->getPay_ByStruk($struckNo, $tranType);
		if ($getData_Payment->num_rows() > 0) {
			$payment_Result = sprintf('%05d', intval($getData_Payment->row()->id));
			return $getData_Payment->row()->payment_code;
		}
		return "P/RJ/{$dateNow}/{$lastPayment_Result}";
	}

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
