@extends('welcome')

@section('content')
<div class="content">
<div class="container">

   <div class="row">
     <form method="POST" action="{{route('save')}}">
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
<!-- /****START TEACHER TABLE DESIGN SETUP***/ -->
  <div class="row">
  <div class="col-md-12">
  <div class="panel panel-default">               
	<div class="panel-body">
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
			 <table id="datatable" class="table table-striped table-bordered my_table">
			   <thead>
				    <tr>
				      <th>Name</th>
				      <th>Mobile</th>
              <th>Designation</th>
				      <th>Institute Name</th>
				      <th>Answer Count</th>
				    </tr>
			   </thead>
			   <tbody>
          @foreach($monthly as $value)
          <tr>
              <td>{{$value->name}}</td>
              <td>{{$value->mobile}}</t>
              <td>
                 @if($value->type == '1')
                 <p>Teacher</p>
                 @elseif($value->type == '2')
                 <p>Student</p>
                 @elseif($value->type == '3')
                 <p>Answer Hero</p>
                 @elseif($value->type == '4')
                 <p>Admin</p>
                  @elseif($value->type == '5')
                 <p>Other</p>
                  @elseif($value->type == '6')
                 <p>Editor</p>
                 @else
                 @endif
              </td>
              <td>{{$value->institutionname}}</t>
              <td>{{$value->total}}</t>
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
     