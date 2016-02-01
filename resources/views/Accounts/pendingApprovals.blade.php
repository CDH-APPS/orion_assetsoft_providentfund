@extends('main')

@section('content')



                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Pending Approvals
                            <small>
                              
                            </small>
                            </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                   
                                <div class="x_content">
                                    


                                

                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#paymentsrecieved" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Payments Recieved</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#fixedincomeinvestments" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Fixed Deposit Investments</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#equityinvestments" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Equity Investments</a>
                                            </li>
                                             <li role="presentation" class=""><a href="#withdrawals" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Withdrawals</a>
                                            </li>
                                        </ul>
                                        <div id="myTabContent" class="tab-content">

                                            <!-- Received Payments -->
                                            <div role="tabpanel" class="tab-pane fade active in" id="paymentsrecieved" aria-labelledby="home-tab">
                                                <p>
                                                    
                                                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                                                        <thead>
                                                            <tr class="headings">
                                                                
                                                                
                                                                <th>Date Recieved</th>
                                                                <th>Cont. Period </th>
                                                                <th>Amount Recieved</th>
                                                                <th>Recieving Bank Account</th>
                                                                <th></th>
                                                                <th></th>
                                                               
                                                              
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach($payments as $payment)
                                                            <tr class="even pointer">
                                                                
                                                                
                                                                <td class=" ">{{ $payment->date_recieved }}</td>
                                                                <td class=" ">{{ $payment->contribution_period }}</td>
                                                                <td class=" ">{{ number_format($payment->amount_recieved,2) }}</td>
                                                                <td class=" "><a href="#">{{ $payment->account_name }}</a></td>
                                                                <td class=" ">     
                                                                    <a class="btn btn-success btn-xs" onclick="approvepayment('{{ $payment->Id }}')">
                                                                        Approve
                                                                    </a>  
                                                                </td>

                                                                <td class=" ">
                                                                    <a data-toggle="modal" class="btn btn-danger btn-xs" onclick="disapprovepayment('{{ $payment->Id }}')">
                                                                        Disapprove
                                                                    </a>
                                                                </td>
                                                                

                                                                                                                                            
                                                            </tr>
                                                            @endforeach
                                                            
                                                           
                                                        </tbody>

                                                    </table>

                                                </p>
                                            </div>
                                            <!-- End Recieved Payments -->

                                            <div role="tabpanel" class="tab-pane fade" id="fixedincomeinvestments" aria-labelledby="profile-tab">
                                                <p>
                                                    
                                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                                    <thead>
                                                        <tr class="headings">
                                                            
                                                            
                                                            <th>Value Date</th>
                                                            <th>Investment Amount</th>
                                                            <th>Tenor/Duration</th>
                                                            <th>Rate</th>
                                                            <th></th>
                                                            <th></th>
                                                           
                                                          
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($fi_investments as $fi_investment)
                                                        <tr class="even pointer">
                                                            
                                                            
                                                            <td class=" ">{{ $fi_investment->value_date }}</td>
                                                            <td class=" ">{{ number_format($fi_investment->amount,2) }}</td>
                                                            <td class=" ">{{ $fi_investment->tenor }} Days</td>
                                                            <td class=" ">{{ number_format($fi_investment->rate,2) }}%</td>
                                                            <td class=" ">     
                                                                <a data-toggle="modal" class="btn btn-success btn-xs" href="#approvefiinvestment" onclick="get_inv_vals('Fixed Deposit','{{ $fi_investment->Id }}','{{ $fi_investment->value_date }}','{{ number_format($fi_investment->amount,2) }}')">
                                                                    Approve
                                                                </a>  
                                                            </td>

                                                            <td class=" ">
                                                                <a data-toggle="modal" class="btn btn-danger btn-xs" onclick="approvefiinvestment('{{ $fi_investment->Id }}')">
                                                                    Disapprove
                                                                </a>
                                                            </td>
                                                            

                                                                                                                                        
                                                        </tr>
                                                        @endforeach
                                                        
                                                       
                                                    </tbody>

                                                </table>

                                                </p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                                <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>
                


        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        

        <!-- Approve Fixed Income Investmemt-->
         <div id="approvefiinvestment"  class="modal fade" tabindex="-1" data-width="600">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>Approval</h4>
          </div>
                <form class="form-horizontal form-label-left" method="post"  >
       

                <div class="modal-body">
 

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Value Date
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                 <input readonly="" type="text" id="inv_valuedate" name="inv_valuedate" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                            
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Amount
                                            </label>
                                            <div class="col-md-6 col-sm-2 col-xs-12">
                                                  <input readonly="" type="text" id="inv_amount" name="inv_amount" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Paying Bank Account
                                            </label>
                                            <div class="col-md-6 col-sm-2 col-xs-12">
                                                  <select id="paying_bank"  name="paying_bank" class="form-control col-md-2 col-xs-12" required>
                                                            <option value="0">Select Paying Bank Account</option>
                                                            @foreach($bankaccounts as $bankaccount)
                                                             <option value="{{ $bankaccount->id }}">{{ $bankaccount->account_name }}</option>
                                                            @endforeach
                                                       
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Current Balance
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input readonly="" id="bank_balance" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="bank_balance" placeholder="Current Balance" required="required" type="text">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Payment Method
                                            </label>
                                            <div class="col-md-6 col-sm-2 col-xs-12">
                                                 <select id="paymentmethod"  name="paymentmethod" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                            
                                                             <option value="Cash">Cash</option>
                                                             <option value="Cheque">Cheque</option>
                                                             <option value="Transfer">Transfer</option>
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Cheque/Trans No.
                                            </label>
                                            <div class="col-md-6 col-sm-7 col-xs-12">
                                                <input type="text" id="chequeno" name="chequeno" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">Bankers.
                                            </label>
                                                <div class="col-md-6 col-sm-7 col-xs-12">

                                                <select disabled="" id="bankers"  name="bankers" class="form-control col-md-2 col-xs-12" required>
                                                         <option value="0">No bank selected</option>
                                                         @foreach($bankers as $bank)
                                                         <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                         @endforeach          
                                                </select>
                                                </div>
                                        </div>
             </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                <button id="save" type="button" class="btn btn-primary" onclick="approvetrans()">Approve</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="inv_id" name="inv_id" >
                <input type="hidden" id="inv_type" name="inv_type" >
              </div>
          
        </form>
        </div>




