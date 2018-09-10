<?php
############################################################################################
####  Name:             	Log_helper.php                                              ####
####  Type:             	ci controller - administrator                     			####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function user_log($tipe){
    $CI =& get_instance();
 
    if ($tipe == "SIGNIN"){
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    elseif($tipe == "SIGNOUT")
    {
        $ip = '';
    }

    $param['user'] = $CI->session->userdata('user');
    $param['user_group'] = $CI->session->userdata('user_group');
    $param['event'] = $tipe;
    $param['computer_ip'] = $ip;
    $param['event_date'] = date('Y-m-d H:i:s');
    $param['browser'] = $_SERVER['HTTP_USER_AGENT'];;
    
    $CI->load->model('Get_log');
    $CI->Get_log->save_user_log($param);
}
?>