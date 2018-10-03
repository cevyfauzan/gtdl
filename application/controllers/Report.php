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
		$this->load->model(array('Get_report'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Report';
		$data['main'] = 'get_reports/index';
		$data['list_camp'] = $this->listCamp();
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function rep_apd()
	{
		$data['list_apd1'] = $this->listUser();
		$data['list_dispo'] = $this->listDispo();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_apd');
	}

	public function rep_atd()
	{
		$data['list_apd1'] = $this->listUser();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_atd');
	}

	public function rep_cp()
	{
		$data['list_apd1'] = $this->listUser();
		$data['list_camp_id'] = $this->listCampID();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_cp');
	}

	public function rep_dash()
	{
		$data['list_apd1'] = $this->listUser();
		$data['list_dispo'] = $this->listDispo();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_dash');
	}

	public function rep_dss()
	{
		$data['list_dispo'] = $this->listDispo();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_dss');
	}

	public function rep_ecr()
	{
		$data['list_camp'] = $this->listCamp();
		$data['list_lists'] = $this->listLists();
		$data['list_dispo_ecr'] = $this->listDispoEcr();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_ecr');
	}

	public function rep_spa()
	{
		$data['list_apd1'] = $this->listUser();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_spa');
	}

	public function rep_st()
	{
		$data['list_lead'] = $this->listLead();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_st');
	}

	public function rep_sr()
	{
		$data['list_dispo'] = $this->listDispo();
		$this->load->vars($data);
		$this->load->view('get_reports/rep_sr');
	}

	private function listCamp()
	{
		$data = array();
		$this->db->select('campaign_id');
		$this->db->order_by('campaign_id', 'ASC');
		$q = $this->db->get('get_campaigns');
		  $data[''] = '-- ALL CAMAPIGNS --';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['campaign_id']] = $row['campaign_id'];
			}
		  }
		$q->free_result();
		return $data;
	}

	private function listLists()
	{
		$data = array();
		$this->db->select('list_id,campaign_id');
		$this->db->order_by('list_id', 'ASC');
		$q = $this->db->get('get_lists');
		  $data[''] = '-- ALL LISTS --';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['list_id']] = $row['list_id'].' - '.$row['campaign_id'];
			}
		  }
		$q->free_result();
		return $data;
	}

	private function listDispoEcr()
	{
		$data = array();
		$this->db->select('status');
		$this->db->order_by('status', 'ASC');
		$q = $this->db->get('get_statuses');
		  $data[''] = '-- ALL DISPO --';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['status']] = $row['status'];
			}
		  }
		$q->free_result();
		return $data;
	}

	private function listCampID()
	{
		$this->db->order_by('campaign_id', 'ASC');
		$this->db->from('get_campaigns');
		$query = $this->db->get();
		return $query->result();
	}

	private function listUser()
	{
		$this->db->order_by('user', 'ASC');
		$this->db->where('user_group', 'AGENTS');
		$this->db->from('get_users');
		$query = $this->db->get();
		return $query->result();
	}

	private function listDispo()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->where('selectable', 'Y');
		$this->db->from('get_statuses');
		$query = $this->db->get();
		return $query->result();
	}

	private function listLead()
	{
		$this->db->order_by('first_name', 'ASC');
		$this->db->where('status', 'SALE');
		$this->db->from('get_list');
		$query = $this->db->get();
		return $query->result();
	}
}
