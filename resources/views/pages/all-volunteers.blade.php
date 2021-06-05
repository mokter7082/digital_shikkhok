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
                                        <table id="" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                 
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Phone</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($all_volunteer  as $val)
                                                        <tr>
                                                            <td>{{$val->first_name}}</td>
                                                            <td>{{$val->email}}</td>
                                                            <td>{{$val->phone_number}}</td>
                                                      
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
