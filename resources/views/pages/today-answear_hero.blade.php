@extends('welcome')

@section('content')
<div class="content">
<div class="container">

  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Today Register Answer Hero</h3>
                                  </div>
                                  @php
                                    $teacher = Session::get('type')  
                                  @endphp
                             @if($teacher == '6') 
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
                                                  <th>Institute Name</th>
                                                  <th>Subject</th>
                                                 
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($today_regi_anshero as $val)
                                                         <tr id = "tr-{{$val->id}}">
                                                            <td>{{$val->id}}</td>
                                                            <td>{{$val->name}}</td>
                                                            <td>{{$val->email}}</td>
                                                            <td>{{$val->mobile}}</td>
                                                            <td>{{$val->institutionname}}</td>
                                                            <td>{{$val->english}}</td>
                                                        </tr>
                                                      @endforeach
                                                  </tbody>
                                              </table>

                                          </div>
                                      </div>
                                  </div>
                         @elseif($teacher == '4')
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
                                                  <th>Institute Name</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($today_regi_anshero as $val)
                                                           <tr id = "tr-{{$val->id}}">
                                                            <td>{{$val->id}}</td>
                                                            <td>{{$val->name}}</td>
                                                            <td>{{$val->email}}</td>
                                                            <td>{{$val->mobile}}</td>
                                                            <td>{{$val->institutionname}}</td>
                                                             <td class="row">
                                                          @if($val->status == '0')
                                                           <button type="submit" id="verified_{{$val->id}}" class="btn btn-warning btn-sm" onclick="verification({{$val->id}})">Verify</button><br>
                                                           @elseif($val->status == 'not_verified')
                                                           <button type="submit" id="verified_{{$val->id}}" class="btn btn-primary btn-sm" onclick="verification({{$val->id}})">Verify</button><br>
                                                          @else
                                                           <button type="submit" id="verified_{{$val->id}}" class="btn btn-primary btn-sm" onclick="verification({{$val->id}})">Verified</button><br>
                                                          @endif
                                                          <button type="submit" style="margin-top:1px;" class="btn btn-danger btn-sm delete" id="t_delete{{$val->id}}" onclick="t_delete({{$val->id}})">Delete</button><br>
                                                          <a href="{{URL::to('edit-teacher/'.$val->id)}}" style="margin-top:2px;" class="btn btn-warning btn-sm">Edit</a><br>
                                                          @if($val->type == '3')
                                                           <button type="submit" style="margin-top:1px;" class="btn btn-primary btn-sm delete" id="" onclick="">Teacher</button><br>
                                                          @else
                                                           <button type="submit" style="margin-top:1px;" style="margin-top:1px;" class="btn btn-danger btn-sm" id="anshero{{$val->id}}" onclick="anshero({{$val->id}})">Ans Hero</button>
                                                          @endif
                                                          @if ($val->status == '3')
                                                          <button type="submit" style="margin-top:4px;" class="btn btn-warning btn-sm block" id="t_block{{$val->id}}" onclick="teacher_block({{$val->id}})">Unblock</button>
                                                          @else
                                                          <button type="submit" style="margin-top:4px;" class="btn btn-danger btn-sm block" id="t_block{{$val->id}}" onclick="teacher_block({{$val->id}})">Block</button>                     
                                                          @endif
                                                        </td>
                                                        </tr>
                                                      @endforeach
                                                  </tbody>
                                              </table>

                                          </div>
                                      </div>
                                  </div>
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

 function teacher_block(id){
        var bclass = $("#t_block"+id).hasClass("btn-danger");
        //alert(bclass);
        if($("#t_block"+id).hasClass("btn-danger")){
          $.ajax({
            url: '<?php echo URL::to('teacher-block');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            $("#t_block"+id).text('Unblock'); //versions newer than 1.6
            $("#t_block"+id).removeClass("btn-danger");
            $("#t_block"+id).addClass("btn-warning");
            }
          });
        }else {
          $.ajax({
            url: '<?php echo URL::to('teacher-unblock');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
             $("#t_block"+id).text('Block'); //versions newer than 1.6
             $("#t_block"+id).removeClass("btn-warning");
             $("#t_block"+id).addClass("btn-danger");
            }
          });
        }
  }


</script>
@endsection
