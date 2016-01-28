@extends('Admin.index')

@section('content')



                <div class="x_panel">
                                <div class="x_title">
                                    <h2>User Details<small><!-- Please enter any additional message here --></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" action="/NewUser">

                                        <p>All fields are <code>required</code> 
                                        </p>
                                        <span class="section">User Info</span>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name of User<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usertype">User Role <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            
                                                <select id="usertype"  name="usertype" class="form-control" required>
                                                       
                                                        @foreach($userroles as $userrole)
                                                        <option value="{{ $userrole->id }}">{{$userrole->role_name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">User Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                       
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Contact Number <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" id="number" name="number" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                       
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3">Department</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select id="department"  name="department" class="form-control" required>
                                                       
                                                        @foreach($departments as $department)
                                                        <option value="{{ $department->Id }}">{{$department->Name}}</option>
                                                        @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="position" type="text" name="position"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>

                                        
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="reset" class="btn btn-primary">Cancel</button>
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>



@stop