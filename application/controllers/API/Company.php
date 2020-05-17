<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Company extends REST_Controller {
	
	// GET
    function index_get() {
		$companies = $this->db->get('company')->result();
        $this->response($companies, 200);
	}
	
	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'company_name' => $this->post('company_name'),
			'address' => $this->post('address'),
			'phone' => $this->post('phone'),
			'created_at' => $this->post('created_at'),
			'country' => $this->post('country')
		);
		$insert = $this->db->insert('company', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	function information_get() {
		$items = $this->db->get('items')->num_rows();
		$shipping = $this->db->get('shipping')->num_rows();
		$users = $this->db->get('users')->num_rows();
		$stores = $this->db->get('stores')->num_rows();

		$data = array(
			'items' => $items,
			'shipping' => $shipping,
			'users' => $users,
			'stores' => $stores
		);

        $this->response($data, 200);
	}

	// PUT: Mengupdate data
	function index_put()
	{
		$id = $this->put('company_name');
		$data = array(
			'company_name' => $this->put('company_name'),
			'address' => $this->put('address'),
			'phone' => $this->put('phone'),
			'created_at' => $this->put('created_at'),
			'country' => $this->put('country')
		);
		$this->db->where('company_name', $id);
		$update = $this->db->update('company', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	// DELETE: Menghapus data
	function index_delete()
	{
		$id = $this->delete('company_name');
		$this->db->where('company_name', $id);
		$delete = $this->db->delete('company');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Company.php */
