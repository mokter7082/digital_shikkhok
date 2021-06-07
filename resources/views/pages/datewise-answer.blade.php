@extends('welcome')

@section('content')
<div class="content">
<div class="container">

   <div class="row">
     <form method="POST" action="{{route('answer-search')}}">
        @csrf
     <div class="col-md-2">
       <label for="">Start Date</label>
       <input class="form-control" type="date" name="start_date" value="{{date('Y-m-d')}}">
       <label for="">End Start</label>
       <input class="form-control" type="date" name="end_date" value="{{date('Y-m-d')}}">
       <button style="margin-top: 2px;" class="btn btn-primary btn-sm pull-right" id="">Search</button>
       </form>
      </div>
   </div>

<!-- /****END BASIC DATE SETUP***/ -->
<!-- /****START TEACHER TABLE DESIGN SETUP***/ -->
  <div class="row">
  <div class="col-md-12">
  <div class="panel panel-default">               
	<div class="panel-body">
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
			 <table id="datatable" class="table table-striped table-bordered">
			   <thead>
				    <tr>
              <th>Ques ID</th>
				      <th>Name</th>
              <th>Mobile Number</th>
				      <th>Answer</th>
              <th>Subject</th>
              <th>Date</th>
              <th>Designation</th>
				      <th>Institute Name</th>
              <th>Action</th>
				    </tr>
			   </thead>
			   <tbody>
               <?php
               $editedData = [];
               ?>
          @foreach($datewise_ans as $value)
          <?php
             $editedData['id'] = $value->id;
             $editedData['ans'] = $value->ans;
          ?>
          <tr>
             <input type="hidden" id="a_id" name=""  value="{{$value->id}}">
             <td>{{$value->post_id}}</td>
              <td>{{$value->user_name}}</td>
              <td>{{$value->mobile}}</td>
              <td id = "answer_td_{{$value->id}}">{{$value->ans}}</td>
              
              <td>{{$value->subject}}</td>
              <td>{{$value->date}}</td>
              <td>
                 @if($value->type == '1')
                 <p>Teacher</p>
                 @elseif($value->type == '2')
                 <p>Student</p>
                 @elseif($value->type == '3')
                 <p>Answer Hero</p>
                 @elseif($value->type == '4')
                 <p>Admin</p>
                  @elseif($value->type == '5')
                 <p>Other</p>
                  @elseif($value->type == '6')
                 <p>Editor</p>
                 @else
                 @endif
              </td>
              <td>{{$value->institutionname}}</td>
              <td>
                   <!-- <button class="btn btn-warning btn sm" id="edit" data-toggle="modal" data-target="#con-close-modal">Edit</button> -->
                   <button class="edit_ans btn btn-warning btn sm" data-text='<?php echo json_encode($editedData, JSON_UNESCAPED_UNICODE); ?>'  data-toggle="modal" id="ans_edit{{$value->id}}"  data-target="#con-close-modal">Edit</button>
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
</div>
</div>
@include('modal.answer-updatemodal')
<script>
$(document).on('click', '.edit_ans', function () {
        //$(".edit_icon").click(function (e) {
       

        var data = $(this).attr("data-text");
        var data_text = $(this).closest('tr').find('td:nth-child(5)').html();
        //console.log($(this).closest('tr').find('td:nth-child(2)').html());
        var obj = JSON.parse(data);
        
        var ans = data_text; //
        $('#exampleFormControlTextarea1').val(ans);
               
        var ans_id = obj.id; //
        $('#ans_id').val(ans_id);
        


    });

    $("#update_ans").click(function (e) {
        //alert();
        var id = $("#ans_id").val();
        var ans = $("#exampleFormControlTextarea1").val();

      //  $(".modal").modal('hide');

        var url = '<?php echo URL::to('answer-update');?>';
        //var form = $("#iconEdit");
        // var camp_name=$("#edit_icon_campaign_name").val();
        $.ajax({
            type: 'post',
            url: url,
            data:{
             "id":id,
             "ans":ans,
             "_token": "{{ csrf_token() }}"  
        },
            success: function (response ) {
              console.log(response);
              if(response.status===200) {
                // loop through all modal's and call the Bootstrap
                // modal jQuery extension's 'hide' method
                $("#answer_td_"+id).html(ans);
                $('.modal').each(function(){
                    $(this).modal('hide');
                });
                console.log('success');
            } else {
                console.log('failure');
            }
                
            }
        });

    });

function ans_edit(id){
    $.ajax({
            url: '<?php echo URL::to('answer-update');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
           // $("#tr-"+id).remove();
            }
          });
}
</script>

 @endsection
     