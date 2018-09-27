<?php
############################################################################################
####  Name:             	index.php                                                   ####
####  Type:             	ci views - administrator                     				####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<script type="text/javascript">    
	function detail_message(agent)
	{
        var user_sender = "<?php $this->session->userdata('user')?>";
		$.ajax({
			url : "<?php echo site_url('messages/ajax_get_message')?>/" + agent,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
                if(data.user_from == user_sender){
                    var html = '<div class="direct-chat-msg"><div class="direct-chat-info clearfix">';
                    html += '<span class="direct-chat-name pull-left">' + data.user + '</span>';
                    html += '<span class="direct-chat-timestamp pull-right">' + data.date_input + '</span></div>';
                    html += '<img class="direct-chat-img" src="<?php echo base_url()?>assets/avatar/'+ data.avatar+ '">';
                    html += '<div class="direct-chat-text"' + data.message + '</div></div>';
                }else{
                    var html = '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix">';
                    html += '<span class="direct-chat-name pull-right">' + data.user + '</span>';
                    html += '<span class="direct-chat-timestamp pull-left">' + data.date_input + '</span></div>';
                    html += '<img class="direct-chat-img" src="<?php echo base_url()?>assets/avatar/'+ data.avatar+ '">';
                    html += '<div class="direct-chat-text"' + data.message + '</div></div>';
                }
                $('.title').text('Direct Message to ' + agent);
                $('#data_message').html( $("#data_message").html() + html);
                $('#send_chat').show();
            },
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from database');
			}
		});
	}

    function send_broadcast(){
        $('#myModal-broadcast').modal({backdrop: 'static', keyboard: false});
        $('#myModal-broadcast').modal('show');
    }

    function nav_active(){
		document.getElementById("mes").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>
<style>
    .agent{
        height: 430px;
        overflow: auto;
    }
</style>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agents</h3>
            </div>
            <div class="box-body no-padding agent">
                <ul class="nav nav-pills nav-stacked">
                    <?php foreach ($list_agent as $row) {?>
                    <li>
                        <a href="javascript:void(0)" onclick="detail_message('<?php echo $row->user; ?>')">
                            <img class="img-circle" src="<?php echo base_url()?>assets/dist/img/user1-128x128.jpg" style="width:30px;"><?php echo $row->user; ?>
                            <span class="label label-primary pull-right">12</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-success btn-block" onClick="send_broadcast();">Broadcast Messages</button>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
                <h3 class="box-title title" id="chat_to">Direct Message</h3>
            </div>
            <div class="box-body">
                <div class="direct-chat-messages">
                    <div id="data_message"></div>
                </div>
            </div>
            <div class="box-footer" id="send_chat" style="display:none;">
                <form action="#" method="post">
                    <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-flat">Send</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Broadcast -->
<div id="myModal-broadcast" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Broadcast Message</h4>
			</div>
			<div class="modal-body">
                <center><h3>Under Construction...!!!</h3></center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&ensp;Close</button>
			</div>
		</div>			
	</div>
</div>
