<?php

/**
 * 
 */
class Accounts extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'bm');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$data = [
			'title' => 'Balance',
		];

		$this->load->view('template/header', $data);
		$this->load->view('template/nav');
		$this->load->view('accounts/balance', $data);
		$this->load->view('template/footer');
	}
}
