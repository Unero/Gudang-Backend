<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Stores extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $stores = $this->db->get('stores')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('name', $data);
            $stores = $this->db->get('stores')->result();
        }
        $this->response($stores, 200);
	}
	
	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'store_name' => $this->post('store_name'),
			'address' => $this->post('address')
		);
		$insert = $this->db->insert('stores', $data);
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
			'store_name' => $this->put('store_name'),
			'address' => $this->put('address')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('stores', $data);
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
		$delete = $this->db->delete('stores');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Stores.php */
