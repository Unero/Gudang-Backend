<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	function index_get(){
		$data = array(
			'username' => $this->get('username'),
			'password' => $this->get('password')
		);

		$query = $this->db->query("SELECT * FROM users WHERE username = '".$data['username']."' AND password = '".$data['password']."'");

		if ($query->num_rows() > 0) {		
			$account = $query->result();
			$this->response(array($account, 'code' => 200));
		} else {
			$this->response(array('status' => 'fail', 'code' => 502));
		}
	}
}
