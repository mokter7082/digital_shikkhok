@extends('welcome')

@section('content')
@php
        date_default_timezone_set("Asia/Dhaka");
        $todaydate = date("Y-m-d");
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
                                <th>Point</th>
                                <th>Ans Count</th>
                                <th>Add Point</th>
                            </tr>
                        </thead>
                                <tbody>
                                @foreach($data_answer_arr as $val)
                                <tr>
                                    <td>{{$val['id']}}</td>
                                    <td>{{$val['name']}}</td>
                                    <td>{{$val['email']}}</td>
                                    <td>{{$val['mobile']}}</td>
                                    <td>
                                        <p>{{$val['total_point']}}</p>
                                        <input type="hidden"  id="point_td_{{$val['id']}}" value="{{$val['total_point']}}" />
                                    </td>
                                    <td>{{$val['anscount']}}</td>
                                    <td> 
                                        <input type="hidden" id="date" value="{{$todaydate}}" />
                                        <input type="hidden" class="form-control" id="user_id_{{$val['id']}}" value="{{$val['id']}}" /> 
                                        <input type="text" class="form-control mb-1 inp" id="point_{{$val['id']}}" name="" />
                                        <select class="form-control form-select form-select-sm" aria-label="form-select-sm example">
                                        <option selected>Select</option>
                                        <option id="type" value="1">Quiz</option>
                                        </select>
                                        <input type="hidden" class="form-control" id="user_type" value="{{$val['type']}}" />
                                        <button class="text-center btn btn-primary btn-sm" onclick="myFunction({{$val['id']}})" type="button">submit</button> 
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
        //    var t = pointcount+point;
        //    alert(pointcount);return;
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
      
            $("#point_td_"+id).html(pointcount+point);
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

 

</script>
@endsection
