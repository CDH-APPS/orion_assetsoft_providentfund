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
use App\Contributions;
use App\StaffInfo;
use App\UploadHistory;
use Auth;
use View;
use Response;
use DB;
use App\Http\Controllers\notificationsController;
use App\Http\Controllers\sendSms;
use App\InvestmentHouses;
use App\InvestmentTypes;
use App\FixedDepositInvestments;
use App\Equities;
use App\EquityInvestments;
use App\FixedDepositTransactions;
use Queue;


//require_once("notificationsController.php");


class OperationsController extends Controller
{
    


   



    public function upload()
    {
       return View::make('Operations.uploadContributions')
       ->with('success_message','Please provide the upload file in xls format');
    }

    public function uploadHistory()
    {
        return View::make('Operations.uploadHistory')
        ->with('uploads',UploadHistory::all());

    }

    public function viewContributions($id)
    {

        $results = DB::table('contributions')
                 ->join('staff_info','contributions.staff_id','=','staff_info.staff_id')
                 ->select('contributions.Id','staff_info.Staff_Id','contributions.Contribution_Date','staff_info.Other_Names','staff_info.Surname','contributions.Employee_Contribution','contributions.Employer_Contribution','contributions.Status')
                 ->where('contributions.Contribution_Period',[$id])->get();
      

        return View::make('Operations.contributions')
        ->with('conts',$results)
        ->with('upload',UploadHistory::where('Contribution_Period','=',[$id])->first())
        ->with('cont_period',$id);
    }


    public function returnTotalContribution($id)
    {

        //Sum total contributions for specified period
        $employer_contribution = DB::table('contributions')
                                 ->where('contributions.Contribution_Period',[$id])
                                 ->sum('Employer_Contribution');
      
        
         $employee_contribution = DB::table('contributions')
                                 ->where('contributions.Contribution_Period',[$id])
                                 ->sum('Employee_Contribution');

         echo $employer_contribution + $employee_contribution;     

    }

    private function sendEMailNotifications($id)
    {
        $results = DB::table('contributions')
                 ->join('staff_info','contributions.staff_id','=','staff_info.staff_id')
                 ->select('staff_info.other_names','staff_info.surname','contributions.employee_contribution as employee_cont','contributions.employer_contribution as employer_cont','staff_info.email as email','staff_info.contact_no as contact_no')
                 ->where('contributions.Contribution_Period',[$id])->get();


        $emailnotification = new notificationsController;
        $smsnotification = new sendSms;         

        foreach($results as $cont)
        {



                    $smsMsg = 'Dear '.($cont->other_names.' '.$cont->surname).', an amount of GHS'.(number_format($cont->employee_cont + $cont->employer_cont,2)).' has been recieved as your P.F contribution for the period '.$id.'.Please visit https://providentfund.cdhgroup.co to view your account statement.';
               
                    $data = array('Name' => $cont->other_names.' '.$cont->surname,
                                  'Employee_Cont' => $cont->employee_cont,
                                  'Employer_Cont' => $cont->employer_cont,
                                  'Email' => $cont->email,
                                  'Contact_No' => $cont->contact_no,
                                  'Subject' => 'CDH P.F '.$id.' Contribution',
                                  'Cont_Period' => $id,
                                  'Sms_Msg' => $smsMsg);

                if(!is_null($cont->email))
                {   
                    $emailnotification->sendContributionsEmail($data);                 
                }
                if(!is_null($cont->email))
                {
                    $smsnotification->sendContributionSMS($data);
                }

        }
        return true;
        

    }

    public function approveContributions($id)
    {

        //Sum total contributions for specified period
        $employer_contribution = DB::table('contributions')
                                 ->where('contributions.Contribution_Period',[$id])
                                 ->sum('Employer_Contribution');
      

         $employee_contribution = DB::table('contributions')
                                 ->where('contributions.Contribution_Period',[$id])
                                 ->sum('Employee_Contribution');



        $affectedRows = Contributions::where('Contribution_Period','=', $id)->update(array('Status' => 1));

        if($affectedRows > 0)
        {
            $approved = UploadHistory::where('Contribution_Period','=', $id)->update(array('Status' => 1,'Approved_By' => Auth::user()->get_user_id(),'Total_Contributions_Amount' => ($employer_contribution + $employee_contribution) ));
            if($approved > 0)
            {
                if($this->sendEMailNotifications($id)){ $this->uploadHistory(); }
            }
        }
        
    }

