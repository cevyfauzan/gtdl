<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Campaigns';
		$data['main'] = 'campaigns';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function get_campaigns()
	{
		$data['title'] = 'getDIAL.tech Campaigns';
		$this->load->view('get_campaigns/campaigns');
	}

	public function get_dispositions()
	{
		$this->load->view('get_campaigns/dispositions');
	}

	public function get_lead_recycling()
	{
		$this->load->view('get_campaigns/lead_recycling');
	}

	public function get_pause_codes()
	{
		$this->load->view('get_campaigns/pause_codes');
	}
	
	public function get_hotkeys()
	{
		$this->load->view('get_campaigns/hotkeys');
	}
}
