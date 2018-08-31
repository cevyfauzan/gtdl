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

    var $table = 'vicidial_list';
    
    private function _getLead()
	{
		$this->db->order_by('lead_id', 'ASC');
		if($this->input->post('campaign_id'))
        {
            $this->db->where('vicidial_lists.campaign_id', $this->input->post('campaign_id'));
        }
		if($this->input->post('dispo_id'))
        {
            $this->db->where('status', $this->input->post('dispo_id'));
        }
		//$this->db->limit('100');
		$this->db->from($this->table);
        $this->db->join('vicidial_lists', 'vicidial_list.list_id = vicidial_lists.list_id', 'left');
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

	public function getNextLead($camp,$dispo,$lead_id)
	{
		$this->db->limit('1');
		$this->db->order_by('lead_id', 'ASC');
		if($camp)
        {
            $this->db->where('vicidial_lists.campaign_id', $camp);
        }
		if($dispo)
        {
            $this->db->where('status', $dispo);
        }
		$this->db->where('lead_id >',$lead_id);
		$this->db->from($this->table);
        $this->db->join('vicidial_lists', 'vicidial_list.list_id = vicidial_lists.list_id', 'left');
		$query = $this->db->get();
		return $query->row();
	}

	public function getLeadId($lead_id)
	{
		$this->db->where('lead_id',$lead_id);
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->row();
	}
}
?>