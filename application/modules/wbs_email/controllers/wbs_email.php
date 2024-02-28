<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Wbs_email extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'login';
        $this->load->view('default_login', $data);
    }

    public function send_email()
    {
        $email = $this->input->post('email');
        $data['balasan'] = $this->input->post('balasan');
        $data['keluhan'] = $this->input->post('keluhan');

        $message = $this->load->view('wbs_email/wbs_template', $data, true);

        $subject = "jangan dibalas - SIMRS RSUD AL IHSAN Mobile - Balasan Pengaduan";

        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'simrsudalihsan20@gmail.com',
            'smtp_pass'   => 'affz ilil nrap gooe', //@alihsan_2018
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('simrsudalihsan20@gmail.com', 'jangan dibalas - SIMRS RSUD AL IHSAN PROVINSI JAWA BARAT');
        // $this->email->from('rsudalihsanprovjabar@gmail.com', 'RSUD AL IHSAN PROVINSI JAWA BARAT');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            echo json_encode(array(
                'status' => 'success'
            ));
        } else {
            echo json_encode(array(
                'status' => 'failed'
            ));
        }
    }

    public function send_email_to_my()
    {
        // if (!$this->input->is_ajax_request()) {
        //     exit('No direct script access allowed');
        // }

        if ($this->input->post('name') == '') {
            echo json_encode(array(
                'status' => 'failed',
                'message' => 'Name cannot be empty'
            ));
            exit;
        }

        if ($this->input->post('email') == '') {
            echo json_encode(array(
                'status' => 'failed',
                'message' => 'Email cannot be empty'
            ));
            exit;

            if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array(
                    'status' => 'failed',
                    'message' => 'Email format is not valid'
                ));
                exit;
            }
        }

        if ($this->input->post('subject') == '') {
            echo json_encode(array(
                'status' => 'failed',
                'message' => 'Subject cannot be empty'
            ));
            exit;
        }

        if ($this->input->post('message') == '') {
            echo json_encode(array(
                'status' => 'failed',
                'message' => 'Message cannot be empty'
            ));
            exit;
        }

        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $message = $this->input->post('message');
        $subject = $this->input->post('subject');



        $message = $this->load->view('wbs_email/wbs_template', $desc, true);

        $subject = "From GIT : " . $name . " - " . $email;

        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'simrsudalihsan20@gmail.com',
            'smtp_pass'   => 'affz ilil nrap gooe', //@alihsan_2018
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('simrsudalihsan20@gmail.com', $email);
        // $this->email->from('rsudalihsanprovjabar@gmail.com', 'RSUD AL IHSAN PROVINSI JAWA BARAT');
        $this->email->to('maliocoding@gmail.com');
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            echo json_encode(array(
                'status' => 'success'
            ));
        } else {
            echo json_encode(array(
                'status' => 'failed'
            ));
        }
    }
}
