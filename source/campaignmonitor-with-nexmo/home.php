<?php
require_once 'header.php';
//$app_id = 'b3292c7aaad739e76eafd1c2d875cb15';
//$nexmo_api_key='5b2a23d7';
//$nexmo_secret='59d9fa03';
//$nexmo_from_number='919222010055';
//$phone_number_field='phone_number';

if (file_exists('settings.xml')) {
   $xml = simplexml_load_file('settings.xml');
   if($xml!="")
   {
	$nexmo_api_key = (string)$xml->nexmo->api;
	$nexmo_secret=(string)$xml->nexmo->secretkey;
	$nexmo_from_number=(string)$xml->nexmo->fromnumber;
	$app_id=(string)$xml->campaignmonitor->campaign_monitor_api_key;
	$phone_number_field=(string)$xml->campaignmonitor->phonenumberfield;
   }
}

?>
<html>
<body class="body">
<script>
$(document).ready(function(){
	//script for client list
	$("#campaign_status").change(function(e){
		$('#loader').show();
		$('.dynamic_rows').remove();
		e.preventDefault();
		var form = $(this);
		if($(this).val()!=""){ // if selected is not blank
			if($("#app_id").val()!=""){
				$.ajax({
					url: 'clients_list.php',
					async: 'false',
					cache: 'false',
					type: 'POST',
					data: {
						app_id : $("#app_id").val()
					},
					success: function(response){
						$('#loader').hide();
						if(response!=""){
							if($("#cliens_list_section").length == 0) {
								$("table").append(response);   
							}							
						}else{
							alert("Please check your app id");
						}
					}
				});
			}else{
				alert("API key can not be blank.");
				$('#loader').hide();
			}
		}else{
			$('#loader').hide();
		}
	});
	
	//script for campaign list
	$('#formTable').on('click', '.client_id', function(e){
		$('#loader').show();
		if($(this).val()!=""){ // if selected is not blank 
		$('#campaign_list_section, #subscribers_list_section, #common_fileds_section, #sent_message_section').remove();
			if($("#app_id").val()!=""){
				$.ajax({
					url: 'campaign_list.php',
					async: 'false',
					cache: 'false',
					type: 'POST',
					data: {
						app_id : $("#app_id").val(),
						client_id : $(this).val(),
						campaign_status : $("#campaign_status").val()
					},
					success: function(response){
						$('#loader').hide();
						if(response!=""){
							if($("#campaign_list_section").length == 0) {	
								$("table").append(response);
							}							
						}else{
							alert("no campaigns");
						}
					}
				});
			}else{
				alert("app id can not be blank.");
			}
		}
	});
	
	//script list details
	$('#formTable').on('click', '.campaign_list', function(e){
		$('#loader').show();
		$('#subscribers_list_section, #common_fileds_section, #sent_message_section').remove();
		if($(this).val()!=""){ // if selected is not blank
			if($("#app_id").val()!=""){
				$.ajax({
					url: 'list_details.php',
					async: 'false',
					cache: 'false',
					type: 'POST',
					data: {
						app_id : $("#app_id").val(),
						campaign_id : $(this).val(),
						phone_number_field : '<?php echo $phone_number_field;?>'
						//campaign_status : $("#campaign_status").val()
					},
					success: function(response){
						$('#loader').hide();
						if(response!=""){ 
							if($("#subscribers_list_section").length == 0) {
								$("table").append(response);    
							}
							
						}else{
							alert("no lists");
						}
					}
				});
			}else{
				alert("app id can not be blank.");
			}
		}
	});
	
	
	$('#formTable').on('click', '#proceed', function(e){
		$('#loader').show();
		e.preventDefault();
		var allVals=[];	
			 $('.users_list').each(function() {
				 if($(this).is(":checked"))
				 {
					 allVals.push($(this).val());
				 }
			 });
			if(allVals.length>0)
			{
				//$.each(allVals, function( key, value ){
				  $.ajax({
					//url: 'contact_details.php',
					url: 'common_fields.php',
					async: 'false',
					cache: 'false',
					type: 'POST',
					data: {
						//list_id : value,
						app_id : $("#app_id").val(),
						list_id : $(this).val(),
						all_lists : allVals
						},
					success: function(response){
						$('#loader').hide();
						//alert(response);
						if(response!=""){ 
							if($("#common_fileds_section").length == 0) {
								$("table").append(response);    
							}
							
						}else{
							//alert("no lists");
						}
					},
					error:function(error)
					{
						alert(error);
					}
				});
				//});
			}
		else{
				alert("Please select one list.");
			}	 
   
	});
	
	//send message
	$('#formTable').on('click', '#send_message', function(e){
		if($("#message").val()==""){
			alert("Message can not be blank.");
			e.preventDefault();
		}else {
			$('#loader').show();
			e.preventDefault();
			var allVals=[];	
				 $('.users_list').each(function() {
					 if($(this).is(":checked"))
					 {
						 allVals.push($(this).val());
					 }
				 });
				if(allVals.length>0)
				{
					$.ajax({
						url: 'send_sms.php',
						async: 'false',
						cache: 'false',
						type: 'POST',
						data: {
							app_id : $("#app_id").val(),
							phone_number_field : '<?php echo $phone_number_field;?>',
							nexmo_api_key : '<?php echo $nexmo_api_key;?>',
							nexmo_secret : '<?php echo $nexmo_secret;?>',
							nexmo_from_number : '<?php echo $nexmo_from_number;?>',
							message : $("#message").val(),
							all_lists : allVals
						},
						success: function(response){
							
							$('#loader').hide();
							if(response!=""){ 
								if($("#sent_message_section").length == 0) {
									$("table").append(response);    
								}
							}
						},
						error:function(error)
						{
							alert(error);
						}
					});
				}
			else{
					alert("Please select one list.");
				}
		}
	});
});
</script>
<div id="defaults" class="pageWrapper">
	<div class="logoWrapper">
		<img src="nexmo-logo.png" alt="Nexmo" width="200">
		<img id="loader" src="loading.gif" height="33px" width="33px" style="display:none;">
	</div>
	<form method="post" action="">
		<table id="formTable" class="tableStyle">
			
            <tr>
                <td colspan="1"> 
                    <div class="areaHeader">Campaign Monitor
                    </div>
                </td>
				<td>
					<a class="blueBtn" href="index.php" style="float:right;">Settings</a>
				</td>
				
            </tr>
            <tr>
                <td class="auto-style2">
                    <label for="dName">
                       Campaign Monitor Api key</label>
                </td>
                <td class="auto-style1">
                    <input type="text" name="app_id" id="app_id">
                </td>
            </tr>
			<tr>
                <td class="auto-style2">
                    <label for="dName">
                       Campaign Status</label>
                </td>
                <td class="auto-style1">
                    <select class="formField" name="campaign_status" id="campaign_status">
						<option value="">Select</option>
						<option value="campaigns">Sent</option>
						<option value="scheduled">Scheduled</option>
						<option value="drafts" >Drafts</option>
					</select>
                </td>
            </tr>
			<!--dynamic clients list will be rendered here as table's row-->
			<!--dynamic campaign list will be rendered here as table's next row-->
			<!--dynamic campaign list contact will be rendered here as table's next row-->
		
		</table>
	</form>
</div>
</body>
<html>