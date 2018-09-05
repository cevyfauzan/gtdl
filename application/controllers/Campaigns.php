<?php
############################################################################################
####  Name:             	Campaigns.php                                             	####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model(array('Get_campaign','Get_list','Get_lead','Get_lead_recycle','Get_script','Get_call_time','Get_dispo'));
		$this->load->database();
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
		$data['listid'] = $this->_get_list_id();
		$this->load->vars($data);
		$this->load->view('get_campaigns/campaigns');
	}

	public function get_dispositions()
	{
		$this->load->view('get_campaigns/dispositions');
	}

	public function get_lead_recycling()
	{
		$data['list_camp'] = $this->Get_campaign->listCamp();
		$data['list_dispo'] = $this->Get_dispo->listDispo();
		$this->load->vars($data);
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
			switch($camp->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_camp('."'".$camp->campaign_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info" onclick="info_camp('."'".$camp->campaign_id."'".')"><i class="fa fa-info-circle text-info"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_camp('."'".$camp->campaign_id."'".')"><i class="fa fa-remove text-red"></i></a>';
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

    public function ajax_add()
    {
        $ACT = 'add';
        $this->_validate($ACT);
		$campaignID = $this->input->post('camp_id');
		$listID = $this->_get_list_id();
		$listName = 'ListID '.$listID;
		$SQLdate = date("Y-m-d H:i:s");
		$NOW = date("Y-m-d");
         
        $data = array(
                'campaign_id' => $campaignID,
                'campaign_name' => $this->input->post('camp_name'),
                'campaign_description' => $this->input->post('camp_desc'),
                'active' => $this->input->post('active'),
                //'dial_prefix' => $this->input->post('camp_carrier'),
                'manual_dial_list_id' => $listID,
                'campaign_script' => $this->input->post('camp_script'),
                'campaign_recording' => $this->input->post('camp_rec'),
                'local_call_time' => $this->input->post('call_time'),
                'hopper_level' => '500',
                'scheduled_callbacks' => 'Y',
                'campaign_changedate' => $SQLdate,
                'campaign_logindate' => $SQLdate,
                'campaign_calldate' => $SQLdate,
                'scheduled_callbacks_alert' => 'BLINK_RED'
            );
		// Create List ID
		$query = $this->db->query("INSERT INTO get_lists (list_id,list_name,campaign_id,active,list_description,list_changedate)values('$listID','$listName','$campaignID','Y','Outbound ListID $listID - $NOW','$SQLdate')");
		// Create campaign stats
		$query = $this->db->query("INSERT INTO get_campaign_stats (campaign_id)values('$campaignID')");
		// Insert Campaign
		$insert = $this->Get_campaign->save($data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_edit($campaign_id)
	{
		$data = $this->Get_campaign->get_camp_id($campaign_id);
		echo json_encode($data);
	}

    public function ajax_update()
    {
        $ACT = 'update';
        $this->_validate($ACT);
		$SQLdate = date("Y-m-d H:i:s");
         
        $data = array(
                'campaign_name' => $this->input->post('camp_name'),
                'campaign_description' => $this->input->post('camp_desc'),
                'active' => $this->input->post('active'),
                //'dial_prefix' => $this->input->post('camp_carrier'),
                'campaign_script' => $this->input->post('camp_script'),
                'campaign_recording' => $this->input->post('camp_rec'),
                'local_call_time' => $this->input->post('call_time'),
                'campaign_changedate' =>$SQLdate
            );
        $this->Get_campaign->update(array('campaign_id' => $this->input->post('camp_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_delete($campaign_id)
    {
		$data = $this->Get_campaign->get_camp_id($campaign_id);
		// Delete campaign
        $this->Get_campaign->delete_by_id($campaign_id);
		$query = $this->db->query("DELETE FROM get_campaign_stats WHERE campaign_id='".$campaign_id."'");
		$query = $this->db->query("DELETE FROM get_list WHERE list_id='".$data->manual_dial_list_id."'");
		$query = $this->db->query("DELETE FROM get_lists WHERE list_id='".$data->manual_dial_list_id."'");
		//$query = $this->db->query("DELETE FROM get_live_agents WHERE campaign_id IN ('$id')");
		//$query = $this->db->query("DELETE FROM get_callbacks WHERE campaign_id IN ('$id')");
		//$query = $this->db->query("DELETE FROM get_lead_recycle WHERE campaign_id IN ('$id')");

		echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete()
    {
        $camp_id = $this->input->post('camp_id');
        foreach ($camp_id as $id) {
			$data = $this->Get_campaign->get_camp_id($id);
            $this->Get_campaign->delete_by_id($id);
			$query = $this->db->query("DELETE FROM get_campaign_stats WHERE campaign_id='".$id."'");
			$query = $this->db->query("DELETE FROM get_list WHERE list_id='".$data->manual_dial_list_id."'");
			$query = $this->db->query("DELETE FROM get_lists WHERE list_id='".$data->manual_dial_list_id."'");
			$query = $this->db->query("DELETE FROM get_live_agents WHERE campaign_id IN ('$id')");
			//$query = $this->db->query("DELETE FROM get_callbacks WHERE campaign_id IN ('$id')");
			//$query = $this->db->query("DELETE FROM get_lead_recycle WHERE campaign_id IN ('$id')");
		}
        echo json_encode(array("status" => TRUE));
    }

	public function list_camp($camp_id=0)
	{
		$listCamp = $this->Get_lead->getListCamp($camp_id);
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
						"recordsTotal" => $this->Get_lead->countAllListCamp(),
						"recordsFiltered" => $this->Get_lead->countFiltListCamp(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function recycle_list()
	{
		$list = $this->Get_campaign->getCampaign();
		$lead_status = $this->_get_lead_status();
		$data = array();
		foreach ($list as $recyc) {
			$row = array();
			$row[] = strtoupper($recyc->campaign_id);
			$row[] = strtoupper($recyc->campaign_name);
			$row[] = ($lead_status[$recyc->campaign_id] != null) ? str_replace(' ',', ',trim($lead_status[$recyc->campaign_id])) : '<del>NONE</del>';

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_recyc('."'".$recyc->campaign_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_all_recyc('."'".$recyc->campaign_id."'".')"><i class="fa fa-remove text-red"></i></a>';
			$row[] = '<input type="checkbox" class="data-check" value="'.$recyc->campaign_id.'">';

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

	public function detail_recycle($campaign_id)
	{
		$list = $this->Get_lead_recycle->getDetailRecycle($campaign_id);
		$data = array();
		$drop_max = array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10');
		$drop_active = array('Y' => 'Y','N' => 'N');
		$no = $_POST['start'];
		foreach ($list as $det) {
			$no++;
			$row = array();
			$row[] = strtoupper($det->status);
			$row[] = '<div class="input-group">
						<input type="text" class="form-control" name="a_delay" maxlength="3" onkeypress="return onlyNumb(event);" value="'.strtoupper($det->attempt_delay).'">
						<div class="input-group-addon">mins</div>
					</div>';
			$row[] = form_dropdown('a_max', $drop_max, $det->attempt_maximum, 'class="form-control"');
			$row[] = '';
			$row[] = form_dropdown('a_max', $drop_active, $det->active, 'class="form-control"');
			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_recyc('."'".$det->recycle_id."'".')"><i class="fa fa-save text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_recyc('."'".$det->recycle_id."'".')"><i class="fa fa-remove text-red"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add_recycle()
    {
        $this->_validate_recycle();
         
        $data = array(
                'campaign_id' => $this->input->post('camp_id_recyc'),
                'status' => $this->input->post('status_recyc'),
                'attempt_delay' => $this->input->post('a_delay') * 60,
                'attempt_maximum' => $this->input->post('a_max'),
                'active' => $this->input->post('active')
            );
		// Insert Recycle
		$insert = $this->Get_lead_recycle->save($data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_edit_recycle($campaign_id)
	{
		$data = $this->Get_lead_recycle->get_recycle_id($campaign_id);
		echo json_encode($data);
	}

    public function ajax_update_recycle()
    {
        $ACT = 'update_recycle';
        $this->_validate_recycle($ACT);
         
        $data = array(
			'attempt_delay' => $this->input->post('a_delay'),
			'attempt_maximum' => $this->input->post('a_max'),
			'active' => $this->input->post('active')
		);
        $this->Get_lead_recycle->update(array('recycle_id' => $this->input->post('recycle_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_delete_all_recycle($campaign_id)
    {
        $this->Get_lead_recycle->delete_all_recycle_by_id($campaign_id);
		echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete_all_recycle()
    {
        $camp_id = $this->input->post('camp_id');
        foreach ($camp_id as $id) {
            $this->Get_lead_recycle->delete_all_recycle_by_id($id);
			}
        echo json_encode(array("status" => TRUE));
    }

	public function dispo_list()
	{
		$list = $this->Get_campaign->getCampaign();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $camp) {
			$no++;
			$row = array();
			$row[] = strtoupper($camp->campaign_id);
			$row[] = strtoupper($camp->campaign_name);
			$row[] = '<del>NONE</del>';

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

	private function _get_list_id() { 
		$query = $this->db->query('SELECT max(list_id) as kode FROM `get_lists` order by list_id asc');
		$data = $query->row();
		if($data->kode >= 1000){
			$kode = intval($data->kode)+1;
			return $kode;
		}else{
			$kode = 1000;
			return $kode;
		}
	}
	
	private function _get_lead_status() {
		error_reporting(0);
		$query = $this->db->query('SELECT recycle_id,vc.campaign_id,campaign_name,status,vlr.active,attempt_delay,attempt_maximum FROM get_lead_recycle as vlr,get_campaigns as vc WHERE vlr.campaign_id=vc.campaign_id ORDER BY recycle_id');
		$lead_status = array();
		foreach ($query->result() as $list)
		{
			$lead_status[$list->campaign_id] .= $list->status . " ";
		}
		return $lead_status;
	}
	
	private function _validate($ACT)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        $action = $ACT;
		$campaign_id = $this->input->post('camp_id');
		$count_row = $this->Get_campaign->get_dup_id($campaign_id);

		if($this->input->post('camp_id') == '')
        {
            $data['inputerror'][] = 'camp_id';
            $data['error_string'][] = 'Campaign ID is required';
            $data['status'] = FALSE;
		}
		
        if($action == 'add'){
			if($count_row > 0)
			{
				$data['inputerror'][] = 'camp_id';
				$data['error_string'][] = 'Campaign ID '.$this->input->post('camp_id').' already exist';
				$data['status'] = FALSE;
			}
		}

		if($this->input->post('camp_name') == '')
        {
            $data['inputerror'][] = 'camp_name';
            $data['error_string'][] = 'Campaign Name is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

	private function _validate_recycle()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
		$campaign_id = $this->input->post('camp_id_recyc');
		$status = $this->input->post('status_recyc');
		$count_row = $this->Get_lead_recycle->get_dup_id($campaign_id,$status);

		if($this->input->post('camp_id_recyc') == '')
        {
            $data['inputerror'][] = 'camp_id_recyc';
            $data['error_string'][] = 'Campaign ID is required';
            $data['status'] = FALSE;
		}
		
		if($count_row > 0)
		{
			$data['inputerror'][] = 'status_recyc';
			$data['error_string'][] = 'Status '.$this->input->post('status').' already exist fror this campaign';
			$data['status'] = FALSE;
		}

		if($this->input->post('status_recyc') == '')
        {
            $data['inputerror'][] = 'status_recyc';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }
 
		if($this->input->post('a_delay') == '')
        {
            $data['inputerror'][] = 'a_delay';
            $data['error_string'][] = 'Attempt Delay is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
