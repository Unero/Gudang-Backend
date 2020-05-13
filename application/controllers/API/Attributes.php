<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Attributes extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $attributes = $this->db->get('attributes')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('name', $data);
            $attributes = $this->db->get('attributes')->result();
        }
        $this->response($attributes, 200);
    }
}


/* End of file Attributes.php */
