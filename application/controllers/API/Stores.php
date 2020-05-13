<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Stores extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $stores = $this->db->get('stores')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('name', $data);
            $this->db->or_where('active', $data);
            $stores = $this->db->get('stores')->result();
        }
        $this->response($stores, 200);
    }
}


/* End of file Stores.php */
