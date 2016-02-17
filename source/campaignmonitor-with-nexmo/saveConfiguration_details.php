<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//
		$clean_api_key = trim($_POST['nexmo_key']);
		$clean_api_secret = trim($_POST['secret_key']);
		if($clean_api_key !="" && $clean_api_secret !=""){
				
			$response=@file_get_contents('https://rest.nexmo.com/account/numbers/'.$clean_api_key.'/'.$clean_api_secret);//fetching from number
			$msg_from=(array)json_decode($response);
			
			if(isset($msg_from['numbers'][0]->msisdn) && ($msg_from['numbers'][0]->msisdn!="")){
				//
				
				$nexmo_key = $clean_api_key;
				$secret_key = $clean_api_secret;
				$from_number = $msg_from['numbers'][0]->msisdn;
				$campaign_monitor = $_POST['campaign_monitor'];
				$phone_number_field = $_POST['phone_number_field'];
				$doc = new DOMDocument(); 
				$doc->formatOutput = true; 

				$s = $doc->createElement("settings");
				$doc->appendchild($s);

				$r = $doc->createElement("nexmo" ); 
				$doc->appendChild( $r );

				$api = $doc->createElement( "api" ); 
				$api->appendChild( 
				$doc->createTextNode( $nexmo_key) 
				);
				$r->appendChild( $api ); 

				$secretkey = $doc->createElement( "secretkey" ); 
				$secretkey->appendChild( 
				$doc->createTextNode( $secret_key ) 
				);
				$r->appendChild( $secretkey ); 

				$fromnumber = $doc->createElement( "fromnumber" ); 
				$fromnumber->appendChild( 
				$doc->createTextNode( $from_number ) 
				);
				$r->appendChild( $fromnumber ); 

				$s->appendChild($r);

				$b = $doc->createElement("campaignmonitor" ); 
				$doc->appendChild( $b );

				$api = $doc->createElement( "api" ); 
				$api->appendChild( 
					$doc->createTextNode( $campaign_monitor ) 
				);
				$b->appendChild( $api );

				$phonenumberfield = $doc->createElement( "phonenumberfield" ); 
				$phonenumberfield->appendChild( 
					$doc->createTextNode( $phone_number_field ) 
				);
				$b->appendChild( $phonenumberfield );

				$s->appendChild($b);
				$doc->saveXML(); 

				$doc->save("settings.xml");	
				echo "Settings saved successfully";
			}else{
				echo "Please enter valid Nexmo Key and Secret.";
			}
		}else{
			echo "API key and Secret can not be empty.";
		}
		//
		
		
}
  ?>

