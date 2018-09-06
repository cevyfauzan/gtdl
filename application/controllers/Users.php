<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_user');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Users';
		$data['main'] = 'get_users/users';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function user_list()
	{
		$list = $this->Get_user->getUser();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $user->user;
			$row[] = strtoupper($user->full_name);
			$row[] = strtoupper($user->user_group);
			switch($user->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_lead('."'".$user->user."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="return confirm(\'Are you sure you want to delete this data ?\');"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$user->user.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_user->countAllUser(),
						"recordsFiltered" => $this->Get_user->countFiltUser(),
						"data" => $data,
				);
		echo json_encode($output);
	}
}
