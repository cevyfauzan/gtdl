<?php
############################################################################################
####  Name:             	Call_times.php                                             	####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Call_times extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$access = explode('#', $this->session->userdata('access'));
		if(!$this->session->userdata('logged_in') or !in_array('call-times', $access))
		{ 
			$this->session->set_flashdata('message', '<div class="bs-example">
													<div class="alert alert-danger alert-dismissible">
														<button class="close" data-dismiss="alert">&times;</button>
														<strong>Error!</strong> You have no right to access Call Times.
													</div>
												</div>');
			redirect('dash'); 
		}
		$this->load->model('Get_call_time');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Call Times';
		$data['main'] = 'get_call_times/call_times';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function call_time_list()
	{
		$list = $this->Get_call_time->getCalltime();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $ct) {
			$no++;
			$row = array();
			$row[] = $ct->call_time_id;
			$row[] = $ct->call_time_name;
			$row[] = $ct->ct_default_start;
			$row[] = $ct->ct_default_stop;

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_ct('."'".$ct->call_time_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_ct('."'".$ct->call_time_id."'".')"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$ct->call_time_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_call_time->countAllCt(),
						"recordsFiltered" => $this->Get_call_time->countFiltCt(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add()
    {
        $ACT = 'add';
        $this->_validate($ACT);
         
        $data = array(
                'call_time_id' => $this->input->post('ct_id'),
                'call_time_name' => $this->input->post('ct_name'),
                'call_time_comments' => $this->input->post('ct_comment'),
                'ct_default_start' => $this->input->post('d_start'),
                'ct_default_stop' => $this->input->post('d_stop')
            );
 
        $insert = $this->Get_call_time->save($data);
 
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($ct_id)
    {
        $data = $this->Get_call_time->get_by_id($ct_id);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $ACT = 'update';
        $this->_validate($ACT);

        $data = array(
			'call_time_name' => $this->input->post('ct_name'),
			'call_time_comments' => $this->input->post('ct_comment'),
			'ct_default_start' => $this->input->post('d_start'),
			'ct_default_stop' => $this->input->post('d_stop')
	);
        $this->Get_call_time->update(array('call_time_id' => $this->input->post('ct_id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($ct_id)
    {
        $this->Get_call_time->delete_by_id($ct_id);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('ct_id');
        foreach ($list_id as $ct_id) {
            $this->Get_call_time->delete_by_id($ct_id);
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
		$ct_id = $this->input->post('ct_id');
		$count_row = $this->Get_call_time->get_dup_id($ct_id);

        if($this->input->post('ct_id') == '')
        {
            $data['inputerror'][] = 'ct_id';
            $data['error_string'][] = 'Call Time ID is required';
            $data['status'] = FALSE;
        }
 
        if($action == 'add'){
			if($count_row > 0)
			{
				$data['inputerror'][] = 'ct_id';
				$data['error_string'][] = 'Campaign ID '.$this->input->post('ct_id').' already exist';
				$data['status'] = FALSE;
			}
		}

        if($this->input->post('ct_name') == '')
        {
            $data['inputerror'][] = 'ct_name';
            $data['error_string'][] = 'Call Time is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('d_start') == '')
        {
            $data['inputerror'][] = 'd_start';
            $data['error_string'][] = 'Default start is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('d_stop') == '')
        {
            $data['inputerror'][] = 'd_stop';
            $data['error_string'][] = 'Default stop is required';
            $data['status'] = FALSE;
        }

		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
