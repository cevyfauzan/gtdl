<?php
############################################################################################
####  Name:             	User_groups.php                                            	####
####  Type:             	ci controllers - administrator                     			####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class User_groups extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$access = explode('#', $this->session->userdata('access'));
		if(!$this->session->userdata('logged_in') or !in_array('user-groups', $access))
		{ 
			$this->session->set_flashdata('message', '<div class="bs-example">
													<div class="alert alert-danger alert-dismissible">
														<button class="close" data-dismiss="alert">&times;</button>
														<strong>Error!</strong> You have no right to access User groups.
													</div>
												</div>');
			redirect('dash'); 
		}
		$this->load->model('Get_user_group');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech User Groups';
		$data['main'] = 'get_user_groups/user_groups';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function user_group_list()
	{
		$list = $this->Get_user_group->getUserGroup();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $grp) {
			$no++;
			$row = array();
			$row[] = strtoupper($grp->group);
			$row[] = strtoupper($grp->group_name);
			$row[] = strtoupper($grp->access);

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_group('."'".$grp->group."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_group('."'".$grp->group."'".')"><i class="fa fa-remove text-red"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$grp->group.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_user_group->countAllUserGroup(),
						"recordsFiltered" => $this->Get_user_group->countFiltUserGroup(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add()
    {
        $ACT = 'add';
        $this->_validate($ACT);
         
		$type = $this->input->post('user_type');
		if($type == 'ADMINISTRATORS'){
			$a_add = $this->input->post('a_add');
			$a_mod = $this->input->post('a_modify');
			$a_del = $this->input->post('a_delete');
			$access = implode('#', (array)$this->input->post('access'));
			$web_access = 'dash';
		}else{
			$a_add = '';
			$a_mod = '';
			$a_del = '';
			$access = '';
			$web_access = 'agent';
		}
		$data = array(
                'group' => $this->input->post('user_group'),
                'group_name' => $this->input->post('group_name'),
                'user_type' => $type,
                'allow_add' => $a_add,
                'allow_modify' => $a_mod,
                'allow_delete' => $a_del,
                'access' => $access
            );
 
        $insert = $this->Get_user_group->save($data);
 
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($user_group)
    {
        $data = $this->Get_user_group->get_by_id($user_group);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
		error_reporting(0);
        $ACT = 'update';
        $this->_validate($ACT);
		$type = $this->input->post('user_type');
		if($type == 'ADMINISTRATORS'){
			$a_add = $this->input->post('a_add');
			$a_mod = $this->input->post('a_modify');
			$a_del = $this->input->post('a_delete');
			$access = implode('#', (array)$this->input->post('access'));
			$web_access = 'dash';
		}else{
			$a_add = 'N';
			$a_mod = 'N';
			$a_del = 'N';
			$access = '';
			$web_access = 'agent';
		}
		$data = array(
                'group_name' => $this->input->post('group_name'),
                'user_type' => $type,
                'allow_add' => $a_add,
                'allow_modify' => $a_mod,
                'allow_delete' => $a_del,
                'access' => $access
            );

		$this->Get_user_group->update(array('group' => $this->input->post('user_group')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($user_group)
    {
        $this->Get_user_group->delete_by_id($user_group);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('user_group');
        foreach ($list_id as $user_group) {
            $this->Get_user_group->delete_by_id($user_group);
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
		$user_group = $this->input->post('user_group');
		$count_row = $this->Get_user_group->get_dup_id($user_group);

        if($this->input->post('user_group') == '')
        {
            $data['inputerror'][] = 'user_group';
            $data['error_string'][] = 'User Group is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('group_name') == '')
        {
            $data['inputerror'][] = 'group_name';
            $data['error_string'][] = 'Group Name is required';
            $data['status'] = FALSE;
        }
 
        if($action == 'add'){
            if($count_row > 0)
            {
                $data['inputerror'][] = 'user_group';
                $data['error_string'][] = 'User Group '.$this->input->post('user_group').' already exist';
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
