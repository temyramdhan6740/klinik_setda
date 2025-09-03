<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Aswal_keperawatan extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('M_aswal_keperawatan', 'model');
		if (!is_logged_in()) {
			redirect('login');
		}
	}

	public function index()
	{
		$data['js'] = 'js';
		$data['css'] = 'css';
		// $data['dropdown_dokter'] = $this->kasir->getListDokter()->result();
		$data['content'] = 'aswal_keperawatan';
		$this->load->view('default', $data);
	}

	public function cari_pasien()
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->model->Cari_List_RM($_POST['no_rm']);
			echo json_encode($this->ResponseAPI(200, 'Success', $data->result()));
			return;
		}
		$this->set_error_code(403);
	}

	public function cari_rm()
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->model->Cari_RM($_POST['struk'], $_POST['no_rm']);
			echo json_encode($this->ResponseAPI(200, 'Success', array(
				"data_rm" => $data->row(),
				"data_medrec" => $this->model->Cari_Askep($_POST['struk'])->result()
			)));
			return;
		}
		$this->set_error_code(403);
	}

	public function simpan()
	{
		if ($this->input->is_ajax_request()) {
			$req = json_decode($_POST['data'], true);
			$data = $this->populate_form($req);
			echo json_encode($this->ResponseAPI(200, 'Success', $req));
			return;
		}
		$this->set_error_code(403);
	}

	// PRIVATE FUNCTION
	private function populate_form($req, $is_update = FALSE)
	{
		$data = array(
			"struck_no" => $req['struckNo'],
			"cust_code" => $req['noRM'],
			"tanggal" => date("Y-m-d", strtotime($req['tanggal'])),
			"jam" => date("H:i:s", strtotime($req['jam'])),
			"ruang" => $req['ruang'],
			"sumber_data" => $req['sumber_data'],
			"rujukan" => json_encode(array(
				"rs" => $req['rs'],
				"puskesmas" => $req['puskesmas'],
				"doc_diag_rujukan" => $req['doc_diag_rujukan'],
			)),
			"keluhan_utama" => $req['keluhan_utama'],
			"pemeriksaan_fisik" => json_encode(array(
				"bb" => $req['bb'],
				"td" => $req['td'],
				"respirasi" => $req['respirasi'],
				"tb" => $req['tb'],
				"nadi" => $req['nadi'],
				"suhu" => $req['suhu']
			)),
			// RIWAYAT KESEHATAN
			"riwayat_penyakit_dahulu" => $req['riwayat_penyakit_dahulu_val'],
			"pernah_dirawat" => json_encode(array(
				"diagnosa" => $req['diag_pernah_dirawat'],
				"waktu" => $req['waktu_pernah_dirawat'],
				"di" => $req['di_pernah_dirawat'],
			)),
			"pernah_operasi" => json_encode(array(
				"diagnosa" => $req['diag_pernah_operasi'],
				"waktu" => $req['waktu_pernah_operasi'],
				"di" => $req['di_pernah_operasi'],
			)),
			"masih_dalam_pengobatan" => $req['masih_dalam_pengobatan_val'],
			// RIWAYAT KESEHATAN
			"riw_penyakit_keluarga" => $req['riw_penyakit_keluarga_val'],
			"ketergantungan_terhadap" => $req['ketergantungan_terhadap_val'],
			"riwayat_pekerjaan" => $req['riwayat_pekerjaan_val'],
			"riwayat_alergi" => $req['riwayat_alergi_val'],
			// RIWAYAT PSIKOSOSIAL & SPIRITUAL
			"status_psikologi" => $req['status_psikologi_val'],
			"hubungan_pasien" => $req['hubungan_pasien'],
			"kerabat_terdekat" => json_encode(array(
				"kerabat_terdekat" => $req['kerabat_terdekat'],
				"nama_kerabat" => $req['nama_kerabat'],
				"hubungan_kerabat" => $req['hubungan_kerabat'],
				"telp_kerabat" => $req['telp_kerabat'],
			)),
			"status_ekonomi" => $req['status_ekonomi'],
			// KEBUTUHAN KOMUNIKASI & EDUKASI
			"hambatan_dlm_pembelajaran" => $req['hambatan_dlm_pembelajaran_val'],
			"dibutuhkan_penerjemah" => $req['dibutuhkan_penerjemah_val'],
			"bahasa_isyarat" => $req['bahasa_isyarat_val'],
			"kebutuhan_edukasi" => $req['kebutuhan_edukasi_val'],
			"risiko_cedera" => json_encode(array(
				"risiko_cedera_a" => $req['risiko_cedera_a'],
				"risiko_cedera_b" => $req['risiko_cedera_b'],
			)),
			"status_fungsional" => json_encode(array(
				"aktivitas_mobilisasi" => $req['aktivitas_mobilisasi'],
				"alat_bantu_jalan" => $req['alat_bantu_jalan_val']
			)),
			// SKALA NYERI
			"skala_nyeri" => json_encode(array(
				"skrining_nyeri" => $req['skrining_nyeri'],
				"nyeri_akut" => $req['nyeri_akut'],
				"nyeri_kronis" => $req['nyeri_kronis'],
				"nyeri_hilang" => $req['nyeri_hilang'],
			)),
			// DAFTAR MASALAH KEPERAWTAN PRIORITAS
			"masalah_keperawatan" => $req['masalah_keperawatan'],
			"is_deleted" => FALSE,
			"created_by" => $this->session->userdata('username'),
		);
		if ($is_update === TRUE) {
			$data["updated_at"] = date("Y-m-d H:i:s");
			$data["updated_by"] = $this->session->userdata('username');
		}
		return $data;
	}

	private function set_error_code($code = 403, $message = 'Forbidden')
	{
		http_response_code(403);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->ResponseAPI(403, $message));
		exit;
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
