@extends('welcome')

@section('content')
<div class="content">
<div class="container">
<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
              <div class="panel-heading">
                  <h2 class=""><i class="fa fa-user-plus" aria-hidden="true"></i> Teacher Subject Add</h2>
              </div>
	<div class="panel-body">
	<div class="row">
	   <div class="col-md-6">
	   <div class="panel panel-default">
        <?php  
		$subject = DB::table('subjects')->get();	
		?>
		@if(Session::has('message'))
				<p class="alert alert-info">{{ Session::get('message') }}</p>
			  @endif
	    <div class="panel-body">
	            <!-- <form role="form" method="post" action="{{url('update-teacher/'.$edit_teacher->id)}}"> -->
				<form role="form" method="post" action="{{route('insert-teacher')}}">
	            	@csrf
	                <div class="form-group">
	                    <label for="name">Teacher Name</label>
	                    <input type="text" class="form-control" value="{{$edit_teacher->name}}" id="name">
						<input type="hidden" name="teacher_id" class="form-control" value="{{$edit_teacher->id}}" id="name">
	                </div>

	                <div class="form-group">
					<label for="name">Subject</label></br>
						@foreach($subject as $val)
						<div class="checkbox checkbox-success checkbox-inline">
							<input type="checkbox"  name="subject_id[]" id="" value="{{$val->id}}" >
						 <label for="">{{$val->name}}</label>
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
