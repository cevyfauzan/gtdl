<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/chartjs/Chart.min.js"></script>
<script>
	$(document).ready(function() {
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
            labels: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "23:59"],
            datasets: [
                {
                label: "Sales",
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#00a65a",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 13, 14, 1, 0, 18, 10, 12, 13, 0, 0, 0, 0, 0, 0, 0]
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
<b>Satistical Reports</b>
<div class="row">
    <div class="col-sm-12">
		<b>Call Day per Hours</b>
		<div class="chart">
            <canvas id="areaChart" style="height:200px"></canvas>
        </div>
    </div>
</div>
<legend></legend>
<div class="row">
    <div class="col-sm-12">
        <b>Call Statistics</b>
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">5</h3>
                    <span class="description-text">Total Calls</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">1</h3>
                    <span class="description-text">Total Agents</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <h3 class="description-header">1</h3>
                    <span class="description-text">Leads Count</span>
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
                        <th>Percent</th>
                        <th>Dipsositions</th>
                        <th>Total Calls</th>
                    </tr>
                </thead>
                <tbody>
					<?php foreach($list_dispo as $row){ ?>
                    <tr>
                        <td>4.61 %</td>
                        <td><i class="fa fa-stop" style="color:#00c0ef"></i> <?= $row->status ?></td>
                        <td>175 Calls</td>
					</tr>
					<?php } ?>
				</table>
			</div>
			<div class="col-sm-6">
				<canvas id="pieChart" style="height:350px"></canvas>
			</div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->