    private function registerStaff($staff_id,$name)
    {
        if(StaffInfo::where('staff_id','=',$staff_id)->count() > 0)
        {
                            return true;
        }
        else
        {

                            $staff = new StaffInfo;
                            
                            
                            $staff->staff_id = $staff_id;
                            $staff->surname = $name;                                                  
                           
                            $staff->created_by = Auth::user()->get_user_id();
                            $staff->updated_by = Auth::user()->get_user_id();
                            $staff->approved_by = Auth::user()->get_user_id();
                            $staff->created_at = date("Y-m-d");
                            $staff->status = 0;

                            if($staff->save()){ return true; }
                            else{ return false; }

                            
        }
    }


    public function doUpload()
    {

             $rules = array(
                        'uploadDate' => 'required',
                        'contMonth' => 'required',
                        'contYear' => 'required'
                        );

             $validation = Validator::make(Input::all(),$rules);

            if($validation->fails())
            {
                return redirect('/UploadContributions')
                ->with('error_message',$validation->errors()->first())
                ->withInput();
            }

            if(is_uploaded_file($_FILES['contributionsUpload']['tmp_name'])) 
            {
                //Import uploaded file to Database
                $handle = fopen($_FILES['contributionsUpload']['tmp_name'], "r");
                $num = 0;
                $uploadDate = Input::get('uploadDate');
                $uploadMonth = Input::get('contMonth');
                $uploadYear = Input::get('contYear');

                //Explode date to array
                $inidate = explode('/', $uploadDate);

                //Check if contribution period exists
               if(DB::table('upload_history')->where('Contribution_Period',[$uploadMonth.' '.$uploadYear])->count() > 0)
               {
                    return View::make('Operations.uploadContributions')
                    ->with('success_message','An upload has already been made for the specified contribution period.');
               } 


               //Insert contributions from uploaded file
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
                {
                    if($num > 0)
                    {
                        if($this->registerStaff($data[0],$data[1]))
                        {
                            $cont = new Contributions;
                            $cont->Contribution_Period = $uploadMonth.' '.$uploadYear;
                            $cont->Staff_ID = $data[0];
                            $cont->Contribution_Date = $inidate[2].'-'.$inidate[0].'-'.$inidate[1];
                            $cont->Employer_Contribution = $data[2];
                            $cont->Employee_Contribution = $data[3];
                            $cont->Created_By = Auth::user()->get_user_id();
                            $cont->save();
                        }
                        else
                        {
                             return View::make('Operations.uploadContributions')
                             ->with('success_message','The upload failed to complete. Some staff details could not be identified. Please try again.');
     
                        }
                    }
                   
                    $num++;                   
                }

                if(DB::table('contributions')->where('Contribution_Period',[$uploadMonth.' '.$uploadYear])->count() > 0)
                {
                    $employer_contribution = DB::table('contributions')
                                     ->where('contributions.Contribution_Period',[$uploadMonth.' '.$uploadYear])
                                     ->sum('Employer_Contribution');
          

                    $employee_contribution = DB::table('contributions')
                                     ->where('contributions.Contribution_Period',[$uploadMonth.' '.$uploadYear])
                                     ->sum('Employee_Contribution');




                    $history = new UploadHistory;
                    $history->Contribution_Period = $uploadMonth.' '.$uploadYear;
                    $history->Upload_Date = $inidate[2].'-'.$inidate[0].'-'.$inidate[1];
                    $history->Total_Contributions_Amount = ($employer_contribution + $employee_contribution); 
                    $history->Total_Contributions = ($num - 1);
                    $history->Status = false;
                    $history->Uploaded_By = Auth::user()->get_user_id();
                    $history->save();



                    fclose($handle);

                   return View::make('Operations.uploadContributions')
                    ->with('success_message',($num - 1).' recordeds uploaded successfully.');

                }
                else
                {
                    return View::make('Operations.uploadContributions')
                    ->with('success_message',($num - 1).'No contributions were found.');  
                }
               

            }   
            else
            {
               return View::make('Operations.contributions')
               ->with('contributions',Contributions::all());
            }
    }

