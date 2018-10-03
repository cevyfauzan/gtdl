<?php
############################################################################################
####  Name:             	Cost_provider.php                                           ####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Cost_provider extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$access = explode('#', $this->session->userdata('access'));
		if(!$this->session->userdata('logged_in') or !in_array('cost-provider', $access))
		{ 
			$this->session->set_flashdata('message', '<div class="bs-example">
													<div class="alert alert-danger alert-dismissible">
														<button class="close" data-dismiss="alert">&times;</button>
														<strong>Error!</strong> You have no right to access Call Times.
													</div>
												</div>');
			redirect('dash'); 
		}
		$this->load->model('Get_cost_provider');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Cost Provider';
		$data['main'] = 'get_cost_provider/cost_provider';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function provider_list()
	{
		$list = $this->Get_cost_provider->getProvider();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cost) {
			$no++;
			$row = array();
			$row[] = $cost->provider;
			$row[] = $cost->prefix;
			$row[] = 'Rp '.$cost->cost_sec.',-';

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_ct('."'".$cost->id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_ct('."'".$cost->id."'".')"><i class="fa fa-remove text-red"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$cost->id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_cost_provider->countAll(),
						"recordsFiltered" => $this->Get_cost_provider->countFilt(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add()
    {
        $ACT = 'add';
        $this->_validate($ACT);
         
        $data = array(
                'provider' => $this->input->post('provider'),
                'prefix' => $this->input->post('prefix'),
                'cost_sec' => $this->input->post('cost_sec')
            );
 
        $insert = $this->Get_cost_provider->save($data);
 
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($id)
    {
        $data = $this->Get_cost_provider->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $ACT = 'update';
        $this->_validate($ACT);

        $data = array(
            'provider' => $this->input->post('provider'),
            'prefix' => $this->input->post('prefix'),
            'cost_sec' => $this->input->post('cost_sec')
);
        $this->Get_cost_provider->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->Get_cost_provider->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->Get_cost_provider->delete_by_id($id);
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
		$id = $this->input->post('provider');
		$count_row = $this->Get_cost_provider->get_dup_id($id);

        if($this->input->post('provider') == '')
        {
            $data['inputerror'][] = 'provider';
            $data['error_string'][] = 'Provider is required';
            $data['status'] = FALSE;
        }
 
        if($action == 'add'){
			if($count_row > 0)
			{
				$data['inputerror'][] = 'provider';
				$data['error_string'][] = 'Provider '.$this->input->post('provider').' already exist';
				$data['status'] = FALSE;
			}
		}

        if($this->input->post('prefix') == '')
        {
            $data['inputerror'][] = 'prefix';
            $data['error_string'][] = 'Prefix is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('cost_sec') == '')
        {
            $data['inputerror'][] = 'cost_sec';
            $data['error_string'][] = 'Cost / sec is required';
            $data['status'] = FALSE;
        }

		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
