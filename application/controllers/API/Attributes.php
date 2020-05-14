<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Attributes extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $attributes = $this->db->get('attributes')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('name', $data);
            $attributes = $this->db->get('attributes')->result();
        }
        $this->response($attributes, 200);
	}
	
	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'name' => $this->post('name'),
			'active' => $this->post('active')
		);
		$insert = $this->db->insert('attributes', $data);
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
			'active' => $this->put('active')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('attributes', $data);
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
		$delete = $this->db->delete('attributes');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Attributes.php */
