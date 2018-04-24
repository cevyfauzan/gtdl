<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Logs';
		$data['main'] = 'get_logs/logs';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
