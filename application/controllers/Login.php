<?php
############################################################################################
####  Name:             	Login.php                                             	    ####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model(array('Get_login','Get_user'));
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{ 
			redirect('dash'); 
		}
		else
		{
			$this->load->view('login');
		}
	}

	function check()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|is_unique[get_session.user]', array('is_unique' => 'This username already sign in. Please choose another users.'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == TRUE)
		{
			$data = $this->Get_login->check();
			if($data == TRUE)
			{
				//helper_log("login", "success login", "");
				$list = $this->Get_user->get_by_id($this->input->post('username'));
				echo '<strong style="color:#00cc44;">Success!</strong> Sign In';
				if($list->user_group == 'ADMIN'){
					echo '<script>function refresh(){window.location = "'.base_url().'dash/";}setTimeout("refresh()", 1500);</script>';
				}else{
					echo '<script>function refresh(){window.location = "'.base_url().'agent/";}setTimeout("refresh()", 1500);</script>';
				}
				$this->db->query("INSERT into get_session (user) values ('$list->user')");
			}
			else
			{
				echo '<strong style="color:#ff0000;">Error!</strong> Username or Password incorrect.';
				//helper_log("login", "failed login"." (".$this->input->post('username').") (".$this->input->post('password').")", "");
			}
		}
		else
		{
			echo validation_errors('<strong style="color:#ff0000;">Error!</strong> Sign In.');
		}
	}
	
	function signout()
	{
		$user = $this->session->userdata('user');
		$this->db->query("DELETE from get_session where user = '$user'");
		//helper_log("logout", "success logout", "");
		$this->session->sess_destroy();
		redirect('login');
	}
}
?>