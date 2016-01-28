@extends('main')

@section('content')



                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Bank Accounts
                            <small>
                               {{ $numbanks }} records found.
                            </small>
                            </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                    <div class="x_title">

                                    <?php if(true){ ?>
                                    <div class="x_panel">
                                        
                                        <a class="btn btn-primary btn-xs" data-toggle="modal" href="#addbankaccount">Create New Bank Account</a>   
                             

                                    </div>
                                    <?php } ?>


                                    <div class="clearfix"></div>
                                    </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                                             
                                                <th>Account No</th>
                                                <th>Name of Bank</th>
                                                <th>Account Type</th>
                                                <th>Current Balance</th>
                                                <th></th>
                                                <th></th>
                  
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($banks as $bank)
                                            <tr class="even pointer">
                                                
                                                
                                                <td class=" ">{{ $bank->account_no }}</td>
                                                <td class=" ">{{ $bank->account_name }}</td>
                                                <td class=" ">{{ $bank->account_type }}</td>
                                                <td class=" ">{{ number_format($bank->ini_bal,2) }}</td>
                                                <td class=" ">
                                               
                                                <a onclick="setTransAcctNo('{{ $bank->account_no }}','{{ $bank->bank_name }}','{{ $bank->account_name }}')" data-toggle="modal" class="btn btn-primary  btn-xs" href="#performtransaction">
                                                    Perform Transaction
                                                </a>
                                              
                                                </td>

                                                <td class=" ">
                                                  <a data-toggle="modal" class="btn btn-success  btn-xs" href="/ViewJournal/{{ $bank->account_no }}">
                                                    View Journal
                                                  </a>
                                                </td>
                                               

                                                                                                                            
                                            </tr>
                                            @endforeach
                                            
                                           
                                        </tbody>

                                    </table>
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

        

        <!-- Add New Bank Account Form-->
         <div id="addbankaccount"  class="modal fade" tabindex="-1" data-width="600">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>New Bank Account</h4>
          </div>
                <form class="form-horizontal form-label-left" method="post"  >
       

              <div class="modal-body">
 

                                       

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Bank Account No.
                                            </label>
                                            <div class="col-md-7 col-sm-4 col-xs-12">
                                                <input id="accountno" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="accountno" placeholder="Bank Account Number" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Account Name
                                            </label>
                                            <div class="col-md-7 col-sm-4 col-xs-12">
                                                <input id="accountname" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="accountname" placeholder="Account Name" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Name of Bank
                                            </label>
                                            <div class="col-md-7 col-sm-2 col-xs-12">
                                                 <select id="bankname"  name="bankname" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                        @foreach($bankers as $bank)
                                                        <option value="{{ $bank->id }}">{{$bank->name}}</option>
                                                        @endforeach
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Account Type
                                            </label>
                                            <div class="col-md-7 col-sm-2 col-xs-12">
                                                 <select id="accounttype"  name="accounttype" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                            
                                                             <option value="Savings">Savings</option>
                                                             <option value="Current">Current</option>
                                                             <option value="Other">Other</option>
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>


                                       

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Bank Branch
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="bankbranch" name="bankbranch" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>


                                        <hr>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Transaction Date
                                            </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                  <select id="day"  name="day" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <?php
                                                                for($i = 1; $i < 32; $i++)
                                                                {
                                                                   echo  "<option value=".$i.">".$i."</option>";
                                                                }
                                                             ?>
                                                       
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                  <select id="month"  name="month" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="01">JAN</option>
                                                             <option value="02">FEB</option>
                                                             <option value="03">MAR</option>
                                                             <option value="04">APR</option>
                                                             <option value="05">MAY</option>
                                                             <option value="06">JUN</option>
                                                             <option value="07">JUL</option>
                                                             <option value="08">AUG</option>
                                                             <option value="09">SEP</option>
                                                             <option value="10">OCT</option>
                                                             <option value="11">NOV</option>
                                                             <option value="12">DEC</option>
                                                       
                                                </select>
                                            </div>

                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                 <select id="year"  name="year" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                            <?php
                                                                for($i = (date('Y') - 1); $i < (date('Y') + 2); $i++)
                                                                {
                                                                   echo  "<option value=".$i.">".$i."</option>";
                                                                }
                                                             ?>
                                                             
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>



                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Openning Balance
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="openningbalance" name="openningbalance" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                         <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Payment Method
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                  <select id="paymentmethod"  name="paymentmethod" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="Cash">Cash</option>
                                                             <option value="Cheque">Cheque</option>
                                                             <option value="Transfer">Transfer</option>
                                                             
                                                       
                                                 </select>
                                            </div>

                                            <div class="col-md-4 col-sm-7 col-xs-12">
                                                <input type="text" id="chequeno" name="chequeno" required="required" placeholder="Cheque/Transfer No." class="form-control col-md-7 col-xs-12">
                                            </div>

                                        </div>


                                        <hr>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Relationship Manager
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="relationshipmanager" name="relationshipmanager" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                         <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Contact No
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="contactno" name="contactno" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        
             </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                <button id="save" type="button" class="btn btn-primary">Create Account</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
          
        </form>
        </div>

<!-- End new bank transaction -->




