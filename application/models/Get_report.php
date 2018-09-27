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
	
	function listApd1()
	{
		$this->db->where('user_group', 'AGENTS');
		$this->db->from($this->table1);
		$query = $this->db->get();
		return $query->result();
	}
}
?>