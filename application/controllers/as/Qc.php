<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phones extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Phones';
		$data['main'] = 'get_phones/phones';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
