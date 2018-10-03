<?php
############################################################################################
####  Name:             	Get_login.php                                            	####
####  Type:             	ci models - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
class Get_login extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	function check()
	{
		$this->db->where('user', $this->input->post('username', TRUE));  
		$this->db->where('pass', $this->input->post('password', TRUE));
		$this->db->from('get_users');
		$this->db->join('get_user_groups', 'get_users.user_group = get_user_groups.group');
		$query = $this->db->get(); 
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			$data = array(
					'user' => $result['user'],
					'full_name' => $result['full_name'],
					'user_group' => $result['user_group'],
					'phone_login' => $result['phone_login'],
					'phone_pass' => $result['phone_pass'],
					'created_date' => $result['created_date'],
					'avatar' => $result['avatar'],
					'access' => $result['access'],
					'allow_add' => $result['allow_add'],
					'allow_modify' => $result['allow_modify'],
					'allow_delete' => $result['allow_delete'],
					'logged_in' => TRUE
					);
			$this->session->set_userdata($data);
			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
?>