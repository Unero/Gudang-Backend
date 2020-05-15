<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Category extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $categories = $this->db->get('categories')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('name', $data);
            $categories = $this->db->get('categories')->result();
        }
        $this->response($categories, 200);
	}
	
	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'name' => $this->post('name')
		);
		$insert = $this->db->insert('categories', $data);
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
			'name' => $this->put('name')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('categories', $data);
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
		$delete = $this->db->delete('categories');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Category.php */
