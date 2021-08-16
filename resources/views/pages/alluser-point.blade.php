@extends('welcome')

@section('content')
@php
        date_default_timezone_set("Asia/Dhaka");
        $todaydate = date("Y-m-d H:i:s");
@endphp
<div class="content">
<div class="container">
  <div class="row">
    <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">All Users</h3>
                </div>  
                <h4 class="show text-success text-center" id="hide"></h4> 
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Designation</th>
                                <th>Institution Name</th>
                                <th>Action</th>
                        </thead>
                                <tbody>
                            @foreach($all_users_points as $val)
                                <tr> 
                                    <td>{{$val->user_id}}</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->email}}</td>
                                    <td>{{$val->mobile}}</td>
                                    <td>
                                        @if($val->type == 1)
                                            <p>Teacher</p>
                                        @elseif($val->type == 2)
                                         <p>Student</p>
                                         @elseif($val->type == 3)
                                         <p>Answer Hero</p>
                                         @elseif($val->type == 4)
                                         <p>Admin</p>
                                         @elseif($val->type == 6)
                                         <p>Editor</p>
                                         @elseif($val->type == 7)
                                         <p>Flags</p>
                                         @else
                                         @endif
                                    </td>
                                    <td>{{$val->institutionname}}</td>
                                    <td><button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#view-{{$val->user_id}}">View</button></td>
                                </tr>
                             @endforeach
                                </tbody>
                            </table>
@include('modal.points-viewmodal')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div> <!-- container -->
</div>

@endsection
