@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                              <?php                           
                                $l_user_id = Session::get('user_id');
                                $institutionname = Session::get('institutionname');
                                $username = Session::get('name');
                                date_default_timezone_set("Asia/Dhaka");
                                $todaydate = date("Y-m-d");
                            ?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Question</th> 
                                                  <th>Subject</th> 
                                                  <th>Answer</th> 
                                                  <th>Photo</th> 
                                                  <th>New Answer</th> 
                                                  <th>Actions</th>  
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                  @foreach($flags_answer as $val)
                                                  <tr id="rowid_{{$val->id}}" data-id="{{$val->id}}">
                                                 <input type="hidden" value="{{$val->id}}" class="userId">
                                                 <input type="hidden" value="{{$val->id}}" name="userId">
                                                        <td>{{$val->id}}</td>
                                                        <td>{{$val->question}}</td>
                                                        <td>{{$val->sname}}</td>
                                                        <td>{{$val->answer}}</td>
                                                        <td><img src="{{$val->file_url}}" alt="no image" style="height:200px;width:160px;"></td>
                                                        <td>
                                                        <form method="post" class="sub" enctype="multipart/form-data">
                                                        @csrf
                                                            <input type="hidden" class="id_i" name="id" value="{{$val->id}}">
                                                            <input type="hidden" class="id_i" name="ques_id" value="{{$val->qid}}">
                                                            <input type="hidden" class="ans_id" name="ans_id" value="{{$val->ans_id}}">
                                                            <input type="hidden" name="post_user_id" id="post_user_id_{{$val->id}}" value="{{$val->asked_by}}">
                                                            <textarea class="form-control" name="ans" id="ans_{{$val->id}}" rows="3" cols="30" placeholder="Write Answer Here" required></textarea>
                                                            <input name="image" type="file" id="image_{{$val->id}}" />
                                                            <input type="hidden" name="user_id" id="l_user_id_{{$val->id}}" value="{{$l_user_id}}">
                                                            <input type="hidden" name="username" id="username_{{$val->id}}" value="{{$username }}">
                                                            <input type="hidden" name="date" id="date_{{$val->id}}" value="{{$todaydate}}">
                                                            <input type="hidden" name="institutionname" id="institutionname_{{$val->id}}" value="{{$institutionname}}">
                                                            <button style="margin-top:2px; border-radius:10px;" type="submit" class="btn btn-sm btn-success">Submit</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                        <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#view-{{$val->id}}">View</button><br>
                                                           <button type="submit" style="margin-top:1px; margin-bottom:1px;" class="btn btn-danger btn-sm delete" id="ans_delete{{$val->id}}" onclick="ans_delete({{$val->ans_id}})">Delete</button><br>
                                                           @if($val->status == '0')
                                                     <button type="submit" id="verified_{{$val->id}}" class="btn btn-warning btn-sm"    onclick="verification({{$val->id}})">Verify</button><br>
                                                      @elseif($val->status == 'not_verified')
                                                      <button type="submit" id="verified_{{$val->id}}" class="btn btn-primary btn-sm" onclick="verification({{$val->id}})">Verify</button><br>
                                                      @else
                                                      <button type="submit" id="verified_{{$val->id}}" class="btn btn-primary btn-sm" onclick="verification({{$val->id}})">Verified</button><br>
                                                      @endif
                                                      @if ($val->status == '3')
                                                     <button type="submit" style="margin-top:4px;" class="btn btn-warning btn-sm block" id="flags_block{{$val->id}}" onclick="flags_block({{$val->id}})">Unblock</button><br>
                                                     @else
                                                     <button type="submit" style="margin-top:4px;" class="btn btn-danger btn-sm block" id="flags_block{{$val->id}}" onclick="flags_block({{$val->id}})">Block</button><br>
                                                    @endif
                                                    <button type="submit" style="margin-top:1px; margin-bottom:1px;" class="btn btn-danger btn-sm success resolve" id="ans_resolve{{$val->id}}" data-ans_id = "{{$val->ans_id}}">Resolve</button><br>
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
 @include('modal.flags-viewmodal')
<!-- Teacher Verified Not_veryfied form database with jquery -->
<script type="text/javascript">

// onclick="ans_resolve({{$val->ans_id}})"

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


  function ans_delete(ans_id){
   
      $('.delete').click(function(){
        var id = $(this).parents('tr').find('.userId').val();
     //alert(id); return;
        swal({   
            title: "Are you sure?",   
            text: "Delete this Ans!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete ",   
            closeOnConfirm: false 
        }, function(){ 
          $.ajax({
            url: '<?php echo URL::to('flags-delete');?>',
            method: 'GET',
            data: {id:ans_id},
            cache: false,
            success: function(html){
            console.log(html);
            $("#rowid_"+id).hide();
            // reload_table();
            }
          });  
            swal("Deleted!", "Your Ans delete successfull.", "success"); 
        });
    });       
 }


   //answer resolved
   $('.resolve').click(function(){
     var id = $(this).parents('tr').find('.userId').val();
    var ans_id = $(this).data('ans_id');
  $.ajax({
              url: '<?php echo URL::to('flags-resolve');?>',
              method: 'GET',
              data: {id:ans_id},
              cache: false,
              success: function(html){
              console.log(html);
               toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  	     	toastr.success("Answer Resolved");
              $("#rowid_"+id).hide();
              // reload_table();
              }
            }); 
    
    });


    $('.sub').submit(function(e) {
       e.preventDefault();
        toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  	     	toastr.success("Loding");
       var id = $(this).parents('tr').find('.userId').val();
         //alert(id); return;
       let formData = new FormData(this);
       $.ajax({
          type:'POST',
          url: '{{url('flags-insert')}}',
           data: formData,
           contentType: false,
           processData: false,
           success:function(data){
             console.log(data);
              toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  	     	toastr.success("Answer Submit Success");
             if(data.data===true) {
              $("#rowid_"+id).hide();
            }else if(data.data===null){
              $("#rowid_"+id).hide();
            }
             
        },
       });
  });
  function flags_block(id){
        var bclass = $("#flags_block"+id).hasClass("btn-danger");
        //alert(bclass);
        if($("#flags_block"+id).hasClass("btn-danger")){
          $.ajax({
            url: '<?php echo URL::to('flags-block');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            $("#flags_block"+id).text('Unblock'); //versions newer than 1.6
            $("#flags_block"+id).removeClass("btn-danger");
            $("#flags_block"+id).addClass("btn-warning");
            }
          });
        }else {
          $.ajax({
            url: '<?php echo URL::to('flags-unblock');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
             $("#flags_block"+id).text('Block'); //versions newer than 1.6
             $("#flags_block"+id).removeClass("btn-warning");
             $("#flags_block"+id).addClass("btn-danger");
            }
          });
        }
  }
</script>
@endsection
