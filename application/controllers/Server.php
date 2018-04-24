<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Server';
		$data['main'] = 'get_server/server';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
