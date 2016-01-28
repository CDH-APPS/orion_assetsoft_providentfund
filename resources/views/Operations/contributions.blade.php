@extends('main')

@section('content')



                <div class="">
                   
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                    <h4 class="pull-left">Contribution period : {{ $cont_period }}</h4>

                                    @if(Auth::user()->user_role_id == 5)
                                         @if(($upload->Payment_Amount == $upload->Total_Contributions_Amount))
                                            <a class="btn btn-info btn-xs pull-right" data-toggle="modal" href="/ApproveContributions/{{ $cont_period }}">
                                            Approve All Contributions
                                            </a>
                                         @endif
                                    @endif

                                   
                                     <div class="x_panel">   

                                     <h4 class="pull-left">
                                         
                                                @if($upload->Payment_Amount == 0)
                                               
                                                    Payment Pending
                                              
                                                @elseif($upload->Status == '1' && ($upload->Payment_Amount == $upload->Total_Contributions_Amount))
                                               
                                                    Processed
                                                
                                                @elseif(($upload->Payment_Amount == $upload->Total_Contributions_Amount))
                                               
                                                    Pending Approval
                                              
                                                @elseif($upload->Payment_Amount < $upload->Total_Contributions_Amount)

                                                        Underpayment
                                     
                                                @elseif($upload->Payment_Amount > $upload->Total_Contributions_Amount)
                                                
                                                         Overpayment <small><code>contributions can not be approved.</code></small>
                                                @else
                                              
                                                         Payment Pending

                                                @endif

                                     </h4>




                                        <h4 class="pull-right">
                                        <small>Total Contributions :</small> GHC {{ number_format($upload->Total_Contributions_Amount,2) }}
                                        <small>Amount Paid :</small> GHC {{ number_format($upload->Payment_Amount,2) }}
                                        </h4>
                                     




                                    </div>
                                    
                              

                                

                                     <div class="clearfix">
                                </div>

                                   
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">    
                                                <th>Staff ID</th>
                                                <th>Name of Staff </th>
                                                <th>Employee Cont.</th>
                                                <th>Employer Cont.</th>
                                                <th>Total Cont.</th>
                                                <th></th>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($conts as $contribution)
                                            <tr class="even pointer">
                                                <td class=" ">{{ $contribution->Staff_Id }}</td>
                                                <td class=" ">{{ $contribution->Other_Names.' '.$contribution->Surname}}</td>
                                                <td class=" ">{{ number_format($contribution->Employee_Contribution,2) }}</td>
                                                <td class=" ">{{ number_format($contribution->Employer_Contribution,2) }}</td>
                                                <td class=" ">{{ number_format($contribution->Employee_Contribution + $contribution->Employer_Contribution,2) }}</td>   
                                                <td class=" ">
                                                <a class="btn btn-primary btn-xs" data-toggle="modal" href="#popup" onclick="setContID('{{ $contribution->Id }}')">
                                                Edit Values
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

    
        
        <div id="popup"  class="modal fade" tabindex="-1" data-width="500">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>Edit Contribution Details</h4>
          </div>
                <form class="form-horizontal form-label-left" method="post"  novalidate action="/UpdateContribution" >
       

              <div class="modal-body">


                                    

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Contribution ID
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input readonly="true" id="contributionid" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="contributionid" placeholder="Contribution ID" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Cont. Period
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input readonly="true" id="contributionperiod" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="contributionperiod" placeholder="Contribution Period" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Staff ID
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input readonly="true" id="staffid" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="staffid" placeholder="Staff ID" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Staff Name
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input readonly="true" id="staffname" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="staffname" placeholder="Staff Name" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Employee Cont.
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="employeecontribution" name="employeecontribution" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">Employer Cont.
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="employercontribution" name="employercontribution" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
             </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
          
        </form>
        </div>


 <script>


        function setContID(id)
        {
            $('#contributionid').val(id); 
            $('#staffid').focus();
            callValues();
        }


        function callValues()
        {
                
                     
                            if($('#contributionid').val() == "NA")
                            {
                                   alert("No contribution id found!");
                                   
                            }
                            else
                            { 

                                    $.get('/GetContributionDetails',
                                    {
                                        "ID": $('#contributionid').val()
                                      
                                    },
                                    function(data)
                                    { 
                                        $('#staffid').val(data[0]['Staff_Id']);
                                        $('#contributionperiod').val(data[0]['Contribution_Period']);
                                        $('#staffname').val(data[0]['Other_Names']+' '+data[0]['Surname']);
                                        $('#employeecontribution').val(data[0]['Employee_Contribution']);
                                        $('#employercontribution').val(data[0]['Employer_Contribution']);

                                    },'json');

                                
                            }
            }


  </script>



       
  

@stop