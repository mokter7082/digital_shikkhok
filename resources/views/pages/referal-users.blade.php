@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <div class="panel-heading">
                                        <h2 class="">Refaral Users</h2>
                                       </div>
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Date</th>
                                                  <th>Mobile</th>
                                                  <th>Designation</th>
                                                  <th>Institution Name</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($referedUsers  as $val)
                                                        <tr>
                                                            <td>{{$val->id}}</td>
                                                            <td>{{$val->name}}</td>
                                                            <td>{{$val->email}}</td>
                                                            <td>{{$val->date}}</td>
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
                                                      
                                                        </tr>
                                                      @endforeach
                                                  </tbody>
                                              </table>

                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>

</div> <!-- container -->
</div>
<!-- Teacher Verified Not_veryfied form database with jquery -->

@endsection
