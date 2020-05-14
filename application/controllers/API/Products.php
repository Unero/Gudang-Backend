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

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'name' => $this->post('name'),
			'sku' => $this->post('sku'),
			'price' => $this->post('price'),
			'qty' => $this->post('qty'),
			'image' => $this->post('image'),
			'description' => $this->post('description'),
			'attribute_value_id' => $this->post('attribute_val'),
			'brand_id' => $this->post('brand_id'),
			'category_id' => $this->post('category_id'),
			'store_id' => $this->post('store_id'),
			'availability' => $this->post('availability')
		);
		$insert = $this->db->insert('products', $data);
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
			'sku' => $this->put('sku'),
			'price' => $this->put('price'),
			'qty' => $this->put('qty'),
			'image' => $this->put('image'),
			'description' => $this->put('description'),
			'attribute_value_id' => $this->put('attribute_val'),
			'brand_id' => $this->put('brand_id'),
			'category_id' => $this->put('category_id'),
			'store_id' => $this->put('store_id'),
			'availability' => $this->put('availability')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('products', $data);
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
		$delete = $this->db->delete('products');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Products.php */
