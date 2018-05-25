<?php
############################################################################################
####  Name:             	Scripts.php                                             	####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Scripts extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_scipts');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Scripts';
		$data['main'] = 'get_scripts/scripts';
		$this->load->vars($data);
		$this->load->view('template');
	}
}
