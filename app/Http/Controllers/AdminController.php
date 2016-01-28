<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Mail\Mailer;
use Input;
use App\User;
use App\Usertype;
use Auth;
use View;
use DB;
use Hash;
use notificationsController;
use Mail;
use Response;

require("notificationsController.php");


class AdminController extends Controller
{

	public function getIndex()
	{
		return View::make('Admin.index')->with('success_message','Welcome to the Admin Portal.');
	}

	public function viewUsers()
	{
        $users = DB::table('users')
                ->join('user_roles', 'users.user_role_id', '=', 'user_roles.id')
                ->select('users.id as id','users.name as name', 'user_roles.role_name as user_role', 'users.status as status', 'users.last_login_date as last_login_date')
                ->get();

       $numusers = DB::table('users')->count();
                

		return View::make('Admin.viewUsers')
        ->with('users',$users)
        ->with('numusers',$numusers);
        
	}

	public function newUser()
	{ 

        $departments = DB::table('departments')->get();

		return View::make('Admin.newUser')
        ->with('userroles',Usertype::all())
        ->with('departments',$departments);
	}
	
	public function createNewUser()
    {
        $rules = array(
                        'name' => 'required',
                        'usertype' => 'required',
                        'email' => 'required',
                        'number' => 'required'
                        );

        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {
            return redirect('/NewUser')
            ->with('error_message',$validation->errors()->first())
            ->withInput();
        }
        else
        {

            $use_pwd  = md5(date('Ymdhis').Input::get('email'));
            $use_pwd = substr($use_pwd, 0, 10);
            $name = Input::get('name');
            $email = Input::get('email');
            
            $user = new User;
            $user->name = $name;
            $user->username = $email;
            $user->password = bcrypt($use_pwd);
            $user->user_role_id = Input::get('usertype');
            $user->contact_number= Input::get('number');
            $user->first_login_date = 1;
            $user->last_login_date = date("Y-m-d");
            $user->password_reset_date = date("Y-m-d");
            $user->status = 0;

            if($user->save())
            {
                $not = new notificationsController;
                $not->registerNewUserEmail(["Name"=>$name,"Email"=>$email,"Password"=>$use_pwd]);

                return redirect('/NewUser')->with('success_message','New User Created');
            }
            else
            {
                return redirect('/NewUser')->with('error_message','User was not created');

            }

            
            
        }
    }


    public function changePassword()
    {
            $userid = Input::get('User_ID');
            $curpwd = Input::get('Current_Password');
            $newpwd = Input::get('New_Password');

           

            $ini_password = bcrypt($newpwd);


            $ini = DB::table('users')
                        ->where('users.id',[$userid])
                        ->first();

            $ini_check = DB::table('users')
                        ->where('users.id',[$userid])
                        ->where('password',[$curpwd])
                        ->first();
           
                        

            if (Auth::validate(array('username' => $ini->username, 'password' => $curpwd)))
            {

           
                $affectedRows = User::where('id', '=', $userid)  
                                ->update(array('Password' => $ini_password,
                                               'Status' => 1, 
                                               'Updated_By' => 1, 
                                               'Updated_At' => date('Y-m-d')));

                if($affectedRows > 0)
                {
                   
                    $ini = array('OK'=>'OK');
                    return  Response::json($ini);
                }
                else
                {
                    $ini = array('No Data'=>'No Data');
                    return  Response::json($ini);
                }
            }
            else
            {
                    $ini = array('No Data'=>'NON');
                    return  Response::json($ini);
            }
    }


    public function resetUserPassword()
    {
            $userid = Input::get("USER_ID");

            $hash_pwd = md5(date("Ydmshss"));
            $password = substr($hash_pwd,0,10);
            $ini_password = bcrypt($password);


            $ini = DB::table('users')
                        ->where('users.id',[$userid])
                        ->get();

            $name = $ini[0]->name;
            $email = $ini[0]->username;

           
            $affectedRows = User::where('id', '=', $userid)  
                            ->update(array('Password' => $ini_password,
                                           'Status' => 0, 
                                           'Updated_By' => 1, 
                                           'Updated_At' => date('Y-m-d')));


            if($affectedRows > 0)
            {
                $not = new notificationsController;
                $not->registerUserPasswordResetEmail(["Name"=>$name,"Email"=>$email,"Password"=>$password]);

             
                $ini = array('OK'=>'OK','Email'=>$email);
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }



    public function activateuser()
    {
       
         
            $userid = Input::get("USER_ID");


            $affectedRows = User::where('Id', '=', $userid)->update(array('status' => 1, 'updated_by' => 1, 'updated_at' => date('Y-m-d')));

            if($affectedRows > 0)
            {
                
                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }



    public function deactivateuser()
    {
       
         
            $userid = Input::get("USER_ID");

            $affectedRows = User::where('Id', '=', $userid)->update(array('status' => 0, 'updated_by' => 1, 'updated_at' => date('Y-m-d')));

            if($affectedRows > 0)
            {
                
                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }

}