@extends('main')

@section('content')



                <div class="">
                   
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                    <h4 class="pull-left">Staff Accounts </h4>
                                    


                                    <div class="clearfix">
                                </div>

                                   
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">    
                                                <th>Staff ID</th>
                                                <th>Name of Staff </th>
                                                <th>Total Contributions</th>
                                                <th>Total Withdrawals</th>
                                                <th>Interest Accrued</th>
                                                <th>Outstanding Bal.</th>
                                                <th>Status</th>
                                             
                                          
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($accts as $account)
                                            <tr class="even pointer">
                                                
                                                
                                                <td class=" ">{{ $account->Staff_ID }}</td>
                                                <td class=" ">{{ $account->Other_Names.' '.$account->Surname}}</td>
                                                <td class=" ">{{ number_format($account->Total_Employee_Contribution + $account->Total_Employer_Contribution,2) }}</td>
                                                <td class=" ">{{ number_format($account->Total_Withdrawals,2) }}</td>
                                                <td class=" ">{{ number_format($account->Total_Withdrawals,2) }}</td>
                                                <td class=" ">{{ $account->Status }}</td>   
                                                <td class=" ">
                                                <a class="btn btn-primary btn-xs">
                                                View Details
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

    




       
  

@stop