@extends('welcome')

@section('content')
<div class="content">
<div class="container">
<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
              <div class="panel-heading">
                  <h2 class=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Student Update</h2>
              </div>
	<div class="panel-body">
	<div class="row">
	   <div class="col-md-6">
	   <div class="panel panel-default">
	   @if(Session::has('message'))
		<p class="alert alert-info">{{ Session::get('message') }}</p>
		@endif
	    <div class="panel-body">
	            <form role="form" method="post" action="{{url('update-student/'.$edit_student->id)}}">
	            	@csrf
	                <div class="form-group">
	                    <label for="name">Name</label>
	                    <input type="text" name="name" class="form-control" value="{{$edit_student->name}}" id="name">
	                </div>
	                <div class="form-group">
	                    <label for="email">Email</label>
	                    <input type="email" name="email" class="form-control" value="{{$edit_student->email}}" id="email">
	                </div>
	                <div class="form-group">
	                    <label for="mobile">Mobile hghgh</label>
	                    <input type="text" name="mobile" class="form-control" value="{{$edit_student->mobile}}" id="mobile">
	                </div>
					<div class="form-group">
	                    <label for="institutionname">Institution Name</label>
	                    <input type="text" name="institutionname" class="form-control" value="{{$edit_student->institutionname}}" id="mobile">
	                </div>
	                <button type="submit" class="btn btn-purple waves-effect waves-light">Update</button>
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