   public function staffAccounts()
   {
         $results = DB::table('staff_info')
                 //->join('withdrawals','staff_info.staff_id','=','withdrawals.staff_id')
                 //->join('contributions','staff_info.staff_id','=','contributions.staff_id')
                 ->selectRaw('staff_info.Staff_ID,staff_info.Other_Names,staff_info.Surname,(select ifnull(sum(Contributions.employee_contribution),0) from contributions where staff_info.staff_id = contributions.staff_id)as Total_Employee_Contribution,(select ifnull(sum(Contributions.employer_contribution),0) from contributions where staff_info.staff_id = contributions.staff_id)as Total_Employer_Contribution,(select ifnull(sum(withdrawals.Amount),0) from withdrawals where staff_info.staff_id = withdrawals.staff_id)as Total_Withdrawals,staff_info.Status')
                 ->get();
      
      //dd($results);

       return View::make('Operations.staffAccounts')
       ->with('accts',$results);
       

   }


   public function editContribution()
   {

            $rules = array(
                            'contributionid' => 'required',
                            'contributionperiod' => 'required',
                            'staffid' => 'required',
                            'employeecontribution' => 'required',
                            'employercontribution' => 'required'
                            );

             $validation = Validator::make(Input::all(),$rules);

            if($validation->fails())
            {
                return redirect('/ViewContributions')
                ->with('error_message',$validation->errors()->first())
                ->withInput();
            }

            $affectedRows = Contributions::where('Id',Input::get('contributionid'))->update(array('Employee_Contribution' => Input::get('employeecontribution'), 'Employer_Contribution' => Input::get('employercontribution'),'Updated_By' => Auth::user()->get_user_id(),'Updated_At' => date('Y-m-d') ));
            
            if($affectedRows > 0)
            {

                 $results = DB::table('contributions')
                 ->join('staff_info','contributions.staff_id','=','staff_info.staff_id')
                 ->select('contributions.Id','staff_info.Staff_Id','contributions.Contribution_Date','staff_info.Other_Names','staff_info.Surname','contributions.Employee_Contribution','contributions.Employer_Contribution','contributions.Status')
                 ->where('contributions.Contribution_Period',[Input::get('contributionperiod')])->get();
      

                $employer_contribution = DB::table('contributions')
                                     ->where('contributions.Contribution_Period',[Input::get('contributionperiod')])
                                     ->sum('Employer_Contribution');
          

                $employee_contribution = DB::table('contributions')
                                     ->where('contributions.Contribution_Period',[Input::get('contributionperiod')])
                                     ->sum('Employee_Contribution');


                $approved = UploadHistory::where('Contribution_Period','=', Input::get('contributionperiod'))->update(array('Updated_By' => Auth::user()->get_user_id(),'Updated_At' => date('Y-m-d'),'Total_Contributions_Amount' => ($employer_contribution + $employee_contribution) ));
  
                return View::make('Operations.contributions')
                ->with('conts',$results)
                ->with('cont_period',Input::get('contributionperiod'));
            }
            else
            {
                //Say something
            }
   }

