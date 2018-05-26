<?php
############################################################################################
####  Name:             	Campaigns.php                                             	####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_campaign');
		$this->load->model('Get_list');
		$this->load->model('Get_script');
		$this->load->model('Get_call_time');
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
		$data['list_script'] = $this->Get_script->listScript();
		$data['list_call_time'] = $this->Get_call_time->listCalltime();
		$this->load->vars($data);
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

	public function campaign_list()
	{
		$list = $this->Get_campaign->getCampaign();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $camp) {
			$no++;
			$row = array();
			$row[] = strtoupper($camp->campaign_id);
			$row[] = strtoupper($camp->campaign_name);
			switch($camp->dial_method){
				case "MANUAL":
				$row[] = 'MANUAL';
				break;
				case "RATIO":
				$row[] = 'AUTO DIAL';
				break;
				case "ADAPT_AVERAGE":
				$row[] = 'PREDICTIVE';
				break;
			}
			switch($camp->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_camp('."'".$camp->campaign_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="return confirm(\'Are you sure you want to delete this data ?\');"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$camp->campaign_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_campaign->countAllCamp(),
						"recordsFiltered" => $this->Get_campaign->countFiltCamp(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function list_camp($camp_id=0)
	{
		$listCamp = $this->Get_list->getListCamp($camp_id);
		$aa = $camp_id;
		$data = array();
		$no = $_POST['start'];
		foreach ($listCamp as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = strtoupper($list->lead_id);
			$row[] = strtoupper($list->list_id);
			$row[] = strtoupper($list->phone_number);
			$row[] = strtoupper($list->first_name);
			$row[] = strtoupper($aa);
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_list->countAllListCamp(),
						"recordsFiltered" => $this->Get_list->countFiltListCamp(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function campaign_edit($campaign_id)
	{
		$data = $this->Get_campaign->get_camp_id($campaign_id);
		echo json_encode($data);
	}
}
