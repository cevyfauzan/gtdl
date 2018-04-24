<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Lists';
		$data['main'] = 'lists';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function get_lists()
	{
		$data['title'] = 'getDIAL.tech Lists';
		$this->load->view('get_lists/lists');
	}

	public function get_load_leads()
	{
		$this->load->view('get_lists/load_leads');
	}

	public function get_lead_search()
	{
		$this->load->view('get_lists/lead_search');
	}
}
