@extends('main')

@section('content')
 <br />
               <div class="">
                <div class="page-title">
                       
                        
                  
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Upload Staff New List<small><!-- Put some text here to display--></small></h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <br />

                                  <form enctype='multipart/form-data' class="form-horizontal form-label-left" method="post"  novalidate action="/UploadStaff">
                                        
                                        <p>Click <a> here to download file <code>template</code> for staff upload</a></p>
                                        <span class="section"></span>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="staffuploadfilename">File Name :<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="staffuploadfilename" class="form-control col-md-4 col-xs-12" data-validate-length-range="30" name="staffuploadfilename" placeholder="Browse for upload file" required="required" type="file"> 
                                            </div> 
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <button id="save" type="submit" class="btn btn-primary col-md-2 col-xs-12">Upload</button>
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>         
                                  </form>

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