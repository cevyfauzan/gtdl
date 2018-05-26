<?php
############################################################################################
####  Name:             	Get_list.php                                            	####
####  Type:             	ci model - administrator                     				####
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

    var $table = 'vicidial_list';
    
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

	public function get_camp_id($campaign_id)
	{
		$this->db->from($this->table);
		$this->db->where('campaign_id',$campaign_id);
		$query = $this->db->get();

		return $query->row();
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

	function listScript()
	{
		$data = array();
		$this->db->select('*');
		$this->db->order_by('script_id', 'ASC');
		$q = $this->db->get($this->table);
		  $data['NONE'] = 'NONE';
		  if($q->num_rows() > 0)
		  {
			foreach ($q->result_array() as $row)
			{
				$data[$row['script_id']] = $row['script_id'].' - '.$row['script_name'];
			}
		  }
		$q->free_result();
		return $data;
	}}
?>