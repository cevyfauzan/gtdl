<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scripts extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Scripts';
		$data['main'] = 'get_scripts/scripts';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
