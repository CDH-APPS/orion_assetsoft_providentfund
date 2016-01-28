<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Mail\Mailer;

use Auth;
use View;
use Response;
use DB;

use Queue;
use Mail;


require_once 'is_email.php';

class notificationsController extends Controller
{



    //Contributions Email
    public function sendContributionsEmail($data)
    {
      
        if(is_email($data['Email']))
        {
            if(Mail::queue('Notifications.contributionsMail',['cont_period' => $data['Cont_Period'],'name'=>$data['Name'],'employee_contribution'=>$data['Employee_Cont'],'employer_contribution'=>$data['Employer_Cont']], function($message) use($data)
            {
                $message->to($data['Email'])->subject($data['Subject']);
            }))
            {
                return true;
            }
            else
            { 
                return false; 
            }
        }
    }
    //End Contributions Email



    public function sendNewUserEmail($job, $data)
    {
		File::append('docs/emaillogs.txt','New user account : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
	

    	Mail::send('Notifications.newUserMail',['name'=>$data['Name'],'username'=>$data['Email'],'password'=>$data['Password']], function($message) use($data)
        {
            $message->to($data['Email'])->subject('User Credentials');
		});

        
        $job->delete();
    }

    public function sendUserPasswordResetEmail($job, $data)
    {
		File::append('docs/emaillogs.txt','Password Reset : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
	

    	Mail::send('Notifications.userPasswordResetMail',['name'=>$data['Name'],'username'=>$data['Email'],'password'=>$data['Password']], function($message) use($data)
        {
            $message->to($data['Email'])->subject('Password Reset');
		});

        
        $job->delete();
    }

    public function registerNewUserEmail($data)
    {
        File::append('docs/emaillogs.txt','New user account queue request : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
    	Queue::push("notificationsController@sendNewUserEmail",$data);
		File::append('docs/emaillogs.txt','New user account queue registered : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
    
    }


    public function registerUserPasswordResetEmail($data)
    {
        File::append('docs/emaillogs.txt','Reset password queue request : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
    	Queue::push("notificationsController@sendUserPasswordResetEmail",$data);
    	File::append('docs/emaillogs.txt','Reset password queue registered: '.$data['Name'].' => '.$data['Email'].PHP_EOL);
    
		
    }

    
}





