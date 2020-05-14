<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Groups extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $groups = $this->db->get('groups')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('group_name', $data);
            $groups = $this->db->get('groups')->result();
        }
        $this->response($groups, 200);
	}
	
	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'group_name' => $this->post('group_name'),
			'permission' => $this->post('permission')
		);
		$insert = $this->db->insert('groups', $data);
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
			'group_name' => $this->put('group_name'),
			'permission' => $this->put('permission')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('groups', $data);
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
		$delete = $this->db->delete('groups');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Groups.php */
