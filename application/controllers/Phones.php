<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phones extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_phone');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Phones';
		$data['main'] = 'get_phones/phones';
		$this->load->vars($data);
		$this->load->view('template');
	}


	public function phone_list()
	{
		$list = $this->Get_phone->getPhone();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $phone) {
			$no++;
			$row = array();
			$row[] = $phone->extension;
			$row[] = $phone->fullname;
			$row[] = $phone->protocol;
			$row[] = $phone->server_ip;
			switch($phone->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}
			$row[] = strtoupper($phone->user_group);

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_lead('."'".$phone->extension."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="return confirm(\'Are you sure you want to delete this data ?\');"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$phone->extension.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_phone->countAllPhone(),
						"recordsFiltered" => $this->Get_phone->countFiltPhone(),
						"data" => $data,
				);
		echo json_encode($output);
	}
}
