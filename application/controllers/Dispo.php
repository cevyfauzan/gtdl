<?php
############################################################################################
####  Name:             	Dispo.php                                             	####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispo extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_dispo');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Dispo';
		$data['main'] = 'get_dispo/dispo';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function disposition_list()
	{
		$list = $this->Get_dispo->getDisposition();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $disp) {
			$no++;
			$row = array();
			$row[] = $disp->status;
			$row[] = $disp->status_name;
			$row[] = $disp->selectable;
			$row[] = $disp->human_answered;
			$row[] = $disp->sale;
			$row[] = $disp->dnc;
			$row[] = $disp->customer_contact;
			$row[] = $disp->not_interested;
			$row[] = $disp->unworkable;
			$row[] = $disp->scheduled_callback;
			$row[] = $disp->completed;

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_dispo('."'".$disp->status."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_dispo('."'".$disp->status."'".')"><i class="fa fa-remove text-red"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$disp->status.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_dispo->countAllDispo(),
						"recordsFiltered" => $this->Get_dispo->countFiltDispo(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add()
    {
        $ACT = 'add';
        $this->_validate($ACT);
         
        $data = array(
                'status' => $this->input->post('status'),
                'status_name' => $this->input->post('status_name'),
                'selectable' => $this->input->post('select'),
                'human_answered' => $this->input->post('ha'),
                'sale' => $this->input->post('sale'),
                'dnc' => $this->input->post('dnc'),
                'customer_contact' => $this->input->post('cc'),
                'not_interested' => $this->input->post('ni'),
                'unworkable' => $this->input->post('unwork'),
                'scheduled_callback' => $this->input->post('callback'),
                'completed' => $this->input->post('complete')
            );
 
        $insert = $this->Get_dispo->save($data);
 
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($status)
    {
        $data = $this->Get_dispo->get_by_id($status);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $ACT = 'update';
        $this->_validate($ACT);
        $data = array(
			'status_name' => $this->input->post('status_name'),
			'selectable' => $this->input->post('select'),
			'human_answered' => $this->input->post('ha'),
			'sale' => $this->input->post('sale'),
			'dnc' => $this->input->post('dnc'),
			'customer_contact' => $this->input->post('cc'),
			'not_interested' => $this->input->post('ni'),
			'unworkable' => $this->input->post('unwork'),
			'scheduled_callback' => $this->input->post('callback'),
			'completed' => $this->input->post('complete')
		);
        $this->Get_dispo->update(array('status' => $this->input->post('status')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($status)
    {
        $this->Get_dispo->delete_by_id($status);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('status');
        foreach ($list_id as $status) {
            $this->Get_dispo->delete_by_id($status);
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
		$status = $this->input->post('status');
		$count_row = $this->Get_dispo->get_dup_id($status);

        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

        if($action == 'add'){
            if($count_row > 0)
            {
                $data['inputerror'][] = 'status';
                $data['error_string'][] = 'Status '.$this->input->post('status').' already exist';
                $data['status'] = FALSE;
            }
        }

        if($this->input->post('status_name') == '')
        {
            $data['inputerror'][] = 'status_name';
            $data['error_string'][] = 'Status Name is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
