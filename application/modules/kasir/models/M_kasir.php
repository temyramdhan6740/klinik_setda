<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_kasir extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->simrs = $this->load->database('simrs', TRUE);
	}

	public function getTindakan()
	{
		$this->simrs->where('poli', 'UMUM');
		return $this->simrs->get('vwTindakanSetDA');
	}

	public function getTindakanSelected($actCode)
	{
		$this->simrs->where('actcode', $actCode);
		$this->simrs->where('poli', 'UMUM');
		return $this->simrs->get('vwTindakanSetDA');
	}
}
