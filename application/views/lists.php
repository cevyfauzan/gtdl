<?php
############################################################################################
####  Name:             	index.php for lists                                         ####
####  Type:             	ci views - administrator                     				####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!--======================================================================================================================-->
<script>
    $(document).ready(function() {
        $('#listTabs a').click(function (e) {
            e.preventDefault();
            var url = $(this).attr("data-url");
            var href = this.hash;
            var pane = $(this);
            
            $(href).load(url,function(result){      
                pane.tab('show');
            });
        });
        $('#tab_1').load($('.active a').attr("data-url"),function(result){
            $('#tab_1').tab('show');
        });
    });

	function nav_active(){
		document.getElementById("data").className = "active";
		document.getElementById("data-list").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="listTabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" data-url="<?= base_url() ?>lists/get_lists">Lists</a></li>
                <li><a href="#tab_2" data-toggle="tab" data-url="<?= base_url() ?>lists/get_load_leads">Load Leads</a></li>
                <li><a href="#tab_3" data-toggle="tab" data-url="<?= base_url() ?>lists/get_lead_search">Lead Search&ensp;<small class="label pull-right bg-green">New</small></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1"></div>
                <div class="tab-pane" id="tab_2"></div>
                <div class="tab-pane" id="tab_3"></div>
            </div>
        </div>
    </div>
</div>
