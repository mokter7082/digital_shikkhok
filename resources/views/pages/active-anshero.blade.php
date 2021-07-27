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
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>User ID</th>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Phone</th>
                                                  <th>Institution Name</th>
                                                  <th>Date</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                       @foreach($active_anshero as $val)
                                                       <tr>
                                                           <td>{{$val->id}}</td>
                                                           <td>{{$val->name}}</td>
                                                           <td>{{$val->email}}</td>
                                                           <td>{{$val->mobile}}</td>
                                                           <td>{{$val->institutionname}}</td>
                                                           <td>{{$val->created_at}}</td>
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
