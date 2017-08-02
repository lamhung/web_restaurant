<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct('user');
    }
    
    public function default_value()
    {
        return array(
            'pknum' => '',
            'fullname' => '',
            'username' => '',
            'password' => '',
            'repassword' => '',
            'image_' => base_url("assets/img/clipping_pictures.png")
           
        );
    }
    
    public function convert_input($data = array())
    {
        return $data;
    }

    public function convert_output($data = array())
    {
        if (!empty($data['image']) && is_file(UPLOADPATH.'user/'.$data['image'])) {
            $data['image_'] = base_url() . "upload/user/thumbnail/" . $data['image'];
        } else {
            $data['image_'] = base_url() . "assets/img/clipping_pictures.png";
        }

        $data['created_at_'] = nice_date($data['created_at'],'d/m/Y');
        return $data;
    }


    public function is_login()
    {

        $user_login = $this->session->userdata('user_login');
        if(!isset($user_login['pknum'])) {
            $url = $this->uri->uri_string();
            $this->session->set_userdata('url',  $url);
            redirect(base_url('sign_in')); 
        }
    }

    public function login($input = array())
    {

        $result = array('success' => FALSE, 'msg' => "");
      
        $condition = array(
            'where' => array('username' => $input['username'])
        );
        $user = $this->get_by($condition);
        if(!$user) {
            $result['msg'] = "Tài khoản không tồn tại";
        }else if($user['password'] != md5(md5($input['password']))){
            $result['msg'] = "Password không chính xác";
        }else {
            $session = array(
                'pknum' => $user['pknum'],
                'fullname' => $user['fullname'],
                'image' => $user['image'],
            );
            $this->session->set_userdata('user_login', $session);
            $result['success'] = TRUE;
        }
      

       
       return $result;
    }
}