<script type="text/javascript">

function get_inv_vals(type,id,valuedate,amount)
{
    $('#inv_id').val(id);
    $('#inv_type').val(type);
    $('#inv_valuedate').val(valuedate);
    $('#inv_amount').val(amount);

}


//Aprove or Disapprove Payment


function approvepayment(paymentid)
{
          if(confirm("Please click OK approve payment."))
          {
        
                $.get('/ApprovePayment',
                {
                        'paymentid': paymentid  
                },
                function(data)
                { 
                  
                  if(data['OK'] == 'OK'){ window.location.href = '/AccountsPendingApprovals'; }
                  else{ alert(data['No Data']); }
                                                
                },'json');
          }

}


function disapprovepayment(paymentid)
{
          if(confirm("Please click OK disapprove payment."))
          {
        
                $.get('/DisapprovePayment',
                {
                        'paymentid': paymentid  
                },
                function(data)
                { 
                  
                  if(data['OK'] == 'OK'){ window.location.href = '/AccountsPendingApprovals'; }
                  else{ alert(data['No Data']); }
                                                
                },'json');
          }

}


//End Approve or Disapprove Payment






//Approve or Disapprove Fixed Income Investment


function approvetrans()
{
    if(confirm("Please click OK to save payment."))
    {    
       
        
                $.get('/ApproveTrans',
                {
                      'transdate': $('#inv_valuedate').val(),
                      'amount': $('#inv_amount').val(),
                      'bankaccountno': $('#paying_bank').val(),
                      'paymentmethod': $('#paymentmethod').val(),
                      'chequeno': $('#chequeno').val(),
                      'bankid': $('#bankers').val(),
                      'transtype': $('#inv_type').val(),
                      'transid': $('#inv_id').val()
                   
                },
                function(data)
                { 
                  
                  if(data['OK'] == 'OK'){ window.location.href = '/AccountsPendingApprovals'; }
                  else{ alert(data['No Data']); }
                                                
                },'json');
          
    }

}

function disapprove(id)
{

}

//End Approve or Disapprove Fixed Income Investment



//Approve or Disapprove Equity Investment

function approveequityinvestment(id,valuedate,amount)
{

    if(confirm("Please click OK to save payment."))
    {     
        
                $.get('/NewPayment',
                {
                      'id':''   
                   
                },
                function(data)
                { 
                  
                  if(data['OK'] == 'OK'){ window.location.href = '/ProcessPayments'; }
                  else{ alert(data['No Data']); }
                                                
                },'json');
                
    }
        
}

function disapproveequityinvestment(id)
{

}

//End Approve or Disapprove Equity Investment



  
   $(document).ready(function () {
  
        $('#paying_bank').change(function(){

                $.get('/GetBankAcctDetails',
                {
                        'bankaccountno': $('#paying_bank').val()
                   
                },
                function(data)
                { 
                  
                    if(data['id'] == $('#paying_bank').val())
                    { 
                        $('#bank_balance').val(data['ini_bal']);
                        $('#bankers').val(data['bank_id']);
                    }
                    else{ alert('Bank details could not be retrieved'); }
                                                
                },'json');
                });
          
            
   });

</script>
       
  

@stop