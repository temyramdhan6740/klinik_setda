<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_kasir extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->simrs = $this->load->database('simrs', TRUE);
	}

	public function getTindakan($poli = "001")
	{
		$this->simrs->where('poli', ($poli == "001") ? 'UMUM' : 'GIGI');
		return $this->simrs->get('vwTindakanSetDA');
	}

	public function getTindakanSelected($actCode)
	{
		$this->simrs->where('actcode', $actCode);
		return $this->simrs->get('vwTindakanSetDA');
	}

	public function getTindakanByStruk($struk)
	{
		$this->db->where('no_struck', $struk);
		return $this->db->get('tb_tindakan_perda');
	}

	public function getResepByStruk($struk)
	{
		$this->db->where('no_struck', $struk);
		return $this->db->get('tb_trans_resep_detail');
	}

	public function getListAntrian($tgl_antrian, $poli_antrian, $dokter_antrian)
	{
		$this->Query_Antrian();
		$this->db->where("DATE(a.reg_date)", $tgl_antrian);
		if ($poli_antrian != '' && $poli_antrian != null) {
			$this->db->where("a.kode_poli", $poli_antrian);
		}
		if ($dokter_antrian != '' && $dokter_antrian != null) {
			$this->db->where("c.dokter_code", $dokter_antrian);
		}
		return $this->db->get("tb_antrian a");
	}

	public function getListAntrian_ByRM($no_rm)
	{
		$this->Query_Antrian();
		$this->db->where("a.no_rm", $no_rm);
		return $this->db->get("tb_antrian a");
	}

	public function getRM($struk_antrian)
	{
		$this->Query_Antrian();
		$this->db->where("a.no_struck", $struk_antrian);
		return $this->db->get("tb_antrian a");
	}

	public function getListDokter()
	{
		return $this->db->get('tb_dokter');
	}

	public function getPay_ByStruk($struk, $tranType)
	{
		$this->db->where('struck_no', $struk);
		$this->db->where('tran_type', $tranType);
		return $this->db->get('tb_payment');
	}

	public function getLastPay()
	{
		$this->db->order_by('id', 'DESC');
		$this->db->limit('1');
		return $this->db->get('tb_payment');
	}

	public function insertPayment($data)
	{
		$getData = $this->getPay_ByStruk($data['struck_no'], $data['tran_type']);

		$this->db->trans_start();
		$data['updated_by'] = $this->session->userdata('id');
		$data['updated_date'] = date('Y-m-d H:i:s');
		if ($getData->num_rows() > 0) {
			$this->db->where('struck_no', $data['struck_no']);
			$this->db->where('tran_type', $data['tran_type']);
			$this->db->update('tb_payment', $data);
		} else {
			$data['created_by'] = $this->session->userdata('id');
			$data['created_date'] = date('Y-m-d H:i:s');
			$this->db->insert('tb_payment', $data);
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			return 1;
		}
	}

	public function insertTindakan($data)
	{
		if (count($data) == 0) {
			return 1;
		}

		$this->db->trans_start();
		$this->db->insert_batch('tb_tindakan_perda', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			return 1;
		}
	}

	public function insertTindakanAwal($data)
	{
		// $getData = $this->getTindakanSelected($data['tindakan_code']);
		// if ($getData->num_rows() > 0) {
		// 	return 1;
		// }

		$this->db->trans_start();
		$this->db->insert('tb_tindakan_perda', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			return 1;
		}
	}

	public function updateTindakan($data)
	{
		if (count($data) == 0) {
			return 1;
		}

		$this->db->trans_start();
		$this->db->update_batch('tb_tindakan_perda', $data, 'id');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			return 1;
		}
	}

	public function getListRekap($tglAwalAkhir, $poli, $dokter)
	{
		$splitTgl = explode(' - ', $tglAwalAkhir);
		$date = array(
			"start" => $splitTgl[0],
			"end" => $splitTgl[1]
		);
		$this->db->select("
			ant.*,
			cus.nama_pasien,
			cus.biro,
			doc.nik,
			doc.sip,
			doc.dokter_code,
			doc.nama_dokter,
			doc.ihs AS dokter_ihs,
			pol.kode_poli,
			pol.nama_poli,
			ROUND(
  			  ROUND(
  			    COALESCE (
  			      ( SELECT SUM ( COALESCE ( CAST ( harga AS NUMERIC ), 0.0 ) ) FROM tb_tindakan_perda tp WHERE ant.no_struck = tp.no_struck ),
  			      0.0 
  			      ) + COALESCE (
  			      (
  			      SELECT SUM
  			        ( COALESCE ( CAST ( qty AS NUMERIC ), 0.0 ) * COALESCE ( CAST ( harga AS NUMERIC ), 0.0 ) ) 
  			      FROM
  			        tb_trans_resep_detail tp 
  			      WHERE
  			        ant.no_struck = tp.no_struck 
  			      ),
  			      0.0 
  			    ),
  			    0 
  			  ) / 1000,
  			  0 
  			) * 1000 AS total_biaya
		");
		$this->db->join("tb_pasien cus", "ant.no_rm = cus.no_rm", "left");
		$this->db->join("tb_dokter doc", "ant.dokter_code = doc.dokter_code", "left");
		$this->db->join("tb_poli pol", "ant.kode_poli = pol.kode_poli", "left");
		$this->db->where("(ant.status <> '3' and ant.status IS NOT NULL)");
		$this->db->where("DATE(ant.reg_date) BETWEEN " . $this->db->escape($date['start']) . " AND " . $this->db->escape($date['end']));
		if ($poli != '' && $poli != null) {
			$this->db->where("pol.kode_poli", $poli);
		}
		if ($dokter != '' && $dokter != null) {
			$this->db->where("doc.dokter_code", $dokter);
		}

		return $this->db->get("tb_antrian AS ant");
	}

	// PRIVATE

	public function Query_Antrian()
	{
		$this->db->select("
			a.id,
			a.no_struck,
			a.jenis_kunjungan,
			a.no_rm,
			a.antrian,
			a.reg_time,
			b.nama_pasien,
			b.biro,
			b.no_ktp,
			b.alamat,
			c.nama_dokter,
			c.dokter_code,
			d.nama_poli,
			d.kode_poli,
			p.payment_code,
			p.tran_type,
			p.payment_type,
			p.amount_total,
			p.amount_total_rounding,
			p.amount_paid,
			p.amount_change,
			p.amount_outstanding,
			p.deleted
		");
		$this->db->join("tb_pasien b", "a.no_rm = b.no_rm", "left");
		$this->db->join("tb_dokter c", "a.dokter_code = c.dokter_code", "left");
		$this->db->join("tb_poli d", "a.kode_poli = d.kode_poli", "left");
		$this->db->join("tb_payment p", "a.no_struck = p.struck_no", "left");
		$this->db->where("(a.status <> '3' and a.status IS NOT NULL)");
		$this->db->order_by("a.antrian", "ASC");
	}
}
