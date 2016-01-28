@extends('Admin.index')

@section('content')
  <div class="">
                    <div class="page-title">
                        

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Users Register <small>{{ $numusers}} users found.</small></h2>
                                    <a class="btn btn-primary pull-right" href="/NewUser">Add New User</a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>User ID</th>
                                                <th class=" no-link last"><span class="nobr">Name of User</span></th>
                                                <th>User Role</th>                                                
                                                <th>Last Login</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        @foreach($users as $user)

                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                <input type="checkbox" class="tableflat">
                                                </td>
                                                <td class=" ">{{$user->id}}</td>
                                                <td class=" last"><a herf="/EditUser/{{ $user->id }}"> {{$user->name}} </a></td>
                                                <td class=" ">{{$user->user_role}} </td>
          
                                                <td class=" ">{{$user->last_login_date}}</td>
                                                <td>
                                                <a onclick="editUser('{{ $user->id }}','{{ $user->name }}')"  class="btn btn-primary btn-xs pull-right" data-toggle="modal" href="#userDetails/{{ $user->id }}">Edit info</a>
                                                </td>
                                                <td>
                                                    <a onclick="resetPassword('{{ $user->id }}','{{ $user->name }}')"  class="btn btn-primary btn-xs pull-right" data-toggle="modal" >Reset Password</a>
                                                </td>
                                                <td>
                                                    @if($user->status == 1)
                                                        <a onclick="deactivate('{{ $user->id }}')"  class="btn btn-success btn-xs pull-right"  data-toggle="modal" style="width:60px;" >Active</a>
                                                    @else
                                                        <a onclick="activate('{{ $user->id }}')"  class="btn btn-danger btn-xs pull-right"  data-toggle="modal" style="width:60px;" >Inactive</a>
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



        

<!-- Call to script files -->

       
        <!-- form validation -->
        <script type="text/javascript" src="js/parsley/parsley.min.js"></script>
        

<!-- end calls -->






<!-- User Form-->

 <form class="form-horizontal row-fluid"  method="post">
    <div id="userDetails" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
      <div class="modal-header">
        <button id="close_session" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>User details for </h3><span id="userSpName"></span>
        <span id="membername"></span>
      </div>
        <div class="modal-body">

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">SP Code:</label>
                                            <div class="controls">
                                                <input type="text" name="userspcode" id="userspcode" disabled="">
                                            </div>
                                        </div>

                                         <div class="control-group">
                                            <label class="control-label" for="basicinput">Name of User :</label>
                                            <div class="controls">
                                                <input type="text" name="name" id="name" >
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Email :</label>
                                            <div class="controls">
                                                <input type="email" name="email" id="email" >
                                            </div>
                                        </div>
                                       
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Mobile No. :</label>
                                            <div class="controls">
                                                <input type="text" name="contactno" id="contactno" >
                                            </div>
                                        </div>
                                        


                                        <div class="control-group">
                                            <label class="control-label">User Type :</label>
                                            <div class="controls">
                                            <select  name="usertype" id="usertype" tabindex="1" data-placeholder="Select here.." >
                                                <option value="Admin">Admin</option>
                                                <option value="Claims Officer">Claims Officer</option>
                                                <option value="Authorizer">Authorizer</option>
                
                                            </select>
                                            </div>
                                        </div>

       </div>
      <div class="modal-footer">
        <button id="btnCancelUser" type="button" data-dismiss="modal" class="btn btn-large btn-danger">Cancel</button>
        <button id="btnSaveUser" type="button" onclick="saveUser()" class="btn btn-large btn-primary">Save User</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
    </div>
  </form>
<!-- End New User Form-->








<!-- Users Functions -->


<script type="text/javascript">
    
    function activate(user_id)
    {
        if(confirm("Activate user!"))
        {

            $.get('/ActivateUser',
            {
              "USER_ID": user_id                      
            },
            function(data)
            { 
                
                $.each(data, function (key, value) {
                  if(data["OK"])
                  {
                    alert("User Activated!");
                    window.location.href = "/ViewUsers"
                  }
                  else
                  {
                    alert("User was not activated!");
                  }
                });
                                            
            },'json');
        }
    }


   

   

    function deactivate(user_id)
    {
        if(confirm("Activate user!"))
        {

            $.get('/DeactivateUser',
            {
              "USER_ID": user_id                      
            },
            function(data)
            { 
                
                $.each(data, function (key, value) {
                  if(data["OK"])
                  {
                    alert("User Deactivated!");
                     window.location.href = "/ViewUsers"
                  }
                  else
                  {
                    alert("User was not deactivated!");
                  }
                });
                                            
            },'json');
        }    
    }



    

    function resetPassword(user_id, name)
    {

        if(confirm("You are about to reset the password for "+name+", please click ok to proceed."))
        {
            $.get('/ResetUserPwd',
            {
              "USER_ID": user_id                      
            },
            function(data)
            { 
                
                $.each(data, function (key, value) {
                  if(data["OK"])
                  {
                    alert("User password reset notification will be sent to "+data['Email']);
                  }
                  else
                  {
                    alert("User password reset failed.");
                  }
                });
                                        
        },'json');
        }

    }


</script>


  

    <!-- End Users Funcions -->
           

   <!-- Validation Script -->

   <script type="text/javascript">
            $(document).ready(function () {
                
                $('#save').on('click', function () {
                    $('#demo-form').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });

           
            try {
                hljs.initHighlightingOnLoad();
            } catch (err) {}
    </script>

    <!-- End Validation Script -->


    <!-- /datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#birthdate').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            
        });
    </script>
   
   
  

@stop