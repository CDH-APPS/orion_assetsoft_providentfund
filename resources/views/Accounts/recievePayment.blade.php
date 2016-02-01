@extends('main')

@section('content')



                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Payments Recieved
                            <small>
                               {{ $numpayments }} payments recieved
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
                                    <div class="x_title">

                                    <?php if(true){ ?>
                                    <div class="x_panel">
                                        
                                        <a class="btn btn-primary btn-xs" data-toggle="modal" href="#addpayment">Recieve New Payment</a>   

                                    </div>
                                    <?php } ?>


                                    <div class="clearfix"></div>
                                    </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                
                                                
                                                <th>Date Recieved</th>
                                                <th>Contribution Period </th>
                                                <th>Amount Recieved</th>
                                                <th>Recieving Bank Account</th>
                                                <th>Status</th>
                                            
                                               
                                              
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($payments as $payment)
                                            <tr class="even pointer">
                                                
                                                
                                                <td class=" ">{{ $payment->date_recieved }}</td>
                                                <td class=" ">{{ $payment->contribution_period }}</td>
                                                <td class=" ">{{ number_format($payment->amount_recieved,2) }}</td>
                                                <td class=" ">{{ $payment->account_name }}</td>
                                                <td class=" ">
                                                @if($payment->status == '1')
                                                <a class="btn btn-success btn-xs" href="">
                                                    Processed
                                                </a>
                                                @elseif($payment->status == '0')
                                                <a class="btn btn-danger btn-xs" href="">
                                                    Pending
                                                </a>
                                                @elseif($payment->status == '3')
                                                <a class="btn btn-danger btn-xs" href="">
                                                    Disapproved
                                                </a>
                                                @endif
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

        

        <!-- Add Payment Form-->
         <div id="addpayment"  class="modal fade" tabindex="-1" data-width="600">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>New Payment</h4>
          </div>
                <form class="form-horizontal form-label-left" method="post"  >
       

              <div class="modal-body">
 

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Date Recieved
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
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Cont. Period
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                  <select id="contmonth"  name="contmonth" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="JAN">JAN</option>
                                                             <option value="FEB">FEB</option>
                                                             <option value="MAR">MAR</option>
                                                             <option value="APR">APR</option>
                                                             <option value="MAY">MAY</option>
                                                             <option value="JUN">JUN</option>
                                                             <option value="JUL">JUL</option>
                                                             <option value="AUG">AUG</option>
                                                             <option value="SEP">SEP</option>
                                                             <option value="OCT">OCT</option>
                                                             <option value="NOV">NOV</option>
                                                             <option value="DEC">DEC</option>
                                                       
                                                </select>
                                            </div>

                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                 <select id="contyear"  name="contyear" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                            
                                                            <?php
                                                                for($i = (date('Y') - 1); $i < (date('Y') + 2); $i++)
                                                                {
                                                                   echo  "<option value=".$i.">".$i."</option>";
                                                                }
                                                             ?>
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Recieving Bank Account
                                            </label>
                                            <div class="col-md-6 col-sm-2 col-xs-12">
                                                 <select id="bankaccountno"  name="bankaccountno" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                            @foreach($bankaccounts as $bankaccount)
                                                             <option value="{{ $bankaccount->account_no }}">{{ $bankaccount->account_name }}</option>
                                                            @endforeach
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Amount Paid
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input id="amount" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="amount" placeholder="Amount Paid" required="required" type="text">
                                            </div>
                                        </div>

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
                                                <select id="bankers"  name="bankers" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                        @foreach($bankers as $bank)
                                                        <option value="{{ $bank->id }}">{{$bank->name}}</option>
                                                        @endforeach
                                                </select>
                                                </div>
                                        </div>
             </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                <button id="save" type="button" class="btn btn-primary">Save Payment</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
          
        </form>
        </div>




<script type="text/javascript">
  
   $(document).ready(function () {
  
        $('#save').click(function(){

          if(confirm("Please click OK to save payment."))
          {
        
                $.get('/NewPayment',
                {
                        'bankaccountno': $('#bankaccountno').val(),
                        'paymentdate': $('#year').val()+'-'+$('#month').val()+'-'+$('#day').val(),
                        'contributionperiod': $('#contmonth').val()+' '+$('#contyear').val(),
                        'amount': $('#amount').val(),
                        'paymentmethod': $('#paymentmethod').val(),
                        'chequeno': $('#chequeno').val(),
                        'bankers': $('#bankers').val()
                   
                },
                function(data)
                { 
                  
                  if(data['OK'] == 'OK'){ window.location.href = '/ProcessPayments'; }
                  else{ alert(data['No Data']); }
                                                
                },'json');
                }

        });
            
   });

</script>
       
  

@stop