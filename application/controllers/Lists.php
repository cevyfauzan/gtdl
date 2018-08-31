<?php
############################################################################################
####  Name:             	Lists.php                                             		####
####  Type:             	ci controllers - administrator                     			####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model(array('Get_list','Get_lead','Get_lead','Get_campaign','Get_dispo'));
	}
	
	public function index()
	{
		$data['title'] = 'getDIAL.tech Lists';
		$data['main'] = 'lists';
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
		$data['leadfile'] = $this->input->post('leadfile');
		$data['leadfile_name'] = $this->input->post('leadfile_name');
		$data['list_list'] = $this->Get_list->listList();
		$this->load->vars($data);
		$this->load->view('get_lists/load_leads');
	}

	public function get_upload_leads()
	{
		/* POST VALUES */
		//$phonedoces = $this->golist->getphonecodes();	
		$leadsload = $this->input->post('leadsload');
		$lead_file = $this->input->post('leadfile');
		$list_id_override = $this->input->post('list_id_override');
		$phone_code_override = $this->input->post('phone_code_override');
		$dupcheck = $this->input->post('dupcheck');
		
		$data['leadsload'] = $leadsload;
		
		$source_code_field = 		$this->input->post('source_id_field');
		$list_id_field = 			$this->input->post('list_id_field');
		$gmt_offset = 				'0';
		$called_since_last_reset=	'N';
		$phone_code_field =			eregi_replace("/[^0-9]/i", "", $this->input->post('phone_code_field'));
		$phone_number_field = 		eregi_replace("[^0-9]", "", $this->input->post('phone_number_field'));
		$title_field = 				$this->input->post('title_field');
		$first_name_field =			$this->input->post('first_name_field');
		$last_name_field = 			$this->input->post('last_name_field');
		$address1_field = 			$this->input->post('address1_field');
		$address2_field = 			$this->input->post('address2_field');
		$city_field = 				$this->input->post('city_field');
		$province_field = 			$this->input->post('province_field');
		$postal_code_field = 		$this->input->post('postal_code_field');
		$country_code_field = 		$this->input->post('country_code_field');
		$gender_field =				$this->input->post('gender_field');
		$date_of_birth_field = 		$this->input->post('date_of_birth_field');
		$alt_phone_field = 			eregi_replace("[^0-9]", "", $this->input->post('alt_phone_field'));
		$email_field = 				$this->input->post('email_field');
		$comments_field = 			trim($this->input->post('comments_field'));
		$rank_field = 				$this->input->post('rank_field');
		$owner_field = 				$this->input->post('owner_field');

		if($leadsload=="ok") {
			// Update time on vicidial_campaign
			$NOW=date("Y-m-d H:i:s");
			$listID = $this->input->post('list_id_override');
			$query = $this->db->query("SELECT campaign_id FROM vicidial_lists WHERE list_id='$listID'");
			$campaign_id = $query->row()->campaign_id;
			$query = $this->db->query("UPDATE vicidial_campaigns SET campaign_changedate='$NOW' WHERE campaign_id='$campaign_id'");

			$data['tabvalsel'] = "tabloadleads";
			//extraction
			$loginuser = $this->session->userdata('user_name');
			$leadfile_name = $this->input->post('leadfile_name');
			$phone_code_override = $this->input->post('phone_code_override');
			$leadfile = $this->input->POST('leadfile');
			$file_layout = $this->input->post('file_layout');
			$dupcheck = $this->input->post('dupcheck');
			$LF_path = $_FILES['leadfile']['tmp_name'];
				
			$leadfile = $_FILES["leadfile"];
			$lead_filename=$leadfile['name'];
					
				
			$data['dupcheck'] = $dupcheck;
			$data['leadfile'] = $leadfile;
			$data['leadfile_name'] = $leadfile_name;
			$data['list_id_override'] = $list_id_override;
			$data['phone_code_override'] = $phone_code_override;
				
			$systemlookup = $this->Get_list->systemsettingslookup();
				
			foreach($systemlookup as $sysinfo){
				$use_non_latin = $sysinfo->use_non_latin;
				$admin_web_directory = $sysinfo->admin_web_directory;
				$custom_fields_enabled = $sysinfo->custom_fields_enabled;
			}					
			
			$US='_';					
			$delim_set=0;
			$lead_filename=$leadfile['name'];
			$filenaming = explode(".", strtolower($lead_filename));
			$existingfile=array("csv","xls","xlsx","ods","sxc");
			$lead_filename = str_replace (" ", "", $lead_filename);
			$leadfile_name = $lead_filename;
				
			if (preg_match("/\.csv$|\.xls$|\.xlsx$|\.ods$|\.sxc$/i", $leadfile_name))
			{ 
				$leadfile_name = $lead_filename;
				copy($LF_path, "/tmp/$leadfile_name");
				//$new_filename = $loginuser."_".preg_replace("/\.csv$|\.xls$|\.xlsx$|\.ods$|\.sxc$/i", '.txt', $leadfile_name);
				$new_filename = $loginuser."_".preg_replace("/\.csv$|\.xls$|\.xlsx$|\.ods$|\.sxc$/i", '.txt', $leadfile_name);
				$WeBServeRRooT = "/var/www/html/";
				$admin_web_directory = "application/views/load_leads";
				$convert_command = "$WeBServeRRooT/$admin_web_directory/sheet2tab.pl /tmp/$leadfile_name /tmp/$new_filename";
				
				passthru("$convert_command");
				$lead_file = "/tmp/$new_filename";
				$data['lead_file'] = $lead_file;
				
				if (preg_match("/\.csv$/i", $leadfile_name)) {$delim_name="CSV: Comma Separated Values";}
				if (preg_match("/\.xls$/i", $leadfile_name)) {$delim_name="XLS: MS Excel 2000-XP";}
				if (preg_match("/\.xlsx$/i", $leadfile_name)) {$delim_name="XLSX: MS Excel 2007+";}
				if (preg_match("/\.ods$/i", $leadfile_name)) {$delim_name="ODS: OpenOffice.org OpenDocument Spreadsheet";}
				if (preg_match("/\.sxc$/i", $leadfile_name)) {$delim_name="SXC: OpenOffice.org First Spreadsheet";}
				$delim_set=1;
			} else {
				copy($LF_path, "/tmp/".$loginuser."_".$leadfile_name.".txt");
				$lead_file = "/tmp/".$loginuser."_".$leadfile_name.".txt";
			}
				
			$file=fopen("$lead_file", "r");
			$buffer=fgets($file, 4096);
			$tab_count=substr_count($buffer, "\t");
			$pipe_count=substr_count($buffer, "|");

			if ($delim_set < 1) {
				if ($tab_count>$pipe_count) {
					$delim_name="tab-delimited";
				} else {
					$delim_name="pipe-delimited";
				}
			} 
	
			if ($tab_count>$pipe_count){
				$delimiter="\t";
			} else {
				$delimiter="|";
			}

			$field_check=explode($delimiter, $buffer);
			flush();
			$file=fopen("$lead_file", "r");
				$data['msg1'] = "<center><font face='arial, helvetica' size=3 color='#009900'><B>Processing $delim_name file...\n";
				
			if (strlen($list_id_override)>0) {
				$data['msg2'] = "<BR><BR>LIST ID OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
			}
				
			$buffer=rtrim(fgets($file, 4096));
			$buffer=stripslashes($buffer);
			$row=explode($delimiter, eregi_replace("[\'\"]", "", $buffer));
			$data['fieldrow'] = $row;

			$standard_SQL = "list_id, phone_code, phone_number, first_name, middle_initial, last_name, address1, city, state, postal_code, alt_phone, email, comments";
			$table_SQL = "vicidial_list";

			if ($custom_fields_enabled > 0)
			{
				$query = $this->asteriskDB->query("SHOW TABLES LIKE 'custom_".$list_id_override."'");
				if ($query->num_rows() > 0)
				{
					$query = $this->asteriskDB->query("SELECT count(*) AS cnt FROM vicidial_lists_fields WHERE list_id='".$list_id_override."'");
					$fields_cnt = $query->row();
					if ($fields_cnt->cnt > 0)
					{
						$custom_SQL='';
						$query = $this->db->query("SELECT field_id,field_label,field_name,field_description,field_rank,field_help,field_type,field_options,field_size,field_max,field_default,field_cost,field_required,multi_position,name_position,field_order from vicidial_lists_fields where list_id='".$list_id_override."' order by field_rank,field_order,field_label");
		
						foreach ($query->result() as $i => $row)
						{
							$field_label[$i] = $row->field_label;
							$field_type[$i] = $row->field_type;
		
							if ( ($field_type[$i]!='DISPLAY') and ($field_type[$i]!='SCRIPT') )
							{
								if (!preg_match("/\|$field_label[$i]\|/",$fields))
								{
									$custom_SQL .= ",$field_label[$i]";
								}
							}
						}
					}
					$table_SQL = "vicidial_list, custom_".$list_id_override;
				}
			}
			$query = $this->db->query("SELECT $standard_SQL $custom_SQL FROM $table_SQL limit 1");
			$fields = $query->list_fields();

			$data['fields'] = $fields;
		} // end if load leads
	}

	public function get_lead_search()
	{
		$data['drop_down_camp'] = $this->Get_campaign->listCamp();
		$data['drop_down_dispo'] = $this->Get_dispo->listDispo();
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
		//$query = $this->db->query("INSERT INTO vicidial_lists (list_id,list_name,campaign_id,active,list_description,list_changedate)values('$listID','$listName','$campaignID','Y','Outbound ListID $listID - $NOW','$SQLdate')");
		//$query = $this->db->query("INSERT INTO vicidial_campaign_stats (campaign_id)values('$campaignID')");
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
		$query = $this->db->query("DELETE FROM vicidial_list WHERE list_id='".$list_id."'");

		echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('list_id');
        foreach ($list_id as $id) {
            $this->Get_list->delete_by_id($id);
			$query = $this->db->query("DELETE FROM vicidial_list WHERE list_id='".$id."'");
		}
        echo json_encode(array("status" => TRUE));
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
					  <a href="javascript:void(0)" title="Delete" onclick="return confirm(\'Are you sure you want to delete this data ?\');"><i class="fa fa-remove text-red"></i></a>&ensp;
					  <a href="javascript:void(0)" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;';
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

	private function _get_list_id() { 
		$query = $this->db->query('SELECT max(list_id) as kode FROM `vicidial_lists` order by list_id asc');
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
}
