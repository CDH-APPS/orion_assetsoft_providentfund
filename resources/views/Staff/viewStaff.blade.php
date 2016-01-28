@extends('main')

@section('content')



                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Staff Register
                    <small>
                        {{ $staffnum }} staff members in registry
                    </small>
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
                                    <h2>Listed Active Staff <small>Active Status</small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                
                                                <th>Staff ID</th>
                                                <th>Surname</th>
                                                <th>Other Names </th>
                                                <th>Designation</th>
                                                <th>Edit</th>
                                                <th>Status </th>
                                                
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($staffInfo as $staff)
                                            <tr class="even pointer">
                                               
                                                <td class=" ">{{ $staff->staff_id }}</td>
                                                <td class=" ">{{ $staff->surname }}</td>
                                                <td class=" ">{{ $staff->other_names }}</td>
                                                <td class=" ">{{ $staff->staff_designation }}</td>
                                                <td class=" "><a class="btn btn-primary btn-xs" href="/EditStaff/{{ $staff->staff_id }}">Edit Details</a></td>
                                                @if($staff->status == 1 )
                                                <td class=" "><a class="btn btn-success btn-xs">Active</a></td>
                                                @else
                                                <td class=" "><a class="btn btn-danger btn-xs">Inactive</a></td>
                                                @endif
                                              
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