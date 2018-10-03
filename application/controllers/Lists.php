<?php
############################################################################################
####  Name:             	Lists.php                                             		####
####  Type:             	ci controllers - administrator                     			####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$access = explode('#', $this->session->userdata('access'));
		if(!$this->session->userdata('logged_in') or !in_array('lists', $access))
		{ 
			$this->session->set_flashdata('message', '<div class="bs-example">
													<div class="alert alert-danger alert-dismissible">
														<button class="close" data-dismiss="alert">&times;</button>
														<strong>Error!</strong> You have no right to access Lists.
													</div>
												</div>');
			redirect('dash'); 
		}
		$this->load->model(array('Get_list','Get_lead','Get_lead','Get_campaign','Get_dispo','Get_user'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Lists';
		$data['main'] = 'get_lists/index';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function get_lists()
	{
		$data['list_camp'] = $this->Get_campaign->listCamp();
		$data['list_id'] = $this->_get_list_id();
		$data['list_name'] = "ListID ".$this->_get_list_id();
		$this->load->vars($data);
		$this->load->view('get_lists/lists');
	}

	public function get_load_leads()
	{
		$data['tabvalsel'] = "tabloadleads";
		$data['list_list'] = $this->Get_list->listList();
		$this->load->vars($data);
		$this->load->view('get_lists/load_leads');
	}

	public function get_lead_search()
	{
		$data['drop_down_camp'] = $this->Get_campaign->listCamp();
		$data['drop_down_list'] = $this->Get_list->listList();
		$data['drop_down_dispo'] = $this->Get_dispo->listDispo();
		$data['drop_down_user'] = $this->Get_user->listUser();
		$this->load->vars($data);
		$this->load->view('get_lists/lead_search');
	}

	public function lists_list()
	{
		$list = $this->Get_list->getList();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $lists) {
			$no++;
			$row = array();
			$row[] = strtoupper($lists->list_id);
			$row[] = strtoupper($lists->list_name);
			switch($lists->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}
			$row[] = strtoupper($lists->list_lastcalldate);
			$row[] = '';
			$row[] = strtoupper($lists->campaign_id);

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_list('."'".$lists->list_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_list('."'".$lists->list_id."'".')"><i class="fa fa-remove text-red"></i></a>';
			$row[] = '<input type="checkbox" class="data-check" value="'.$lists->list_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_list->countAllList(),
						"recordsFiltered" => $this->Get_list->countFiltList(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add()
    {
        $this->_validate();
		$listID = $this->_get_list_id();
		$SQLdate = date("Y-m-d H:i:s");
         
        $data = array(
                'list_id' => $listID,
                'list_name' => $this->input->post('list_name'),
                'list_description' => $this->input->post('list_desc'),
                'campaign_id' => $this->input->post('camp_id'),
                'active' => $this->input->post('active'),
                'list_changedate' => $SQLdate
            );
		$insert = $this->Get_list->save($data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_edit($list_id)
	{
		$data = $this->Get_list->get_list_id($list_id);
		echo json_encode($data);
	}

    public function ajax_update()
    {
        $this->_validate();
		$SQLdate = date("Y-m-d H:i:s");
         
        $data = array(
			'list_name' => $this->input->post('list_name'),
			'list_description' => $this->input->post('list_desc'),
			'campaign_id' => $this->input->post('camp_id'),
			'active' => $this->input->post('active'),
			'list_changedate' => $SQLdate
		);
        $this->Get_list->update(array('list_id' => $this->input->post('list_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_delete($list_id)
    {
        $this->Get_list->delete_by_id($list_id);
		$query = $this->db->query("DELETE FROM get_list WHERE list_id='".$list_id."'");

		echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('list_id');
        foreach ($list_id as $id) {
            $this->Get_list->delete_by_id($id);
			$query = $this->db->query("DELETE FROM get_list WHERE list_id='".$id."'");
		}
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_upload()
    {
		$this->load->library('excel');
        //$this->_validate_upload();
		$SQLdate = date("Y-m-d H:i:s");
         
		$configUpload['upload_path'] = FCPATH.'assets/excel/';
		$configUpload['allowed_types'] = 'xls|xlsx';
		$configUpload['max_size'] = '5000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('lead_file');	
		$upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];

		//$objReader =PHPExcel_IOFactory::createReader('Excel5');
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');
		$objReader->setReadDataOnly(true); 		  
		$objPHPExcel = $objReader->load(FCPATH.'assets/excel/'.$file_name);		 
		$totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);                
		for($i=1;$i<=$totalrows;$i++)
		{
			$count_row = $this->Get_lead->get_dup_id($objWorksheet->getCellByColumnAndRow(0,$i)->getValue());
			if($count_row = 0){
				$data = array(
					'entry_date' => $SQLdate,
					'modify_date' => '0000-00-00 00:00:00',
					'status' => 'NEW',
					'list_id' => $this->input->post('list_id'),
					'phone_number' => $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(),
					'first_name' => $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(),
					'address1' => $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(),
					'address2' => $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(),
					'city' => $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(),
					'province' => $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(),
					'postal_code' => $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(),
					'date_of_birth' => $objWorksheet->getCellByColumnAndRow(7,$i)->getValue(),
					'email' => $objWorksheet->getCellByColumnAndRow(8,$i)->getValue()
				);
				$insert = $this->Get_lead->upload($data);
			}
		}
		unlink(FCPATH.'assets/excel/'.$file_name); 
	
        echo json_encode(array("status" => TRUE, "totalRows" => $totalrows, "totalSuccess" => $i));
    }

	public function lead_list()
	{
		$list = $this->Get_lead->getLead();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $lead) {
			$no++;
			$row = array();
			$row[] = strtoupper($lead->lead_id);
			$row[] = strtoupper($lead->list_id);
			$row[] = strtoupper($lead->phone_number);
			$row[] = strtoupper($lead->first_name);
			$row[] = strtoupper($lead->modify_date);
			$row[] = strtoupper($lead->status);
			$row[] = strtoupper($lead->user);

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_lead('."'".$lead->lead_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_lead('."'".$lead->lead_id."'".')"><i class="fa fa-remove text-red"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$lead->lead_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_lead->countAllLead(),
						"recordsFiltered" => $this->Get_lead->countFiltLead(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add_lead()
    {
        $ACT = 'add';
        $this->_validate_lead($ACT);
		$SQLdate = date("Y-m-d H:i:s");
         
        $data = array(
                'list_id' => $this->input->post('list_id'),
                'first_name' => strtoupper($this->input->post('first_name')),
                'address1' => strtoupper($this->input->post('address1')),
                'address2' => strtoupper($this->input->post('address2')),
                'city' => strtoupper($this->input->post('city')),
                'postal_code' => $this->input->post('zip'),
                'date_of_birth' => $this->input->post('dob'),
                'phone_number' => $this->input->post('phone_number'),
                'email' => strtoupper($this->input->post('email')),
                'notes' => $this->input->post('notes'),
                'user' => $this->input->post('user'),
                'status' => $this->input->post('dispo'),
				'modify_date' => '0000-00-00 00:00:00',
                'entry_date' => $SQLdate
            );
		$insert = $this->Get_lead->save($data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_edit_lead($lead_id)
	{
		$data = $this->Get_lead->get_lead_id($lead_id);
		echo json_encode($data);
	}

    public function ajax_update_lead()
    {
        $ACT = 'update';
        $this->_validate_lead($ACT);
		$SQLdate = date("Y-m-d H:i:s");
         
        $data = array(
			'first_name' => strtoupper($this->input->post('first_name')),
			'address1' => strtoupper($this->input->post('address1')),
			'address2' => strtoupper($this->input->post('address2')),
			'city' => strtoupper($this->input->post('city')),
			'postal_code' => $this->input->post('zip'),
			'date_of_birth' => $this->input->post('dob'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => strtoupper($this->input->post('email')),
			'notes' => $this->input->post('notes'),
			'user' => $this->input->post('user'),
			'status' => $this->input->post('dispo'),
			'modify_date' => $SQLdate
		);
        $this->Get_lead->update(array('lead_id' => $this->input->post('lead_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

	public function ajax_delete_lead($lead_id)
    {
        $this->Get_lead->delete_by_id($lead_id);

		echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete_lead()
    {
        $lead_id = $this->input->post('lead_id');
        foreach ($lead_id as $id) {
            $this->Get_lead->delete_by_id($id);
		}
        echo json_encode(array("status" => TRUE));
    }

	private function _get_list_id() { 
		$query = $this->db->query('SELECT max(list_id) as kode FROM `get_lists` order by list_id asc');
		$data = $query->row();
		if($data->kode >= 1000){
			$kode = intval($data->kode)+1;
			return $kode;
		}else{
			$kode = 1000;
			return $kode;
		}
	}
	
	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
		if($this->input->post('list_name') == '')
        {
            $data['inputerror'][] = 'list_name';
            $data['error_string'][] = 'List Name is required';
            $data['status'] = FALSE;
        }
 
		if($this->input->post('camp_id') == '')
        {
            $data['inputerror'][] = 'camp_id';
            $data['error_string'][] = 'Campaign is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

	private function _validate_lead($ACT)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        $action = $ACT;
		$phone_number = $this->input->post('phone_number');
		$count_row = $this->Get_lead->get_dup_id($phone_number);

		if($this->input->post('first_name') == '')
        {
            $data['inputerror'][] = 'first_name';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
		}
		
		if($this->input->post('phone_number') == '')
        {
            $data['inputerror'][] = 'phone_number';
            $data['error_string'][] = 'Phone Number is required';
            $data['status'] = FALSE;
		}

		if($action == 'add'){
			if($count_row > 0)
			{
				$data['inputerror'][] = 'phone_number';
				$data['error_string'][] = 'Phone Number '.$this->input->post('phone_number').' already exist';
				$data['status'] = FALSE;
			}

			if($this->input->post('list_id') == '')
			{
				$data['inputerror'][] = 'list_id';
				$data['error_string'][] = 'List ID is required';
				$data['status'] = FALSE;
			}
		}
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

	private function _validate_upload()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
		if($this->input->post('lead_file') == '')
        {
            $data['inputerror'][] = 'lead_file';
            $data['error_string'][] = 'Lead File is required';
            $data['status'] = FALSE;
        }
 
		if($this->input->post('list_id') == '')
        {
            $data['inputerror'][] = 'list_id';
            $data['error_string'][] = 'List ID is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
