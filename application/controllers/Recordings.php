<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recordings extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Get_recording');
		$this->load->model('Get_dispo');
		$this->load->model('Get_user');
		$this->load->model('Get_campaign');
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Recordings';
		$data['main'] = 'get_recordings/recording';
		$data['list_dispo'] = $this->Get_dispo->listDispo();
		$data['list_agent'] = $this->Get_user->listAgent();
		$data['list_camp'] = $this->Get_campaign->listCamp();
		$this->load->vars($data);
		$this->load->view('template');
	}

	public function recording_list()
	{
		$list = $this->Get_recording->getRecording();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rec) {
			$no++;
			$row = array();
			$row[] = $rec->fullname;
			$row[] = $rec->phone;
			$row[] = $rec->call_date;
			$row[] = $rec->duration;
			$row[] = $rec->agent;
			$row[] = $rec->disposition;
			$row[] = $rec->campaign_id;
			$row[] = $rec->filename;

			$row[] = '<a href="'.$rec->location.'" title="Download" download="'.$rec->filename.'"><i class="fa fa-download text-blue"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Delete" onclick="delete_rec('."'".$rec->recording_id."'".')"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Play"><i class="fa fa-play-circle text-green"></i></a>&ensp;';
			$row[] = '<input type="checkbox" class="data-check" value="'.$rec->recording_id.'">';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Get_recording->countAllRec(),
						"recordsFiltered" => $this->Get_recording->countFiltRec(),
						"data" => $data,
				);
		echo json_encode($output);
	}

    public function ajax_delete($recording_id)
    {
        $this->Get_recording->delete_by_id($recording_id);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('recording_id');
        foreach ($list_id as $recording_id) {
            $this->Get_recording->delete_by_id($recording_id);
        }
        echo json_encode(array("status" => TRUE));
    }
}
