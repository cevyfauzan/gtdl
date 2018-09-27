<?php
############################################################################################
####  Name:             	Get_agent.php                                            	####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_agent extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'get_list';
    
    private function _getLead()
	{
		$this->db->order_by('lead_id', 'ASC');
		if($this->input->post('campaign_id'))
        {
            $this->db->where('get_lists.campaign_id', $this->input->post('campaign_id'));
        }
		if($this->input->post('dispo_id'))
        {
            $this->db->where('status', $this->input->post('dispo_id'));
        }
		if($this->input->post('first_name'))
        {
            $this->db->like('first_name', $this->input->post('first_name'));
        }
		//$this->db->where('user',$this->session->(user));
		$this->db->from($this->table);
        $this->db->join('get_lists', 'get_list.list_id = get_lists.list_id', 'left');
    }

    function getLead()
	{
		$this->_getLead();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
    }

	function countAll()
	{
		$this->_getLead();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getNextLead($camp,$dispo,$lead_id,$first_name)
	{
		$this->db->limit('1');
		$this->db->order_by('lead_id', 'ASC');
		if($camp)
        {
            $this->db->where('get_lists.campaign_id', $camp);
        }
		if($dispo)
        {
            $this->db->where('status', $dispo);
        }
		if($first_name)
        {
            $this->db->like('first_name', $first_name);
        }
		$this->db->where('lead_id >',$lead_id);
		//$this->db->where('user',$this->session->(user));
		$this->db->from($this->table);
        $this->db->join('get_lists', 'get_list.list_id = get_lists.list_id', 'left');
		$query = $this->db->get();
		return $query->row();
	}

	public function getLeadId($camp_id)
	{
		$this->db->limit('1');
		$this->db->order_by('lead_id', 'ASC');
		$this->db->where('get_list.user', '');
		$this->db->where('get_lists.campaign_id',$camp_id);
		$this->db->where('get_list.status', 'NEW');
		$this->db->from($this->table);
        $this->db->join('get_lists', 'get_list.list_id = get_lists.list_id', 'left');
		$query = $this->db->get();
		$data = $query->row();
		if($data != null){
			if($data->user == ''){
				$user = $this->session->userdata('user');
				$SQLdate = date("Y-m-d H:i:s");
				$this->db->query("UPDATE get_list SET user = '$user' WHERE lead_id = '$data->lead_id'");
				$this->db->query("UPDATE get_live_agents SET status = 'INCALL', lead_id = '$data->lead_id', campaign_id = '$data->campaign_id', last_call_time = '$SQLdate'  WHERE user = '$user'");
				return $data;
			}else{
				$this->getLeadId($camp_id);
			}
		}else{
			return $data;
		}
	}

	function search_by_name($name){
		//$this->db->where('user',$this->session->(user));
        $this->db->order_by('first_name', 'ASC');
        $this->db->like('first_name', $name , 'both');
        $this->db->limit(10);
        return $this->db->get($this->table)->result();
	}

	function search_by_number($number){
		//$this->db->where('user',$this->session->(user));
        $this->db->order_by('phone_number', 'ASC');
        $this->db->like('phone_number', $number);
        $this->db->limit(10);
        return $this->db->get($this->table)->result();
	}

	public function save_agent_log($data)
	{
		$this->db->insert('get_agent_log', $data);
		return $this->db->insert_id();
	}
}
?>