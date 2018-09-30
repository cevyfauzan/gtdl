<?php
############################################################################################
####  Name:             	Get_report.php                                            	####
####  Type:             	ci model - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_report extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table1 = 'get_users';
    var $table2 = 'get_statuses';
	
	function listApd1()
	{
		$this->db->order_by('user', 'ASC');
		$this->db->where('user_group', 'AGENTS');
		$this->db->from($this->table1);
		$query = $this->db->get();
		return $query->result();
	}

	function listDispo()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->where('selectable', 'Y');
		$this->db->from($this->table2);
		$query = $this->db->get();
		return $query->result();
	}
}
?>