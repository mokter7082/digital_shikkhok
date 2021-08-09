@extends('welcome')

@section('content')
@php
        date_default_timezone_set("Asia/Dhaka");
        $todaydate = date("Y-m-d H:i:s");
@endphp
<div class="content">
<div class="container">
  <div class="row">
    <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Leader Board</h3>
                    <h3 class="panel-title">All Teachers</h3>
                </div>  
                <h4 class="show text-success text-center" id="hide"></h4> 
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                 <th>Institution Name</th>
                                <th>Point</th>
                                <th>Ans Count</th>
                                <th>Add Point</th>
                                <th>Remove Point</th>
                                <th>Action</th>
                        </thead>
                                <tbody>
                                @foreach($data_answer_arr as $val)
                                <tr>
                                    <td>{{$val['id']}}</td>
                                    <td>{{$val['name']}}</td>
                                    <td>{{$val['email']}}</td>
                                    <td>{{$val['mobile']}}</td>
                                    <td>{{$val['institutionname']}}</td>
                                    <td>
                                        <p id="point_p_{{$val['id']}}">{{$val['total_point']}}</p>
                                        <input type="hidden"  id="point_td_{{$val['id']}}" value="{{$val['total_point']}}" />
                                    </td>
                                    <td>{{$val['anscount']}}</td>
                                    <td> 
                                        <input type="hidden" id="date" value="{{$todaydate}}" />
                                        <input type="hidden" class="form-control" id="user_id_{{$val['id']}}" value="{{$val['id']}}" /> 
                                        <input type="text" class="form-control mb-1 inp" id="point_{{$val['id']}}" name="" />
                                        <select class="form-control form-select form-select-sm" aria-label="form-select-sm example" id="type">
                                        <option selected>Select</option>
                                        <option value="custom">Custom</option>
                                        <option value="scholarship">Scholarship</option>
                                        <option value="referral">Referral</option>
                                        <option value="quiz">Quiz</option>
                                        </select>
                                        <input type="hidden" class="form-control" id="user_type" value="{{$val['type']}}" />
                                        <button class="text-center btn btn-primary btn-sm" onclick="myFunction({{$val['id']}})" type="button">Add Point</button> 
                                    </td>
                                    <td> 
                                        <input type="hidden" id="date" value="{{$todaydate}}" />
                                        <input type="hidden" class="form-control" id="user_id_{{$val['id']}}" value="{{$val['id']}}" /> 
                                        <input type="text" class="form-control mb-1 inp" id="remive_point_{{$val['id']}}" name="" />
                                        <button class="text-center btn btn-danger btn-sm" onclick="removePoint({{$val['id']}})" type="button" style="margin-top:08px;">Remove</button> 
                                    </td>
                            <td>
                                @if ($val['status'] == '3')
                                 <button type="submit" style="margin-top:2px;" class="btn btn-warning btn-sm block" id="t_block{{$val['id']}}" onclick="teacher_block({{$val['id']}})">Unblock</button>
                                @else
                                <button type="submit" style="margin-top:2px;" class="btn btn-danger btn-sm block" id="t_block{{$val['id']}}" onclick="teacher_block({{$val['id']}})">Block</button> 
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

    </div>

</div> <!-- container -->
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">

$.ajaxSetup({
      headers: { 'X-CSRF-Token' : '{{csrf_token()}}' }
  });
//add point
 function myFunction(id){
       var id = (id);
 
       //alert(id);
          var user_id = $("#user_id_"+id).val();
            var point = $("#point_"+id).val();
            //alert(point); return;
            var type = $("#type").val();
            var user_type = $("#user_type").val();
            var date = $("#date").val();
           // alert(user_type);
           var pointcount = $("#point_td_"+id).val();

    $.ajax({
        url: '<?php echo URL::to('point-insert');?>',
        type: "POST",
        dataType: "json",
        data:{
            //  "id":id,
              "user_id":user_id,
              "point":point,
              "type":type,
              "user_type":user_type,
              "date":date,
              "_token": "{{ csrf_token() }}"
             
        },
        success:function(response){
      
            $("#point_td_"+id).html(Number(pointcount)+Number(point));
            $("#point_p_"+id).html(Number(pointcount)+Number(point));
            $(".inp").val("");

            toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  	     	toastr.success("Point Updated");
             
        }
      })
 }

//  remove Point
 function removePoint(id){
       var id = (id);

            var point = $("#point_"+id).val();
            //alert(point); return;
            var type = $("#type").val();
            var user_type = $("#user_type").val();
            var date = $("#date").val(); 
            var remove_point = $("#remive_point_"+id).val();
            var user_id = $("#user_id_"+id).val();
           // alert(remove_point); return;
           var pointcount = $("#point_td_"+id).val();

    $.ajax({
        url: '<?php echo URL::to('remove-point');?>',
        type: "POST",
        dataType: "json",
        data:{
              "point":remove_point,
              "user_id":user_id,
              "type":"0",
              "user_type":user_type,
              "_token": "{{ csrf_token() }}"
             
        },
        success:function(response){
      
             $("#point_td_"+id).html(Number(pointcount)-Number(remove_point));
             $("#point_p_"+id).html(Number(pointcount)-Number(remove_point));
             $(".inp").val("");

            toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  	     	toastr.success("Removed");
             
        }
      })
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
