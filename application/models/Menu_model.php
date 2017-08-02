<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct('menu');
    }
    
    public function default_value()
    {
        return array(
            'pknum' => '',
            'name' => '',
            'cost' => '',
            'menu_type' => '',
            'image_' => base_url('assets/img/clipping_pictures.png')
        );
    }
    
    public function convert_input($data = array())
    {
        $data['cost'] = str_replace('.', '', $data['cost']);
        $data['url'] = clean_url($data['name']);
        return $data;
    }
    public function convert_output($data = array())
    {
        
        if (!empty($data['image']) && is_file(UPLOADPATH.'menu/'.$data['image'])) {
            $data['image_'] = base_url() . "upload/menu/thumbnail/" . $data['image'];
        } else {
            $data['image_'] = base_url() . "assets/img/clipping_pictures.png";
        }
        $data['created_at_'] = nice_date($data['created_at'],'d/m/Y');
        return $data;
    }
}
