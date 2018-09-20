<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{ 
			redirect('login');
		}
		$this->load->model(array('Get_campaign'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Dashboard';
		$data['main'] = 'dash';
		$this->load->vars($data);
		$this->load->view('template');
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
			switch($camp->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_camp('."'".$camp->campaign_id."'".')"><i class="fa fa-edit text-yellow"></i></a>';

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
}
