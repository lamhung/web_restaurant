<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->lang->load('lang');
    }

    public function sign_in()
    {

    	$data = array();
    	$user_login = $this->session->userdata('user_login');
        if ($user_login) {
            redirect(base_url('index'));
        }
    	
    	if($this->input->post('submit')) {

    		$post = array();
    		$this->form_validation->set_rules('username',$this->lang->line('user_username'), "required");
    		$this->form_validation->set_rules('password',$this->lang->line('user_password'), "required");
    		if($this->form_validation->run() == 'TRUE'){
    			$post['username'] = $this->input->post('username');
    			$post['password'] = $this->input->post('password');
    			$result = $this->user_model->login($post);
    			// print_r($result);die;
    			if($result['success']) {
    				$url = $this->session->userdata('url');
    				redirect(base_url($url));
    			}else {
                    $data['msg'] = $result['msg'];
                }
    		}
    	}
    	
    	$this->load->view('layout/header');
    	$this->load->view('auth/login', $data);
    	$this->load->view('layout/footer');
    }

    public function sign_out()
    {
    	$this->session->sess_destroy();
    	redirect(base_url());
    }
}