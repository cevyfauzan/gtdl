<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispo extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		//$this->load->model('agent_model');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Dispo';
		$data['main'] = 'get_dispo/dispo';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
