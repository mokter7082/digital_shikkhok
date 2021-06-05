@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Agriculture Question</h3>
                                  </div>
                                  <div class="panel-heading">
                               <?php  
            $l_user_id = Session::get('user_id');
             $ins = DB::table('users')
                    ->join('institutes','institutes.user_id','=','users.id')
                    ->join('teachers','teachers.institute_id','=','institutes.id')
                    ->select('institutes.institute_name')
                    ->where('users.id',$l_user_id)            
                    ->first();  
                   // dd($ins);                    
                       $l_user_id = Session::get('user_id');
                      // $ins_name Session::get('institutionname');
                       $username = Session::get('name');
                       $institutionname = @$ins->institute_name;
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
                                                 <th>Date</th>
                                                 <th>Subject</th>
                                                 <th>Answer</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($agriculture_sub as $val)
                                                      <tr id = "tr-{{$val->id}}">
                                                        <input type="hidden" value="{{$val->id}}" id="userId">
                                                        <td>{{$val->id}}</td>
                                                        <td id="q">
                                                        {{$val->quens}}
                                                         @if($val->status == 0)
                                                          <p id="a">No answers yet</p>
                                                          @elseif($val->status == 2)
                                                          <p>Someone is answering this question</p>
                                                          @else
                                                          @endif  
                                                            <input type="hidden" name="a_id" value="{{$val->id}}">
                                                            @if($val->status == 0)
                                                            <button class="btn btn-warning btn-sm edit" id="ans{{$val->id}}">I am Answering</button>
                                        
                                                             @elseif($val->status == 1)
                                                             @else
                                                             @endif
                                                        </td>
                                                        <td>{{$val->date}}</td>
                                                        <td>{{$val->subject}}</td>
                                                        <td>
                                                         
                                                          <input type="hidden" name="id" id="id_{{$val->id}}" value="{{$val->id}}">
                                                          <input type="hidden" name="post_user_id" id="post_user_id_{{$val->id}}" value="{{$val->user_id}}">
                                                          <textarea name="ans" id="ans_{{$val->id}}" rows="3" cols="45" placeholder="Write Answer Here" required></textarea>
                                                          <input type="hidden" name="user_id" id="l_user_id_{{$val->id}}" value="{{$l_user_id}}">
                                                          <input type="hidden" name="username" id="username_{{$val->id}}" value="{{$username }}">
                                                          <input type="hidden" name="subject" id="subject_{{$val->id}}" value="{{$val->subject}}">
                                                          <input type="hidden" name="date" id="date_{{$val->id}}" value="{{$todaydate}}">
                                                          <input type="hidden" name="institutionname" id="institutionname_{{$val->id}}" value="{{$institutionname}}">
                                                          <button class="text-left btn btn-primary btn-sm" onclick="myFunction({{$val->id}})" type="button">submit</button>
                                                         
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


    //*****update data******/
 
    $('.edit').on('click',function(){
       var id = $(this).parents('tr').find('#userId').val();
       //alert(id);
       $.ajax({
        type: "get",
        url: '{{url('answering')}}/' + id,
        dataType: "json",
        success: function(data){
            console.log(data);
           $("#ans"+id).text('Someone is answering this question'); 
           $("#ans"+id).removeClass("btn-warning");
           $("#ans"+id).removeClass("btn"); 
           $("#a").remove();
        }
    });
    })

   function myFunction(id){
    //var id = $("#post_user_id_"+id).val();
     var post_user_id = $("#post_user_id_"+id).val();
     var ans = $("#ans_"+id).val();
      var l_user_id = $("#l_user_id_"+id).val();
      var username = $("#username_"+id).val();
      var subject = $("#subject_"+id).val();
      var date = $("#date_"+id).val();
      var institutionname = $("#institutionname_"+id).val();

        $.ajax({
        url: "{{url('a_insert')}}",
        type: "POST",
        data:{
             "id":id,
             "post_user_id":post_user_id,
             "ans":ans,
             "l_user_id":l_user_id,
             "username":username,
             "subject":subject,
             "date":date,
             "institutionname":institutionname,
             "_token": "{{ csrf_token() }}"
             
        },
        success:function(response){
            console.log(response);
             $("#tr-"+id).hide();

        }
      })
    }
//Search data
      //  $(document).ready(function(){ 
      //      $('#search').keyup(function(){  
      //           search_table($(this).val());  
      //      });  
      //      function search_table(value){  
      //           $('#value_serch tr').each(function(){  
      //                var found = 'false';  
      //                $(this).each(function(){  
      //                     if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
      //                     {  
      //                          found = 'true';  
      //                     }  
      //                });  
      //                if(found == 'true')  
      //                {  
      //                     $(this).show();  
      //                }  
      //                else  
      //                {  
      //                     $(this).hide();  
      //                }  
      //           });  
      //      }  
      // });



</script>


@endsection
