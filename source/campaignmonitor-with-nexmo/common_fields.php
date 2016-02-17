<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$campaign_id = $_POST['campaign_id'];
		$username = $_POST['app_id'];
		$password = '';
		$constumfields=array();
		$phone_number_field = $_POST['phone_number_field'];
		$all_lists = $_POST['all_lists'];
		
		//print_r($all_lists);
		
		$common_fileds=array(); // constant
		$all_list_fields = array();
		if(count($all_lists) > 0){
			
			foreach($all_lists as $list){
				$context = stream_context_create(array(
					'http' => array(
					'header'  => "Authorization: Basic " . base64_encode("$username:$password")
					)
				));			
				$custom_fields = @file_get_contents('https://api.createsend.com/api/v3.1/lists/'.$list.'/customfields.json',false,$context);
				$custom_fields=json_decode($custom_fields);
				//$current_fields=$custom_fields;
				$temp_array = array();
				foreach($custom_fields as $cf){
					$temp_array[]=$cf->Key;
				}
				
				$all_list_fields[] = $temp_array;
			}
		}
		$common_fileds = $all_list_fields[0];//initializing common fields
		foreach($all_list_fields as $fields){
			$common_fileds = array_intersect($common_fileds, $fields);
		}
		
		?>
		<tr class="dynamic_rows " id="common_fileds_section">
			<td class="auto-style2">
				<label for="dName">
				   Your message
				</label>
			</td>
			<td class="auto-style1">
				<div style="margin-left:10px;">
					<textarea id="message" class="formField" placeholder="Type here your message to be sent..."></textarea>
				</div>
				<div style="margin-left:10px;">
				<small>You may use [name] and [email] in your messages to make your SMS dynamic.</small>
				</div>
				<div>
				<input type="submit" id="send_message" class="SendSms1" name="Send SMS" value="Send SMS">
				</div>
			</td>
		</tr>
		<?php
	}
?>

	