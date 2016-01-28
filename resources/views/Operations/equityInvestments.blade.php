@extends('main')

@section('content')



                <div class="">
                   
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                    <h4 class="pull-left">Equity Investments</h4>
                                    

                                   

                                

                                     <div class="clearfix">
                                </div>

                                   
                                   
                                </div>
                                <div class="x_content">

                                     @if(Auth::user()->user_role_id == 6)
                                         <div class="x_panel">
                                         <div class="pull-left"><h4>Manage Investments</h4></div>   
                                         <div class="btn-group pull-right">
                                            <button class="btn btn-default" type="button" data-toggle="modal" href="#popup">Create New Account</button>
                                            
                                            <button class="btn btn-default" type="button">Perform Transaction</button>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> B.I Reports <span class="caret"></span> </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Active Investments</a>
                                                    </li>
                                                    <li><a href="#">Journal</a>
                                                    </li>
                                                    <li><a href="#">List by Investment Stock</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        </div>

                                    @endif

                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">    
                                                <th>Account No</th>
                                                <th>Value Date</th>
                                                <th>Share Code </th>
                                                <th>Invested Amount</th>
                                                <th>Offer_Price</th>
                                                <th>No of Shares</th>
                                                <th>Current Price</th>
                                                <th>Current Balance</th>
                                                <th>Gain/Loss</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($accts as $accounts)
                                            <tr class="even pointer">
                                                <td class=" ">{{ $accounts->Investment_Id }}</td>
                                                <td class=" ">{{ $accounts->Value_Date }}</td>
                                                <td class=" ">{{ $accounts->Share_Code }}</td>
                                                <td class=" ">{{ number_format($accounts->Amount_Paid,2) }}</td>
                                                <td class=" ">{{ number_format($accounts->Offer_Price,4) }}</td>   
                                                <td class=" ">{{ number_format($accounts->No_Of_Shares,2) }}</td> 
                                                <td class=" ">{{ number_format($accounts->Current_Price,4) }}</td> 
                                                <td class=" ">{{ number_format($accounts->Current_Balance,2) }}</td> 
                                                <td class=" ">{{ number_format($accounts->Gain_Loss,2) }}</td>                                                                                  
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

    

        <div id="popup"  class="modal fade" tabindex="-1" data-width="500">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>New Equity Account</h4>
          </div>
          <form class="form-horizontal form-label-left" method="post"  novalidate action="/NewEquityInvestment" >
       

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
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="designation">Share Code 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            
                                                <select id="equity"  name="equity" class="form-control" required>
                                                       
                                                        @foreach($stocks as $stock)
                                                            <option value="{{ $stock->Share_Code }}">{{$stock->Share_Code}}</option>
                                                        @endforeach
                                                        
                                                </select>
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Value Date
                                            </label>
                                           <div class="col-md-6 xdisplay_inputx has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="valuedate" name="valuedate" ria-describedby="inputSuccess2Status" data-inputmask="'mask':'99/99/9999'">
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
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Offer Price
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="offerprice" name="offerprice" placeholder="Offer Price" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">Number of Shares
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="noofshares" name="noofshares" required="required" placeholder="No of Shares" class="form-control col-md-7 col-xs-12">
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






 <script type="text/javascript">
        $(document).ready(function () {
            
            
        });
    </script>
       
  <script>
        $(document).ready(function () {
            $(":input").inputmask();
        });
    </script>

@stop