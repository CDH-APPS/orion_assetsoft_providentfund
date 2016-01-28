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
use BasicAuth;
use ApiHost;
use MessagingApi;
use Message;
use messageResponse;
use App\InvestmentHouses;
use App\InvestmentTypes;
use App\FixedDepositInvestments;
use App\Equities;
use App\EquityInvestments;
use App\FixedDepositTransactions;
use App\Payments;
use App\Banks;
use App\BankAccounts;
use App\BankTransactions;
use App\Journals;



class AccountsController extends Controller
{


    public function recievepayment()
    {
        $payments = Payments::all();
        $paycounter = Payments::count();
        $bankers = Banks::all();
        $bankaccounts = BankAccounts::all();

        return View::make('Accounts.recievePayment')
        ->with('payments',$payments)
        ->with('numpayments',$paycounter)
        ->with('bankaccounts',$bankaccounts)
        ->with('bankers',$bankers);
            
    }


    public function viewjournal($vals)
    {
        $transactions = DB::table('bank_transactions')->where('bank_account_id','=',$vals)->get();
        $transnum = DB::table('bank_transactions')->where('bank_account_id','=',$vals)->count();
        $bankers = Banks::all();

        $bankaccount = DB::table('bank_accounts')
        ->join('bankers','bankers.id','=','bank_accounts.bank_id')
        ->select('bank_accounts.id as id','bank_accounts.account_no as account_no','bank_accounts.account_name as account_name','bankers.name as bank_name','bank_accounts.account_type as account_type','bank_accounts.status as status',
        DB::raw('(select ifnull(sum(amount),0) from  bank_transactions where trans_type = 1 and bank_transactions.bank_account_id = bank_accounts.account_no) as deposits'),
        DB::raw('(select ifnull(sum(amount),0) from  bank_transactions where trans_type = 0 and bank_transactions.bank_account_id = bank_accounts.account_no) as withdrawals'),
        DB::raw('(select (deposits - withdrawals)) as ini_bal'))
        ->where('bank_accounts.account_no','=',$vals)
        ->first();

        return View::make('Accounts.bankTransactions')
        ->with('transactions',$transactions)
        ->with('transnum',$transnum)
        ->with('bankaccount',$bankaccount)
        ->with('bankers',$bankers);

            
    }


    public function getbanktransdata()
    {
    	$rules = array('ID' => 'required');

        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {
           $ini = array('No Data'=>$validation->errors()->first());
		   return  Response::json($ini);          
        }
        else
        {
        	$transaction = DB::table('bank_transactions')
        	->where('id','=',Input::get('ID'))
        	->first();


        	return  Response::json($transaction);
        }
    }


    public function recievepaymentredirect($vals)
    {
        $payments = Payments::all();
        $paycounter = Payments::count();
        $banksers = Banks::all();

        return View::make('Accounts.recievePayment')
        ->with('payments',$payments)
        ->with('numpayments',$paycounter)
        ->with('bankers',$banksers)
        ->with('message',$vals);
            
    }



    public function newpayment()
    {
    	$rules = array(
    					'bankaccountno' => 'required',
                        'paymentdate' => 'required',
                        'contributionperiod' => 'required',
                        'amount' => 'required',
                        'paymentmethod' => 'required'
                        );

        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {
           
            $this->recievepaymentredirect($validation->errors()->first());
            
        }
        else
        {
        	$exists = Payments::where('contribution_period', '=', [Input::get('contributionperiod')])
        					->count();
			             
        	if($exists == 0)
        	{

        		
			            $payment = new Payments;
			           	$payment->date_recieved = Input::get('paymentdate');
			           	$payment->contribution_period = Input::get('contributionperiod');
			           	$payment->amount_recieved = Input::get('amount');
			           	$payment->payment_method = Input::get('paymentmethod');
			           	$payment->cheque_no = Input::get('chequeno');
			           	$payment->bankers_id = Input::get('bankers');
			           	$payment->status = 0;
			           	$payment->created_by = Auth::user()->get_user_id();
			           	$payment->created_at = date('Y-m-d');
			        

			            if($payment->save() && $this->create_bank_transaction(Input::get('bankaccountno'),Input::get('paymentdate'),Input::get('amount'),'Payment recieved for P.F Contribution for the period '.Input::get('contributionperiod'),1,Input::get('paymentmethod'),Input::get('bankers'),Input::get('chequeno'),'N/A'))
			            {
			            	$affectedRows = UploadHistory::where('Contribution_Period', '=', Input::get('contributionperiod'))  
			                                ->update(array('Payment_Amount' => Input::get('amount'),
			                                               'Updated_By' => Auth::user()->get_user_id(), 
			                                               'Updated_At' => date('Y-m-d')));
			    			if($affectedRows > 0)
			    			{
			              		$ini = array('OK'=>'OK');
			                    return  Response::json($ini);
			                }
			                else
			                {
			                	$ini = array('No Data'=>'Amount paid was not updated for the specified period');
			                    return  Response::json($ini);
			                }
			            }
			            else
			            {               
			            		$ini = array('No Data'=>'Payment was not saved.');
			                    return  Response::json($ini);
			            }
			    
			}
			else
			{
				$ini = array('No Data'=>'Payment has already been made for the specified period.');
			                    return  Response::json($ini);
			}

            
        }
	}



