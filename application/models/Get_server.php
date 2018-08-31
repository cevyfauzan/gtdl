<?php
############################################################################################
####  Name:             	Get_server.php                                            	####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_server extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'servers';
	var $column_order = array(null,'server_id','server_description','server_ip','active','asterisk_version','local_gmt',null);
	var $column_search = array('server_id','server_description','server_ip','active','asterisk_version','local_gmt');
	var $order = array('server_id' => 'ASC');
    
    private function _getServerQuery()
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

	function getServer()
	{
		$this->_getServerQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltServer()
	{
		$this->_getServerQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllServer()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_serv_id($server_id)
	{
		$this->db->from($this->table);
		$this->db->where('server_id',$server_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_dup_id($server_id)
	{
		$this->db->from($this->table);
		$this->db->where('server_id',$server_id);
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

	public function delete_by_id($server_id)
	{
		$this->db->where('server_id', $server_id);
		$this->db->delete($this->table);
	}

	function listServer()
	{
		$data = array();
		$this->db->select('*');
		$this->db->order_by('server_ip', 'ASC');
		$q = $this->db->get($this->table);
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['server_ip']] = $row['server_ip'];
			}
		  }
		$q->free_result();
		return $data;
	}
}
?>