<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carriers extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Carriers';
		$data['main'] = 'get_carriers/carriers';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
