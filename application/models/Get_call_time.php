<?php
############################################################################################
####  Name:             	Get_call_time.php                                           ####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_call_time extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'get_call_times';
	var $column_order = array(null,'call_time_id','call_time_name','ct_default_start','ct_default_stop','active',null);
	var $column_search = array('call_time_id','call_time_name','ct_default_start','ct_default_stop','active');
    
    private function _getCalltimeQuery()
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

	function getCalltime()
	{
		$this->_getCalltimeQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltCt()
	{
		$this->_getCalltimeQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllCt()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($ct_id)
	{
		$this->db->from($this->table);
		$this->db->where('call_time_id',$ct_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_dup_id($ct_id)
	{
		$this->db->from($this->table);
		$this->db->where('call_time_id',$ct_id);
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

	public function delete_by_id($ct_id)
	{
		$this->db->where('call_time_id', $ct_id);
		$this->db->delete($this->table);
	}

	function listCalltime()
	{
		$data = array();
		$this->db->select('*');
		$q = $this->db->get($this->table);
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['call_time_id']] = $row['call_time_id'].' - '.$row['call_time_name'];
			}
		  }
		$q->free_result();
		return $data;
	}}
?>