<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function index()
	{
		$this->db->where('username', 'rin-ss');
		$this->db->where('password', 'Ringgo');
		$check = $this->db->get('users')->num_rows();
		var_dump($check);

		$this->load->view('list');
	}
}
