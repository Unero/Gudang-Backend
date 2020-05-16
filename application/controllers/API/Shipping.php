<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Shipping extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$this->db->select('shipping.id, shipping.item_id, shipping.qty, shipping.type, shipping.store_id, shipping.user_id, shipping.time, items.`name`, stores.store_name, users.username');
			$this->db->from('shipping');
			$this->db->join('items', 'shipping.item_id = items.id');	
			$this->db->join('stores', 'shipping.store_id = stores.id');
			$this->db->join('users', 'shipping.user_id = users.id');
			$products = $this->db->get()->result();
		} else {
			$this->db->where('id', $data);
			$this->db->select('shipping.id, shipping.item_id, shipping.qty, shipping.type, shipping.store_id, shipping.user_id, shipping.time, items.`name`, stores.store_name, users.username');
			$this->db->from('shipping');
			$this->db->join('items', 'shipping.item_id = items.id');	
			$this->db->join('stores', 'shipping.store_id = stores.id');
			$this->db->join('users', 'shipping.user_id = users.id');
			$products = $this->db->get()->result();
		}
		$this->response($products, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'item_id' => $this->post('item_id'),
			'qty' => $this->post('qty'),
			'type' => $this->post('type'),
			'store_id' => $this->post('store_id'),
			'user_id' => $this->post('user_id'),
			'time' => $this->post('time')
		);
		$insert = $this->db->insert('shipping', $data);
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
			'item_id' => $this->put('item_id'),
			'qty' => $this->put('qty'),
			'type' => $this->put('type'),
			'store_id' => $this->put('store_id'),
			'user_id' => $this->put('user_id'),
			'time' => $this->put('time')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('shipping', $data);
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
		$delete = $this->db->delete('shipping');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Products.php */
