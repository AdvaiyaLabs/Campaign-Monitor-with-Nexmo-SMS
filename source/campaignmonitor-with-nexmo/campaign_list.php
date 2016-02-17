<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$username = $_POST['app_id'];
		$password = '';

		$context = stream_context_create(array(
			'http' => array(
			'header'  => "Authorization: Basic " . base64_encode("$username:$password")
			)
		));
		
		$campaigns_list = @file_get_contents('https://api.createsend.com/api/v3.1/clients/'.$_POST['client_id'].'/'.$_POST['campaign_status'].'.json', false, $context);
		
		$campaigns_list=json_decode($campaigns_list);
		if(!empty($campaigns_list)){
			if(count($campaigns_list)>0){
				?>
				<tr class="dynamic_rows " id="campaign_list_section">
					<td class="auto-style2">
						<label for="dName">
						   Select Campaign
						</label>
					</td>
					<td class="auto-style1">
						<?php 
							foreach($campaigns_list as $campaign){
								?><input type="radio" id="campaign_id" class="campaign_list" name="campaign_id" value="<?php echo $campaign->CampaignID;?>"> <?php echo $campaign->Name.'<br />';
							}
						?>
					</td>
				</tr>
				<?php
			}else{
				echo "";
			}
		}
	}
?>