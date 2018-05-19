<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qc extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Quality Control';
		$data['main'] = 'aft/get_qc/index';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
