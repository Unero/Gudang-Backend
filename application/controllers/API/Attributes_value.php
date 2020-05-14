<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Attributes_value extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$atr = $this->db->get('attribute_value')->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('value', $data);
			$atr = $this->db->get('attribute_value')->result();
		}
		$this->response($atr, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'value' => $this->post('value'),
			'attribute_parent_id' => $this->post('attribute_parent_id')
		);
		$insert = $this->db->insert('attribute_value', $data);
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
			'value' => $this->put('value'),
			'attribute_parent_id' => $this->put('attribute_parent_id')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('attribute_value', $data);
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
		$delete = $this->db->delete('attribute_value');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Attributes_value.php */
