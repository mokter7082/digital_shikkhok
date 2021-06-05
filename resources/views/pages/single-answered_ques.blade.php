@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
  
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Multi Answred Questions</h3>
                                  </div>

                            <div class="panel-body">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                   <!-- <button type="button" onclick="reload_table();">Reload</button> -->
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr> 
                                                    <th>ID</th>
                                                    <th>Quetions</th>
                                                    <th>Answear</th>
                                                    <th>Quetions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($single_answered_ques as $val)
                                                <tr>
                                                  <td>{{$val->id}}</td>
                                                  <td>{{$val->quens}}</td>
                                                  <td>{{$val->ans}}</td> 
                                                  <td>{{$val->ct}}</td>                             
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
@endsection
