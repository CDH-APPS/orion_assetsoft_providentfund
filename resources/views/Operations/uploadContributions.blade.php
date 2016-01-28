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
                                    <h2>Contributions Upload<small><!-- Put some text here to display--></small></h2>
                                  
                                    <div class="clearfix"></div>
                                </div> 

                                <div class="x_panel">
                                {{{ $success_message or '' }}}
                                </div>
                                <div class="x_panel">
                                    Click <a> here to download file <code>template</code></a>
                                </div>
                                <div class="x_content">
                                <br />

                                  <form enctype='multipart/form-data' class="form-horizontal form-label-left" method="post"  novalidate action="/UploadContributions">

                                        <span class="section"></span>

                                         <div class="form-group">
                                            <label for="uploadDescription" class="control-label col-md-2 col-sm-2 col-xs-12">Contribution Period *</label>
                                               <div class="col-md-2 col-sm-2 col-xs-12">
                                                  <select id="contMonth"  name="contMonth" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="JAN">JAN</option>
                                                             <option value="FEB">FEB</option>
                                                             <option value="MAR">MAR</option>
                                                             <option value="APR">APR</option>
                                                             <option value="MAY">MAY</option>
                                                             <option value="JUN">JUN</option>
                                                             <option value="JUL">JUL</option>
                                                             <option value="AUG">AUG</option>
                                                             <option value="SEP">SEP</option>
                                                             <option value="OCT">OCT</option>
                                                             <option value="NOV">NOV</option>
                                                             <option value="DEC">DEC</option>
                                                       
                                                </select>
                                            </div>

                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                 <select id="contYear"  name="contYear" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                            
                                                            <?php
                                                                for($i = (date('Y') - 1); $i < (date('Y') + 2); $i++)
                                                                {
                                                                   echo  "<option value=".$i.">".$i."</option>";
                                                                }
                                                             ?>
                                                            
                                                       
                                                </select>
                                            </div>

                                        </div>


                                         <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="uploadDate">Contibution Date <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 xdisplay_inputx has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="uploadDate" name="uploadDate" placeholder="Contribution Date" aria-describedby="inputSuccess2Status">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="contributionsUpload">File Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="contributionsUpload" class="form-control col-md-4 col-xs-12" data-validate-length-range="30" name="contributionsUpload" placeholder="Browse for upload file" required="required" type="file"> 
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
            $('#uploadDate').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);

            });
            
        });
    </script>
   
   
  

@stop