<?php
defined('BASEPATH') or exit('No direct script access allowed');


class DashboardModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('sirs', TRUE);
    }
}