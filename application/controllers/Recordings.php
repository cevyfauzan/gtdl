<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recordings extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Recordings';
		$data['main'] = 'get_recordings/recordings';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
