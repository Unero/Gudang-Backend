<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Products extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$products = $this->db->get('products')->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('name', $data);
			$this->db->or_where('sku', $data);
			$products = $this->db->get('products')->result();
		}
		$this->response($products, 200);
	}
}


/* End of file Products.php */
