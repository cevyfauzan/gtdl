<?php
############################################################################################
####  Name:             	Scripts.php                                             	####
####  Type:             	ci controller - administrator                     			####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Scripts extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_script');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Scripts';
		$data['main'] = 'get_scripts/scripts';
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function script_list()
	{
		$list = $this->Get_script->getScript();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $scr) {
			$no++;
			$row = array();
			$row[] = strtoupper($scr->script_id);
			$row[] = strtoupper($scr->script_name);
			switch($scr->active){
				case "N":
				$row[] = '<font color="red">INACTIVE<font>';
				break;
				case "Y":
				$row[] = '<font color="green">ACTIVE<font>';
				break;
			}
			$row[] = '';

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_script('."'".$scr->script_id."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_script('."'".$scr->script_id."'".')"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$scr->script_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_script->countAllScript(),
						"recordsFiltered" => $this->Get_script->countFiltScript(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_add()
    {
        $ACT = 'add';
        $this->_validate($ACT);
         
        $data = array(
                'script_id' => $this->input->post('script_id'),
                'script_name' => $this->input->post('script_name'),
                'script_comments' => $this->input->post('script_comments'),
                'active' => $this->input->post('active'),
                'script_text' => $this->input->post('script_text')
            );
 
        $insert = $this->Get_script->save($data);
 
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($script_id)
    {
        $data = $this->Get_script->get_by_id($script_id);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $ACT = 'update';
        $this->_validate($ACT);

        $data = array(

            'script_name' => $this->input->post('script_name'),
			'script_comments' => $this->input->post('script_comments'),
			'active' => $this->input->post('active'),
			'script_text' => $this->input->post('script_text')
	);
        $this->Get_script->update(array('script_id' => $this->input->post('script_id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($status)
    {
        $this->Get_script->delete_by_id($status);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('script_id');
        foreach ($list_id as $script_id) {
            $this->Get_script->delete_by_id($script_id);
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
		$script_id = $this->input->post('script_id');
		$count_row = $this->Get_script->get_dup_id($script_id);

        if($this->input->post('script_id') == '')
        {
            $data['inputerror'][] = 'script_id';
            $data['error_string'][] = 'Script ID is required';
            $data['status'] = FALSE;
        }
 
        if($action == 'add'){
			if($count_row > 0)
			{
				$data['inputerror'][] = 'script_id';
				$data['error_string'][] = 'Script ID '.$this->input->post('script_id').' already exist';
				$data['status'] = FALSE;
			}
		}

        if($this->input->post('script_name') == '')
        {
            $data['inputerror'][] = 'script_name';
            $data['error_string'][] = 'Script Name is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
