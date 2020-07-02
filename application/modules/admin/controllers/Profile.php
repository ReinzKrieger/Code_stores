<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('login/login_m');
    }

    public function index()
    {
        if ($this->login_m->cek_session()) {
            $this->load->view('profile_v');
        } else {
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect(base_url('login'));
        }
    }
}
