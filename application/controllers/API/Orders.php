<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Orders extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$orders = $this->db->get('orders')->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('customer_name', $data);
			$this->db->or_where('paid_status', $data);
			$orders = $this->db->get('orders')->result();
		}
		$this->response($orders, 200);
	}
}


/* End of file Orders.php */
