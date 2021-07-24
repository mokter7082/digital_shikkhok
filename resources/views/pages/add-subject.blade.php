@extends('welcome')

@section('content')
<div class="content">
<div class="container">
<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
              <div class="panel-heading">
                  <h2 class=""><i class="fa fa-user-plus" aria-hidden="true"></i>Add Subjects</h2>
              </div>
	<div class="panel-body">
	<div class="row">
	   <div class="col-md-6">
	   <div class="panel panel-default">
        <?php  
		//dd($add_subject);
		$subject = DB::select("SELECT * FROM `subjects` WHERE `status` ='1'");
		$ext_sub = explode(",",$add_subject->s_id);
		//explode(" ",$str)
		
		?>
		       @if(Session::has('message'))
					<p class="alert alert-info">{{ Session::get('message') }}</p>
				@endif
	    <div class="panel-body">
	            <!-- <form role="form" method="post" action="{{url('update-teacher/'.$add_subject->id)}}"> -->
				<form role="form" method="post" action="{{route('insert-teacher')}}">
	            	@csrf
	                <div class="form-group">
	                    <label for="name">Teacher Name</label>
	                    <input type="text" class="form-control" value="{{$add_subject->name}}" id="name">
						<input type="hidden" name="teacher_id" class="form-control" value="{{$add_subject->id}}" id="name">
	                </div>

	                <div class="form-group">
					<label for="name">Subject</label></br>
						@foreach($subject as $val)
						<div class="checkbox checkbox-success checkbox-inline">
						@if (!in_array($val->id, $ext_sub))
						<input type="checkbox"  name="subject_id[]" id="" value="{{$val->id}}" >
						 <label for="">{{$val->name}}</label>
						@endif
						</div>
						@endforeach
	                </div>
					
	                <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
	            </form>
	     </div>
	     </div>
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
