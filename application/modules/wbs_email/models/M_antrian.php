<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_antrian extends CI_Model
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
        $qry = $this->db->query("SELECT * from tb_user where username = '$username' and password ='$password'");
        return $qry->row();
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

    public function get_list_dokter()
    {
        $qry = $this->db->query("SELECT * from tb_dokter");
        return $qry->result_array();
    }

    public function get_list_poli()
    {
        $qry = $this->db->query("SELECT * from tb_poli");
        return $qry->result_array();
    }

    public function get_pasien($no_rm)
    {
        $qry = $this->db->query("SELECT * from tb_pasien where replace(no_rm,'-','') = '$no_rm'");
        return $qry->row();
    }

    public function get_struck_no()
    {
        $year = date("y");
        $month = date("m");
        $qry = $this->db->query("SELECT  max(right(no_struck, 6)) as no_struck from tb_antrian
                                WHERE
                                LEFT ( no_struck, 4 ) = '$year$month'");

        $struckNo = $qry->row();
        if (isset($struckNo->no_struck)) {
            $strukno = $struckNo->no_struck;
        } else {
            $strukno = 0;
        }

        $id_new = $strukno + 1;

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

        return substr($year, -2) . $month . $id;
    }

    public function get_antrian($poli)
    {
        $qry = $this->db->query("SELECT max(antrian) as antrian from tb_antrian where date(reg_date) = '" . date("Y-m-d") . "' and kode_poli = '$poli' ");
        return $qry->row();
    }

    public function insert_antrian($param)
    {
        $this->db->db_debug = false;
        $this->db->trans_begin();
        $this->db->set("no_struck", $param['no_struck']);
        $this->db->set("no_rm", $param['no_rm']);
        $this->db->set("antrian", $param['antrian']);
        $this->db->set("reg_date", date('Y-m-d H:i:s'));
        $this->db->set("is_bpjs", $param['bpjs']);
        $this->db->set("kode_poli", $param['poli']);
        $this->db->set("dokter_code", $param['dokter']);
        @$this->db->insert("tb_antrian");


        $this->db->set("anamnesa", $param['anamnesa']);
        $this->db->set("no_struck", $param['no_struck']);
        $this->db->set("no_rm", $param['no_rm']);
        @$this->db->insert("tb_soap");

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'Antrian Berhasil Ditambah');
        }
    }

    public function get_list_antrian()
    {
        $qry = $this->db->query("SELECT 
                a.no_rm,
                a.antrian,
                to_char(a.reg_date, 'HH24:MI:SS') as reg_date,
                b.nama_pasien,
                b.biro,
                c.nama_dokter,
                d.nama_poli 
            FROM
                tb_antrian
                A left JOIN tb_pasien b ON A.no_rm = b.no_rm 
                left join tb_dokter c on a.dokter_code= c.dokter_code
                left join tb_poli d on a.kode_poli=d.kode_poli
            WHERE
                DATE ( reg_date ) = '" . date('Y-m-d') . "'
                order by antrian asc
                ");

        return $qry->result_array();
    }

    public function insert_pasien_baru($param)
    {
        $this->db->db_debug = false;
        $this->db->trans_begin();

        $qry = $this->db->query("SELECT max(replace(no_rm,'-','')) as no_rm from tb_pasien");
        $no_rm = strval($qry->row()->no_rm + 1);
        $no_rm = str_pad($no_rm, 6, "0", STR_PAD_LEFT);
        $split_arr = str_split($no_rm, 2);
        $param['no_rm'] = implode("-", $split_arr);
        foreach ($param as $key => $value) {
            $this->db->set($key, $value);
        }
        @$this->db->insert("tb_pasien");

        if ($this->db->trans_status() === FALSE) {
            $msg = $this->db->error();
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => $msg['message']);
        } else {
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'pasien Berhasil Ditambah', 'no_rm' => $param['no_rm']);
        }
    }
}