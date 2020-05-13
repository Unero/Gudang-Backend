<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Company extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $companies = $this->db->get('company')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('company_name', $data);
            $companies = $this->db->get('company')->result();
        }
        $this->response($companies, 200);
    }
}


/* End of file Company.php */
