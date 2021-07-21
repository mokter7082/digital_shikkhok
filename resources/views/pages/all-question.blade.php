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
                                      <h3 class="panel-title">All Question</h3>
                                  </div>
                                  <div class="panel-heading">
                                
                                    <h3 class="panel-title"></h3>
                                  </div>
                                  <?php 
                                    $que_approval = DB::table('question_approaval')->first(); 
                                  ?>

                              

                                 <?php
                                 // $all_qus = DB::select("SELECT post_q.quens,post_q.id,post_q.user_id,post_q.subject,post_q.status, COUNT(ans.ans) ans_ct FROM `post_q` LEFT JOIN ans ON post_q.id = ans.post_id GROUP BY post_q.id,post_q.quens,ans.ans,post_q.id,post_q.user_id,post_q.subject,post_q.status");


                                   $all_qus = DB::table('post_q')->orderBy('date','DESC')->get();
                                   
                                    $l_user_id = Session::get('user_id');
                                    // $ins_name Session::get('institutionname');
                                     $username = Session::get('name');
                                     $institutionname = Session::get('institutionname');
                                     date_default_timezone_set("Asia/Dhaka");
                                      $todaydate = date("Y-m-d");
                                 ?>
                                 <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                               <th>ID</th>
                                               <th>Question</th>
                                               <th>Date</th>
                                               <th>Answer</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($all_qus as $val)
                                                      <tr id = "tr-{{$val->id}}">
                                                        <td>{{$val->id}}</td>
                                                        <td>
                                                          {{$val->quens}}
                                                          @if($val->status == 0)
                                                          <p>No answers yet</p>
                                                          @else
                                                          @endif   
                                                      </td>
                                                      <td>{{$val->date}}</td>
                                                        <td>
                                                          <form method="post" action="{{route('ans-submit')}}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$val->id}}">
                                                            <input type="hidden" name="post_user_id" value="{{$val->user_id}}">
                                                          <textarea name="ans" rows="3" cols="30" placeholder="Write Answer Here" required></textarea>
                                                          <input type="hidden" name="user_id" value="{{$l_user_id}}">
                                                          <input type="hidden" name="username" value="{{$username }}">
                                                          <input type="hidden" name="subject" value="{{$val->subject}}">
                                                          <input type="hidden" name="date" value="{{$todaydate}}">
                                                          <input type="hidden" name="institutionname" value="{{$institutionname}}">
                                                          <button class="text-center btn btn-primary btn-sm">submit</button>
                                                          </form>
                                                        </td>
                                                      </tr>
                                                     @endforeach
                                                  </tbody>
                                              </table>
                                        
                                          </div>
                                      </div>
                                  </div>
                              @elseif($teacher == '3')
                              @php
                                $all_qus = DB::table('post_q')
                                ->join('subjects','subjects.id','=','post_q.subject_id')
                                ->select('post_q.*','subjects.name as sname')
                                ->get();
                              @endphp
                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Questions</th>
                                                  <th>Date</th>
                                                  <th>Subject</th>                                 
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($all_qus as $val)
                                                      <tr id="tr-{{$val->id}}">
                                                        <td>{{$val->id}}</td>
                                                        <td>{{$val->quens}}</td>
                                                        <td>{{$val->date}}</td>
                                                        <td>{{$val->sname}}</td>
                                                      </tr>
                                                     @endforeach
                                                  </tbody>
                                              </table>
                                        
                                          </div>
                         @elseif($teacher == '4')
                                    
                                <?php 
                                    $que_approval = DB::table('question_approaval')->first(); 
                                  ?>

                             <div class="text-center">
                              @if($que_approval->is_approval_on == 1)         
                                     <input type="checkbox"  id="approve_check" onChange="ques_approval({{$que_approval->id}})" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="danger" data-offstyle="light" data-width="90" data-height="30" style="font-size:38px">        
                                @else
                                   <input checked type="checkbox"  id="approve_check" onChange="ques_approval({{$que_approval->id}})" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="danger" data-offstyle="light" data-width="90" data-height="30" style="font-size:38px">
                                   @endif
                                   <!-- <input type="checkbox"> -->
                              </div>
                    
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="my_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>SL</th>
                                                  <th>Name</th>
                                                  <th>Mobile</th>
                                                  <th>Institutions Name</th>
                                                  <th>Questions</th>
                                                  <th>Date</th>
                                                  <th>Subject</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                           
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
 @elseif($teacher == '5')
             @php
        $all_qus = DB::table('post_q')->orderBy('date','DESC')->get();
      @endphp
    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                <table id="" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                    
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>Date</th>
                          <th>Question</th>
             
                      </tr>
                  </thead>
                          <tbody>
                            @foreach($all_qus as $val)
                              <tr id = "tr-{{$val->id}}">
          
                              <td>{{$val->user_name}}</td>
                              <td>{{$val->user_email}}</td>
                              <td>{{$val->date}}</td>
                              <td>{{$val->quens}}</td>
                    
                              </tr>
                             @endforeach
                          </tbody>
                      </table>
                
                  </div>
 @elseif($teacher == '6')
        <!-- EDITOR -->
               <div class="panel-body">
                      <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                      <table id="my_table" class="table table-striped table-bordered">
                         <thead>
                            <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Institutions Name</th>
                            <th>Questions</th>
                            <th>Date</th>
                            <th>Subject</th>
                            </tr>
                         </thead>
                        <tbody>
                             
                        </tbody>   
                    </table>    
           </div>
           </div>
           </div>
  @else
  @endif
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!--START AJAX SERVERSITE DATATABLE-->
<script type="text/javascript">
  var table;
  jQuery(document).ready(function ($) {
    table = $('#my_table').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      pageLength: 0,
      lengthMenu: [10, 50, 100, 500, 1000,5000],
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo route('all_ques_data'); ?>",
        "type": "POST",
        "data": function(data) {
           data._token = "{{ csrf_token() }}";
          // data.dates = $('.date').text();
        }
      },

      //Set column definition initialisation properties.
      "columnDefs": [
        {
          "targets": [0, -1], //first, second and last column
          "orderable": false, //set not orderable
        },
      ],

    });
    
    $('#search').on( 'click change', function (event) {
      event.preventDefault();
      table.draw();
      serach = 'SEARCH';
    });

  });

  function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
  }
