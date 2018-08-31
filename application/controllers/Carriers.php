<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carriers extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_carrier');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Carriers';
		$data['main'] = 'get_carriers/carriers';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function carrier_list()
	{
		$list = $this->Get_carrier->getCarrier();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $car) {
			$no++;
			$row = array();
			$row[] = strtoupper($car->carrier_id);
			$row[] = strtoupper($car->carrier_name);
			$row[] = strtoupper($car->server_ip);
			$row[] = strtoupper($car->protocol);
			$row[] = strtoupper($car->registration_string);
			switch($car->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_car('."'".$car->carrier_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="return confirm(\'Are you sure you want to delete this data ?\');"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$car->carrier_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_carrier->countAllCarrier(),
						"recordsFiltered" => $this->Get_carrier->countFiltCarrier(),
						"data" => $data,
				);
		echo json_encode($output);
	}
}
