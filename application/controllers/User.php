<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();

    }
    
    public function index()
    {
    	$get = $this->input->get();	
    	$keywords = isset($get['keywords']) ? $get['keywords'] : '';
    	$config = $this->config->item('pagination');
        $config['base_url'] = base_url('user');
        $config['reuse_query_string'] = TRUE;
        $con_count = array(
        	'select' => 'COUNT(*)',
            );
        if(!empty($keywords)) {
        	$con_count['like'] = 'name, $keywords';
        }
        $config['total_rows'] = $this->user_model->count_total($con_count);
        $config['per_page'] = 12;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE; 
        $config['query_string_segment'] = 'page'; 

        $this->pagination->initialize($config);
        $offset = isset($get['page']) ? ($get['page'] - 1) * $config['per_page'] : 0;

        $condition = array(
            'order_by' => 'pknum DESC',
            'limit' => $config['per_page'],
            'offset' => $offset,
            );
        if(!empty($keywords)) {
        	$condition['like'] = 'name, $keywords';
        }

        $rows = $this->user_model->get_rows($condition);

        $this->data['rows'] = $rows;

        $this->load->view('layout/header');
        $this->load->view('user/index', $this->data);
        $this->load->view('layout/footer');
    }


    public function add()
    {
        $this->data['row'] = $this->user_model->default_value();

        if($this->input->post('submit')) {
            $success = TRUE;
            $post = $this->user_model->convert_input($this->input->post());
            
            
            $this->form_validation->set_rules('fullname',$this->lang->line('user_fullname'), "required");
            $this->form_validation->set_rules('username',$this->lang->line('user_username'), "required|is_unique[user.username]");
            $this->form_validation->set_rules('password',$this->lang->line('user_password'),'required|min_length[6]');
            $this->form_validation->set_rules('repassword',$this->lang->line('user_repassword'), 'required|matches[password]');

            if($this->form_validation->run() == 'TRUE'){
                if($_FILES['image']['name'])
                {
                    $this->load->library('imagelib');
                    $thumb_config = array('width' => 220, 'height' => 180);
                    $image = $this->imagelib->upload_one('image', 'user', NULL, $thumb_config);
                    if(isset($image['error'])) {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    } else {
                        $post['image'] = $image['file_name'];
                    }
                }
                if($success)
                {
                    $post['created_at'] = time();
                    $post['password'] = md5(md5($post['password']));
                    $result = $this->user_model->insert($post);
                    if ($result) {
                       $this->session->set_flashdata('msg_success', $this->lang->line('user_has_been_create'));
                       redirect(base_url('user'));
                   }
                }
           }
       }

       $this->load->view('layout/header');
       $this->load->view('user/add',$this->data);
       $this->load->view('layout/footer');
   }

    public function edit()
    {
        $id = $this->input->get('id');
        $row = $this->user_model->get_by($id);
        $post = array();
        $post = $this->user_model->convert_input($this->input->post());
        
        if (!$row) {
            $this->session->set_flashdata("msg_error", $this->lang->line('user_not_exist'));
            redirect(base_url('user'));
        }
        if($this->input->post('submit')) {
            $success = TRUE;

            $this->form_validation->set_rules('fullname',$this->lang->line('user_fullname'), "required");
            if(!empty($post['username']) && $post['username'] != $row['username'] )
            {
               $this->form_validation->set_rules('username',$this->lang->line('user_username'), "required|is_unique[user.username]");
            }
            else
            { $this->form_validation->set_rules('username',$this->lang->line('user_username'), "required");
            }

            if(!empty($post['password']) && md5(md5($post['password'])) != $row['password'])
            { 
               $this->form_validation->set_rules('password',$this->lang->line('user_password'),'required|min_length[6]');
               $this->form_validation->set_rules('repassword',$this->lang->line('user_repassword'), 'required|matches[password]');
            }
            if($this->form_validation->run() == 'TRUE'){
                if($_FILES['image']['name'])
                {
                    $this->load->library('imagelib');
                    $thumb_config = array('width' => 220, 'height' => 180);
                    $image = $this->imagelib->upload_one('image', 'user', NULL, $thumb_config);
                    if(isset($image['error'])) {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    } else {
                        $post['image'] = $image['file_name'];
                    }
                }
                if($success)
                {
                    $post['password'] = !empty($post['password']) ?  md5(md5($post['password'])) : $row['password'];
                    $post['created_at'] = time();
                    $post['pknum'] = $id;
                    $result = $this->user_model->update($post);
                    if ($result) {
                       $this->session->set_flashdata('msg_success', $this->lang->line('user_has_been_update'));
                       if(isset($post['image'])) {
                            $this->imagelib->delete('user', $row['image']);
                        }
                       redirect(base_url('user'));
                    }
                }
            }
        
        }
        $this->data['row'] = $this->user_model->convert_output($row);
        $this->load->view('layout/header');
        $this->load->view('user/edit',$this->data);
        $this->load->view('layout/footer');
    }

    public function delete()
    {
        $get = $this->input->get();
        $id = isset($get['id']) ? $get['id'] : 0;

        $row = $this->user_model->get_by($id);
        if (!$row) {
            $this->session->set_flashdata("msg_error", $this->lang->line('user_not_exist'));
            redirect(base_url('user'));
        }
        if($this->user_model->destroy($id)){
            $this->load->library('imagelib');
            $this->imagelib->delete('user', $row['image']);
            $this->session->set_flashdata("msg_info", $this->lang->line('user_has_been_deleted'));
        }
        $url = isset($get['page']) ? '?page='.$get['page'] : '';
        redirect(base_url('user'.$url));
    }
}