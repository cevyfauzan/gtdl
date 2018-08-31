<?php
############################################################################################
####  Name:             	Get_recording.php                                           ####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_recording extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'goautodial_recordings_views';
	var $column_order = array(null,'name','phone','call_date','duration','campaign_id','agent','disposition','filename',null);
	var $column_search = array('name','phone','call_date','duration','agent','campaign_id','disposition','filename');
	var $order = array('call_date' => 'desc');
    
    private function _getRecQuery()
	{
		if($this->input->post('phone'))
        {
            $this->db->like('phone', $this->input->post('phone'));
        }
		if($this->input->post('fullname'))
        {
            $this->db->like('fullname', $this->input->post('fullname'));
        }
        if($this->input->post('dispo'))
        {
            $this->db->like('disposition', $this->input->post('dispo'));
        }
        if($this->input->post('agent'))
        {
            $this->db->like('agent', $this->input->post('agent'));
        }
        if($this->input->post('campaign'))
        {
            $this->db->like('campaign_id', $this->input->post('campaign'));
        }
		if($this->input->post('awal'))
        {
            $this->db->where('call_date >=', $this->input->post('awal').' 00:00:00');
        }
        if($this->input->post('akhir'))
        {
            $this->db->where('call_date <=', $this->input->post('akhir').' 23:59:59');
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

	function getRecording()
	{
		$this->_getRecQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltRec()
	{
		$this->_getRecQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllRec()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function delete_by_id($recording_id)
	{
		$this->db->where('recording_id', $recording_id);
		$this->db->delete($this->table);
	}
}
?>