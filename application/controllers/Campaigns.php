<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_campaign');
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
			$row[] = $camp->dial_method;
			if($camp->active == 'N'){
				$row[] = '<font color="red">INACTIVE<font>';
			}elseif($camp->active == 'Y'){
				$row[] = '<font color="green">ACTIVE<font>';
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

	public function campaign_edit($campaign_id)
	{
		$data = $this->Get_campaign->get_camp_id($campaign_id);
		echo json_encode($data);
	}
}
