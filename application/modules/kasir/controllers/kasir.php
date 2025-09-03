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
		$data['dropdown_dokter'] = $this->kasir->getListDokter()->result();
		$data['content'] = 'kasir';
		$this->load->view('default', $data);
	}

	public function insert_tindakan_awal()
	{
		echo json_encode($this->ResponseAPI(200, 'A', $_POST));
		die;
	}

	public function cetak_pembayaran($struk, $paymentCode = NULL)
	{
		$paymentCode = str_replace('-', '/', $paymentCode);
		$getData = $this->kasir->getRM($struk);
		$getData_Tindakan = $this->kasir->getTindakanByStruk($struk, $paymentCode);
		$getData_Resep = $this->kasir->getResepByStruk($struk, $paymentCode);
		$getData_LastPayment = $this->kasir->getLastPay();
		$getData_Payment = $this->kasir->getPay_ByStruk($struk, 'Rawat Jalan', $paymentCode);

		$data['data_rm'] = $getData->row();
		$data['data_tindakan'] = array(
			'data' => array(),
			'total' => 0,
			'total_sebelum_checkout' => 0
		);
		$data['data_resep'] = array(
			'data' => array(),
			'total' => 0
		);
		$data['data_total'] = array(
			'total_seluruh' => 0
		);

		if ($getData->num_rows() == 0) {
			echo "Data Tidak Ada";
			die;
		}

		if ($getData_Tindakan->num_rows() > 0) {
			foreach ($getData_Tindakan->result() as $row) {
				$dT['nama_tindakan'] = $row->nama_tindakan;
				$dT['harga'] = number_format($row->harga, 0, ",", ".");
				$dT['is_paid'] = $row->is_paid;
				$data['data_tindakan']['data'][] = (object)$dT;
				$data['data_tindakan']['total'] += floatval($row->harga);
				if ($row->is_paid == 0) {
					$data['data_tindakan']['total_sebelum_checkout'] += floatval($row->harga);
				}
			}
		}
		$data['data_tindakan']['total'] = $data['data_tindakan']['total'];
		$data['data_tindakan']['total_sebelum_checkout'] = $data['data_tindakan']['total_sebelum_checkout'];
		$data['data_pembayaran'] = $getData_Payment->row();

		if ($getData_Resep->num_rows() > 0) {
			foreach ($getData_Resep->result() as $row) {
				$dT['nama_resep'] = $row->nama_obat;
				$dT['harga'] = number_format($row->harga, 0, ",", ".");
				$dT['qty'] = intval($row->qty);
				$dT['subtotal'] = number_format(($row->harga * $row->qty), 0, ",", ".");
				$data['data_resep']['data'][] = (object)$dT;
				$data['data_resep']['total'] += floatval(($row->harga * $row->qty));
			}
		}
		$data['data_resep']['total'] = $data['data_resep']['total'];

		$data['data_total']['total_seluruh'] = ($data['data_tindakan']['total'] + $data['data_resep']['total']);

		$this->load->view("kasir/cetak_pembayaran", $data);
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
