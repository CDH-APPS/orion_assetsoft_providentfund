@extends('main')

@section('content')



                <div class="">
                    <div class="page-title">
                        

                       
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post"  novalidate action="/NewStaff" >
                                            <?php if(isset($form_error_message)) { ?>
                                            <div class="alert alert-warning">
                                            <span class="alert"><b><?php echo $form_error_message ?></b></span>
                                            </div>
                                            <?php } ?>


                                            <?php if(isset($success_message)) { ?>
                                            <div class="alert alert-success">
                                            <span class="alert"><b><?php echo $success_message ?></b></span>
                                            </div>
                                            <?php } ?>
                                        
                                        <span class="section">Staff Info</span>

                                        <div class="item form-group">

                                             
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="staffid">Staff ID
                                                </label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <input id="staffid" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="staffid" placeholder="Staff ID" value="{{ $staff->staff_id }}" required="required"  readonly="" type="text">
                                                </div>
                                          

                                            <!-- Staff ID -->

                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="designation">Staff Designation
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                            
                                                <select id="designation"  name="designation" class="form-control" required>
                                                       
                                                        @foreach($designations as $designation)
                                                        <option <? if ($staff->designation_id == $designation->id) { echo "selected"; } ?> value="{{ $designation->id }}">{{$designation->designation_name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        

                                        

                                        <div class="item form-group">


                                           
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="surname">Surname
                                                </label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <input id="surname" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="surname"  required="required" value="{{ $staff->surname }}" type="text">
                                                </div>
                                            

                                            <!-- Surname -->


                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="othernames">Other Names
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="othernames" class="form-control col-md-7 col-xs-12" data-validate-length-range="30" name="othernames"  value="{{ $staff->other_names }}"  required="required" type="text">
                                            </div>


                                        </div>




                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="birthdate">Date of Birth
                                            </label>
                                            <div class="col-md-4 xdisplay_inputx has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="birthdate" name="birthdate" placeholder="Date of Birth" value="{{ $staff->date_of_birth }}" aria-describedby="inputSuccess2Status">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                            </div>


                                            <!-- Gender -->

                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="gender">Gender
                                            </label>
                                            <div class="col-md-2 col-sm-3 col-xs-12">
                                             <select id="gender"  name="gender" class="form-control" required>
                                                     
                                                        <option <? if ($staff->gender == "Male") { echo "selected"; } ?> value="Male">Male</option>
                                                        <option <? if ($staff->gender == "Female") { echo "selected"; } ?> value="Female">Female</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="mobile">Mobile
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" id="mobile" name="mobile" required="required" value="{{ $staff->contact_no }}"  class="form-control col-md-7 col-xs-12">
                                            </div>

                                            <!-- Email -->
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="email">Email 
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="email" id="email" name="email" required="required" value="{{ $staff->email }}" class="form-control col-md-7 col-xs-12">
                                            </div>

                                        </div>

                                       
                                        
                                     
                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="postaladdress">Postal Address 
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <textarea id="postaladdress" required="required" name="postaladdress" value="{{ $staff->postal_address }}" class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>

                                            <!-- Residential Address -->

                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="residentialaddress">Residentail Address
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <textarea id="residentialaddress" required="required" name="residentialaddress" value="{{ $staff->residential_address }}" class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>

                                        </div>

                                       
                                         <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="ssn">SSN
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="ssn" class="form-control col-md-7 col-xs-12" value="{{ $staff->ssn }}" data-validate-length-range="30" name="ssn" required="required" type="text">
                                            </div>

                                            <!-- Next of Kin -->

                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="nokname">Next of Kin Name
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="nokname" class="form-control col-md-7 col-xs-12" value="{{ $staff->nok_name }}" data-validate-length-range="30" name="nokname" required="required" type="text">
                                            </div>

                                        </div>
                                        
                                         <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="nokcontact">Next of Kin Contact
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="nokcontact" class="form-control col-md-7 col-xs-12" value="{{ $staff->nok_contact }}" data-validate-length-range="30" name="nokcontact" required="required" type="text">
                                            </div>

                                            <!-- Next of Kin Address-->

                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="nokaddress">Next of Address
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <textarea id="nokaddress" required="required" name="nokaddress" value="{{ $staff->nok_address }}" class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>

                                        </div>
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-danger pull-right">Cancel</button>
                                                <button id="save" type="submit" class="btn btn-success pull-right">Save Details</button>
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