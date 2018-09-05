<?php
############################################################################################
####  Name:             	User_groups.php                                            	####
####  Type:             	ci controllers - administrator                     			####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class User_groups extends CI_Controller {

	function __construct()
    {
		parent::__construct();
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
			$row[] = strtoupper($grp->user_group);
			$row[] = strtoupper($grp->group_name);
			$row[] = strtoupper($grp->web_access);

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_lead('."'".$grp->user_group."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="return confirm(\'Are you sure you want to delete this data ?\');"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$grp->user_group.'">';

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
}
