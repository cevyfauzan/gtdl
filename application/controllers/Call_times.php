<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Call_times extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Call Times';
		$data['main'] = 'get_call_times/call_times';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
