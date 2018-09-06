<?php
############################################################################################
####  Name:             	Lists.php                                             		####
####  Type:             	ci controllers - administrator                     			####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model(array('Get_list','Get_lead','Get_lead','Get_campaign','Get_dispo'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Lists';
		$data['main'] = 'get_lists/index';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function get_lists()
	{
		$data['list_camp'] = $this->Get_campaign->listCamp();
		$data['list_id'] = $this->_get_list_id();
		$data['list_name'] = "ListID ".$this->_get_list_id();
		$this->load->vars($data);
		$this->load->view('get_lists/lists');
	}

	public function get_load_leads()
	{
		$data['tabvalsel'] = "tabloadleads";
		$data['list_list'] = $this->Get_list->listList();
		$this->load->vars($data);
		$this->load->view('get_lists/load_leads');
	}

	public function get_upload_leads()
	{
		
	}

	public function get_lead_search()
	{
		$data['drop_down_camp'] = $this->Get_campaign->listCamp();
		$data['drop_down_dispo'] = $this->Get_dispo->listDispo();
		$this->load->vars($data);
		$this->load->view('get_lists/lead_search');
	}

	public function lists_list()
	{
		$list = $this->Get_list->getList();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $lists) {
			$no++;
			$row = array();
			$row[] = strtoupper($lists->list_id);
			$row[] = strtoupper($lists->list_name);
			switch($lists->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}
			$row[] = strtoupper($lists->list_lastcalldate);
			$row[] = '';
			$row[] = strtoupper($lists->campaign_id);

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_list('."'".$lists->list_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_list('."'".$lists->list_id."'".')"><i class="fa fa-remove text-red"></i></a>';
			$row[] = '<input type="checkbox" class="data-check" value="'.$lists->list_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_list->countAllList(),
						"recordsFiltered" => $this->Get_list->countFiltList(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add()
    {
        $this->_validate();
		$listID = $this->_get_list_id();
		$SQLdate = date("Y-m-d H:i:s");
         
        $data = array(
                'list_id' => $listID,
                'list_name' => $this->input->post('list_name'),
                'list_description' => $this->input->post('list_desc'),
                'campaign_id' => $this->input->post('camp_id'),
                'active' => $this->input->post('active'),
                'list_changedate' => $SQLdate
            );
		//$query = $this->db->query("INSERT INTO get_lists (list_id,list_name,campaign_id,active,list_description,list_changedate)values('$listID','$listName','$campaignID','Y','Outbound ListID $listID - $NOW','$SQLdate')");
		//$query = $this->db->query("INSERT INTO get_campaign_stats (campaign_id)values('$campaignID')");
		$insert = $this->Get_list->save($data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_edit($list_id)
	{
		$data = $this->Get_list->get_list_id($list_id);
		echo json_encode($data);
	}

    public function ajax_update()
    {
        $this->_validate();
		$SQLdate = date("Y-m-d H:i:s");
         
        $data = array(
			'list_name' => $this->input->post('list_name'),
			'list_description' => $this->input->post('list_desc'),
			'campaign_id' => $this->input->post('camp_id'),
			'active' => $this->input->post('active'),
			'list_changedate' => $SQLdate
		);
        $this->Get_list->update(array('list_id' => $this->input->post('list_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_delete($list_id)
    {
        $this->Get_list->delete_by_id($list_id);
		$query = $this->db->query("DELETE FROM get_list WHERE list_id='".$list_id."'");

		echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('list_id');
        foreach ($list_id as $id) {
            $this->Get_list->delete_by_id($id);
			$query = $this->db->query("DELETE FROM get_list WHERE list_id='".$id."'");
		}
        echo json_encode(array("status" => TRUE));
    }

	public function lead_list()
	{
		$list = $this->Get_lead->getLead();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $lead) {
			$no++;
			$row = array();
			$row[] = strtoupper($lead->lead_id);
			$row[] = strtoupper($lead->list_id);
			$row[] = strtoupper($lead->phone_number);
			$row[] = strtoupper($lead->first_name);
			$row[] = strtoupper($lead->modify_date);
			$row[] = strtoupper($lead->status);
			$row[] = strtoupper($lead->user);

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_lead('."'".$lead->lead_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="return confirm(\'Are you sure you want to delete this data ?\');"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$lead->lead_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_lead->countAllLead(),
						"recordsFiltered" => $this->Get_lead->countFiltLead(),
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
	
	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
		if($this->input->post('list_name') == '')
        {
            $data['inputerror'][] = 'list_name';
            $data['error_string'][] = 'List Name is required';
            $data['status'] = FALSE;
        }
 
		if($this->input->post('camp_id') == '')
        {
            $data['inputerror'][] = 'camp_id';
            $data['error_string'][] = 'Campaign is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
