<?php
############################################################################################
####  Name:             	Get_list.php                                            	####
####  Type:             	ci models - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_list extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'get_lists';
	var $column_order = array(null,'list_id','list_name','active','list_lastcalldate','campaign_id',null);
	var $column_search = array('list_id','list_name','active','list_lastcalldate','campaign_id');
	var $order = array('list_id' => 'ASC');
    
    private function _getListQuery()
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

	function getList()
	{
		$this->_getListQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltList()
	{
		$this->_getListQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllList()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_list_id($list_id)
	{
		$this->db->from($this->table);
		$this->db->where('list_id',$list_id);
		$query = $this->db->get();

		return $query->row();
	}
	
    private function _getListCampQuery()
	{
		//$camp = 'testcamp';
		//$this->db->where('get_lists.campaign_id', $camp_id);
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('get_lists', 'get_list.list_id = get_lists.list_id', 'left');
	}

	function getListCamp($camp_id)
	{
		$this->db->where('get_lists.campaign_id', $camp_id);
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('get_lists', 'get_list.list_id = get_lists.list_id', 'left');
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

	public function delete_by_id($list_id)
	{
		$this->db->where('list_id', $list_id);
		$this->db->delete($this->table);
	}

	function systemsettingslookup()
	{
		$stmt = "SELECT use_non_latin,admin_web_directory,custom_fields_enabled FROM system_settings;";
		$syslook = $this->asteriskDB->query($stmt);
		$ctr = 0;
		foreach($syslook->result() as $info){
			$syslookup[$ctr] = $info;
			$ctr++;
		}
		return $syslookup;
	}

	function listList()
	{
		$data = array();
		$this->db->select('*');
		$this->db->order_by('list_id', 'ASC');
		$q = $this->db->get($this->table);
		  $data[''] = '-- NONE --';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['list_id']] = $row['list_id'].' - '.$row['list_name'];
			}
		  }
		$q->free_result();
		return $data;
	}
}
?>