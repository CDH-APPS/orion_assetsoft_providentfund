@extends('admin')

@section('content')
 <br />
        <div class="">

            <div class="page-title">
  
                <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>User Information <small>users must have passwords that conform to our <a href="#">password format</a></small></h2>
                                    <div class="clearfix"></div>
                                </div>


                                <div class="x_content">
                                <br />


                                    <form action="/NewUser" method="post" id="new-user-form">

                                    <div id="demo-form" data-parsley-validate >
                                    <h2>User Details</h2>
                                    <hr>
                                  
                                            <div class="well" style="overflow:auto; padding-bottom:10px; padding-top:10px; "> 

                                         		<!-- Name of User, Username , Password, Retype password  -->
                                         		<div class="form-group">

        	                                 		<div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
        		                                        <label for="name">Name of User * :</label>
        		                                        <input type="text" id="name" class="form-control" name="name" placeholder="Full name of user" required />
        	                                        </div>

        	                                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
        		                                        <label for="userpriv">User Priv * :</label>
        		                                        <input type="text" id="userpriv" class="form-control" name="userpriv" placeholder="User Priv" required />
        	                                        </div>	    

                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <label for="username">Username * :</label>
                                                        <input type="text" id="username" class="form-control" name="username" placeholder="Username" required />
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <label for="password">Password * :</label>
                                                        <input type="text" id="password" class="form-control" name="password" placeholder="Password" required />
                                                    </div>      

                                                </div>
                                                <!-- end -->

                                            </div>

                                        <br/>
                                        <input type="submit" id="save" class="btn btn-primary" value="Save Details">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    </div>

                                    </form>


                                    </div>
							     </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 




<!-- Call to script files -->

       
        <!-- form validation -->
        <script type="text/javascript" src="js/parsley/parsley.min.js"></script>
        

<!-- end calls -->



           

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