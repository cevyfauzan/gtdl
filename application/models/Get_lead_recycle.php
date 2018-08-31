<?php
############################################################################################
####  Name:             	Get_lead_recycle.php                                       	####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_lead_recycle extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'vicidial_lead_recycle';
	var $column_order = array(null);
	var $column_search = array('vicidial_lead_recycle.campaign_id','status');
	var $order = array('vicidial_lead_recycle.campaign_id' => 'ASC');
    
	function getDetailRecycle($campaign_id)
	{
		$this->db->order_by('status', 'ASC');
		$this->db->where('campaign_id', $campaign_id);
		$this->db->select('*');
		$this->db->from($this->table);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_recycle_id($campaign_id)
	{
		$this->db->from($this->table);
		$this->db->where('campaign_id',$campaign_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_dup_id($campaign_id,$status)
	{
		$this->db->from($this->table);
		$this->db->where('campaign_id',$campaign_id);
		$this->db->where('status',$status);
		$query = $this->db->get();

		return $query->num_rows();
	}
	
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_all_recycle_by_id($campaign_id)
	{
		$this->db->where('campaign_id', $campaign_id);
		$this->db->delete($this->table);
	}

	function listCamp()
	{
		$data = array();
		$this->db->select('campaign_id');
		$this->db->order_by('campaign_id', 'ASC');
		$q = $this->db->get($this->table);
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
}
?>