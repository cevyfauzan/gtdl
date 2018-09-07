<?php
############################################################################################
####  Name:             	Get_dispo.php                                            	####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_dispo extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'get_statuses';
	var $column_order = array(null,'status','status_name',null);
	var $column_search = array('status','status_name');
	var $order = array('status' => 'ASC');
    
    private function _getDispoQuery()
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

	function getDisposition()
	{
		$this->_getDispoQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltDispo()
	{
		$this->_getDispoQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllDispo()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($status)
	{
		$this->db->from($this->table);
		$this->db->where('status',$status);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_dup_id($status)
	{
		$this->db->from($this->table);
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

	public function delete_by_id($status)
	{
		$this->db->where('status', $status);
		$this->db->delete($this->table);
	}

	function listDispo()
	{
		$data = array();
		$this->db->select('status, status_name');
		$this->db->order_by('status', 'ASC');
		$q = $this->db->get($this->table);
		  $data[''] = '-- ALL DISPO --';
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
}
?>