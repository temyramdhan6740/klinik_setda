<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        if (!is_logged_in()) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'dashboard';
        $this->load->view('default', $data);
    }
}