	public function create_bank_transaction($acct_no,$date,$amount,$narration,$type,$paymentmethod,$bankid,$chequeno,$recievedby)
	{
		$journal_id = $this->create_journal($date,$amount,$type,$narration);

		if($journal_id > 0)
		{
			$bank_trans = new BankTransactions;
			$bank_trans->bank_account_id = $acct_no;
			$bank_trans->transaction_date = $date;
			$bank_trans->amount = $amount;
			$bank_trans->narration = $narration;
			$bank_trans->trans_type = $type;
			$bank_trans->journal_id = $journal_id;
			$bank_trans->payment_method = $paymentmethod;
			$bank_trans->bankers_id = $bankid;
			$bank_trans->cheque_no = $chequeno;
			$bank_trans->created_by = Auth::user()->get_user_id();
			$bank_trans->created_at = date('Y-m-d');

			if($bank_trans->save()){ return true; }
			else{ return false; }
		}
		else
		{
			return false;
		}

	}


	public function editbanktransaction()
	{
			$rules = array(
                        'transid' => 'required',
                        'journalid' => 'required',
                        'transdate' => 'required',
                        'transamount' => 'required',
                        'transtype' => 'required',
                        'transpaymentmethod' => 'required',
                        'transnarration' => 'required'      
                        );

        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {
           
    
           $ini = array('No Data'=>$validation->errors()->first());
			                    return  Response::json($ini);
            
        }
        else
        {
        	    $transid =  Input::get('transid');  
        	    $journalid = Input::get('journalid');
        	    $transdate = Input::get('transdate');
        	    $transamount = Input::get('transamount');
        	    $transtype = Input::get('transtype');
        	    $transpaymentmethod = Input::get('transpaymentmethod');
        	    $transchequeno = Input::get('transchequeno');
        	    $transbankers = Input::get('transbankers');
        	    $transnarration = Input::get('transnarration');


        	  

        	    $affectedRows = BankTransactions::where('id',$transid)
        	    ->update(array('transaction_date' => $transdate,
			        	    	'amount' => $transamount,
			        	    	'narration' => $transnarration,
			        	    	'trans_type' => $transtype,
			        	    	'payment_method' => $transpaymentmethod,
			        	    	'bankers_id' => $transbankers,
			        	    	'cheque_no' => $transchequeno,
			        	    	'Updated_By' => Auth::user()->get_user_id(),
			        	    	'Updated_At' => date('Y-m-d') ));
            
	            if($affectedRows > 0)
	            {
	            	if($this->edit_journal($journalid,$transdate,$transamount,$transtype,$transnarration))
	            	{
	            		$ini = array('OK'=>'OK');
						return  Response::json($ini);
	            	}
	            	else
	            	{
	            		File::append('docs/errorlogs.txt','Edit Journal Entry : Journal ID : '.$journalid.'   Bank Trans ID : '.$transid.PHP_EOL);
	
	            		$ini = array('No Data'=>'Journal linking to this transaction could not be resolved.');
						return  Response::json($ini);
	            	}

	            }

          
               else
               {
               		$ini = array('No Data'=>'Bank transaction could not be edited.');
					return  Response::json($ini);

               }


        }
	}




	public function bankaccounts()
	{
	    $bankaccounts = DB::table('bank_accounts')
        ->join('bankers','bankers.id','=','bank_accounts.bank_id')
      
        ->select('bank_accounts.id as id','bank_accounts.account_no as account_no','bank_accounts.account_name as account_name','bankers.name as bank_name','bank_accounts.account_type as account_type','bank_accounts.status as status',
        DB::raw('(select ifnull(sum(amount),0) from  bank_transactions where trans_type = 1 and bank_transactions.bank_account_id = bank_accounts.account_no) as deposits'),
        DB::raw('(select ifnull(sum(amount),0) from  bank_transactions where trans_type = 0 and bank_transactions.bank_account_id = bank_accounts.account_no) as withdrawals'),
        DB::raw('(select (deposits - withdrawals)) as ini_bal'))
        ->get();


        $bankcounter = BankAccounts::count();
        $bankers = Banks::all();

        return View::make('Accounts.bankAccounts')
        ->with('banks',$bankaccounts)
        ->with('numbanks',$bankcounter)
        ->with('bankers',$bankers);
	}


	public function redirectbankaccounts($message)
	{
		$bankaccounts = BankAccounts::all();
        $bankcounter = BankAccounts::count();
        $bankers = Banks::all();

        return View::make('Accounts.bankAccounts')
        ->with('banks',$bankaccounts)
        ->with('numbanks',$bankcounter)
        ->with('bankers',$bankers)
        ->with('message',$message);
	}

