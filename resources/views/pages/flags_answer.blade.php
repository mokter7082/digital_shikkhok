@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                              	  <div class="panel-heading">
                                      <h3 class="panel-title">Flags Answer</h3>
                                  </div>
                   
                          @php
                          $teacher = Session::get('type')  
                          @endphp
                          @if($teacher == '4') 
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                 <th>ID</th>
                                                  <th>Question</th> 
                                                  <th>Answer</th> 
                                                  <th>Actions</th>  
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                   @foreach($flags_answer as $val)
                                                   <tr id = "tr-{{$val->id}}">
                                                        <td>{{$val->id}}</td>
                                                        <td>{{$val->question}}</td>
                                                        <td>{{$val->answer}}</td>
                                                        <td>
                                                           <button type="submit" style="margin-top:1px;" class="btn btn-danger btn-sm delete" id="ans_delete{{$val->id}}" onclick="ans_delete({{$val->id}})">Delete</button>
                                                        </td>
                                                   </tr>
                                                     @endforeach
                                                  </tbody>
                                              </table>

                                          </div>
                                      </div>
                                  </div>

                          @elseif($teacher == '6') 
                     
                          @else
                          @endif
                              </div>
                          </div>

                      </div>

</div> <!-- container -->
</div>
<script type="text/javascript">

function ans_delete(id){
      // var t_td = (id);
      $('.delete').click(function(){
        swal({   
            title: "Are you sure?",   
            text: "Delete this teacher!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete ",   
            closeOnConfirm: false 
        }, function(){ 
          $.ajax({
            url: '<?php echo URL::to('answer-delete');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
            $("#tr-"+id).hide();
            }
          });  
            swal("Deleted!", "Your teacher delete successfull.", "success"); 
        });
    });     
 }

</script>
@endsection
