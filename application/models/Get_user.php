<?php
############################################################################################
####  Name:             	Get_user.php	                                         	####
####  Type:             	ci models - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_user extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'get_users';
	var $column_order = array(null,'user','full_name','active','group',null);
	var $column_search = array('user','full_name','active','group');
	var $order = array('user' => 'ASC');
    
    private function _getUserQuery()
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

	function getUser()
	{
		$this->_getUserQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltUser()
	{
		$this->_getUserQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllUser()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	public function get_by_id($user)
	{
		$this->db->from($this->table);
		$this->db->where('user',$user);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_dup_id($user)
	{
		$this->db->from($this->table);
		$this->db->where('user',$user);
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

	public function delete_by_id($user)
	{
		$this->db->where('user', $user);
		$this->db->where('user !=', 'admin');
		$this->db->delete($this->table);
	}

	function listUser()
	{
		$data = array();
		$this->db->select('*');
		$this->db->order_by('user', 'ASC');
		$q = $this->db->get($this->table);
		  $data[''] = '-- Select --';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['user']] = $row['user'].' - '.$row['full_name'];
			}
		  }
		$q->free_result();
		return $data;
	}

	function listAgent()
	{
		$data = array();
		$this->db->where('user_group', 'agents');
		$this->db->select('*');
		$this->db->order_by('user', 'ASC');
		$q = $this->db->get($this->table);
		  $data[''] = '-- ALL AGENTS --';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['user']] = $row['user'];
			}
		  }
		$q->free_result();
		return $data;
	}
}
?>