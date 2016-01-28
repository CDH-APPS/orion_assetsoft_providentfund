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
use App\Designations;
use App\StaffInfo;
use DateTime;   
use Auth;
use DB;
use View;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {






        return View::make('Staff.newStaff')
        ->with('designations',Designations::all());
    }

    public function editStaff($id)
    {
        $staff = StaffInfo::where('staff_id','=',$id)->first();

        return View::make('Staff.newStaff')
        ->with('staff',$staff)
        ->with('designations',Designations::all());
    }

    public function upload()
    {
        return View::make('Staff.newStaffUpload')
        ->with('designations',Designations::all());
    }


    public function checkExists($staff_id)
    {

    }

    public function doUpload()
    {

       
            if(is_uploaded_file($_FILES['staffuploadfilename']['tmp_name'])) 
            {
                //Import uploaded file to Database
                $handle = fopen($_FILES['staffuploadfilename']['tmp_name'], "r");
                $num = 0;
                $test = '';
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
                {
                    if($num > 0)
                    {
                            $staff = new StaffInfo;
                            
                            
                            $staff->staff_id = $data[0];
                            $staff->surname = $data[1];
                            $staff->other_names = $data[2];
                           
                            $staff->contact_no = $data[3];
                            $staff->designation_id = 1;
                            $staff->postal_address = $data[5];
                            $staff->email = $data[6];                            
                           
                            $staff->created_by = Auth::user()->get_user_id();
                            $staff->updated_by = Auth::user()->get_user_id();
                            $staff->approved_by = Auth::user()->get_user_id();
                            $staff->created_at = date("Y-m-d");
                            $staff->status = 0;
                            $staff->save();
                    }
                   
                    $num++;                   
                }

                fclose($handle);

                dd($num." uploaded!");
                return View::make('Staff.newStaffUpload')
                ->with('success_message',$test." entries found.<br>".$test);
            }   
        
    }

    public function updateStaff()
    {
         $rules = array(
                        'staffid'=> 'required',
                        'surname' => 'required',
                        'othernames' => 'required',
                        'gender' => 'required',
                        'birthdate' => 'required',
                        'mobile' => 'required',
                        'designation' => 'required'
                        );

        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {

             $staff = StaffInfo::where('staff_id','=',Input::get('staffid'))->first();

            return View::make('Staff.newStaff')
            ->with('staff',$staff)
            ->with('designations',Designations::all())
            ->with('form_error_message',$validation->errors()->first());      
        }
        else
        {
            
            $dob = new DateTime(Input::get('birthdate'));

            $affectedRows = StaffInfo::where('staff_id', '=', Input::get('staffid'))
            ->update(array('designation_id' => Input::get('designation'),
                           'surname' =>  Input::get('surname'),
                           'other_names' => Input::get('othernames'),
                           'gender'=> Input::get('gender'),
                           'date_of_birth'=> date_format($dob,'Y-m-d'),
                           'contact_no'=> Input::get('mobile'),
                           'email'=> Input::get('email'),
                           'postal_address'=> Input::get('postaladdress'),
                           'residential_address'=> Input::get('residentialaddress'),
                           'ssn'=> Input::get('ssn'),
                           'nok_name'=> Input::get('nokname'),
                           'nok_contact'=> Input::get('nokcontact'),
                           'nok_address'=> Input::get('nok_address'),
                           'updated_by'=> Auth::user()->get_user_id(),
                           'updated_at'=> date('Y-m-d'),
                           'status'=>1
                            ));

            if($affectedRows > 0)
            {
                    $staff = StaffInfo::where('staff_id','=',Input::get('staffid'))->first();

                    return View::make('Staff.newStaff')
                    ->with('staff',$staff)
                    ->with('designations',Designations::all())
                    ->with('success_message','Update complete.');
            }
            else
            {
                  $staff = StaffInfo::where('staff_id','=',Input::get('staffid'))->first();

                    return View::make('Staff.newStaff')
                    ->with('staff',$staff)
                    ->with('designations',Designations::all())
                    ->with('form_error_message','An error occured while updating staff infomation.');
            }
        }
    }

    public function create()
    {
        $rules = array(
                        'surname' => 'required',
                        'othernames' => 'required',
                        'gender' => 'required',
                        'birthdate' => 'required',
                        'mobile' => 'required',
                        'email' => 'required',
                        'postaladdress' => 'required',
                        'designation' => 'required'
                        );

        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {
            return redirect('/NewStaff')
            ->with('form_error_message',$validation->errors()->first())
            ->withInput();
        }
        else
        {
            
            $staff = new StaffInfo;
            $staff->designation_id = 1; //Input::get('designation');
            $staff->Staff_Id = '1029828';
            $staff->surname = Input::get('surname');
            $staff->other_names = Input::get('othernames');
            $staff->gender = Input::get('gender');
            $staff->date_of_birth = Input::get('birthdate');
            $staff->contact_no = Input::get('mobile');
            $staff->email = Input::get('email');
            $staff->postal_address = Input::get('postaladdress');
            $staff->residential_address = Input::get('residentialaddress');
            $staff->ssn = Input::get('ssn');
            $staff->nok_name = Input::get('nokname');
            $staff->nok_contact = Input::get('nokcontact');
            $staff->nok_address = Input::get('nokcontact');
            $staff->created_by = Auth::user()->get_user_id();
            $staff->updated_by = Auth::user()->get_user_id();
            $staff->approved_by = Auth::user()->get_user_id();
            $staff->created_at = date("Y-m-d");
            $staff->status = 0;
            $staff->save();

            //$user = new User;

            //$user->create_new_user();

           /* \Mail::send('newUserMail',['name'=>'nic','username'=>'Nic'], function($message)
                    {
                        $message->to('niicoark27@gmail.com')->subject('Nicholas Test Massage');
                    }
                );
            */

            return redirect('/ViewStaff')->with('success_message','New Staff Created');
        }
    }

   public function viewStaff()
   {

        $staffinfo = DB::table('staff_info')
        ->join('designations','designations.id','=','staff_info.designation_id')
        ->select('staff_info.*','designations.designation_name as staff_designation')
        ->get();




        return View::make('Staff.viewStaff')
        ->with('staffnum',DB::table('staff_info')->count())
        ->with('staffInfo',$staffinfo);
    }

   
}