   public function fixedDepositAccounts()
   {
       $results = DB::table('fixed_deposit_investments')
                 ->selectRaw('fixed_deposit_investments.Investment_Id,
                              fixed_deposit_investments.Value_Date,
                              fixed_deposit_investments.Maturity_Date,
                              fixed_deposit_investments.Principal_Bal,
                              fixed_deposit_investments.Interest_Rate,
                              fixed_deposit_investments.Tenor,
                              (to_days(now()) - to_days(fixed_deposit_investments.Value_Date)) as Age,
                              (((fixed_deposit_investments.Principal_Bal * (fixed_deposit_investments.Interest_Rate / 100))/fixed_deposit_investments.Basis)) * (to_days(now()) - to_days(fixed_deposit_investments.Last_Trans_Date)) as Interest_Acrued,
                              (((fixed_deposit_investments.Principal_Bal * (fixed_deposit_investments.Interest_Rate / 100))/fixed_deposit_investments.Basis)) * (to_days(now()) - to_days(fixed_deposit_investments.Last_Trans_Date)) + (fixed_deposit_investments.Principal_Bal) + (fixed_deposit_investments.Interest_Bal) as Outstanding_Bal')
                 ->get();
      
     

       return View::make('Operations.fixedDepositInvestments')
       ->with('accts',$results)
       ->with('inv',InvestmentHouses::all())
       ->with('invaccts',FixedDepositInvestments::all())
       ->with('invtypes',InvestmentTypes::all());
   }


    public function equityAccounts()
   {
       $results = DB::table('equity_investments')
                 ->selectRaw('equity_investments.Investment_Id,
                              equity_investments.Share_Code,
                              equity_investments.Value_Date,
                              equity_investments.Amount_Paid,
                              equity_investments.Offer_Price,
                              equity_investments.No_Of_Shares,
                              (select equities.Offer_Price from equities where equities.Share_Code = equity_investments.Share_Code) as Current_Price,
                              (equity_investments.No_Of_Shares * (select equities.Offer_Price from equities where equities.Share_Code = equity_investments.Share_Code)) as Current_Balance,
                              (equity_investments.Amount_Paid - (equity_investments.No_Of_Shares * (select equities.Offer_Price from equities where equities.Share_Code = equity_investments.Share_Code))) as Gain_Loss')
                 ->get();
      
     

       return View::make('Operations.equityInvestments')
       ->with('accts',$results)
       ->with('inv',InvestmentHouses::all())
       ->with('stocks',Equities::all());
   }



   public function createFixedDepositAccount()
   {
         $rules = array(
                        'accountno' => 'required',
                        'investmenthouse' => 'required',
                        'investmenttype' => 'required',
                        'valuedate' => 'required',
                        'amount' => 'required',
                        'tenor' => 'required',
                        'rate' => 'required',
                        'basis' => 'required',
                        'maturitydate' => 'required',
                        'interest' => 'required'
                        );

             $validation = Validator::make(Input::all(),$rules);

            if($validation->fails())
            {
                return redirect('/ManagerFixedDepositInvestments')
                ->with('error_message',$validation->errors()->first())
                ->withInput();
            }
            else
            {
                //Explode date to array
                $valuedate = Input::get('valuedate');
                $inidate = explode('/', $valuedate);

                $investment = new FixedDepositInvestments;
                $investment->Investment_Id = Input::get('accountno');
                $investment->Investment_House_Id = Input::get('investmenthouse');
                $investment->Investment_Type_Id = Input::get('investmenttype');
                $investment->Value_Date = $inidate[2].'-'.$inidate[1].'-'.$inidate[0];
                $investment->Last_Trans_Date = $inidate[2].'-'.$inidate[1].'-'.$inidate[0];
                $investment->Investment_Amount = Input::get('amount');
                $investment->Principal_Bal = Input::get('amount');
                $investment->Tenor = Input::get('tenor');
                $investment->Interest_Rate = Input::get('rate');
                $investment->Basis = Input::get('basis');
                $investment->Maturity_Date = Input::get('maturitydate');
                $investment->Interest = Input::get('interest');
                $investment->Status = 0;
                $investment->Created_By = Auth::user()->get_user_id();
                $investment->save();

                //if(DB::table('fixed_deposit_investments')->where('Investment_ID',Input::get('accountno'))->count() > 0)
                {
                    $journal = new FixedDepositTransactions;
                    $journal->Investment_ID = Input::get('accountno');
                    $journal->Trans_Date = $inidate[2].'-'.$inidate[1].'-'.$inidate[0];
                    $journal->Trans_Type = 'Investment';
                    $journal->Amount = Input::get('amount');
                    $journal->Principal_Bal = Input::get('amount');
                    $journal->Interest_Bal = 0;
                    $journal->Age = 0;
                    $journal->Outstanding_Bal = Input::get('amount');
                    $journal->Ref = '';
                    $journal->save();

                }
                return redirect('/ManagerFixedDepositInvestments')
                ->with('success_message','New account created.');
               
                  
            }

   }




   public function createEquityAccount()
   {
         $rules = array(
                        'accountno' => 'required',
                        'investmenthouse' => 'required',
                        'equity' => 'required',
                        'valuedate' => 'required',
                        'amount' => 'required',
                        'offerprice' => 'required',
                        'noofshares' => 'required'
                        );

             $validation = Validator::make(Input::all(),$rules);

            if($validation->fails())
            {
                return redirect('/ManagerEquityInvestments')
                ->with('error_message',$validation->errors()->first())
                ->withInput();
            }
            else
            {
                //Explode date to array
                $valuedate = Input::get('valuedate');
                $inidate = explode('/', $valuedate);

                $investment = new EquityInvestments;
                $investment->Investment_Id = Input::get('accountno');
                $investment->Investment_House_Id = Input::get('investmenthouse');
                $investment->Share_Code = Input::get('equity');
                $investment->Value_Date = $inidate[2].'-'.$inidate[1].'-'.$inidate[0];
                $investment->Amount_Paid = Input::get('amount');
                $investment->Offer_Price = Input::get('offerprice');
                $investment->No_Of_Shares = Input::get('noofshares');
                $investment->Status = 0;
                $investment->Created_By = Auth::user()->get_user_id();
               
                $investment->save();

                return redirect('/ManagerEquityInvestments')
                ->with('success_message','New account created.');
               
                  
            }

   }

    public function getContributionDetails(Request $request)
    {

       $id = Input::get('ID');

       
       $results = DB::table('contributions')
                 ->join('staff_info','contributions.staff_id','=','staff_info.staff_id')
                 ->select('contributions.Id','staff_info.Staff_Id','contributions.Contribution_Period','staff_info.Other_Names','staff_info.Surname','contributions.Employee_Contribution','contributions.Employer_Contribution')
                 ->where('contributions.Id',$id)->get();
                              

       
        // return a JSON response
        return  Response::json($results);
        
    }

    public function getFixedIncomeAccount(Request $request)
    {

        $id = Input::get('ID');

        $date = Input::get('INIDATE');

       
        $results =  DB::table('fixed_deposit_investments')
                     ->selectRaw('fixed_deposit_investments.Investment_ID,
                                  (select investment_houses.Name from investment_houses where investment_houses.Id = fixed_deposit_investments.Investment_House_Id) as Investment_House,
                                  format(fixed_deposit_investments.Principal_Bal,2) as Principal,
                                  format((((fixed_deposit_investments.Principal_Bal * (fixed_deposit_investments.Interest_Rate / 100))/fixed_deposit_investments.Basis)) * (to_days(NOW()) - to_days(fixed_deposit_investments.Last_Trans_Date)) + (fixed_deposit_investments.Interest_Bal),2) as Interest_Acrued
                                ')
                     ->where('fixed_deposit_investments.Investment_ID',$id)
                     ->get();

       $data   = array('value' => $id, 'input' => 'Relax Man');
        // return a JSON response
        return  Response::json($results);
        
    }


    public function currentposition()
    {
        $fixed_income_res =  DB::table('fixed_deposit_investments')
                     ->selectRaw('fixed_deposit_investments.Investment_ID,
                                  concat(fixed_deposit_investments.Tenor," Days") as Type,
                                  concat(Interest_Rate,"%") as Rate,
                                  (select investment_houses.Name from investment_houses where investment_houses.Id = fixed_deposit_investments.Investment_House_Id) as Investment_House,
                                  fixed_deposit_investments.Principal_Bal as Principal,
                                  (((fixed_deposit_investments.Principal_Bal * (fixed_deposit_investments.Interest_Rate / 100))/fixed_deposit_investments.Basis)) * (to_days(NOW()) - to_days(fixed_deposit_investments.Last_Trans_Date)) + (fixed_deposit_investments.Interest_Bal) as Interest_Acrued
                                ')
                     ->where('fixed_deposit_investments.Maturity_Date','>',date('Y-m-d'))
                     ->get();



        $equities_res = DB::table('equity_investments')
                 ->selectRaw('equity_investments.Investment_Id,
                              equity_investments.Share_Code,
                              equity_investments.Value_Date,
                              equity_investments.Amount_Paid,
                              equity_investments.Offer_Price,
                              equity_investments.No_Of_Shares,
                              (select equities.Offer_Price from equities where equities.Share_Code = equity_investments.Share_Code) as Current_Price,
                              (equity_investments.No_Of_Shares * (select equities.Offer_Price from equities where equities.Share_Code = equity_investments.Share_Code)) as Current_Balance,
                              (equity_investments.Amount_Paid - (equity_investments.No_Of_Shares * (select equities.Offer_Price from equities where equities.Share_Code = equity_investments.Share_Code))) as Gain_Loss')
                 ->get();



        $bankaccounts = DB::table('bank_accounts')
        ->join('bankers','bankers.id','=','bank_accounts.bank_id')
        ->select('bank_accounts.id as id','bank_accounts.account_no as account_no','bank_accounts.account_name as account_name','bankers.name as bank_name','bank_accounts.account_type as account_type','bank_accounts.status as status',
        DB::raw('(select ifnull(sum(amount),0) from  bank_transactions where trans_type = 1 and bank_transactions.bank_account_id = bank_accounts.account_no) as deposits'),
        DB::raw('(select ifnull(sum(amount),0) from  bank_transactions where trans_type = 0 and bank_transactions.bank_account_id = bank_accounts.account_no) as withdrawals'),
        DB::raw('(select (deposits - withdrawals)) as ini_bal'))
        ->get();

        return View::make('Operations.currentposition')
        ->with('fixedincome',$fixed_income_res)
        ->with('equities',$equities_res)
        ->with('bankaccounts',$bankaccounts);
       
    }

   
}
