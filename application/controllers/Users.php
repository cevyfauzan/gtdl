<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Users';
		$data['main'] = 'get_users/users';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
