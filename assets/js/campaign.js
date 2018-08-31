	var save_method;
	var tableCamp;
	var tableList;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		tableCamp = $('#camp').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('campaigns/campaign_list')?>",
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
		
		var aaa = document.getElementById("campID").value;
		tableList = $('#tblHopper').DataTable({ 
			"ordering": false,
			"searching": false,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('campaigns/list_camp/')?>" + aaa,
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

		$("input").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("textarea").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});

	function add_camp()
	{
		save_method = 'add';
		$('#form-camp')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form_camp').modal('show');
		$('#list_camp').hide();
		$('.modal-title').text('Add New Campaign');
		$('[name="camp_id"]').attr('readonly',false);
	}

	function edit_camp(campaign_id)
	{
		save_method = 'update';
		$('#form-camp')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('campaigns/ajax_edit')?>/" + campaign_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('label[for="camp_id"]').html(data.campaign_id);
				$('label[for="camp_name"]').html(data.campaign_name);
				$('[name="camp_id"]').val(data.campaign_id);
				$('[name="camp_name"]').val(data.campaign_name);
				$('[name="camp_desc"]').val(data.campaign_description);
				$('[name="camp_carrier"]').val(data.dial_prefix);
				$('[name="active"]').val(data.active);
				$('[name="dial_method"]').val(data.dial_method);
				$('[name="auto_dial_level"]').val(data.auto_dial_level);
				$('[name="camp_cid"]').val(data.campaign_cid);
				$('[name="camp_rec"]').val(data.campaign_recording);
				$('[name="amd"]').val(data.campaign_vdad_exten);
				$('[name="camp_script"]').val(data.campaign_script);
				$('[name="call_time"]').val(data.local_call_time);
				$('[name="camp_id"]').attr('readonly',true);
				$('[name="camp_name"]').attr('required',true);
				$('#list_camp').show();
				$('#modal_form_camp').modal('show');
				$('.modal-title').text('Modify Campaign : ' + data.campaign_id + ' - ' + data.campaign_name);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function info_camp(campaign_id)
	{
		$.ajax({
			url : "<?php echo site_url('campaigns/ajax_edit')?>/" + campaign_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('label[for="camp_id"]').html(data.campaign_id);
				$('label[for="camp_name"]').html(data.campaign_name);
				$('[name="camp_id"]').val(data.campaign_id);
				$('[name="camp_name"]').val(data.campaign_name);
				$('[name="camp_desc"]').val(data.campaign_description);
				$('[name="active"]').val(data.active);
				$('[name="dial_method"]').val(data.dial_method);
				$('[name="auto_dial_level"]').val(data.auto_dial_level);
				$('[name="camp_cid"]').val(data.campaign_cid);
				$('[name="camp_rec"]').val(data.campaign_recording);
				$('[name="amd"]').val(data.campaign_vdad_exten);
				$('[name="camp_script"]').val(data.campaign_script);
				$('[name="call_time"]').val(data.local_call_time);
				$('#info-camp').modal('show');
				$('.modal-title').text('Info Campaign : ' + data.campaign_id + ' - ' + data.campaign_name);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_camp()
	{
		tableCamp.ajax.reload();
	}

	function save()
	{
		$('#btnSave').text('SAVING...');
		$('#btnSave').attr('disabled',true);
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('campaigns/ajax_add')?>";
		} else {
			url = "<?php echo site_url('campaigns/ajax_update')?>";
		}

		var formData = new FormData($('#form-camp')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
					$('#modal_form_camp').modal('hide');
					reload_table_camp();
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					}
				}
				$('#btnSave').text('SUBMIT');
				$('#btnSave').attr('disabled',false);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data');
				$('#btnSave').text('SUBMIT');
				$('#btnSave').attr('disabled',false);
			}
		});
	}

	function delete_camp(campaign_id)
	{
		if(confirm('Are you sure you want to delete this campaign ?'))
		{
			$.ajax({
				url : "<?php echo site_url('campaigns/ajax_delete')?>/"+campaign_id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					$('#modal_form_camp').modal('hide');
					reload_table_camp();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}

	function bulk_delete()
	{
		var list_id = [];
		$(".data-check:checked").each(function() {
				list_id.push(this.value);
		});
		if(list_id.length > 0)
		{
			if(confirm('Are you sure delete campaign '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {camp_id:list_id},
					url: "<?php echo site_url('campaigns/ajax_bulk_delete')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table_camp();
						}
						else
						{
							alert('Failed.');
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting data');
					}
				});
			}
		}
		else
		{
			alert('No data selected');
		}
	}

	function change(b){
		var id = b.value;
		if(id == 'Y' || id == 'MANUAL'){
			$('#autoDial').hide();
		}else{
			$('#autoDial').show();
		}
	}

		var save_method;
	var tableRecyc;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		tableRecyc = $('#recyc').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('campaigns/recycle_list')?>",
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

		$("input").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("select").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("#check-all-recyc").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});
		
	function add_recyc()
	{
		//save_method = 'addRecyc';
		$('#form-add_recyc')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#add-recyc').modal('show');
		$('.modal-title').text('Add New Lead Recycle');
	}

	function edit_recyc(recycle_id)
	{
		save_method = 'updateRecyc';
		$('#form-camp')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('campaigns/ajax_edit_recycle')?>/" + recycle_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="camp_id"]').val(data.campaign_id);
				$('[name="camp_name"]').val(data.campaign_name);
				$('[name="camp_desc"]').val(data.campaign_description);
				$('[name="camp_carrier"]').val(data.dial_prefix);
				$('[name="active"]').val(data.active);
				$('[name="dial_method"]').val(data.dial_method);
				$('[name="camp_id"]').attr('readonly',true);
				$('[name="camp_name"]').attr('required',true);
				$('#list_camp').show();
				$('#lead-recyc').modal('show');
				$('.modal-title').text('Modify Lead Recycle Campaign : ' + data.campaign_id + ' - ' + data.campaign_name);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_recyc()
	{
		tableRecyc.ajax.reload(null,false);
	}

	function save_recyc()
	{
		$('#btnSaveRecyc').text('SAVING...');
		$('#btnSaveRecyc').attr('disabled',true);
		var url;
		url = "<?php echo site_url('campaigns/ajax_add_recycle')?>";

		var formDataRecyc = new FormData($('#form-add_recyc')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formDataRecyc,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
					$('#add-recyc').modal('hide');
					reload_table_recyc();
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					}
				}
				$('#btnSaveRecyc').text('SUBMIT');
				$('#btnSaveRecyc').attr('disabled',false);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding data');
				$('#btnSaveRecyc').text('SUBMIT');
				$('#btnSaveRecyc').attr('disabled',false);
			}
		});
	}

	function delete_recyc(recycle_id)
	{
		if(confirm('Are you sure you want to delete this campaign ?'))
		{
			$.ajax({
				url : "<?php echo site_url('campaigns/ajax_delete')?>/"+recycle_id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					$('#modal_form_camp').modal('hide');
					reload_table_recyc();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}

	function bulk_delete_recyc()
	{
		var list_id = [];
		$(".data-check:checked").each(function() {
				list_id.push(this.value);
		});
		if(list_id.length > 0)
		{
			if(confirm('Are you sure delete campaign '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {camp_id:list_id},
					url: "<?php echo site_url('campaigns/ajax_bulk_delete')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table_recyc();
						}
						else
						{
							alert('Failed.');
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting data');
					}
				});
			}
		}
		else
		{
			alert('No data selected');
		}
	}
