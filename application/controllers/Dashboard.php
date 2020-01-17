<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if((!$this->session->userdata('ses_email')) ){ 
            redirect('auth');
        } 
       
    }

    public function index()
    {
        
        $this->load->view('layout/header');
        $this->load->view('dashboard/index');
        $this->load->view('layout/footer');
    }
}