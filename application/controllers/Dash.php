<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Dashboard';
		$data['main'] = 'dash';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
