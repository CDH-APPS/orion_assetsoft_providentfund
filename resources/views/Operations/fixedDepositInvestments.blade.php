@extends('main')

@section('content')



                <div class="">
                   
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                    <h4 class="pull-left">Fixed Deposit Investments</h4>

                                     <div class="clearfix">
                                </div>

                                   
                                   
                                </div>
                                <div class="x_content">

                                     @if(true)
                                         <div class="x_panel">
                                         <div class="pull-left"><h4>Manage Investments</h4></div>   
                                         <div class="btn-group pull-right">
                                            <button class="btn btn-default" type="button" data-toggle="modal" href="#popup">Create New Account</button>
                                            
                                            <button class="btn btn-default" type="button" data-toggle="modal" href="#transaction">Perform Transaction</button>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> B.I Reports <span class="caret"></span> </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Active Investments</a>
                                                    </li>
                                                    <li><a href="#">Journal</a>
                                                    </li>
                                                    <li><a href="#">Maturing Accounts</a>
                                                    </li>
                                                    <li><a href="#">List by Investment Type</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        </div>

                                    @endif

                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">    
                                                
                                                <th>Value Date</th>
                                                <th>Maturity Date </th>
                                                <th>Principal Bal.</th>
                                                <th>Rate</th>
                                                <th>Tenor</th>
                                                <th>Age</th>
                                                <th>Interest Acrued</th>
                                                <th>Outstd. Bal.</th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($accts as $accounts)
                                            <tr class="even pointer">
                                                
                                                <td class=" ">{{ $accounts->Value_Date }}</td>
                                                <td class=" ">{{ $accounts->Maturity_Date }}</td>
                                                <td class=" ">{{ number_format($accounts->Principal_Bal,2) }}</td>
                                                <td class=" ">{{ $accounts->Interest_Rate }}</td>   
                                                <td class=" ">{{ $accounts->Tenor }}</td> 
                                                <td class=" ">{{ $accounts->Age }}</td> 
                                                <td class=" ">{{ number_format($accounts->Interest_Acrued,2) }}</td> 
                                                <td class=" ">{{ number_format($accounts->Outstanding_Bal,2) }}</td>   
                                                <td class=" ">
                                                @if($accounts->Status == 0)
                                                <a style="width:90px" class="btn btn-danger btn-xs" href="">
                                                   Pending
                                                </a>
                                                @elseif($accounts->Status == '1')
                                                <a style="width:90px" class="btn btn-success btn-xs" href="">
                                                    Active
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

 

<!-- New Fixed Deposit Account -->


        <div id="popup"  class="modal fade" tabindex="-1" data-width="500">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>New Fixed Deposit Account</h4>
          </div>
          <form class="form-horizontal form-label-left" method="post"  novalidate action="/NewFixedDepositInvestment" >
       

              <div class="modal-body">


                                    
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Account No. 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="accountno" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="accountno" placeholder="Account No" required="required" type="text">
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="designation">Investment House
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            
                                                <select id="investmenthouse"  name="investmenthouse" class="form-control" required>
                                                       
                                                        @foreach($inv as $houses)
                                                            <option value="{{ $houses->Id }}">{{$houses->Name}}</option>
                                                        @endforeach
                                                        
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="designation">Investment Type 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            
                                                <select id="investmenttype"  name="investmenttype" class="form-control" required>
                                                       
                                                        @foreach($invtypes as $types)
                                                            <option value="{{ $types->Id }}">{{$types->Name}}</option>
                                                        @endforeach
                                                        
                                                </select>
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Value Date
                                            </label>
                                           <div class="col-md-6 xdisplay_inputx has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="valuedate" name="valuedate" placeholder="dd/mm/yyyy" ria-describedby="inputSuccess2Status" data-inputmask="'mask':'99/99/9999'">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                          
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Investment Amount
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="amount" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="amount" placeholder="Amount" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Investment Period
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="tenor" name="tenor" placeholder="Tenor"  value="365" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">Interest Rate
                                            </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" id="rate" name="rate" required="required" value="20" placeholder="Rate" class="form-control col-md-7 col-xs-12">
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" id="basis" name="basis" required="required" class="form-control col-md-7 col-xs-12" value="365">
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Maturity Date
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input readonly="true" type="text" id="maturitydate" name="maturitydate" placeholder="Maturity Date" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                         <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Interest Expected
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input readonly="true" type="text" id="interest" name="interest" placeholder="Interest" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>                                    



             </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
          </form>
        </div>



<!-- End New Fixed Deposit Account -->







