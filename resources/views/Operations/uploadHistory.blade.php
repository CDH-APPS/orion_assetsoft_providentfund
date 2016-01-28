@extends('main')

@section('content')



                <div class="">
                    <div class="page-title">
                        

                       
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Listed Uploads <small>Active Status</small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                
                                                
                                                <th>Upload Date</th>
                                                <th>Contribution Period </th>
                                                <th>Total Contributions </th>
                                                <th>No.</th>
                                                <th>Payment Receieved</th>
                                                <th>Status</th>
                                                <th>Contributions</th>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($uploads as $upload)
                                            <tr class="even pointer">
                                                
                                                
                                                <td class=" ">{{ $upload->Upload_Date }}</td>
                                                <td class=" ">{{ $upload->Contribution_Period }}</td>
                                                <td class=" ">{{ number_format($upload->Total_Contributions_Amount,2) }}</td>
                                                <td class=" ">{{ $upload->Total_Contributions }}</td>
                                                <td class=" ">
                                                {{ number_format($upload->Payment_Amount,2) }} 
                                                </td>
                                                <td class=" ">
                                                @if($upload->Payment_Amount == 0)
                                                <a style="width:110px" class="btn btn-default btn-xs" href="{{ URL::route('ViewContributions', array('id' => $upload->Contribution_Period )) }}">
                                                    Payment Pending
                                                </a>
                                                @elseif($upload->Status == '1' && ($upload->Payment_Amount == $upload->Total_Contributions_Amount))
                                                <a style="width:110px" class="btn btn-success btn-xs" href="{{ URL::route('ViewContributions', array('id' => $upload->Contribution_Period )) }}">
                                                    Processed
                                                </a>
                                                @elseif(($upload->Payment_Amount == $upload->Total_Contributions_Amount))
                                                <a style="width:110px" class="btn btn-default btn-xs" href="{{ URL::route('ViewContributions', array('id' => $upload->Contribution_Period )) }}">
                                                    Pending Approval
                                                </a>
                                                @elseif($upload->Payment_Amount < $upload->Total_Contributions_Amount)
                                                <a style="width:110px" class="btn btn-default btn-xs" href="{{ URL::route('ViewContributions', array('id' => $upload->Contribution_Period )) }}">
                                                    Underpayment
                                                </a>
                                                @elseif($upload->Payment_Amount > $upload->Total_Contributions_Amount)
                                                <a style="width:110px" class="btn btn-default btn-xs" href="{{ URL::route('ViewContributions', array('id' => $upload->Contribution_Period )) }}">
                                                    Overpayment
                                                </a>
                                                @else
                                                <a style="width:110px" class="btn btn-default btn-xs" href="{{ URL::route('ViewContributions', array('id' => $upload->Contribution_Period )) }}">
                                                    Payment Pending
                                                </a>
                                                @endif
                                                </td>

                                                <td class=" ">
                                                    <a class="btn btn-primary btn-xs" href="{{ URL::route('ViewContributions', array('id' => $upload->Contribution_Period )) }}">
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