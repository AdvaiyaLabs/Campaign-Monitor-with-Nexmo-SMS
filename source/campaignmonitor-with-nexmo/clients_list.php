<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$username = $_POST['app_id'];
		$password = '';

		$context = stream_context_create(array(
		'http' => array(
		'header'  => "Authorization: Basic " . base64_encode("$username:$password")
		)
		));
		
		$clients_list = @file_get_contents('https://api.createsend.com/api/v3.1/clients.json', false, $context);
		
		$clients_list = json_decode($clients_list);
		if(count($clients_list)>0){
			?>
				<tr class="dynamic_rows" id="cliens_list_section">
					<td class="auto-style2">
						<label for="dName">
						   Select Client
						</label>
					</td>
					<td class="auto-style1">
						<?php 
							foreach($clients_list as $client){
								?><input type="radio" class="client_id" id="client_id" name="client_id" value="<?php echo $client->ClientID;?>"> <?php echo $client->Name.'</ br>';
							}
						?>
					</td>
				</tr>
			<?php
		}else{
			echo "";
		}
	}
?>