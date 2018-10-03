<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		table_apdd1 = $('#cp','#cp2').DataTable({ 
			"searching": false,
			"paging": false,
			"ordering": false,
			"info": false
		});
	});
</script>

<!--======================================================================================================================-->
<b>Cost Provider</b>
<button type="button" class="btn btn-success btn-sm pull-right">Donwload Excel</button>
<div class="row">
    <div class="col-sm-12">
        <b>Cost Provider per Agents</b>
		<table id="cp1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td rowspan="2" style="vertical-align : middle;text-align:center;"><b>Fullname</b></td>
                    <td rowspan="2" style="vertical-align : middle;text-align:center;"><b>ID</b></td>
                    <td colspan="2"><b>Telkomsel <span class="pull-right">Rp 9,- / sec</span></b></td>
                    <td colspan="2"><b>Indosat <span class="pull-right">Rp 6,- / sec</span></b></td>
                    <td colspan="2"><b>XL <span class="pull-right">Rp 5,- / sec</span></b></td>
                    <td colspan="2" align="center"><b>Subtotal</b></td>
                </tr>
                <tr>
                    <th>Talk Sec</th>
                    <th>Cost</th>
                    <th>Talk Sec</th>
                    <th>Cost</th>
                    <th>Talk Sec</th>
                    <th>Cost</th>
                    <th>Talk Sec</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_apd1 as $row){ ?>
				<tr>
                    <td><?= $row->full_name; ?></td>
                    <td><?= $row->user; ?></td>
                    <td>1200</td>
                    <td align="right">Rp 10.800,-</td>
                    <td>870</td>
                    <td align="right">Rp 5.220,-</td>
                    <td>617</td>
                    <td align="right">Rp 3.085,-</td>
                    <td>2689</td>
                    <td align="right">Rp 19.105,-</td>
				</tr>
				<?php } ?>
			</tbody>
            <tfoot>
				<tr>
                    <th colspan="2">TOTAL</th>
                    <th>12000</th>
                    <td align="right"><b>Rp 108.000,-</b></td>
                    <th>8700</th>
                    <td align="right"><b>Rp 52.200,-</b></td>
                    <th>7170</th>
                    <td align="right"><b>Rp 30.850,-</b></td>
                    <th>26890</th>
                    <td align="right"><b>Rp 191.050,-</b></td>
				</tr>
            </tfoot>
        </table>
    </div>
</div>
<legend></legend>
<div class="row">
    <div class="col-sm-12">
        <b>Cost Provider per Campaigns</b>
		<table id="cp2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td rowspan="2" style="vertical-align : middle;text-align:center;"><b>Campaign</b></td>
                    <td colspan="2"><b>Telkomsel <span class="pull-right">Rp 9,- / sec</span></b></td>
                    <td colspan="2"><b>Indosat <span class="pull-right">Rp 6,- / sec</span></b></td>
                    <td colspan="2"><b>XL <span class="pull-right">Rp 5,- / sec</span></b></td>
                    <td colspan="2" align="center"><b>Subtotal</b></td>
                </tr>
                <tr>
                    <th>Talk Sec</th>
                    <th>Cost</th>
                    <th>Talk Sec</th>
                    <th>Cost</th>
                    <th>Talk Sec</th>
                    <th>Cost</th>
                    <th>Talk Sec</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_camp_id as $row2){ ?>
				<tr>
                    <td><?= $row2->campaign_id; ?></td>
                    <td>1200</td>
                    <td align="right">Rp 10.800,-</td>
                    <td>870</td>
                    <td align="right">Rp 5.220,-</td>
                    <td>617</td>
                    <td align="right">Rp 3.085,-</td>
                    <td>2689</td>
                    <td align="right">Rp 19.105,-</td>
				</tr>
				<?php } ?>
			</tbody>
            <tfoot>
				<tr>
                    <th>TOTAL</th>
                    <th>12000</th>
                    <td align="right"><b>Rp 108.000,-</b></td>
                    <th>8700</th>
                    <td align="right"><b>Rp 52.200,-</b></td>
                    <th>7170</th>
                    <td align="right"><b>Rp 30.850,-</b></td>
                    <th>26890</th>
                    <td align="right"><b>Rp 191.050,-</b></td>
				</tr>
            </tfoot>
        </table>
    </div>
</div>
