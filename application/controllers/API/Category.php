<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Category extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $categories = $this->db->get('categories')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('name', $data);
            $categories = $this->db->get('categories')->result();
        }
        $this->response($categories, 200);
    }
}


/* End of file Category.php */
