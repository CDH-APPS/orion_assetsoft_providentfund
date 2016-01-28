<?php



public function sendPFSMSNotification($recipent)
{




	$contact = urlencode($recipent);
	    

	$message ='Dear_*Client*,_this_SMS_is_to_inform_you_we_have_recieved_an_amount_of_*amount*_for_your_monthly_P.F_contribution_for_the_period_*Period*';


	$url = "https://api.smsgh.com/v3/messages/send?"
	    . "From=CDHAssetMgt"
	    . "&To=".$contact
	    . "&Content=".$message
	    . "&ClientId=czbcfudg"
	    . "&ClientSecret=bakmqoxh"
	    . "&RegisteredDelivery=true";s


	 // Fire the request and wait for the response
	 $response = file_get_contents($url) ;
	 return var_dump($response);

}