<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Groups extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $groups = $this->db->get('groups')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('group_name', $data);
            $groups = $this->db->get('groups')->result();
        }
        $this->response($groups, 200);
    }
}


/* End of file Groups.php */
