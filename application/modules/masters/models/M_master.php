<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_master extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function list_dokter()
    {
        $qry = $this->db->query("SELECT * from tb_dokter");
        return $qry->result_array();
    }

    public function list_user()
    {
        $qry = $this->db->query("SELECT id,username,nama from tb_user where username <> 'admin'");
        return $qry->result_array();
    }

    public function list_pasien()
    {
        $qry = $this->db->query("SELECT * from tb_pasien");
        return $qry->result_array();
    }

    public function get_dokter_code()
    {
        $qry = $this->db->query("SELECT  max(right(dokter_code, 3)) as dokter_code from tb_dokter");

        $dokter_code = $qry->row();
        if (isset($dokter_code->dokter_code)) {
            $dokter_code = $dokter_code->dokter_code;
        } else {
            $dokter_code = 0;
        }

        $id_new = $dokter_code + 1;

        if ($id_new < 10) {
            $id = "00" . $id_new;
        } elseif (($id_new >= 10) && ($id_new <= 99)) {
            $id = "0" . $id_new;
        } elseif (($id_new >= 100) && ($id_new <= 999)) {
            $id =  $id_new;
        }
        return 'D' . $id;
    }

    public function get_no_rm()
    {
        $qry = $this->db->query("SELECT right(max(replace(no_rm, '-', '')),4) as no_rm from tb_pasien");

        $no_rm = $qry->row();
        if (isset($no_rm->no_rm)) {
            $no_rm = $no_rm->no_rm;
        } else {
            $no_rm = 0;
        }

        $id_new = $no_rm + 1;

        if ($id_new < 10) {
            $id = "00000" . $id_new;
        } elseif (($id_new >= 10) && ($id_new <= 99)) {
            $id = "0000" . $id_new;
        } elseif (($id_new >= 100) && ($id_new <= 999)) {
            $id = "000" . $id_new;
        } elseif (($id_new >= 1000) && ($id_new <= 9999)) {
            $id = "00" . $id_new;
        } elseif (($id_new >= 10000) && ($id_new <= 99999)) {
            $id = "0" . $id_new;
        } elseif (($id_new >= 100000) && ($id_new <= 999999)) {
            $id = $id_new;
        }

        return wordwrap($id, 2, '-', true);
    }

    public function get_data($id, $table)
    {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    public function update_data($param, $table)
    {
        $this->db->trans_begin();
        foreach ($param as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->where("id", $param['id']);
        $this->db->update($table);

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'Data Berhasil Diubah');
        }
    }

    public function delete_data($id, $table)
    {
        $this->db->trans_begin();
        $this->db->where("id", $id);
        $this->db->delete($table);

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'Data Berhasil Hapus');
        }
    }

    public function insert_data($param, $table)
    {
        $this->db->db_debug = false;
        $this->db->trans_begin();
        foreach ($param as $key => $value) {
            $this->db->set($key, $value);
        }
        @$this->db->insert($table);

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => 'Username tidak dapat digunakan');
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'Data Berhasil Ditambah');
        }
    }
}