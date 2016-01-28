<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use BasicAuth;
use ApiHost;
use MessagingApi;
use Message;
use messageResponse;
use Queue;

require 'Smsgh/Api.php';

class sendSms extends Controller
{




    public function sendContributionSMS($data)
    {
        //Queue::push($this->fire($data));
        $this->fire($data);
    }



    function fire($data)
    {
         
        

        $mobile = $data['Contact_No'];
        $msg = $data['Sms_Msg'];

        $auth = new BasicAuth("ldwwkvev", "rvkqriya");

        $mob = $mobile;
        if(strlen($mobile) == 10)
        { $mob = '+233'.substr($mobile, 1); }

        
    

        // instance of ApiHost
        $apiHost = new ApiHost($auth);
        $enableConsoleLog = FALSE;
        $messagingApi = new MessagingApi($apiHost, $enableConsoleLog);
        try {
           
            // Default Approach
            $mesg = new Message();
            $mesg->setContent($msg);
            $mesg->setTo($mob);
            $mesg->setFrom("CDHAssetMgt");
            $mesg->setRegisteredDelivery(true);

            $messageResponse = $messagingApi->sendMessage($mesg);

            if ($messageResponse instanceof MessageResponse) {
                //echo $messageResponse->getStatus();

            } elseif ($messageResponse instanceof HttpResponse) {
               // echo "\nServer Response Status : " . $messageResponse->getStatus();
            }
        } 
        catch (Exception $ex) 
        {
            //echo 'Error Occured.';
            //echo "Script Error".$ex->getTraceAsString();
        }     

    
    }
}
