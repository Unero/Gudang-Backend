<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Orders_item extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$orders = $this->db->get('orders_item')->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('order_id', $data);
			$this->db->or_where('product_id', $data);
			$orders = $this->db->get('orders_item')->result();
		}
		$this->response($orders, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'order_id' => $this->post('order_id'),
			'product_id' => $this->post('product_id'),
			'qty' => $this->post('qty'),
			'rate' => $this->post('rate'),
			'ammount' => $this->post('ammount')
		);
		$insert = $this->db->insert('orders_item', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	// PUT: Mengupdate data
	function index_put()
	{
		$id = $this->put('id');
		$data = array(
			'id' => $this->put('id'),
			'order_id' => $this->put('order_id'),
			'product_id' => $this->put('product_id'),
			'qty' => $this->put('qty'),
			'rate' => $this->put('rate'),
			'ammount' => $this->put('ammount')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('orders_item', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	// DELETE: Menghapus data
	function index_delete()
	{
		$id = $this->delete('id');
		$this->db->where('id', $id);
		$delete = $this->db->delete('orders_item');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Orders_item.php */
