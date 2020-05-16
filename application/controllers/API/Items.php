<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Items extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$this->db->select('items.id, items.`name`, items.price, items.qty, items.description, items.room_id, items.brand_id, items.category_id, rooms.location, rooms.`desc`, brands.brand_name, categories.category_name');
			$this->db->from('items');
			$this->db->join('rooms', 'items.room_id = rooms.id');
			$this->db->join('brands', 'items.brand_id = brands.id');
			$this->db->join('categories', 'items.category_id = categories.id');			
			$products = $this->db->get()->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('name', $data);
			$this->db->select('items.id, items.`name`, items.price, items.qty, items.description, items.room_id, items.brand_id, items.category_id, rooms.location, rooms.`desc`, brands.brand_name, categories.category_name');
			$this->db->from('items');
			$this->db->join('rooms', 'items.room_id = rooms.id');
			$this->db->join('brands', 'items.brand_id = brands.id');
			$this->db->join('categories', 'items.category_id = categories.id');			
			$products = $this->db->get()->result();
		}
		$this->response($products, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'name' => $this->post('name'),
			'price' => $this->post('price'),
			'qty' => $this->post('qty'),
			'description' => $this->post('description'),
			'room_id' => $this->post('room_id'),
			'brand_id' => $this->post('brand_id'),
			'category_id' => $this->post('category_id')
		);
		$insert = $this->db->insert('items', $data);
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
			'name' => $this->put('name'),
			'price' => $this->put('price'),
			'qty' => $this->put('qty'),
			'description' => $this->put('description'),
			'room_id' => $this->put('room_id'),
			'brand_id' => $this->put('brand_id'),
			'category_id' => $this->put('category_id')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('items', $data);
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
		$delete = $this->db->delete('items');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Products.php */
