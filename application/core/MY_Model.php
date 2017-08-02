<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $table = null;
    protected $key = null;
    protected $fields = array();
    

    public function __construct($table = null) {
        parent::__construct();
        $this->initialize($table);
    }

    private function initialize($table = null) {
        $CI = &get_instance();
        $CI->load->database();

        if (!is_null($table)) {
            $this->table = $this->db->dbprefix($table);
            $this->fields = $this->db->list_fields($this->table);
            $this->key = $this->db->primary($this->table);
            // $fields = $this->db->field_data($this->table);
            // foreach ($fields as $row) {
            //     if ($row->primary_key) {
            //         $this->key = $row->name;
            //         break;
            //     }
            // }//foreach
        } else {
            show_error("CRUD : __construct() must have table name");
        }

    }

    /**
     * Lấy ra 1 dòng
     * $conditions : Điều kiện truyền vào là số hoặc mảng
     *
     */
    public function get_by($conditions)
    {
    	if(is_numeric($conditions)) {
            $this->db->where($this->key, $conditions);
        }else if (is_array($conditions) && count($conditions) > 0) {
            $this->get_list_set_input($conditions);
        }else {
            show_error("Method: get_by() CRUD : Param must be ARRAY OR NUMBERIC and NOT empty!");
        }
        $query = $this->db->get($this->table);
        return $query->row_array();
    }
    public function count_total($input = array()){
        $this->get_list_set_input($input);

       return $this->db->count_all_results($this->table);   
       // echo $this->db->last_query();die;
    }
    /**
     * Lấy ra danh sách dữ liệu
     * $conditions : Điều kiện truyền vào là mảng
     *
    */
    public function get_rows($array = array())
    {

        $this->get_list_set_input($array);
        $query = $this->db->get($this->table);
        // echo $this->db->last_query();
        return $query->result_array();
    }

    /**
     * Insert Data
     * @param $input
     * @return boolean
     */
    public function insert($input = array()) {
        $data = array();
        foreach ($this->fields as $v) {
            if (isset($input[$v])) {
                $data[$v] = $input[$v];
            }
        }
        // $this->db->last_query();die;
        return $this->db->insert($this->table, $data);
    }

    /**
     * Get Insert ID
     * @return number
     */
    public function insert_id() {
        return $this->db->insert_id();
    }

    /**
     * Update data
     * @return boolean
     */
    public function update($o, $where = array()) 
    {
        if (!is_array($where) || count($where) == 0) {
            if (isset($o[$this->key])) {
                $this->db->where($this->key, $o[$this->key]);
                
                unset($o[$this->key]);
            } else {
                show_error('Method: update() CRUD : Can not found value key for update');
            }
        } else {
            foreach ($where as $field => $data) {
                if (!in_array($field, $this->fields)) {
                    show_error("CRUD : '$this->table' don't have in '$field'");
                }
            }
           
            $this->db->where($where);
        }

        $data = array();

        foreach ($o as $k => $v) {
            if (in_array($k, $this->fields)) {
                $data[$k] = $v;
            }
        }

        return $this->db->update($this->table, $data);
    }

    public function destroy($conditions = array())
    {
        if(is_numeric($conditions)) {
            $this->db->where($this->key, $conditions);
            
        }
        else if (is_array($conditions) && count($conditions) > 0) 
        {
            foreach ($conditions as $field => $data) {
                if (!in_array($field, $this->fields)) {
                    show_error("CRUD : '$this->table' don't have in '$field'");
                }
            }
            $this->db->where($conditions);
            
        }
        return $this->db->delete($this->table);
    }


    protected function get_list_set_input($input = array()) {
    //Select
        if (isset($input['select'])) {
            if (is_string($input['select']) && $input['select']) {
                $this->db->select($input['select']);
            } else {
                show_error("Method: get_row() CRUD : Param SELECT must be STRING and NOT empty!");
            }
        }
        //where
        // string or array(field1 => value1, field2 => value2, ...)
        if (isset($input['where']) && $input['where']) {
            if (is_array($input['where']) && count($input['where']) > 0) {
                $this->db->where($input['where']);
            } else if (is_string($input['where'])) {
                $this->db->where($input['where']);
            } else {
                show_error("Method: get_row() CRUD : Param WHERE must be ARRAY OR STRING and NOT empty!");
            }
        }

        if (isset($input['like']) && $input['like']) {

            if(is_array($input['like']) && count($input['like']) > 0) {
                $this->db->like($input['like']);
            }else {
                show_error("Method: get_row() CRUD : Param LIKE must be ARRAY  and NOT empty!");
            }
        }
        if (isset($input['or_like']) && $input['or_like']) {
            if (is_array($input['or_like']) && count($input['or_like']) > 0) {
                $this->db->or_like($input['or_like']);
            }  else {
                show_error("Method: get_row() CRUD : Param OR LIKE must be ARRAY  and NOT empty!");
            }
        }
        //or_where
        //$input['or_where'] = "'id>', 1";
        if (isset($input['or_where'])) {
            $this->db->or_where($input['where']);
            
            // echo $input['or_where'];die;
        }
        //where_in
        //Vi du: input['wherer_in'] = 'id, array(1,2,3)';
        if (isset($input['where_in'])) {
            $this->db->where_in($input['where_in']);
        }
        //order_by
        //string "field1 ASC, field2 DESC"string "field1 ASC, field2 DESC"
        if (isset($input['order_by'])) {
            $this->db->order_by($input['order_by']);
        }
        //limit
        //phải là số
        if (isset($input['limit'])) {
            if (is_numeric($input['limit'])) {
                $offset = isset($input['offset']) ? intval($input['offset']) : 0;
                $this->db->limit($input['limit'], $offset);
            } else {
                show_error("Method: get_row() CRUD : Param LIMIT must be NUMBER!");
            }
        }
    }

   
}