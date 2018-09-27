<?php
############################################################################################
####  Name:             	Report.php                                             	    ####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$access = explode('#', $this->session->userdata('access'));
		if(!$this->session->userdata('logged_in') or !in_array('report-sys', $access))
		{ 
			$this->session->set_flashdata('message', '<div class="bs-example">
													<div class="alert alert-danger alert-dismissible">
														<button class="close" data-dismiss="alert">&times;</button>
														<strong>Error!</strong> You have no right to access Report.
													</div>
												</div>');
			redirect('dash'); 
		}
		$this->load->model(array('Get_report','Get_campaign'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Report';
		$data['main'] = 'get_reports/index';
		$data['list_camp'] = $this->Get_campaign->listCamp();
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function rep_dash()
	{
		$this->load->view('get_reports/rep_dash');
	}

	public function rep_apd()
	{
		$data['list_apd1'] = $this->Get_report->listApd1();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_apd');
	}
}
