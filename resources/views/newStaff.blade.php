@extends('main')

@section('content')



                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Staff Register []
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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Staff ID <small>showing details of the staff with the current ID.</small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left"  novalidate >

                                        <p>You can update the staff details as an  <code>Authorizer</code>
                                        </p>
                                        <span class="section">Staff Info</span>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="surname">Surname<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="surname" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="surname" placeholder="Surname" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="othernames">Other Names<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="othernames" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="othernames" placeholder="Other Names" required="required" type="text">
                                            </div>
                                        </div>


                                         <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="gender">Gender<span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <p>
                                            Male :
                                            <input type="radio" class="flat" name="gender" id="genderM" value="M" checked="" required /> 
                                            Female : 
                                            <input type="radio" class="flat" name="gender" id="genderF" value="F" />
                                            </p>
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="birthdate">Date of Birth<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 xdisplay_inputx has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="birthdate" name="birthdate" placeholder="Date of Birth" aria-describedby="inputSuccess2Status">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="mobile">Mobile  <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" id="mobile" name="mobile" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Email 
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        
                                     
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="postaladdress">Postal Address 
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <textarea id="postaladdress" required="required" name="postaladdress" class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="residentialaddress">Residentail Address
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <textarea id="residentialaddress" required="required" name="residentialaddress" class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ssn">SSN
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="ssn" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="ssn" required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="submit" class="btn btn-primary">Cancel</button>
                                                <button id="save" type="submit" class="btn btn-success">Save</button>
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

        <script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>

   
   
  

@stop