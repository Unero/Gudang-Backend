<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Rooms extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$products = $this->db->get('rooms')->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('name', $data);
			$this->db->or_where('sku', $data);
			$products = $this->db->get('rooms')->result();
		}
		$this->response($products, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'location' => $this->post('location'),
			'desc' => $this->post('desc')
		);
		$insert = $this->db->insert('rooms', $data);
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
			'location' => $this->put('location'),
			'desc' => $this->put('desc')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('rooms', $data);
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
		$delete = $this->db->delete('rooms');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Products.php */
