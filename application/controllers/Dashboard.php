<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    // Ko can login
    public function index()
    {
    	$this->load->view('layout/header');
    	$this->load->view('layout/dashboard');
    	$this->load->view('layout/footer');
    }

}