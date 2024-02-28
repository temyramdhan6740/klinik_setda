<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function is_doctor($staffCode)
    {
        $qry = $this->db->query("select b.docCode from tbuser a join tbdoctor b on a.staffCode =b.docCode where (b.deleted is null or b.deleted =0 ) and b.type = 'Dokter' and a.staffCode = '$staffCode'");
        return $qry->num_rows();
    }


    public function login($username, $password)
    {
        $this->db->select("*");
        $this->db->from('tb_user');
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        return $this->db->get()->row();
    }

    public function insert_register($param)
    {
        $this->db->db_debug = false;
        $this->db->trans_begin();
        $this->db->set("username", $param['username']);
        $this->db->set("password", $param['password']);
        $this->db->set("role_user", $param['role']);
        $this->db->set("nama", $param['nama']);
        $this->db->set("kode_dokter", $param['kode_dokter']);
        @$this->db->insert("tb_user");

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'Register berhasil');
        }
    }

    public function cek_pass($param)
    {
        $this->db->select("*");
        $this->db->from('tb_user');
        $this->db->where("username", $_SESSION['id']);
        $this->db->where("password", $param);
        return $this->db->get()->row();
    }

    public function update_pass($param)
    {
        $this->db->db_debug = false;
        $this->db->trans_begin();
        $this->db->set("password", $param);
        $this->db->where("username", $_SESSION['id']);
        @$this->db->update("tb_user");

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'Ubah Password berhasil');
        }
    }
}