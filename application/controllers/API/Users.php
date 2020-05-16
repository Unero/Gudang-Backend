<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Users extends REST_Controller
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	// GET : Menampilkan seluruh Data
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->join('roles', 'users.role_id = roles.id');
			$users = $this->db->get()->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('username', $data);
			$this->db->select('*');
			$this->db->from('users');
			$this->db->join('roles', 'users.role_id = roles.id');
			$users = $this->db->get()->result();
		}
		$this->response($users, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'username' => $this->post('username'),
			'password' => $this->post('password'),
			'name' => $this->post('name'),
			'email' => $this->post('email'),
			'phone' => $this->post('phone'),
			'gender' => $this->post('gender'),
			'address' => $this->post('address'),
			'role_id' => $this->post('role_id')
		);
		$insert = $this->db->insert('users', $data);
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
			'username' => $this->put('username'),
			'password' => $this->put('password'),
			'name' => $this->put('name'),
			'email' => $this->put('email'),
			'phone' => $this->put('phone'),
			'gender' => $this->put('gender'),
			'address' => $this->put('address'),
			'role_id' => $this->put('role_id')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);
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
		$delete = $this->db->delete('users');
		if ($delete) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Users.php */
