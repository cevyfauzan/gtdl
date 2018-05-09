<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_setting extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech System Setings';
		$data['main'] = 'get_setting/system_setting';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
