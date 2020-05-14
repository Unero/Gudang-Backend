<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Company extends REST_Controller {
	
	// GET
    function index_get() {
        $data = $this->get('data');
        if ($data == '') {
            $companies = $this->db->get('company')->result();
        } else {
            $this->db->where('id', $data);
            $this->db->or_where('company_name', $data);
            $companies = $this->db->get('company')->result();
        }
        $this->response($companies, 200);
	}
	
	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'company_name' => $this->post('company_name'),
			'service_charge_value' => $this->post('service_charge_value'),
			'vat_charge_value' => $this->post('vat_charge_value'),
			'address' => $this->post('address'),
			'phone' => $this->post('phone'),
			'country' => $this->post('country'),
			'message' => $this->post('message'),
			'currency' => $this->post('currency')
		);
		$insert = $this->db->insert('company', $data);
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
			'company_name' => $this->put('company_name'),
			'service_charge_value' => $this->put('service_charge_value'),
			'vat_charge_value' => $this->put('vat_charge_value'),
			'address' => $this->put('address'),
			'phone' => $this->put('phone'),
			'country' => $this->put('country'),
			'message' => $this->put('message'),
			'currency' => $this->put('currency')
		);
		$this->db->where('id', $id);
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
		$id = $this->delete('id');
		$this->db->where('id', $id);
		$delete = $this->db->delete('company');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Company.php */
