@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                    @php
                   $teacher = Session::get('type')  
                   @endphp
                   @if($teacher == '1') 
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">All Teacher</h3>
                                  </div>
                                  <div class="panel-heading">
                                    <?php
                                       $total_teacher = DB::table('users')
                                                       ->where('type',1)
                                                       ->where('status','verified')
                                                       ->get();
                                       $t_teacger = count($total_teacher);


                                       $all_teacher = DB::table('users')
                                      ->where('type',1)
                                      ->get();
                                     // dd($all_teacher);
                                                              ?>
                                      <h3 class="panel-title">Total Teacher = {{$t_teacger}}</h3>
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
                                                  <th>Date</th>
                                                  <th>Mobile</th>
                                                  <th>Institute Name</th>
                                                  <th>Ans Count</th>
                                                  <th>Subject</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                        <tbody>
                                          @foreach($all_teacher as $val)
                                              <tr id = "tr-{{$val->id}}">
                                                  <td>{{$val->id}}</td>
                                                  <td>{{$val->name}}</td>
                                                  <td>{{$val->email}}</td>
                                                  @php
                                                        $d = $val->date;
                                                        $date =  date("Y-m-d",strtotime($d));
                                                  @endphp
                                                  <td>{{$date}}</td>
                                                  <td>{{$val->mobile}}</td>
                                                  <td>{{$val->institutionname}}</td>
                                                  <td>{{isset($a_q[$val->id])?$a_q[$val->id]:0}}</td>
                                                  <td>{{$val->english}}</td>
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



                @elseif($teacher == '4')
                 <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">All Teachers</h3>
                                  </div>
                                @php
                                   $all_teacher = DB::table('users')
                                              ->where('type',1)  
                                              ->get();
                                              
                                            
                                @endphp
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Date</th>
                                                  <th>Mobile</th>
                                                  <th>Institution Name</th>
                                                  <th>Ans Count</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                        <tbody>
                                          @foreach($all_teacher as $val)
                                              <tr id = "tr-{{$val->id}}">
                                                 <td>{{$val->id}}</td>
                                                  <td>{{$val->name}}</td>
                                                  <td>{{$val->email}}</td>
                                                  @php
                                                        $d = $val->date;
                                                        $date =  date("Y-m-d",strtotime($d));
                                                  @endphp
                                                  <td>{{$date}}</td>
                                                  <td>{{$val->mobile}}</td>
                                                  <td>{{$val->institutionname}}</td>
                                                  <td>{{isset($a_q[$val->id])?$a_q[$val->id]:0}}</td>
                                                 
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
                    @elseif($teacher == '5')
                        <div class="col-md-12">
                              <div class="panel panel-default">
                                @php
                                   $all_teacher = DB::table('users')
                                      ->where('type',1)
                                      ->orderBy('date', 'DESC')
                                      ->get();
                                @endphp
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                            
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Date</th>
                                                  <th>Mobile</th>
                                                  <th>Institute Name</th>
                                                  <th>Ans Count</th>
          
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                        <tbody>
                                          @foreach($all_teacher as $val)
                                              <tr id = "tr-{{$val->id}}">
                                                
                                                  <td>{{$val->name}}</td>
                                                  <td>{{$val->email}}</td>
                                                  @php
                                                        $d = $val->date;
                                                        $date =  date("Y-m-d",strtotime($d));
                                                  @endphp
                                                  <td>{{$date}}</td>
                                                  <td>{{$val->mobile}}</td>
                                                  <td>{{$val->institutionname}}</td>
                                                  <td>{{isset($a_q[$val->id])?$a_q[$val->id]:0}}</td>
                                                 
                                                  <td class="row">
                                                    @if($val->status == 'verified')
                                                     <button type="submit" id="verified_{{$val->id}}" class="btn btn-primary btn-sm" onclick="verification({{$val->id}})">Verified</button>
                                                    @else
                                                     <button type="submit" id="verified_{{$val->id}}" class="btn btn-danger btn-sm" onclick="verification({{$val->id}})">Not Verified</button>
                                                    @endif
                                                    <button type="submit" class="btn btn-danger btn-sm delete" id="t_delete{{$val->id}}" onclick="t_delete({{$val->id}})">Delete</button>
                                                    <a href="{{URL::to('edit-teacher/'.$val->id)}}" class="btn btn-warning btn-sm">Edit</a>
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
                    @else
                    @endif

 </div>
</div> <!-- container -->
</div>
<!-- Teacher Verified Not_veryfied form database with jquery -->
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


</script>
@endsection
