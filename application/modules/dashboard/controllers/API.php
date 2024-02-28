<?php
defined('BASEPATH') or exit('No direct script access allowed');


class API extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index()
    {
        echo 'kudaliar';
        // $data['js'] = 'js';
        // $data['css'] = 'css';
        // $data['content'] = 'dashboard';
        // $this->load->view('default', $data);
    }
}