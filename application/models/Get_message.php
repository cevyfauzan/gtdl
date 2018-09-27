<?php
############################################################################################
####  Name:             	Get_message.php                                            	####
####  Type:             	ci models - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_message extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	var $table = 'get_messages';

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
 
	public function get_by_user($agent)
	{
		$this->db->where('user_from', $this->session->userdata('user'));
		$this->db->where('user_to', $agent);
		$this->db->from($this->table);
		$this->db->join('get_users', 'get_users.user = get_messages.user_from');
		$query = $this->db->get();

		return $query->row();
	}

	function get_messages($timestamp)
	{
		$this->db->where('timestamp >', $timestamp);
		$this->db->order_by('timestamp', 'DESC');
		$this->db->limit(10); 
		$query = $this->db->get('messages');
		
		return array_reverse($query->result_array());
	}
}
?>