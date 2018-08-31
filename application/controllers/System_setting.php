<?php
############################################################################################
####  Name:             	System_setting.php                                         	####
####  Type:             	ci controllers - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class System_setting extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_system_setting');
		$this->load->model('Get_server');
	}
	
	public function index($id=0)
	{
		$id = '2.4rc1';
		$data['title'] = 'getDIAL.tech System Setings';
		$data['main'] = 'get_setting/system_setting';
		$data['list'] = $this->Get_system_setting->getValue($id);
		$data['drop_down_server'] = $this->Get_server->listServer();
		$this->load->vars($data);
		$this->load->view('template');
	}
}
