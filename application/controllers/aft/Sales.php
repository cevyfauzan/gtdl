<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Sales';
		$data['main'] = 'aft/get_sales/index';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
