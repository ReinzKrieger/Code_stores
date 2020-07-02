<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login/login_m');
    }

    //Load Halaman dashboard     
    public function index()
    {
        if ($this->login_m->cek_session()) {
            $this->load->view("dashboard_v");
        } else {
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect(base_url('login'));
        }
    }
}
