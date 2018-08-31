<?php
############################################################################################
####  Name:             	Get_lead.php                                            	####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_lead extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'vicidial_list';
	var $column_order = array(null,'lead_id','list_id','phone_number','first_name','status','user',null);
	var $column_search = array('lead_id','list_id','phone_number','first_name','status','user');
	var $order = array('lead_id' => 'ASC');
    
    private function _getLeadQuery()
	{
		if($this->input->post('phone_number'))
        {
            $this->db->like('phone_number', $this->input->post('phone_number'));
        }
		if($this->input->post('name'))
        {
            $this->db->like('first_name', $this->input->post('name'));
        }
        /*if($this->input->post('campaign_id'))
        {
            $this->db->like('campaign_id', $this->input->post('campaign_id'));
        }*/
        if($this->input->post('status'))
        {
            $this->db->like('status', $this->input->post('status'));
        }
        if($this->input->post('user'))
        {
            $this->db->like('user', $this->input->post('user'));
        }
		if($this->input->post('min_call_date'))
        {
            $this->db->where('modify_date >=', $this->input->post('min_call_date'));
        }
		if($this->input->post('max_call_date'))
        {
            $this->db->where('modify_date <=', $this->input->post('max_call_date'));
        }
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function getLead()
	{
		$this->_getLeadQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltLead()
	{
		$this->_getLeadQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllLead()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
    
    private function _getListCampQuery()
	{
		//$camp = 'testcamp';
		//$this->db->where('vicidial_lists.campaign_id', $camp_id);
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('vicidial_lists', 'vicidial_list.list_id = vicidial_lists.list_id', 'left');
	}

	function getListCamp($camp_id)
	{
		$this->db->where('vicidial_lists.campaign_id', $camp_id);
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('vicidial_lists', 'vicidial_list.list_id = vicidial_lists.list_id', 'left');
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltListCamp()
	{
		$this->_getListCampQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllListCamp()
	{
		$this->_getListCampQuery();
		return $this->db->count_all_results();
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

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
}
?>