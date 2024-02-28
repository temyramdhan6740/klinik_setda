<?php
defined('BASEPATH') or exit('No direct script access allowed');


class LoginModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('sirs', TRUE);
    }

    public function is_doctor($staffCode)
    {
        $qry = $this->db->query("select b.docCode from tbuser a join tbdoctor b on a.staffCode =b.docCode where (b.deleted is null or b.deleted =0 ) and b.type = 'Dokter' and a.staffCode = '$staffCode'");
        return $qry->num_rows();
    }

    public function cek_user($email, $password)
    {
        $query = $this->db->query("select id, username, password, docCode, role from tbUserLogin where username = '{$email}' and password = '{$password}'");
        return $query;
    }

    public function cek_user2($userid, $password)
    {
        $this->db->select("userId, name, role, statusAktifWeb, staffCode,docCode");
        $this->db->from("tbuser");
        $this->db->where("userId", $userid);
        $this->db->where("pass", $password);
        return $this->db->get();
    }

    public function list_user()
    {
        $this->db->select("userId");
        $this->db->from("tbuser");
        $this->db->where("userId !=", '');
        $this->db->where("userId !=", null);
        $this->db->where("deleted", null, "|| deleted =='0'");
        $this->db->order_by("userId asc");
        return $this->db->get();
    }
}