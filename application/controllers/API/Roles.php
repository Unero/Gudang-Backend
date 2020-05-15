<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Roles extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$roles = $this->db->get('roles')->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('role_name', $data);
			$roles = $this->db->get('roles')->result();
		}
		$this->response($roles, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'role_name' => $this->post('role_name')
		);
		$insert = $this->db->insert('roles', $data);
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
			'role_name' => $this->put('role_name')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('roles', $data);
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
		$delete = $this->db->delete('roles');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Roles.php */
