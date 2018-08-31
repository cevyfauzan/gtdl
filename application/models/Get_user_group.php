<?php
############################################################################################
####  Name:             	Get_user_group.php                                         	####
####  Type:             	ci models - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_user_group extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'vicidial_user_groups';
	var $column_order = array(null,'user_group','group_name','forced_timeclock_login',null);
	var $column_search = array('user_group','group_name','forced_timeclock_login');
	var $order = array('user_group' => 'ASC');
    
    private function _getUserGroupQuery()
	{
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

	function getUserGroup()
	{
		$this->_getUserGroupQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltUserGroup()
	{
		$this->_getUserGroupQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllUserGroup()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function listUserGroup()
	{
		$data = array();
		$this->db->select('*');
		$this->db->order_by('user_group', 'ASC');
		$q = $this->db->get($this->table);
		  $data[''] = '-- Select --';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['user_group']] = $row['user_group'].' - '.$row['group_name'];
			}
		  }
		$q->free_result();
		return $data;
	}
}
?>