<?php
############################################################################################
####  Name:             	dash.php                                                    ####
####  Type:             	ci views - administrator                     				####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/chartjs/Chart.min.js"></script>
<script>
	var tableCamp;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		tableCamp = $('#campaigns').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('dash/campaign_list')?>",
				"type": "POST"
			},
			"columnDefs": [
				{ 
					"targets": [ 0 ],
					"orderable": false,
				},
				{ 
					"targets": [ -1 ],
					"orderable": false,
				},
			],
		});

        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
            labels: ["00-03", "03-06", "06-09", "09-12", "12-15", "15-18", "18-21", "21-24"],
            datasets: [
                {
                label: "Sales",
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#00a65a",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [0, 0, 2, 13, 14, 6, 0, 0]
                }
            ]
        };

        var areaChartOptions = {
            showScale: true,
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            bezierCurve: false,
            bezierCurveTension: 0.3,
            pointDot: true,
            pointDotRadius: 4,
            pointDotStrokeWidth: 1,
            pointHitDetectionRadius: 20,
            datasetStroke: true,
            datasetStrokeWidth: 2,
            datasetFill: true,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            maintainAspectRatio: true,
            responsive: true
            };
        areaChart.Line(areaChartData, areaChartOptions);
    });

    window.setTimeout(function() {
		$("#alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 3000);
    
    function nav_active(){
		document.getElementById("dash").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>

<!--======================================================================================================================-->
<div id="alert"><?= $this->session->flashdata('message') ?></div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">TOTAL SALES</span>
                <span class="info-box-number">35</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">SALES / HOUR</span>
                <span class="info-box-number">6</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-phone"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CALLS RINGING</span>
                <span class="info-box-number">5</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fa fa-tags"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">TOTAL CALLS</span>
                <span class="info-box-number">2581</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agents & Leads Status</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#a_status"><i class="fa fa-desktop"></i> Agent Status</button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#wall"><i class="fa fa-desktop"></i> Wallboard</button>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8">
                        <b>AGENT RESOURCES</b>
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <h3 class="description-header">5</h3>
                                    <span class="description-text">AGENTS ON CALL</span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <h3 class="description-header">1</h3>
                                    <span class="description-text">AGENTS ON PAUSED</span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <h3 class="description-header">1</h3>
                                    <span class="description-text">AGENTS ON WAITING</span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <h3 class="description-header">7</h3>
                                    <span class="description-text">TOTAL AGENTS ONLINE</span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <legend></legend>
                        <b>LEADS RESOURCES</b>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block border-right">
                                    <h3 class="description-header">10.288</h3>
                                    <span class="description-text">LEADS IN HOPPER</span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block border-right">
                                    <h3 class="description-header">23.952</h3>
                                    <span class="description-text">DIALABLE LEADS</span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block">
                                    <h3 class="description-header">23.950</h3>
                                    <span class="description-text">TOTAL LEADS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <b>CAMPAIGNS RESOURCES</b>
                        <div class="callout">
                            <?php for($i=1; $i<6; $i++){ ?>
                            <div class="row">
                                <div class="col-sm-7"><h4><b>CAMPAIGN <?= $i ?></b></h4></div>
                                <div class="col-sm-5">200 Leads</div>
                            </div>
                            <?php } ?>
                        </div>
                        <b><a href="" class="small-box-footer" data-toggle="modal" data-target="#more_camp">View More Campaigns <i class="fa fa-arrow-circle-right"></i></a></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Sales Graph (Today)</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="areaChart" style="height:200px"></canvas>
                </div>            
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">System Services</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>SERVICE</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Asterisk (Telephony)</td>
                            <td style="color:#00a65a ">Running</td>
                            <td><button class="btn btn-primary btn-xs">Reload</button></td>
                        </tr>
                        <tr>
                            <td>Mysql (Database)</td>
                            <td style="color:#00a65a ">Running</td>
                            <td><button class="btn btn-primary btn-xs">Reload</button></td>
                        </tr>
                        <tr>
                            <td>Http (Web)</td>
                            <td style="color:#00a65a ">Running</td>
                            <td><button class="btn btn-primary btn-xs">Reload</button></td>
                        </tr>
                        <tr>
                            <td>Network (NIC)</td>
                            <td style="color:#dd4b39 ">Stopped</td>
                            <td><button class="btn btn-success btn-xs">Start</button></td>
                        </tr>
                    </tbody>
                </table>           
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Server Statistics</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <b>CPU</b>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="callout">
                            <div class="row">
                                <div class="col-sm-2" ><b>PROCESSOR</b></div>
                                <div class="col-sm-10">:&ensp;4</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"><b>MODEL</b></div>
                                <div class="col-sm-10">:&ensp;Intel(R) Xeon E3-1220 v2 CPU @ 3.10 Ghz</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"><b>CPU SPEED</b></div>
                                <div class="col-sm-10">:&ensp;3.1 Ghz</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                    <b>MEMORY USAGE</b>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>TYPE</th>
                                    <th>CAPACITY (%)</th>
                                    <th></th>
                                    <th>FREE</th>
                                    <th>USED</th>
                                    <th>SIZE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Physical Memory</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar progress-bar-danger" style="width: 95%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-red">95%</span></td>
                                    <td>93.63 MB</td>
                                    <td>1.65 MB</td>
                                    <td>1.75 MB</td>
                                </tr>
                                <tr>
                                    <td>- Cached</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar progress-bar-success" style="width: 68%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-green">68%</span></td>
                                    <td></td>
                                    <td>1.18 MB</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Disk Swap</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar progress-bar-success" style="width: 1%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-green">1%</span></td>
                                    <td>1.98 GB</td>
                                    <td>15.4 MB</td>
                                    <td>2.00 GB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-sm-12 table-responsive">
                    <b>FILE SYSTEMS</b>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>MOUNT</th>
                                    <th>TYPE</th>
                                    <th>PARTITION</th>
                                    <th>CAPACITY (%)</th>
                                    <th></th>
                                    <th>FREE</th>
                                    <th>USED</th>
                                    <th>SIZE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>/boot</td>
                                    <td>ext3</td>
                                    <td>/dev/sda1</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" style="width: 10%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-green">10%</span></td>
                                    <td>103.75 MB</td>
                                    <td>11.75 MB</td>
                                    <td>121.32 MB</td>
                                </tr>
                                <tr>
                                    <td>/</td>
                                    <td>ext3</td>
                                    <td>/dev/sda3</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" style="width: 51%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-green">51%</span></td>
                                    <td>195.27 GB</td>
                                    <td>230.67 GB</td>
                                    <td>449.11 GB</td>
                                </tr>
                                <tr>
                                    <td>/dev/shm</td>
                                    <td>tmpfs</td>
                                    <td>tmpfs</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" style="width: 1%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-green">1%</span></td>
                                    <td>894.29 MB</td>
                                    <td>0.00 KB</td>
                                    <td>894.29 MB</td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">Totals</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" style="width: 51%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-green">51%</span></td>
                                    <td>196.24 GB</td>
                                    <td>230.68 GB</td>
                                    <td>450.11 GB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Wallboard -->
<div id="wall" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:97%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agent Status Wallboard</h4>
			</div>
			<div class="modal-body" style="background: #e2e6e9">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><b>10</b></span>

                            <div class="info-box-content">
                            <center><span class="info-box-number">Agent001 - 8001</span></center>
                            <span class="info-box-number pull-right">campaign</span>
                            <span class="info-box-number text-green"><i class="fa fa-circle"></i> Incall</span>
                            <span class="info-box-number pull-right">572</span>
                            <span class="info-box-number">00:12:51</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-orange"><b>10</b></span>

                            <div class="info-box-content">
                            <center><span class="info-box-number">Agent001 - 8001</span></center>
                            <span class="info-box-number pull-right">campaign</span>
                            <span class="info-box-number text-orange"><i class="fa fa-circle"></i> Dispo</span>
                            <span class="info-box-number pull-right">572</span>
                            <span class="info-box-number">00:00:51</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-blue"><b>11</b></span>

                            <div class="info-box-content">
                            <center><span class="info-box-number">Agent002 - 8002</span></center>
                            <center><span class="info-box-number text-blue"><i class="fa fa-circle"></i> Ready</span></center>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-default"><b>0</b></span>

                            <div class="info-box-content">
                            <center><span class="info-box-number">Agent002 - 8002</span></center>
                            <center><span class="info-box-number"><i class="fa fa-circle"></i> Offline</span></center>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <center><button class="btn btn-default btn-md" data-dismiss="modal">CLOSE</button></center>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Agent Status -->
<div id="a_status" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agent Status Wallboard</h4>
			</div>
			<div class="modal-body" style="background: #e2e6e9">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><b>10</b></span>

                            <div class="info-box-content">
                            <center><span class="info-box-number">Agent001 - 8001</span></center>
                            <span class="info-box-number pull-right">campaign</span>
                            <span class="info-box-number text-green"><i class="fa fa-circle"></i> Incall</span>
                            <span class="info-box-number pull-right">572</span>
                            <span class="info-box-number">00:12:51</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-orange"><b>10</b></span>

                            <div class="info-box-content">
                            <center><span class="info-box-number">Agent001 - 8001</span></center>
                            <span class="info-box-number pull-right">campaign</span>
                            <span class="info-box-number text-orange"><i class="fa fa-circle"></i> Dispo</span>
                            <span class="info-box-number pull-right">572</span>
                            <span class="info-box-number">00:00:51</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-blue"><b>11</b></span>

                            <div class="info-box-content">
                            <center><span class="info-box-number">Agent002 - 8002</span></center>
                            <center><span class="info-box-number text-blue"><i class="fa fa-circle"></i> Ready</span></center>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-default"><b>0</b></span>

                            <div class="info-box-content">
                            <center><span class="info-box-number">Agent002 - 8002</span></center>
                            <center><span class="info-box-number"><i class="fa fa-circle"></i> Offline</span></center>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <center><button class="btn btn-default btn-md" data-dismiss="modal">CLOSE</button></center>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Campaigns -->
<div id="more_camp" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Campaings</h4>
			</div>
			<div class="modal-body">
                <table id="campaigns" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Campaign ID</th>
                        <th>Campaign Name</th>
                        <th>Status</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <center><button class="btn btn-default btn-md" data-dismiss="modal">CLOSE</button></center>
			</div>
		</div>			
	</div>
</div>