<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/* Admin Routes  */

	Route::get('/Admin', array(
	'uses' => '\App\Http\Controllers\AdminController@getIndex',
	'as' => 'AdminIndex',
	));


	Route::get('/ViewUsers', array(
	'uses' => '\App\Http\Controllers\AdminController@viewUsers',
	'as' => 'ViewUsers',
	));

	Route::get('/NewUser', array(
	'uses' => '\App\Http\Controllers\AdminController@newUser',
	'as' => 'NewUser',
	));

	Route::post('/NewUser',array('as'=>'NewUser',
	'before'=>'csrf',
	'uses'=>'\App\Http\Controllers\AdminController@createNewUser'));


	Route::get('/ActivateUser', array(
		'uses' => '\App\Http\Controllers\AdminController@activateuser',
		'as' => 'ActivateUser',
		));

	Route::get('/DeactivateUser', array(
		'uses' => '\App\Http\Controllers\AdminController@deactivateuser',
		'as' => 'DeactivateUser',
		));

	Route::get('/EditUser', array(
		'uses' => '\App\Http\Controllers\AdminController@edituser',
		'as' => 'EditUser',
		));

	Route::get('/ResetUserPwd', array(
		'uses' => '\App\Http\Controllers\AdminController@resetUserPassword',
		'as' => 'ResetUserPwd',
		));

	Route::get('/ChangePwd', array(
		'uses' => '\App\Http\Controllers\AdminController@changePassword',
		'as' => 'ChangePwd',
		));


/* End Admin Routes */

	Route::get('/',function() { return View::make('login'); });

	Route::get('/Logout',array('as'=>'logout','uses'=>'AuthController@logout'));

	Route::get('/Home',function() { if(Auth::check()){ return View::make('main'); }else{ return View::make('login'); } });

	Route::post('/',array('as'=>'login','before'=>'csrf','uses'=>'AuthController@login'));


/* Staff Routes */

	Route::get('/NewStaff', array(
	'uses' => '\App\Http\Controllers\StaffController@getIndex',
	'as' => 'NewStaff',
	));

	Route::post('/NewStaff',array('as'=>'NewStaff',
	'before'=>'csrf',
	'uses'=>'\App\Http\Controllers\StaffController@updateStaff'));

	Route::post('/UploadStaff',array('as'=>'UploadStaff',
	'before'=>'csrf',
	'uses'=>'\App\Http\Controllers\StaffController@doUpload'));


	Route::get('/ViewStaff', array(
	'uses' => '\App\Http\Controllers\StaffController@viewStaff',
	'as' => 'ViewStaff',
	));

	Route::get('/UploadStaff', array(
	'uses' => '\App\Http\Controllers\StaffController@upload',
	'as' => 'UploadStaff',
	));

	Route::get('/EditStaff/{id}', array(
	'uses' => '\App\Http\Controllers\StaffController@editstaff',
	'as' => 'EditStaff',
	));

/* End Staff Routes */



/* Operations Route */

	Route::get('/UploadContributions', array(
	'uses' => '\App\Http\Controllers\OperationsController@upload',
	'as' => 'UploadContributions',
	));

	Route::post('/UploadContributions',array('as'=>'UploadContributions',
	'before'=>'csrf',
	'uses'=>'\App\Http\Controllers\OperationsController@doUpload'));

	Route::get('/UploadHistory', array(
	'uses' => '\App\Http\Controllers\OperationsController@uploadHistory',
	'as' => 'UploadHistory',
	));

	Route::get('/StaffAccounts', array(
	'uses' => '\App\Http\Controllers\OperationsController@staffAccounts',
	'as' => 'StaffAccounts',
	));


	Route::get('/ViewContributions/{id}', array(
	'uses' => '\App\Http\Controllers\OperationsController@viewContributions',
	'as' => 'ViewContributions',
	));

	Route::get('/ApproveContributions/{id}', array(
	'uses' => '\App\Http\Controllers\OperationsController@approveContributions',
	'as' => 'ApproveContributions',
	));

	Route::post('//UpdateContribution', array(
	'uses' => '\App\Http\Controllers\OperationsController@editContribution',
	'as' => 'EditContributions',
	));


 /* End Operations Route */


