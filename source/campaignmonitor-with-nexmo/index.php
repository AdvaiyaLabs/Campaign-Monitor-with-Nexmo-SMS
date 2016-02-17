<?php
require_once 'header.php';


if (file_exists('settings.xml')) {
   $xml = simplexml_load_file('settings.xml');
   if($xml!="")
   {
		$nexmoApi = (string)$xml->nexmo->api;
		$nexmoSecret=(string)$xml->nexmo->secretkey;
		$nexmofromnumber=(string)$xml->nexmo->fromnumber;
		$campaignMonitorApi=(string)$xml->campaignmonitor->api;
		$phone_number_field=(string)$xml->campaignmonitor->phonenumberfield;
   }
}
?>
  <div id="defaults" class="pageWrapper">
		<div class="logoWrapper">
			<img src="nexmo-logo.png" alt="Nexmo" width="200">
			<img id="loader" src="loading.gif" height="33px" width="33px" style="display:none;">
		</div>
		
        <table class="tableStyle">
            <tr>
                <td colspan="2"> 
                    <div class="areaHeader">
                        Configuration Settings
						<a class="blueBtn" href="home.php" style="float:right">Home</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="auto-style2">
                    <label for="dName">
                        Nexmo Key:</label>
                </td>
                <td class="auto-style1">
                    <input id="NKey"  type="text" value=<?php if(isset($nexmoApi) && $nexmoApi!="") echo $nexmoApi;?> >
                </td>
            </tr>
            <tr>
                <td class="auto-style2">
                    <label for="dLine1">
                        Nexmo Secret:</label>
                </td>
                <td class="auto-style1">
                    <input id="NSecret" type="text" value=<?php if(isset($nexmoSecret) && $nexmoSecret!="") echo $nexmoSecret;?> >
                </td>
            </tr>
            <!--<tr>
                <td class="auto-style2">
                    <label for="dLine2">
                        From User:</label>
                </td>
                <td class="auto-style1">
                    <input id="NUser" type="text" value=<?php //if(isset($nexmofromnumber) && $nexmofromnumber!="") echo $nexmofromnumber;?>>
                </td>
            </tr>-->
			
			 <!--<tr>
                <td class="auto-style2">
                    <label for="dLine2">
                        Campaign Monitor API:</label>
                </td>
                <td class="auto-style1">
                    <input id="ApiKey" type="text" value=<?php //if(isset($campaignMonitorApi) && $campaignMonitorApi!="") echo $campaignMonitorApi;?>>
                </td>
            </tr>-->
			
			 <tr>
                <td class="auto-style2">
                    <label for="dLine2">
                        Phone Number field:</label>
                </td>
                <td class="auto-style1">
                    <input id="phone_number_field" type="text" name="phone_number_field" value=<?php if(isset($phone_number_field) && $phone_number_field!="") echo $phone_number_field;?>>
                </td>
            </tr>
			
            <tr>
			<td class="auto-style2">&nbsp;</td>
                <td class="auto-style1">
                    <div>
					<?php if(!empty($campaignMonitorApi) || !empty($nexmofromnumber) || !empty($nexmoSecret) || !empty($nexmoApi) || !empty($phone_number_field )){?>
					    <button id="saveDefaults" class="blueBtn">Update</button>
					<?php } else{?>
					
						<button id="saveDefaults" class="blueBtn">Save</button>
					<?php }?>
                    </div>
                </td>
            </tr>
        </table>
		</form>
    </div>

	
<script>
$("#saveDefaults").click(function(){
	$('#loader').show();
	if($("#NKey").val()=="" || $("#NSecret").val()=="" || $("#phone_number_field").val()=="")
	{
		alert("Please enter all the values");
		$('#loader').hide();
	}
	else{
			$.ajax({
						url: 'saveConfiguration_details.php',
						async: 'false',
						cache: 'false',
						type: 'POST',
						data:{ 
						    nexmo_key:$("#NKey").val(),
							secret_key:$("#NSecret").val(),
							from_number:$("#NUser").val(),
							campaign_monitor:$("#ApiKey").val(),
							phone_number_field:$(phone_number_field).val(),
						},
						success: function(result){
							alert(result);
							//alert("Settings saved successfully");
							$('#loader').hide();
							$("#NKey").val("");
							$("#NSecret").val("");
							$("#NUser").val("");
							$("#ApiKey").val("");
							window.location.href="index.php";
						}
					});
	}
});
	

</script>