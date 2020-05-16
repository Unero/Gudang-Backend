<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Brands extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$brands = $this->db->get('brands')->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('name', $data);
			$brands = $this->db->get('brands')->result();
		}
		$this->response($brands, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'brand_name' => $this->post('brand_name'),
			'company' => $this->post('company'),
			'address' => $this->post('address'),
			'phone' => $this->post('phone')
		);
		$insert = $this->db->insert('brands', $data);
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
			'brand_name' => $this->put('brand_name'),
			'company' => $this->put('company'),
			'address' => $this->put('address'),
			'phone' => $this->put('phone')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('brands', $data);
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
		$delete = $this->db->delete('brands');
		if ($delete) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Brands.php */
