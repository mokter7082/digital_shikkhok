@extends('welcome')

@section('content')
<div class="content">
<div class="container">

  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Today Register Student</h3>
                                  </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Mobile</th>
                                                
                                                  <th>Subject</th>
                                                  <th>Date</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($today_st_re as $val)
                                                    <tr id = "tr-{{$val->id}}">
                                                           <td>{{$val->id}}</td>
                                                            <td>{{$val->name}}</td>
                                                            <td>{{$val->email}}</td>
                                                            <td>{{$val->mobile}}</td>
                                                           
                                                            <td>{{$val->english}}</td>
                                                            <td>{{$val->date}}</td>
                                                            <td>
                                                                <button type="submit" class="btn btn-danger btn-sm delete" id="s_delete{{$val->id}}" onclick="s_delete({{$val->id}})">Delete</button>
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
<script type="text/javascript">

  function s_delete(id){
      //  alert(id);
      $('.delete').click(function(){
        swal({   
            title: "Are you sure?",   
            text: "Delete this Student!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete ",   
            closeOnConfirm: false 
        }, function(){ 
          $.ajax({
            url: '<?php echo URL::to('student-delete');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
            $("#tr-"+id).remove();
            }
          });  
            swal("Deleted!", "Your Student delete successfull.", "success"); 
        });
    });

  }

</script>
@endsection