/* Fund Manager Routes */


	Route::get('/ManagerViewContributions/{id}', array(
	'uses' => '\App\Http\Controllers\OperationsController@viewContributions',
	'as' => 'ManagerViewContributions',
	));

	Route::get('/ApproveContributions/{id}', array(
	'uses' => '\App\Http\Controllers\OperationsController@approveContributions',
	'as' => 'ApproveContributions',
	));

	Route::get('/ManagerViewStaff', array(
	'uses' => '\App\Http\Controllers\StaffController@viewStaff',
	'as' => 'ManagerViewStaff',
	));

	Route::get('/ManagerStaffAccounts', array(
	'uses' => '\App\Http\Controllers\OperationsController@staffAccounts',
	'as' => 'ManagerStaffAccounts',
	));

	Route::get('/ManagerUploadHistory', array(
	'uses' => '\App\Http\Controllers\OperationsController@uploadHistory',
	'as' => 'ManagerUploadHistory',
	));

	Route::get('/ManagerFixedDepositInvestments', array(
	'uses' => '\App\Http\Controllers\OperationsController@fixedDepositAccounts',
	'as' => 'ManagerFixedDepositInvestments',
	));


	Route::post('/NewFixedDepositInvestment',array('as'=>'NewFixedDepositInvestment',
	'before'=>'csrf',
	'uses'=>'\App\Http\Controllers\OperationsController@createFixedDepositAccount'));


	Route::get('/ManagerEquityInvestments', array(
	'uses' => '\App\Http\Controllers\OperationsController@equityAccounts',
	'as' => 'ManagerEquityInvestments',
	));


	Route::post('/NewEquityInvestment',array('as'=>'NewEquityInvestment',
	'before'=>'csrf',
	'uses'=>'\App\Http\Controllers\OperationsController@createEquityAccount'));

	Route::get('/ManagerCurrentPosition', array(
	'uses' => '\App\Http\Controllers\OperationsController@currentposition',
	'as' => 'ManagerCurrentPosition',
	));


/* End Fund Manager Routes */



/* Accounts Routes */

	Route::get('/ProcessPayments', array(
	'uses' => '\App\Http\Controllers\AccountsController@recievepayment',
	'as' => 'ProcessPayments',
	));

	Route::get('/NewPayment', array(
	'uses' => '\App\Http\Controllers\AccountsController@newpayment',
	'as' => 'NewPayment',
	));

	Route::get('/ApprovePayment', array(
	'uses' => '\App\Http\Controllers\AccountsController@approvepayment',
	'as' => 'ApprovePayment',
	));

	Route::get('/DisapprovePayment', array(
	'uses' => '\App\Http\Controllers\AccountsController@disapprovepayment',
	'as' => 'DisapprovePayment',
	));

	Route::get('/BankAccounts', array(
	'uses' => '\App\Http\Controllers\AccountsController@bankaccounts',
	'as' => 'BankAccounts',
	));

	Route::get('/NewBankAccount', array(
	'uses' => '\App\Http\Controllers\AccountsController@newbankaccount',
	'as' => 'NewBankAccount',
	));

	Route::get('/NewBankTransaction', array(
	'uses' => '\App\Http\Controllers\AccountsController@newbanktransaction',
	'as' => 'NewBankTransaction',
	));

	Route::get('/ViewJournal/{id}', array(
	'uses' => '\App\Http\Controllers\AccountsController@viewjournal',
	'as' => 'ViewJournal',
	));

	Route::get('/GetBankTransData', array(
	'uses' => '\App\Http\Controllers\AccountsController@getbanktransdata',
	'as' => 'GetBankTransData',
	));

	Route::get('/EidtBankTransaction', array(
	'uses' => '\App\Http\Controllers\AccountsController@editbanktransaction',
	'as' => 'EidtBankTransaction',
	));

	Route::get('/AccountsPendingApprovals', array(
	'uses' => '\App\Http\Controllers\AccountsController@pendingapprovals',
	'as' => 'AccountsPendingApprovals',
	));


	Route::get('/GetBankAcctDetails', array(
	'uses' => '\App\Http\Controllers\AccountsController@getbankacctdetails',
	'as' => 'GetBankAcctDetails',
	));

	Route::get('/ApproveTrans', array(
	'uses' => '\App\Http\Controllers\AccountsController@approvetrans',
	'as' => 'ApproveTrans',
	));
	

/* End Accounts Routess */



 /* Ajax Funtions For Operations */

 	/* Get Contribution Details */ 
	Route::get('/GetContributionDetails', '\App\Http\Controllers\OperationsController@getContributionDetails');

 	/* Get Fixed Income Values */
	Route::get('/GetFixedIncomeDetails', '\App\Http\Controllers\OperationsController@getFixedIncomeAccount');

 /* End Ajax Functions */