<!-- New Transaction -->



        <div id="transaction"  class="modal fade" tabindex="-1" data-width="700">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>Fixed Deposit Transaction</h4>
          </div>
          <form class="form-horizontal form-label-left" method="post"  novalidate action="/NewFixedDepositInvestment" >
       

              <div class="modal-body">


                                    
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Account No. 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select id="transaccountno"  name="transaccountno" class="form-control" required>
                                                       <option value="NA">Select an account</option>
                                                        @foreach($invaccts as $accounts)
                                                            <option value="{{ $accounts->Investment_Id }}">{{$accounts->Investment_Id}}</option>
                                                        @endforeach
                                                        
                                                </select>                   
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="designation">Investment House
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            
                                                <input id="transinvestmenthouse" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="transinvestmenthouse" placeholder="Investment House" readonly="true" type="text">
                                 
                                            </div>
                                        </div>


                                        

                                       <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="designation">Principal & Interest Bal.
                                            </label>
                                             <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" id="transprincipalbal" name="transprincipalbal" readonly="true" required="required" value="20" placeholder="Rate" class="form-control col-md-7 col-xs-12">
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" id="transinterestbal" name="transinterestbal" readonly="true" required="required" class="form-control col-md-7 col-xs-12" value="365">
                                            </div>
                                        </div>


                                        

                                        <hr>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Transaction Date
                                            </label>
                                           <div class="col-md-6 xdisplay_inputx has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="transdate" name="transdate" placeholder="dd/mm/yyyy" value="{{ date('d/m/Y') }}" ria-describedby="inputSuccess2Status" data-inputmask="'mask':'99/99/9999'">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                          
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Transaction Type
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="radio" name="transtype" value="Topup"> &nbsp; Topup &nbsp;
                                                <input type="radio" name="transtype" value="Withdrawal"> &nbsp; Withdrawal &nbsp;
                                                <input type="radio" name="transtype" value="TotalRedemption"> &nbsp; Total Redemption&nbsp;
                                            </div>
                                        </div>


                                         <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Perform Trans. On 
                                            </label>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select id="transon"  name="transon" class="form-control" required>
                                                       
                                                       
                                                            <option value="Principal">Principal Balance</option>
                                                            <option value="Interest">Interest Balance</option>
                                                        
                                                </select>                   
                                                </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Amount
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="transamount" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="transamount" placeholder="Amount" required="required" type="text">
                                            </div>
                                        </div>

                                        

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">Outstanding Balance
                                            </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" id="transprincipalbal" name="transprincipalbal" required="required" value="20" placeholder="Rate" class="form-control col-md-7 col-xs-12">
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" id="transinterestbal" name="transinterestbal" required="required" class="form-control col-md-7 col-xs-12" value="365">
                                            </div>
                                        </div>
                                                                



             </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
          </form>
        </div>





<!-- End new transaction -->
 <script type="text/javascript">


        function getMaturityDate()
        {
                  from = $("#valuedate").val().split("/");
                  var start_date = new Date(from[2], from[1] - 1, from[0]);
                  
                  var days = parseInt($("#tenor").val())-1;
                  var end_date = new Date(start_date);
                  end_date.setDate(start_date.getDate() + days);                            
                  $("#maturitydate").val(end_date.getFullYear() + '-' + ("0" + (end_date.getMonth() + 1)).slice(-2) + '-' + ("0" + end_date.getDate()).slice(-2));
                  
                 
                  var exp_interest = (($("#amount").val()*($("#rate").val()/100))/365) * $("#tenor").val();
                  $("#interest").val(exp_interest);

        }

        $(document).ready(function () {
            
            $('#valuedate').change(function()
            {
                getMaturityDate();
            });

            $('#tenor').change(function()
            {
                getMaturityDate();
            });

            $('#amount').change(function()
            {
                getMaturityDate();
            });

            $('#rate').change(function()
            {
                getMaturityDate();
            });
            
        });
</script>


       
  <script>
        $(document).ready(function () {
            $(":input").inputmask();
        });
  </script>



  <script>
        $(document).ready(function () {
          

            $('#transaccountno').change(function () 
            {
                            if($('#transaccountno').val() == "NA")
                            {
                                   alert("Please select an account.");
                                   $('#transinvestmenthouse').val();
                                   $('#transprincipalbal').val();
                                   $('#transinterestbal').val();
                            }
                            else
                            { 

                                    $.get('/GetFixedIncomeDetails',
                                    {
                                        "ID": $('#transaccountno').val(),
                                        "INIDATE": $('#transdate').val()
                                    },
                                    function(data)
                                    { 
                                       
                                        $('#transinvestmenthouse').val(data[0]['Investment_House']);
                                        $('#transprincipalbal').val(data[0]['Principal']);
                                        $('#transinterestbal').val(data[0]['Interest_Acrued']);

                                    },'json');

                                
                            }
            });

        });
  </script>



@stop