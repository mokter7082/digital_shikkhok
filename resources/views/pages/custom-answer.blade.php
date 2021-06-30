@extends('welcome')

@section('content')
<div class="content">
<div class="container">

   <div class="row">
     <form method="POST" action="{{route('date-custom_answer')}}">
        @csrf
     <div class="col-md-2">
       <label for="">Start Date</label>
       <input class="form-control" type="date" name="start_date" value="{{date('Y-m-d')}}">
       <label for="">End Start</label>
       <input class="form-control" type="date" name="end_date" value="{{date('Y-m-d')}}">
       <button style="margin-top: 2px;" class="btn btn-primary btn-sm pull-right" id="">Search</button>
       </form>
      </div>
   </div>

<!-- /****END BASIC DATE SETUP***/ -->
<!-- /****START CUSTOM QUESTIONS TABLE DESIGN SETUP***/ -->
  <div class="row">
  <div class="col-md-12">
  <div class="panel panel-default">               
	<div class="panel-body">
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
			 <table id="datatable" class="table table-striped table-bordered my_table">
			   <thead>
				    <tr>
				      <th>Ques ID</th>
				      <th>Name</th>
                      <th>Mobile</th>
                      <th>Date</th>
				      <th>Questions</th>
                      <th>Answer</th>
				    </tr>
			   </thead>
			   <tbody> 
               @foreach($monthly_answer as $val) 
                    <tr>
                        <td>{{$val->id}}</td>
                        <td>{{$val->user_name}}</td>
                        <td>{{$val->mobile}}</td>
                        <td>{{$val->date}}</td>
                        <td>{{$val->quens}}</td>
                        <td>{{$val->ans}}</td>
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

  
</div>
</div>
 @endsection
     