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
                                                  <th>Answer</th> 
                                                  <th>Actions</th>  
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                   @foreach($flags_answer as $val)
                                                   <tr id = "tr-{{$val->id}}">
                                                        <td>{{$val->id}}</td>
                                                        <td>{{$val->answer}}</td>
                                                        <td>Somthing</td>
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

  function verification(id){
        var bclass = $("#verified_"+id).hasClass("btn-warning");
        //alert(bclass);
        if($("#verified_"+id).hasClass("btn-warning")){
          $.ajax({
            url: '<?php echo URL::to('teacher-inactive');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            $("#verified_"+id).text('Verified'); //versions newer than 1.6
            $("#verified_"+id).removeClass("btn-warning");
            $("#verified_"+id).addClass("btn-primary");
            }
          });
        }else {
          $.ajax({
            url: '<?php echo URL::to('teacher-active');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
             $("#verified_"+id).text('Verify'); //versions newer than 1.6
             $("#verified_"+id).removeClass("btn-primary");
             $("#verified_"+id).addClass("btn-warning");
            }
          });
        }
  }

 function t_delete(id){
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
            url: '<?php echo URL::to('teacher-delete');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
            $("#tr-"+id).remove();
            }
          });  
            swal("Deleted!", "Your teacher delete successfull.", "success"); 
        });
    });     
 }

 function anshero(id){
  //alert(id);
   $.ajax({
            url: '<?php echo URL::to('answer-hero');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
             $("#anshero"+id).text('Teacher'); //versions newer than 1.6
             $("#anshero"+id).removeClass("btn-danger");
             $("#anshero"+id).addClass("btn-primary");
          
            }
          });  
 }


 function anshero_block(id){
        var bclass = $("#anshero_block"+id).hasClass("btn-danger");
        //alert(bclass);
        if($("#anshero_block"+id).hasClass("btn-danger")){
          $.ajax({
            url: '<?php echo URL::to('anshero-block');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            $("#anshero_block"+id).text('Unblock'); //versions newer than 1.6
            $("#anshero_block"+id).removeClass("btn-danger");
            $("#anshero_block"+id).addClass("btn-warning");
            }
          });
        }else {
          $.ajax({
            url: '<?php echo URL::to('anshero-unblock');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
             $("#anshero_block"+id).text('Block'); //versions newer than 1.6
             $("#anshero_block"+id).removeClass("btn-warning");
             $("#anshero_block"+id).addClass("btn-danger");
            }
          });
        }
  }


</script>
@endsection
