<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_aswal_keperawatan extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}

	public function Cari_List_RM($custCode)
	{
		$this->Query_RM();
		$this->db->where("a.no_rm", implode("-", str_split($custCode, 2)));
		return $this->db->get("tb_antrian a");
	}

	public function Cari_RM($struk, $custCode)
	{
		$this->Query_RM();
		$this->db->where("a.no_rm", $custCode);
		$this->db->where("a.no_struck", $struk);
		return $this->db->get("tb_antrian a");
	}
	public function Cari_Askep($struk)
	{
		$this->db->where("struck_no", $struk);
		return $this->db->get("tb_aswal_keperawatan");
	}

	// PRIVATE FUNCTION
	private function Query_RM()
	{
		$this->db->select("
			a.*, 
			c.nama_pasien AS cust_name, 
			c.jenis_kelamin AS jk, 
			c.tanggal_lahir,
			d.nama_dokter AS doc_name,
			p.nama_poli AS poli_name
		");
		$this->db->join("tb_pasien c", "c.no_rm = a.no_rm", "left");
		$this->db->join("tb_dokter d", "d.dokter_code = a.dokter_code", "left");
		$this->db->join("tb_poli p", "p.kode_poli = a.kode_poli", "left");
		$this->db->order_by("a.created_date", "DESC");
	}
}
