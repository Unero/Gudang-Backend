<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Orders extends REST_Controller
{

	// GET
	function index_get()
	{
		$data = $this->get('data');
		if ($data == '') {
			$orders = $this->db->get('orders')->result();
		} else {
			$this->db->where('id', $data);
			$this->db->or_where('customer_name', $data);
			$this->db->or_where('paid_status', $data);
			$orders = $this->db->get('orders')->result();
		}
		$this->response($orders, 200);
	}

	// POST : Menambahkan Data
	function index_post()
	{
		$data = array(
			'bill_no' => $this->post('bill_no'),
			'customer_name' => $this->post('customer_name'),
			'customer_address' => $this->post('customer_address'),
			'customer_phone' => $this->post('customer_phone'),
			'date_time' => $this->post('date_time'),
			'gross_amount' => $this->post('gross_amount'),
			'service_charge_rate' => $this->post('service_charge_rate'),
			'service_charge' => $this->post('service_charge'),
			'vat_charge_rate' => $this->post('vat_charge_rate'),
			'vat_charge' => $this->post('vat_charge'),
			'net_amount' => $this->post('net_amount'),
			'discount' => $this->post('discount'),
			'paid_status' => $this->post('paid_status'),
			'user_id' => $this->post('user_id')
		);
		$insert = $this->db->insert('orders', $data);
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
			'bill_no' => $this->put('bill_no'),
			'customer_name' => $this->put('customer_name'),
			'customer_address' => $this->put('customer_address'),
			'customer_phone' => $this->put('customer_phone'),
			'date_time' => $this->put('date_time'),
			'gross_amount' => $this->put('gross_amount'),
			'service_charge_rate' => $this->put('service_charge_rate'),
			'service_charge' => $this->put('service_charge'),
			'vat_charge_rate' => $this->put('vat_charge_rate'),
			'vat_charge' => $this->put('vat_charge'),
			'net_amount' => $this->put('net_amount'),
			'discount' => $this->put('discount'),
			'paid_status' => $this->put('paid_status'),
			'user_id' => $this->put('user_id')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('orders', $data);
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
		$delete = $this->db->delete('orders');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}


/* End of file Orders.php */
