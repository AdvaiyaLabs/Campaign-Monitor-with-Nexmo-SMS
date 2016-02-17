<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$campaign_id = $_POST['campaign_id'];
		$username = $_POST['app_id'];
		$password = '';
		$phone_number_field = $_POST['phone_number_field'];
		
		$context = stream_context_create(array(
			'http' => array(
			'header'  => "Authorization: Basic " . base64_encode("$username:$password")
			)
		));
		
		$lists = @file_get_contents('https://api.createsend.com/api/v3.1/campaigns/'.$campaign_id.'/listsandsegments.json',false,$context);
		
		$lists=json_decode($lists);
		$lists = $lists->Lists;
		//print_r($lists);
		
		if(!empty($lists)){
			if(count($lists)>0){
				?>
				<tr class="dynamic_rows " id="subscribers_list_section">
					<td class="auto-style2">
						<label for="dName">
						   Select List
						</label>
					</td>
					<td class="auto-style1">
						<?php 
							foreach($lists as $list){
								?><label class="subscribers_list"><input type="checkbox" class="users_list" id="chk_listId" name="list_id"  value="<?php echo $list->ListID;?>"> <?php echo $list->Name.'</label>';	
							}
						?>
					   <input type="submit" id="proceed" class="SendSms1" name="Proceed" value="Proceed">
					</td>
				</tr>
				<?php
			}else{
				echo "";
			}
		}
	}
?>

	