	public function newbankaccount()
	{

		$rules = array(
                        'accountno' => 'required',
                        'accountname' => 'required',
                        'bankname' => 'required',
                        'accounttype' => 'required',
                        'bankbranch' => 'required',
                        'openningbalance' => 'required',
                        'relationshipmanager' => 'required',
                        'contactno' => 'required'
                        );

        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {
           
    
           $ini = array('No Data'=>$validation->errors()->first());
			                    return  Response::json($ini);
            
        }
        else
        {


			           	$account_no = Input::get('accountno');
			           	$account_name = Input::get('accountname');
			           	$bank_name = Input::get('bankname');
			           	$bank_branch = Input::get('bankbranch');
			           	$account_type = Input::get('accounttype');
			           	$current_balance = Input::get('openningbalance');
			           	$relationship_manager = Input::get('relationshipmanager');
			           	$contact_no = Input::get('contactno');
			           	$date = Input::get('date');
			           	$payment_method = Input::get('paymentmethod');
			           	$cheque_no = Input::get('chequeno');



        	$exists = BankAccounts::where('account_no', '=', [Input::get('accountno')])
        					->count();
			             
        	if($exists == 0)
        	{
			            $bankaccount = new BankAccounts;
			           	$bankaccount->account_no = $account_no;
			           	$bankaccount->account_name = $account_name;
			           	$bankaccount->bank_id = $bank_name;
			           	$bankaccount->bank_branch = $bank_branch;
			           	$bankaccount->account_type = $account_type;
			           	$bankaccount->current_balance = $current_balance;
			           	$bankaccount->relationship_manager = $relationship_manager;
			           	$bankaccount->contact_no = $contact_no;
			           	$bankaccount->status = 0;
			           	$bankaccount->created_by = Auth::user()->get_user_id();
			           	$bankaccount->created_at = date('Y-m-d');
			        
			           	if($this->create_bank_transaction($account_no,$date,$current_balance,'Openning Balance',1,$payment_method,$bank_name,$cheque_no,'N/A'))
			           	{
					            if($bankaccount->save())
					            {
					            	
					              		$ini = array('OK'=>'OK');
					                    return  Response::json($ini);
					               
					            }
					            else
					            {               
					            		$ini = array('No Data'=>'Bank account could not be created.');
					                    return  Response::json($ini);
					            }
			        	}
			        	else
			        	{
			        		$ini = array('No Data'=>'Bank account could not be created.');
					        return  Response::json($ini);
			        	}
			}
			else
			{
				$ini = array('No Data'=>'The specified bank account no has already been created.');
			                    return  Response::json($ini);
			}

            
        }

	}


	public function create_journal($date,$amount,$type,$narration)
	{
		$journal = new Journals;
		
		$journal->Trans_Date = $date;
		$journal->Amount = $amount;
		$journal->Trans_Type = $type;
		$journal->Narration = $narration;
		$journal->Status = 0;
		$journal->Created_By = Auth::user()->get_user_id();
		$journal->created_at = date('Y-m-d');

		if($journal->save()){ return $journal->id; }
		else{ return 0; }
	}


	public function edit_journal($id,$date,$amount,$type,$narration)
	{
	
		
		$affectedRows = Journals::where('id',$id)
		->update(array('Trans_Date' => $date, 
					   'Amount' => $amount,
					   'Trans_Type' => $type,
					   'Narration' => $narration,
					   'Status' => 0,
					   'Updated_By' => Auth::user()->get_user_id(),
					   'Updated_At' => date('Y-m-d') ));
            
            if($affectedRows > 0)
            {
            	return true;
            }
            else
            {
            	return false;
            }

		
	}


 

	public function newbanktransaction()
	{
		$rules = array(
                       'accountno' => 'required',
                        'transdate' => 'required',
                        'transamount' => 'required',
                        'transtype' => 'required',
                        'transpaymentmethod' => 'required',
                        'transnarration' => 'required'      
                        );

        $validation = Validator::make(Input::all(),$rules);

        if($validation->fails())
        {
           
    
           $ini = array('No Data'=>$validation->errors()->first());
			                    return  Response::json($ini);
            
        }
        else
        {
        	    $accountno =  Input::get('accountno');  
        	    $transdate = Input::get('transdate');
        	    $transamount = Input::get('transamount');
        	    $transtype = Input::get('transtype');
        	    $transpaymentmethod = Input::get('transpaymentmethod');
        	    $transchequeno = Input::get('transchequeno');
        	    $transbankers = Input::get('transbankers');
        	    $transnarration = Input::get('transnarration');

               if($this->create_bank_transaction($accountno,$transdate,$transamount,$transnarration,$transtype,$transpaymentmethod,$transbankers,$transchequeno,'N/A'))
               {
               		$ini = array('OK'=>'OK');
					return  Response::json($ini);
               }
               else
               {
               		$ini = array('No Data'=>'Bank transaction could not be created.');
					return  Response::json($ini);

               }


        }
	}








}
