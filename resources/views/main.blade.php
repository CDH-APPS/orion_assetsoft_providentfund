

@if(!Auth::check())
    <script type="text/javascript">
    window.location.href = "/";
    </script>
@endif



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ORION FUND MANAGER</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL::to('fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ URL::to('css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/maps/jquery-jvectormap-2.0.1.css') }}" />
    <link href="{{ URL::to('css/icheck/flat/green.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('css/floatexamples.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/popup.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/datatables/tools/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script src="{{ URL::to('js/nprogress.js') }}"></script>
    
    <script>
        NProgress.start();
    </script>
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div style="background-color:white; height:120px; " align="center" class="navbar nav_title" style="border: 0;">
                        <a href="/Home" >
                            
                          <br>
                            {!! Html::image('images/front_logo.png', 'Logo',array('width' => 180 , 'height' => 90)) !!}

                        </a>
                    </div>



                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                   
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                        
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Staff Register <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="/UploadStaff">Upload Staff List</a>
                                        </li>
                                        <li><a href="/ViewStaff">View Register</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Operations <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="/UploadContributions">Upload Contributions File</a>
                                        </li>
                                        <li><a href="/UploadHistory">View Upload History</a>
                                        </li>
                                        <li><a href="/StaffAccounts">Staff Accounts</a>
                                        </li>
                                        <li><a href="/NewTransaction">Process New Transaction</a>
                                        </li>
                                     
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i> Fund Manager <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="/ManagerViewStaff">Staff Register</a>
                                        </li>
                                        <li><a href="/ManagerStaffAccounts">Staff Accounts</a>
                                        </li>
                                        <li><a href="/ManagerUploadHistory">Contributions History</a>
                                        </li>
                                        <li><a href="/ManagerFixedDepositInvestments">Fixed Deposit Investments</a>
                                        </li>
                                        <li><a href="/ManagerEquityInvestments">Equity Investments</a>
                                        </li>
                                        <li><a href="/ManagerCurrentPosition">Current Position</a>
                                        </li>
                                        <li><a href="/ManagerPendingApprovals">Pending Approvals</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i> Accounts <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="/BankAccounts">Bank Accounts</a>
                                        </li>
                                        <li><a href="/ProcessPayments">Process Payments Received</a>
                                        </li>
                                        <li><a href="/AccountsPendingApprovals">Pending Approvals</a>
                                        </li>
                                        <li><a href="/ProcessWithdrawals">Process Withdrawals</a>
                                        </li>
                                         <li><a href="/StaffAccounts">Staff Accounts</a>
                                        </li>
                                        <li><a href="/StaffAccounts">Chart of Accounts</a>
                                        </li>
                                        <li><a href="/StaffAccounts">Ledgers</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bar-chart-o"></i>Reports<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="chartjs.html">Statement</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                      
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                   Welcome, {{ Auth::user()->get_user() }}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="#userprofile" data-toggle="modal">Profile</a>
                                    </li>
                                    <li>
                                        <a href="#changepwd" data-toggle="modal">
                                           
                                            <span>Change Password</span>
                                        </a>
                                    </li>
                                   
                                    <li><a href="/Logout"><i class="fa fa-sign-out pull-right"></i>Log Out</a>
                                    </li>
                                </ul>
                            </li>

                           

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                   
                        @if (Session::has('success_message'))
                            <div class="alert alert-success">
                            <p class="alert">{{ Session::get('success_message') }}</p>
                            </div>
                        @endif

                        @if(Session::has('error_message'))
                            <div class="alert alert-warning">
                            <p class="alert">{{ Session::get('error_message') }}</p>
                            </div>
                        @endif

                        @yield('content')      
            
                <!-- footer content -->







                <footer>
                    <div class="">
                        <p class="pull-right">CDH Asset Management Ltd. | <a>Orion Fund Manager</a>
                        
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="{{ URL::to('js/bootstrap.min.js') }}"></script>

    <!-- gauge js -->
    <script type="text/javascript" src="{{ URL::to('js/gauge/gauge.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/gauge/gauge_demo.js') }}"></script>
    <!-- chart js -->
    <script src="{{ URL::to('js/chartjs/chart.min.js') }}"></script>
    <!-- bootstrap progress js -->
    <script src="{{ URL::to('js/progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ URL::to('js/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <!-- icheck -->
    <script src="{{ URL::to('js/icheck/icheck.min.js') }}"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="{{ URL::to('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/datepicker/daterangepicker.js') }}"></script>

    <script src="{{ URL::to('js/custom.js') }}"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="{{ URL::to('js/flot/jquery.flot.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/flot/jquery.flot.pie.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/flot/jquery.flot.orderBars.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/flot/jquery.flot.time.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/flot/date.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/flot/jquery.flot.spline.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/flot/jquery.flot.stack.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/flot/curvedLines.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/flot/jquery.flot.resize.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/bootstrap-modal.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/bootstrap-modalmanager.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/jquery.inputmask.js') }}"></script>    

    <!-- worldmap -->
    <script type="text/javascript" src="{{ URL::to('js/maps/jquery-jvectormap-2.0.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/maps/gdp-data.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/maps/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/jquery.popup.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/jquery.popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/common.js') }}" type="text/javascript"></script>

    
    <!-- skycons -->
    <script src="js/skycons/skycons.js"></script>
   
    <!-- /datepicker -->
    <!-- /footer content -->





<!-- Change Password -->
  
        <div id="changepwd"  class="modal fade" tabindex="-1" data-width="500">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>Change Password</h4>
          </div>
                <form class="form-horizontal form-label-left" method="post"  novalidate action="/ChangePwd" >
       

              <div class="modal-body">                                    

                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-5 col-sm-4 col-xs-12" for="othernames">Current Password :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="currentpassword" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="currentpassword" placeholder="Current Password" required="required" type="password">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-5 col-sm-4 col-xs-12" for="othernames">New Password :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="newpassword" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="newpassword" placeholder="New Password" required="required" type="password">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-5 col-sm-4 col-xs-12" for="othernames">Retype New Password :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="renewpassword" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="renewpassword" placeholder="Retype New Password" required="required" type="password">
                                            </div>
                                        </div>
                                       
             </div>

              <div class="modal-footer">
                <button id="closeChangePwd"type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                <button type="button" onclick="changePwd()" class="btn btn-primary">Change Password</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input readonly="true" id="userid" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="userid" placeholder="User ID" value="{{ Auth::user()->get_user_id() }}" required="required" type="hidden">
              </div>
          
        </form>
        </div>

<!-- End Change Password -->

<!-- User Profile -->

     <div id="userprofile"  class="modal fade" tabindex="-1" data-width="600">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>User Profile</h4>
          </div>
                <form class="form-horizontal form-label-left" method="post"  novalidate  >
       

              <div class="modal-body">                                    

                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Name :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="name" class="form-control col-md-7 col-xs-12" value="{{ Auth::user()->get_user() }}" readonly="">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Username :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="username" class="form-control col-md-7 col-xs-12" value="{{ Auth::user()->get_user_username() }}" readonly="">
                                            </div>
                                        </div>

                                         <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Mobile Number :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="mobnumber" class="form-control col-md-7 col-xs-12" value="{{ Auth::user()->get_user_contact_number() }}" readonly="">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Department:
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="department" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="department" readonly="">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Position :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="position" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="position" value="{{ Auth::user()->get_user_position() }}" readonly="">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">User Role :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="userrole" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="position" value="{{ Auth::user()->get_user_role_id() }}" readonly="">
                                            </div>
                                        </div>
                                       
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="othernames">Last Login Date :
                                            </label>
                                            <div class="col-md-6 col-sm-4 col-xs-12">
                                                <input  id="lastlogin" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="position" value="{{ Auth::user()->get_user_last_login() }}" readonly="">
                                            </div>
                                        </div>
                                       
             </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
              </div>
          
        </form>
        </div>

<!-- End User Profile -->

<!-- Change Password -->
<script type="text/javascript">
    
        function changePwd()
        {
            if($("#newpassword").val()  == $("#renewpassword").val() )
            {
                $.get('/ChangePwd',
                {
                   "User_ID": $("#userid").val(),
                   "Current_Password": $("#currentpassword").val(),     
                   "New_Password":$("#newpassword").val()                 
                },
                function(data)
                { 
                    
                   if(data['OK'] == "OK"){ alert("Your password has been changed!"); $("#closeChangePwd").click(); }
                   else if(data["No Data"] == "NON"){ alert("The current password is incorrect."); }
                   else{ alert("An error occured while attemping to change your password. Please try again.");  }

                                                
                },'json');
            }
            else{ alert('Retyped password does not match new password.'); }
        }

</script>

<!-- End Change Password -->
















</body>

</html>

