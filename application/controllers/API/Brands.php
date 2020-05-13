<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Brands extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $brands = $this->db->get('brands')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('name', $data);
            $brands = $this->db->get('brands')->result();
        }
        $this->response($brands, 200);
    }
}


/* End of file Brands.php */
