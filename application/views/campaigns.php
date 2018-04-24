<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/all.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="camTabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" data-url="<?= base_url() ?>campaigns/get_campaigns">Campaigns</a></li>
                <li><a href="#tab_2" data-toggle="tab" data-url="<?= base_url() ?>campaigns/get_dispositions">Dispositions&ensp;<small class="label pull-right bg-green">New</small></a></li>
                <li><a href="#tab_3" data-toggle="tab" data-url="<?= base_url() ?>campaigns/get_lead_recycling">Lead Recycling</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1"></div>
                <div class="tab-pane" id="tab_2"></div>
                <div class="tab-pane" id="tab_3"></div>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->
<script>
    $(document).ready(function() {
        $('#camTabs a').click(function (e) {
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
		document.getElementById("data-camp").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>