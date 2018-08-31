<?php
############################################################################################
####  Name:             	Servers.php                                             	####
####  Type:             	ci controllers - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model(array('Get_server','Get_carrier','Get_phone'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Server';
		$data['main'] = 'get_servers/server';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function server_list()
	{
		$list = $this->Get_server->getServer();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $serv) {
			$no++;
			$row = array();
			$row[] = strtoupper($serv->server_id);
			$row[] = strtoupper($serv->server_description);
			$row[] = strtoupper($serv->server_ip);
			switch($serv->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}
			$row[] = strtoupper($serv->asterisk_version);
			$row[] = strtoupper($serv->local_gmt);

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_server('."'".$serv->server_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_server('."'".$serv->server_id."'".')"><i class="fa fa-remove text-red"></i></a>';
			$row[] = '<input type="checkbox" class="data-check" value="'.$serv->server_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_server->countAllServer(),
						"recordsFiltered" => $this->Get_server->countFiltServer(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add()
    {
        $ACT = 'add';
        $this->_validate($ACT);
         
        $data = array(
                'server_id' => $this->input->post('server_id'),
                'server_description' => $this->input->post('server_name'),
                'server_ip' => $this->input->post('server_ip'),
                'active' => $this->input->post('active'),
                'asterisk_version' => $this->input->post('ast_ver'),
                'user_group' => $this->input->post('user_group'),
                'max_vicidial_trunks' => '96',
                'local_gmt' => '7.00',
                'rebuild_conf_files' => 'N',
                'outbound_calls_per_second' => '100',
                'rebuild_music_on_hold' => 'N'
            );
		$insert = $this->Get_server->save($data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_edit($server_id)
	{
		$data = $this->Get_server->get_serv_id($server_id);
		echo json_encode($data);
	}

    public function ajax_update()
    {
        $ACT = 'update';
        $this->_validate($ACT);
         
        $data = array(
			'server_description' => $this->input->post('server_name'),
			'server_ip' => $this->input->post('server_ip'),
			'active' => $this->input->post('active'),
			'asterisk_version' => $this->input->post('ast_ver'),
			'user_group' => $this->input->post('user_group'),
			'max_vicidial_trunks' => $this->input->post('max_trunk'),
			'outbound_calls_per_second' => $this->input->post('max_call'),
			'vicidial_recording_limit' => $this->input->post('rec_limit')
		);
        $this->Get_server->update(array('server_id' => $this->input->post('server_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_delete($server_id)
    {
        $this->Get_server->delete_by_id($server_id);

		echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete()
    {
        $server_id = $this->input->post('server_id');
        foreach ($server_id as $id) {
            $this->Get_server->delete_by_id($id);
		}
        echo json_encode(array("status" => TRUE));
    }

	private function _validate($ACT)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        $action = $ACT;
		$server_id = $this->input->post('server_id');
		$count_row = $this->Get_server->get_dup_id($server_id);

		if($this->input->post('server_id') == '')
        {
            $data['inputerror'][] = 'server_id';
            $data['error_string'][] = 'Server ID is required';
            $data['status'] = FALSE;
		}
		
        if($action == 'add'){
			if($count_row > 0)
			{
				$data['inputerror'][] = 'server_id';
				$data['error_string'][] = 'Server ID '.$this->input->post('server_id').' already exist';
				$data['status'] = FALSE;
			}
		}

		if($this->input->post('server_ip') == '')
        {
            $data['inputerror'][] = 'server_ip';
            $data['error_string'][] = 'Server IP is required';
            $data['status'] = FALSE;
        }
 
		if($this->input->post('ast_ver') == '')
        {
            $data['inputerror'][] = 'ast_ver';
            $data['error_string'][] = 'Asterisk Version is required';
            $data['status'] = FALSE;
        }
 
        if($action == 'update'){
			if($this->input->post('max_trunk') == '')
			{
				$data['inputerror'][] = 'max_trunk';
				$data['error_string'][] = 'Max trunk is required';
				$data['status'] = FALSE;
			}
			if($this->input->post('max_call') == '')
			{
				$data['inputerror'][] = 'max_call';
				$data['error_string'][] = 'Max call per second is required';
				$data['status'] = FALSE;
			}
			if($this->input->post('rec_limit') == '')
			{
				$data['inputerror'][] = 'rec_limit';
				$data['error_string'][] = 'Recording limit is required';
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
