<?php
############################################################################################
####  Name:             	Get_system_setting.php                                   	####
####  Type:             	ci models - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_system_setting extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	var $table = 'system_settings';

	function getValue($id){
		$data = array();
		$this->db->limit(1);
		$this->db->select('*');
		$q = $this->db->get($this->table);
		  if($q->num_rows() > 0)
		  {
		  	$data = $q->row_array();
		  }
		$q->free_result();
		return $data;
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