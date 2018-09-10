<?php
############################################################################################
####  Name:             	Uses.php	                                            	####
####  Type:             	ci controllers - administrator                     			####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$access = explode('#', $this->session->userdata('access'));
		if(!$this->session->userdata('logged_in') or !in_array('users', $access))
		{ 
			$this->session->set_flashdata('message', '<div class="bs-example">
													<div class="alert alert-danger alert-dismissible">
														<button class="close" data-dismiss="alert">&times;</button>
														<strong>Error!</strong> You have no right to access Users.
													</div>
												</div>');
			redirect('dash'); 
		}
		$this->load->model(array('Get_user','Get_user_group'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Users';
		$data['main'] = 'get_users/users';
		$data['list_user_group'] = $this->Get_user_group->listUserGroup();
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

			$row[] = '<a href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$user->user."'".')"><i class="fa fa-edit text-yellow"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_user('."'".$user->user."'".')"><i class="fa fa-remove text-red"></i></a>&ensp;';
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

	public function ajax_add()
    {
        $ACT = 'add';
        $this->_validate($ACT);
		$SQLdate = date("Y-m-d H:i:s");

		$data = array(
                'user' => $this->input->post('user'),
                'pass' => $this->input->post('password'),
                'full_name' => $this->input->post('fullname'),
                'phone_login' => $this->input->post('phone_login'),
                'phone_pass' => $this->input->post('phone_pass'),
                'user_group' => $this->input->post('user_group'),
                'active' => $this->input->post('active'),
                'created_date' => $SQLdate
            );
 
        if(!empty($_FILES['avatar']['name']))
        {
            $upload = $this->_do_upload();
            $data['avatar'] = $upload;
        }else{
            $data['avatar'] = 'avatar.png';
        }
        $insert = $this->Get_user->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($user_group)
    {
        $data = $this->Get_user->get_by_id($user_group);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $ACT = 'update';
        $this->_validate($ACT);

		$data = array(
            'pass' => $this->input->post('password'),
            'full_name' => $this->input->post('fullname'),
            'phone_login' => $this->input->post('phone_login'),
            'phone_pass' => $this->input->post('phone_pass'),
            'user_group' => $this->input->post('user_group'),
            'active' => $this->input->post('active')
        );

        if(!empty($_FILES['avatar']['name']))
        {
            $upload = $this->_do_upload();
            $user = $this->Get_user->get_by_id($this->input->post('user'));
            if(file_exists('assets/avatar/'.$user->avatar) && $user->avatar)
            unlink('assets/avatar/'.$user->avatar);
            $data['avatar'] = $upload;
        }
        $this->Get_user->update(array('user' => $this->input->post('user')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($user)
    {
        $data = $this->Get_user->get_by_id($user);
        if(file_exists('assets/avatar/'.$data->avatar) && $data->avatar)
        unlink('assets/avatar/'.$data->avatar);
        
        $this->Get_user->delete_by_id($user);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('user');
        foreach ($list_id as $user) {
            $data = $this->Get_user->get_by_id($user);
            if(file_exists('assets/avatar/'.$data->avatar) && $data->avatar)
            unlink('assets/avatar/'.$data->avatar);
            $this->Get_user->delete_by_id($user);
        }
        echo json_encode(array("status" => TRUE));
    }
 
    private function _do_upload()
    {
        $config['upload_path'] = 'assets/avatar/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name']  = round(microtime(true) * 1000);
        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('avatar'))
        {
            $data['inputerror'][] = 'avatar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }else{
            $img = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'assets/avatar/'.$img['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $config['new_image'] = 'assets/avatar/'.$img['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            return $this->upload->data('file_name');
        }
    }
 
    private function _validate($ACT)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        $action = $ACT;
		$user = $this->input->post('user');
		$count_row = $this->Get_user->get_dup_id($user);

        if($this->input->post('user') == '')
        {
            $data['inputerror'][] = 'user';
            $data['error_string'][] = 'User Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('fullname') == '')
        {
            $data['inputerror'][] = 'fullname';
            $data['error_string'][] = 'Full Name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('user_group') == '')
        {
            $data['inputerror'][] = 'user_group';
            $data['error_string'][] = 'User Group is required';
            $data['status'] = FALSE;
        }
 
        if($action == 'add'){
            if($count_row > 0)
            {
                $data['inputerror'][] = 'user';
                $data['error_string'][] = 'User '.$this->input->post('user').' already exist';
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