</script>
<!--END SERVERSITE DATATABLE-->
<script type="text/javascript">

  function verification(id){
        var bclass = $("#approve_"+id).hasClass("btn-primary");
        //alert(bclass);
        if($("#approve_"+id).hasClass("btn-primary")){
          $.ajax({
            url: '<?php echo URL::to('ques-approve');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            $("#approve_"+id).text('Disapprove'); //versions newer than 1.6
            $("#approve_"+id).removeClass("btn-primary");
            $("#approve_"+id).addClass("btn-danger");
            }
          });
        }else {
          $.ajax({
            url: '<?php echo URL::to('ques-disapprove');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
             $("#approve_"+id).text('Approve'); //versions newer than 1.6
             $("#approve_"+id).removeClass("btn-danger");
             $("#approve_"+id).addClass("btn-primary");
            }
          });
        }
  }

 function q_delete(id){
       var t_td = (id);
      $('.delete').click(function(){
        swal({   
            title: "Are you sure?",   
            text: "Delete this Question!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete ",   
            closeOnConfirm: false 
        }, function(){ 
          $.ajax({
            url: '<?php echo URL::to('ques-delete');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
            //$("#tr-"+id).hide();
            reload_table();
            
            }
          });  
            swal("Deleted!", "Your Question delete successfull.", "success"); 
        });
    });        
 }





function ques_approval(id) {

  var status = $('#approve_check').is(":checked");
  //alert(status);

  if(status == true){
   // alert(id);
     //return false;
    $.ajax({
            url: '<?php echo URL::to('approval-disable');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
           
            console.log(html);
           
            }
          });
  }else{
    $.ajax({
            url: '<?php echo URL::to('approval-anable');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
           
            }
          });
  }

}



</script>

@endsection