<!-- Add Transaction -->

         <div id="performtransaction"  class="modal fade" tabindex="-1" data-width="600">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>New Transaction</h4>
          </div>
                <form class="form-horizontal form-label-left" method="post"  >
       

              <div class="modal-body">
                                       
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Account No.
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="transacctno" name="transacctno" readonly="" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Account Name.
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="transaccountname" name="transaccountname" readonly="" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Bankers 
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="transbankers" name="transbankers" readonly="" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Transaction Date
                                            </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                  <select id="transday"  name="transday" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <?php
                                                                for($i = 1; $i < 32; $i++)
                                                                {
                                                                   echo  "<option value=".$i.">".$i."</option>";
                                                                }
                                                             ?>
                                                       
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                  <select id="transmonth"  name="transmonth" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="01">JAN</option>
                                                             <option value="02">FEB</option>
                                                             <option value="03">MAR</option>
                                                             <option value="04">APR</option>
                                                             <option value="05">MAY</option>
                                                             <option value="06">JUN</option>
                                                             <option value="07">JUL</option>
                                                             <option value="08">AUG</option>
                                                             <option value="09">SEP</option>
                                                             <option value="10">OCT</option>
                                                             <option value="11">NOV</option>
                                                             <option value="12">DEC</option>
                                                       
                                                </select>
                                            </div>

                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                 <select id="transyear"  name="transyear" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                            <?php
                                                                for($i = (date('Y') - 1); $i < (date('Y') + 2); $i++)
                                                                {
                                                                   echo  "<option value=".$i.">".$i."</option>";
                                                                }
                                                             ?>
                                                             
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>



                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Amount
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="transamount" name="transamount" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Transaction Type
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                  <select id="transtype"  name="transtype" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="1">Deposit</option>
                                                             <option value="0">Withdrawal</option>              
                                                       
                                                 </select>
                                            </div>

                                            
                                        </div>




                                         <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Payment Method
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                  <select id="transpaymentmethod"  name="transpaymentmethod" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="Cash">Cash</option>
                                                             <option value="Cheque">Cheque</option>
                                                             <option value="Transfer">Transfer</option>
                                                             
                                                       
                                                 </select>
                                            </div>

                                            <div class="col-md-4 col-sm-7 col-xs-12">
                                                <input type="text" id="transchequeno" name="transchequeno" required="required" placeholder="Cheque/Transfer No." class="form-control col-md-7 col-xs-12">
                                            </div>

                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" >Paying Bank
                                            </label>
                                            <div class="col-md-7 col-sm-2 col-xs-12">
                                                 <select id="transbankname"  name="transbankname" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                        <option value="N/A">Select bankers for cheque/transfer deposits</option>
                                                        @foreach($bankers as $bank)
                                                        <option value="{{ $bank->id }}">{{$bank->name}}</option>
                                                        @endforeach
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>


                                        

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Narration
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea rows='3' id="transnarration" name="transnarration" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>
                                        </div>

                                        

                                        
              </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                <button id="savetransaction" type="button" class="btn btn-primary">Save Transaction</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
          
        </form>
        </div>

<!-- Create new transaction-->






<script type="text/javascript">
  
   $(document).ready(function () {
  
        $('#save').click(function(){

          if($('#chequeno').val() == ''){$('#chequeno').val('N/A')}
          if(confirm("Please click OK to create bank account."))
          {
        
                $.get('/NewBankAccount',
                {
                 
                        'accountno': $('#accountno').val(),
                        'accountname': $('#accountname').val(),
                        'bankname': $('#bankname').val(),
                        'accounttype': $('#accounttype').val(),
                        'bankbranch': $('#bankbranch').val(),
                        'openningbalance': $('#openningbalance').val(),
                        'relationshipmanager': $('#relationshipmanager').val(),
                        'contactno': $('#contactno').val(),
                        'date': $('#year').val()+'-'+$('#month').val()+'-'+$('#day').val(),
                        'paymentmethod': $('#paymentmethod').val(),
                        'chequeno': $('#chequeno').val()
                       
                   
                },
                function(data)
                { 
                  
                  if(data['OK'] == 'OK'){ window.location.href = '/BankAccounts'; }
                  else{ alert(data['No Data']); }
                                                
                },'json');
            }

        });



        $('#savetransaction').click(function(){

          if($('#transchequeno').val() == ''){$('#transchequeno').val('N/A')}
          if(confirm("Please click OK save this transaction."))
          {
        
                $.get('/NewBankTransaction',
                {
                 
                        'accountno': $('#transacctno').val(),
                        'transdate': $('#transyear').val()+'-'+$('#transmonth').val()+'-'+$('#transday').val(),
                        'transamount': $('#transamount').val(),
                        'transtype': $('#transtype').val(),
                        'transpaymentmethod': $('#transpaymentmethod').val(),
                        'transchequeno': $('#transchequeno').val(),
                        'transbankers': $('#transbankname').val(),
                        'transnarration': $('#transnarration').val()                      
                   
                },
                function(data)
                { 
                  
                  if(data['OK'] == 'OK'){ window.location.href = '/BankAccounts'; }
                  else{ alert(data['No Data']); }
                                                
                },'json');
            }

        });


            
   });




function setTransAcctNo(acctno,bankers,accountname)
{
    $('#transacctno').val(acctno);
    $('#transbankers').val(bankers);
    $('#transaccountname').val(accountname);
}

</script>



  

@stop