@extends('main')

@section('content')


 <div class="left_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Provident Fund Current Position
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

                        <!-- Fixed Income Investment Forms -->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Fixed Income Investments</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form class="form-horizontal form-label-left">

                                        <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th >Principal</th>
                                                <th>Rate</th>
                                                <th>Int. Accrued</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                        	$total_fi_principal = 0;
                                        	$total_fi_interest = 0;
                                        	$total_fi_bal = 0;
                                            ?>
                                        	@foreach($fixedincome as $fi_investment)
                                            <tr>
                                            	<?php 
	                                        	$total_fi_principal = $total_fi_principal + $fi_investment->Principal;
	                                        	$total_fi_interest = $total_fi_interest + $fi_investment->Interest_Acrued
	                                            ?>
                                                <td>{{ $fi_investment->Type }} </td>
                                                <td class="a-right">{{ number_format($fi_investment->Principal,2) }}</td>
                                                <td>{{ $fi_investment->Rate }}</td>
                                                <td class="a-right">{{ number_format($fi_investment->Interest_Acrued,2) }}</td>
                                                <td>
                                                	<a href="" class="btn btn-primary btn-xs" >
                                                	Statement	
                                                	</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <!-- Fixed Income Summary -->
                                            <tr>
                                            	<td>Totals : </td>
                                                <th >{{ number_format($total_fi_principal,2) }}</th>
                                                <td></td>
                                                <th align="right">{{ number_format($total_fi_interest,2) }}</th>
                                                <th >{{ number_format(($total_fi_principal + $total_fi_interest),2) }}</th>
                                            </tr>
                                        </tbody>
                                    </table>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Fixed Income Investments -->
                        
                        <!-- Equities Investments -->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Equities Investments</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form class="form-horizontal form-label-left">

                                       <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Principal</th>
                                                <th>c. Price</th>
                                                <th>Gain/Loss</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($equities as $equity)
                                            <tr>
                                                <td>{{ $equity->Share_Code}} </td>
                                                <td>{{ number_format($equity->Amount_Paid,2) }}</td>
                                                <td>{{ number_format($equity->Current_Price,2) }}</td>
                                                <th>{{ number_format($equity->Gain_Loss,2) }}</th>
                                                <td>
                                                	<a href="" class="btn btn-primary btn-xs" >
                                                	Statement	
                                                	</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Equities Investments -->


                    </div>




                     <div class="row">

                        <!-- Bank Accounts -->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Bank Accounts</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form class="form-horizontal form-label-left">

                                        <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Account Name</th>
                                                <th>Balance</th>
                                                <th></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($bankaccounts as $bankaccount)
                                            <tr>
                                                <td>{{ $bankaccount->account_name}} </td>
                                                <th>{{ number_format($bankaccount->ini_bal,2) }}</th>
                                                <td>
                                                	<a href="" class="btn btn-primary btn-xs" >
                                                	Statement	
                                                	</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Bank Accounts-->
                        
                        <!-- Summary -->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Summary</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form class="form-horizontal form-label-left">

                                      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Asset</th>
                                                <th>Total Value</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	
                                            <tr>
                                                <td>Fixed Income Investments </td>
                                                <td>{{ number_format(($total_fi_principal + $total_fi_interest),2) }}</td> 
                                                <td>
                                                	<a href="" class="btn btn-primary btn-xs" >
                                                	View Accounts	
                                                	</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Equity Investments </td>
                                                <td>{{ number_format(($total_fi_principal + $total_fi_interest),2) }}</td> 
                                                <td>
                                                	<a href="" class="btn btn-primary btn-xs" >
                                                	View Accounts	
                                                	</a>
                                                </td>
                                            </tr>
                                        
                                        	<tr>
                                                <td>Cash at Bank </td>
                                                <td>{{ number_format(($total_fi_principal + $total_fi_interest),2) }}</td> 
                                                <td>
                                                	<a href="" class="btn btn-primary btn-xs" >
                                                	View Accounts	
                                                	</a>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Summary -->


                    </div>
</div></div>



@stop