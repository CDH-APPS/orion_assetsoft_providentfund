<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Mail\Mailer;
use Input;
use App\User;
use Auth;




class AuthController extends Controller
{

    /* Validation rule */

    public function login(Request $request)
    {
        $rules = array(
                        'username' => 'required',
                        'password' => 'required'
                        );


        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {
            return redirect()->back()->with('error_message',$validation->errors()->first());
        }
        else
        {

            $email = Input::get("username");
            $password = Input::get("password");

            if (Auth::attempt(['username' => $email, 'password' => $password, 'status' => 1]))
            {
                return redirect('/Home')->with('success_message','Welcome');
            }
            elseif(Auth::attempt(['username' => $email, 'password' => $password, 'status' => 0]))
            {
                return redirect()->back()->with('error_message',"Your acccount is currently inactive, please contact your system admin.");
            }
            else
            {
                return redirect()->back()->with('error_message',"Username or password is incorrect.");
            }
            

           
        }

    }

    public function logout()
    {

         Auth::logout();
         return redirect('/')->with('error_message',"You are currently signed out.");

    }

}
