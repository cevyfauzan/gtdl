<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model(array('Get_agent','Get_campaign'));
	}
	
	public function index()
	{
		$data['list_camp'] = $this->listCamp();
		//$data['count_lead'] = $this->countLead();
		$data['list_dispo'] = $this->listDispo();
		$data['list_dispo_hgp'] = $this->listDispoHgp();
		$this->load->vars($data);
		$this->load->view('agent');
	}

	public function login()
	{
		$this->load->view('login_agent');
	}

	public function lead_list()
	{
		$list = $this->Get_agent->getLead();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $lead) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a value="'.$lead->lead_id.'"><font color="333">'.strtoupper($lead->first_name).'</font></a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_agent->countAll(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function next_lead()
	{
		$camp = $_GET['camp'];
		$dispo = $_GET['dispo'];
		$first_name = $_GET['first_name'];
		$lead_id = $_GET['lead_id'];
		$data = $this->Get_agent->getNextLead($camp,$dispo,$lead_id,$first_name);
		echo json_encode($data);
	}

	public function ajax_detail($lead_id)
	{
		$data = $this->Get_agent->getLeadId($lead_id);
		echo json_encode($data);
	}

	private function listCamp()
	{
		$data = array();
		$this->db->order_by('campaign_id', 'ASC');
		$this->db->where('active', 'Y');
		$this->db->select('campaign_id');
		$q = $this->db->get('get_campaigns');
		  $data[''] = '-- ALL CAMPAIGN --';
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

	private function listDispo()
	{
		$data = array();
		$this->db->order_by('status', 'ASC');
		$this->db->where('sale !=', 'Y');
		$this->db->select('status, status_name');
		$q = $this->db->get('get_statuses');
		$data[''] = '-- ALL DISPO --';
		$data['NEW'] = 'NEW LEADS';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['status']] = $row['status'].' - '.$row['status_name'];
			}
		  }
		$q->free_result();
		return $data;
	}

	private function listDispoHgp()
	{
		$data = array();
		$this->db->order_by('status', 'ASC');
		$this->db->where('selectable', 'Y');
		$this->db->select('status, status_name');
		$q = $this->db->get('get_statuses');
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['status']] = $row['status'].' - '.$row['status_name'];
			}
		  }
		$q->free_result();
		return $data;
	}

	function get_by_name(){
		if (isset($_GET['term'])) {
				$result = $this->Get_agent->search_by_name($_GET['term']);
				if (count($result) > 0) {
				foreach ($result as $row)
						$arr_result[] = $row->first_name;
						echo json_encode($arr_result);
				}
		}
	}

	function get_by_number(){
		if (isset($_GET['term'])) {
				$result = $this->Get_agent->search_by_number($_GET['term']);
				if (count($result) > 0) {
				foreach ($result as $row)
						$arr_result[] = $row->phone_number;
						echo json_encode($arr_result);
				}
		}
	}
}

