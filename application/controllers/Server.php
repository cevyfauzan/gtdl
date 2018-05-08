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
		$data['main'] = 'get_servers/server';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function get_carrier()
	{
		$this->load->view('get_servers/carrier');
	}

	public function get_phone()
	{
		$this->load->view('get_servers/phone');
	}

	public function get_conference()
	{
		$this->load->view('get_servers/conference');
	}
}
