<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$list_id = $_POST['list_id'];
		$username = $_POST['app_id'];
		$password = '';
		
		$context = stream_context_create(array(
			'http' => array(
			'header'  => "Authorization: Basic " . base64_encode("$username:$password")
			)
		));
	
		try	
		{
			
			$custom_fields_lists = @file_get_contents('https://api.createsend.com/api/v3.1/lists/'.$list_id.'/active.json', false, $context);
			
			$customlists = json_decode($custom_fields_lists);
			
			if(count($custom_fields_lists)>0){
				print_r($custom_fields_lists);
			}else{
				
			}
		}
		catch(Exception $ex) 
		{
			echo $ex->getMessage();
		}
	}
	else{
		echo "not post";
	}
?>

	