<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('agent_model');
	}
	
	public function index()
	{
		$this->load->view('agent');
	}
}
