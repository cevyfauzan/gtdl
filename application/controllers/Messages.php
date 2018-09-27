<?php
############################################################################################
####  Name:             	Messages.php                                             	####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		/*$access = explode('#', $this->session->userdata('access'));
		if(!$this->session->userdata('logged_in') or !in_array('campaigns', $access))
		{ 
			$this->session->set_flashdata('message', '<div class="bs-example">
													<div class="alert alert-danger alert-dismissible">
														<button class="close" data-dismiss="alert">&times;</button>
														<strong>Error!</strong> You have no right to access Campaigns.
													</div>
												</div>');
			redirect('dash'); 
		}*/
		$this->load->model(array('Get_message'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Messages';
		$data['main'] = 'get_messages/index';
		$data['list_agent'] = $this->listAgent();
		$this->load->vars($data);
		$this->load->view('template');
	}

    public function ajax_send_message()
    {
        $data = array(
                'user_from' => $this->session->userdata('user'),
                'user_to' => $this->input->get('user_to', ''),
                'message' => $this->input->get('message', null),
                'guid' => $this->input->get('guid', ''),
                'timestamp' => time()
            );
 
        $insert = $this->Get_message->save($data);
 
        $this->_setOutput($this->input->get('message', null));
    }

	public function ajax_get_message($agent)
    {
        $data = $this->Get_message->get_by_user($agent);
        echo json_encode($data);
	}
	
	public function send_message()
	{
		$message = $this->input->get('message', null);
		$nickname = $this->input->get('nickname', '');
		$guid = $this->input->get('guid', '');
		
		$this->M_message->add_message($message, $nickname, $guid);
	
		$this->_setOutput($message);
	}

	public function get_messages()
	{
		$timestamp = $this->input->get('timestamp', null);
			
		$messages = $this->M_chat->get_messages($timestamp);
			
		$this->_setOutput($messages);
	}
		
		
	private function _setOutput($data)
	{
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
			
		echo json_encode($data);
	}

	public function listAgent()
	{
		$this->db->where('user_group', 'AGENTS');
		$this->db->from('get_users');
		$query = $this->db->get();
		return $query->result();
	}

}
?>