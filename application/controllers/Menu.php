<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index()
    {
        $get = $this->input->get();

        $keywords = isset($get['keywords']) ? $get['keywords'] : '';
        $config = $this->config->item('pagination');
        $config['base_url'] = base_url('menu');
        $config['reuse_query_string'] = TRUE; 
        $con_count = array(
            'select' => 'COUNT(*)',
        );
        if(!empty($keywords)) {
            $con_count['like'] = array('name' => $keywords);
        }
        $config['total_rows'] = $this->menu_model->count_total($con_count);
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
            $condition['like'] = array('name' => $keywords);
        }

        $rows = $this->menu_model->get_rows($condition);

        $this->data['rows'] = $rows;
    	$this->load->view('layout/header');
    	$this->load->view('menu/index', $this->data);
    	$this->load->view('layout/footer');
    }

    public function add()
    {
        $this->data['row'] = $this->menu_model->default_value();
        if($this->input->post('submit')) {
            $success = TRUE;
            $post =$this->input->post();
            // print_r($post);die;
            $this->form_validation->set_rules('name',$this->lang->line('menu_name'), "required");
            $this->form_validation->set_rules('cost',$this->lang->line('menu_cost'), "required");
            if($this->form_validation->run() == 'TRUE'){
                if($_FILES['image']['name'])
                {
                    $this->load->library('imagelib');
                    $thumb_config = array('width' => 220, 'height' => 180);
                    $image = $this->imagelib->upload_one('image', 'menu', NULL, $thumb_config);
                    if(isset($image['error'])) {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    } else {
                        $post['image'] = $image['file_name'];
                    }
                }
                if($success)
                {
                    $user = $this->session->userdata('user_login');
                    $post['created_at'] = time();
                    $post['created_by'] = $user['pknum'];
                    $post = $this->menu_model->convert_input($post);
                    $result = $this->menu_model->insert($post);
                    if ($result) {
                         $this->session->set_flashdata('msg_success', $this->lang->line('menu_has_been_create'));
                        redirect(base_url('menu'));
                    }
                }
            }
        }
    	$this->load->view('layout/header');
    	$this->load->view('menu/add',$this->data);
    	$this->load->view('layout/footer');
    }

    public function edit()
    {   
        $id = $this->input->get('id');
        $row = $this->menu_model->get_by($id);
        $post = $this->input->post();
        if (!$row) {
            $this->session->set_flashdata("msg_error", $this->lang->line('menu_not_exist'));
             redirect(base_url('menu'));
        }
        if($this->input->post('submit')) {
            $success = TRUE;

            $this->form_validation->set_rules('name',$this->lang->line('menu_name'), "required");
            $this->form_validation->set_rules('cost',$this->lang->line('menu_cost'), "required");
            if($this->form_validation->run() == 'TRUE'){
                if($_FILES['image']['name'])
                {

                    $this->load->library('imagelib');
                    $thumb_config = array('width' => 220, 'height' => 180);
                    $image = $this->imagelib->upload_one('image', 'menu', NULL, $thumb_config);
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
                    $post['pknum'] = $id;
                    $post = $this->menu_model->convert_input($post);
                    $result = $this->menu_model->update($post);
                    if ($result) {
                        $this->session->set_flashdata('msg_success', $this->lang->line('menu_has_been_update'));
                        if(isset($post['image'])) {
                            $this->imagelib->delete('menu', $row['image']);
                        }
                        redirect(base_url('menu'));
                    }
                }
            }
        }

        
        $this->data['row'] = $this->menu_model->convert_output($row);
    	$this->load->view('layout/header');
    	$this->load->view('menu/edit', $this->data);
    	$this->load->view('layout/footer');
    }

    public function delete()
    {
        $get = $this->input->get();
        $id = isset($get['id']) ? $get['id'] : 0;
    	$row = $this->menu_model->get_by($id);
        if (!$row) {
            $this->session->set_flashdata("msg_error", $this->lang->line('menu_not_exist'));
            redirect(base_url('menu'));
        }
        if($this->menu_model->destroy($id)){
            $this->load->library('imagelib');
            $this->imagelib->delete('menu', $row['image']);
            
            $this->session->set_flashdata("msg_info", $this->lang->line('menu_has_been_deleted'));
        }
        $url = isset($get['page']) ? '?page='.$get['page'] : '';
        redirect(base_url('menu'.$url));
    }

}