<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Users extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $users = $this->db->get('users')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('username', $data);
            $users = $this->db->get('absensi')->result();
        }
        $this->response($users, 200);
    }
}


/* End of file Users.php */
