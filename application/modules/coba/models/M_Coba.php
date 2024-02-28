<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Coba extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }


    public function update_fire($nik, $his)
    {
        $this->db->set('his', $his);
        $this->db->where('no_ktp', $nik);
        $this->db->update("tb_pasien");

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'His pasien Berhasil Ditambah', 'his' => $his, 'nik' => $nik);
        }
    }

    public function get_dokter()
    {
        $qry = $this->db->query("SELECT *
            FROM
                coba_dokter");

        return $qry->result_array();
    }

    public function get_lokasi()
    {
        $qry = $this->db->query("SELECT *
            FROM
                coba_lokasi");

        return $qry->result_array();
    }

    public function insert_encounter($encounter_id, $pasien_id, $lokasi_id, $tranCode)
    {
        $this->db->where('encounter_id', $encounter_id);
        $this->db->delete("coba_encounter");

        $this->db->set('encounter_id', $encounter_id);
        $this->db->set('lokasi_id', $lokasi_id);
        $this->db->set('pasien_id', $pasien_id);
        $this->db->set('tranCode', $tranCode);
        $this->db->insert("coba_encounter");

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'Encounter Berhasil Ditambah', 'encounter_id' => $encounter_id, 'pasien_id' => $pasien_id);
        }
    }

    // public function update_encounter($encounter_id, $update_encounter_id)
    // {
    //     $this->db->where('encounter_id', $encounter_id);

    //     if ($this->db->trans_status() === FALSE) {
    //         $msg = $this->db->error();
    //         $this->db->trans_rollback();
    //         return array('status' => 0, 'message' => $msg['message']);
    //     } else {
    //         $this->db->trans_commit();
    //         return array('status' => 200, 'message' => 'Encounter Berhasil Ditambah', 'encounter_id' => $encounter_id, 'pasien_id' => $pasien_id);
    //     }
    // }

    public function insert_condition($condition_id, $encounter_id, $pasien_id)
    {

        $this->db->where('condition_id', $condition_id);
        $this->db->delete("coba_condition");

        $this->db->set('condition_id', $condition_id);
        $this->db->set('encounter_id', $encounter_id);
        $this->db->set('pasien_id', $pasien_id);
        $this->db->insert("coba_condition");

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'Condition Berhasil Ditambah', 'condition_id' => $condition_id);
        }
    }

    public function get_list_diagnosa($param)
    {
        $qry = $this->db->query("SELECT
                    kode,
                    nama
                from
                    tb_icd10_ihs
                where
                kode like '%$param%' or nama like '%$param%'
                order by
                nama asc");
        return $qry->result();
    }

    public function get_list_pasien()
    {
        $qry = $this->db->query("select * from coba_pasien");
        return $qry->result_array();
    }

    public function get_list_encounter($pasien)
    {
        $qry = $this->db->query("select coba_encounter where pasien_id = $pasien");
        return $qry->result_array();
    }
}