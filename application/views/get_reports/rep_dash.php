<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/chartjs/Chart.min.js"></script>
<script>
	$(document).ready(function() {
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "IE"
      },
      {
        value: 400,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "FireFox"
      },
      {
        value: 600,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Safari"
      },
      {
        value: 300,
        color: "#3c8dbc",
        highlight: "#3c8dbc",
        label: "Opera"
      },
      {
        value: 100,
        color: "#d2d6de",
        highlight: "#d2d6de",
        label: "Navigator"
      }
    ];
    var pieOptions = {
        segmentShowStroke: true,
      segmentStrokeColor: "#fff",
      segmentStrokeWidth: 2,
      percentageInnerCutout: 0,
      animationSteps: 100,
      animationEasing: "easeOutBounce",
      animateRotate: true,
      animateScale: true,
      responsive: true,
      maintainAspectRatio: true,
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
    });

	function nav_active(){
		document.getElementById("rep").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>

<!--======================================================================================================================-->
<b>Dashboard</b>
<div class="row">
    <div class="col-sm-12">
        <b>Dispo Call Detail</b>
		<table id="apd1" class="table table-striped">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <?php foreach($list_dispo as $row1){ ?>
                    <th width="7%"><?= $row1->status; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_apd1 as $row2){ ?>
				<tr>
                    <td><?= $row2->full_name; ?></td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>1</td>
                    <td>2</td>
				</tr>
				<?php } ?>
			</body>
            <tfoot>
				<tr>
                    <th>TOTAL</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
				</tr>
            </tfoot>
        </table>
    </div>
</div>
<legend></legend>
<div class="row">
    <div class="col-sm-12">
        <b>Contact Rate</b>
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">39.61 %</h3>
                    <span class="description-text">Contact Rate</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">1201</h3>
                    <span class="description-text">Total Calls</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">501</h3>
                    <span class="description-text">Total Contacts</span>
                </div>
            </div>
        </div>
        <br>
        <legend></legend>
        <b>Sales Rate</b>
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">19.61 %</h3>
                    <span class="description-text">Sales Rate</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">66</h3>
                    <span class="description-text">Total Sales</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">5.61</h3>
                    <span class="description-text">Sales per Hours</span>
                </div>
            </div>
        </div>
        <br>
        <legend></legend>
        <b>Disposition Stats</b>
        <div class="row">
			<div class="col-sm-6 table-responsive">
				<table class="table table-striped">
					<thead>
                        <tr>
                            <th>Dispo</th>
                            <th>Dispo Desc</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list_dispo as $row3){ ?>
                        <tr>
                            <td><i class="fa fa-stop" style="color:#00c0ef"></i> <?= $row3->status ?></td>
                            <td><?= $row3->status_name ?></td>
                            <td>10</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>TOTAL</th>
                        <th></th>
                        <th>100</th>
                    </tr>
                </tfoot>
				</table>
			</div>
			<div class="col-sm-6">
				<canvas id="pieChart" style="height:350px"></canvas>
			</div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->