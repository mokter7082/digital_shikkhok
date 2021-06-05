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
                                                    <th>Quetions</th>
                                                    <th>Answear</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($question_details as $question => $answer_array)
                                                <tr>
                                                  <td>{{$question}}</td>
                                                  <td> 
                                                    <ol>
                                                    @foreach($answer_array as $answer)
                                                      <li>{{$answer}}</li>
                                                    @endforeach
                                                  </ol>
                                                  </td>                                            
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
