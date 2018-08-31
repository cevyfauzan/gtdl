<?php
############################################################################################
####  Name:             	Get_carrier.php                                            	####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_carrier extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'vicidial_server_carriers';
	var $column_order = array(null,'carrier_id','carrier_name','protocol','server_ip','registration_string','active',null);
	var $column_search = array('carrier_id','carrier_name','protocol','server_ip','registration_string','active');
    
    private function _getCarrierQuery()
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

	function getCarrier()
	{
		$this->_getCarrierQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltCarrier()
	{
		$this->_getCarrierQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllCarrier()
	{
		$this->db->from($this->table);
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

	function listCarriers()
	{	
		$query = $this->db->query("SELECT * FROM vicidial_server_carriers WHERE active='Y';");
		foreach ($query->result() as $carrier_info)
		{
			$prefixes = explode("\n",$carrier_info->dialplan_entry);
			$prefix = explode(",",$prefixes[0]);
			$prefixuse = substr(ltrim($prefix[0],"exten => _ "),0,(strpos(".",$prefix[0]) - 1));
			
			$return[$carrier_info->carrier_id]['carrier_name'] = $carrier_info->carrier_name;
			$return[$carrier_info->carrier_id]['prefix'] = $prefixuse;
		}
		
		return $return;
	}
}
?>