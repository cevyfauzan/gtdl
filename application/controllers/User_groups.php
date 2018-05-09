<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_groups extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech User Groups';
		$data['main'] = 'get_user_groups/user_groups';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
