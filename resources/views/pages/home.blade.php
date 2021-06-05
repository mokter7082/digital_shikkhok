@extends('welcome')

@section('content')
<div class="content">
   <div class="container">

   @php
   ini_set('memory_limit', '-1');
   date_default_timezone_set("Asia/Dhaka");
       $todaydate = date("Y-m-d");
       $today_teacher_count = DB::select("SELECT * FROM users WHERE users.type=1 AND users.date  LIKE '%$todaydate%'");
       $teacher_count = count($today_teacher_count);
   @endphp

       
       
             @php
             $teacher = Session::get('type')  
             @endphp
             @if($teacher == '1') 
             <form  method="POST">
                  @csrf
                 <div class="row">
                    <div class="col-md-2">
                    <p class="date"></p>
                    <button class="btn btn-primary" type="button" id="decrement"><i class="fa fa-arrow-left"></i></button>
                    <button class="btn btn-primary" type="button" id="increment"><i class="fa fa-arrow-right"></i></button>
                  </div>
                </div>
            </form>
                <?php
                    $user_id = Session::get('user_id');
                    $today_ans_count = $teacher_ans =  DB::table('ans')
                                                   ->where('user_id',$user_id)->get();
                    $ans_count = count($today_ans_count);

                ?>
                <!-- STAET TEACHERS COMPONENT -->

             <div class="col-md-6 col-sm-6 col-lg-3">
                 <div class="mini-stat clearfix bx-shadow">
                     <span class="mini-stat-icon bg-info"><i class="fa fa-reply"></i></span>
                     <a href="{{URL::to('today-answear')}}">
                     <div class="mini-stat-info text-right text-muted">
                         <span class="a_count counter">{{$ans_count}}</span>
                          Answer
                     </div>
                     </a>
                     <div class="tiles-progress">
                         <div class="m-t-20">
                             <h5 class="text-uppercase">Answer <span class="a_count pull-right">{{$ans_count}}</span></h5>
                         </div>
                     </div>
                 </div>
             </div>
                      @php
                      $pending_count =DB::select("SELECT * FROM `post_q` WHERE status = 0");
                      $pending_count = count($pending_count);
                      @endphp

          <div class="col-md-6 col-sm-6 col-lg-3">
                 <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{URL::to('pending-ques')}}">
                  <div class="mini-stat-info text-right text-muted">
                   <span class="counter">{{$pending_count}}</span>
                       Pending Questio
                  </div>
                  </a>
                  <div class="tiles-progress">
                      <div class="m-t-20">
                        <h5 class="text-uppercase">Pending <span class="pull-right">{{$pending_count}}</span></h5>
                      </div>
              </div>                              
              </div>
          </div>
        <!-- END TEACHER COMPONENT  --> 
            @elseif($teacher == '3')
        <!--START OTHER COMPONENT COMPONENT  --> 
 
               <form  method="POST">
                  @csrf
                 <div class="row">
                    <div class="col-md-2">
                    <p class="date"></p>
                    <button class="btn btn-primary" type="button" id="decrement"><i class="fa fa-arrow-left"></i></button>
                    <button class="btn btn-primary" type="button" id="increment"><i class="fa fa-arrow-right"></i></button>
                  </div>
                </div>
            </form>
                <?php
                    $user_id = Session::get('user_id');
                    $today_ans_count = $teacher_ans =  DB::table('ans')
                                                   ->where('user_id',$user_id)->get();
                    $ans_count = count($today_ans_count);
                ?>
                <!-- STAET TEACHERS COMPONENT -->
             <div class="col-md-6 col-sm-6 col-lg-3">
                 <div class="mini-stat clearfix bx-shadow">
                     <span class="mini-stat-icon bg-info"><i class="fa fa-reply"></i></span>
                     <a href="{{URL::to('today-answear')}}">
                     <div class="mini-stat-info text-right text-muted">
                         <span class="a_count counter">{{$ans_count}}</span>
                          Answer
                     </div>
                     </a>
                     <div class="tiles-progress">
                         <div class="m-t-20">
                             <h5 class="text-uppercase">Answer <span class="a_count pull-right">{{$ans_count}}</span></h5>
                         </div>
                     </div>
                 </div>
             </div>
                      @php
                      $pending_count =DB::select("SELECT * FROM `post_q` WHERE status = 0");
                      $pending_count = count($pending_count);
                      @endphp

          <div class="col-md-6 col-sm-6 col-lg-3">
                 <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{URL::to('pending-ques')}}">
                  <div class="mini-stat-info text-right text-muted">
                   <span class="counter">{{$pending_count}}</span>
                       Pending Question
                  </div>
                  </a>
                  <div class="tiles-progress">
                      <div class="m-t-20">
                        <h5 class="text-uppercase">Pending <span class="pull-right">{{$pending_count}}</span></h5>
                      </div>
              </div>                              
              </div>
          </div>
                   
   <!--END OTHER COMPONENT COMPONENT  --> 
    @elseif($teacher == '4')
            
   <!--  START ADMIN COMPONENT -->
     <form  method="POST">
                  @csrf
                 <div class="row">
                    <div class="col-md-2">
                    <p class="date"></p>
                    <button class="btn btn-primary" type="button" id="decrement"><i class="fa fa-arrow-left"></i></button>
                    <button class="btn btn-primary" type="button" id="increment"><i class="fa fa-arrow-right"></i></button>
                  </div>
                </div>
            </form>

<div class="text-center">
  <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Questioning Time</button>
</div>
  @include('fileInclude.timing-modal')

    
   @php
   ini_set('memory_limit', '-1');
   date_default_timezone_set("Asia/Dhaka");
       $todaydate = date("Y-m-d");
       $today_teacher_count = DB::select("SELECT * FROM users WHERE users.type=1 AND users.date  LIKE '%$todaydate%'");
       $teacher_count = count($today_teacher_count);
   @endphp
     
    <div class="row">
          <div class="col-md-6 col-sm-6 col-lg-3">
          <div class="mini-stat clearfix bx-shadow">
            <span class="mini-stat-icon bg-info"><i class="fa fa-users"></i></span>
            <a href="{{URL::to('today-reg_teacher')}}">
            <div class="mini-stat-info text-right text-muted">
            <span class="t_count counter">{{$teacher_count}}</span>
                    Teachers
                    </div>
                    </a>
                    <div class="tiles-progress">
            <div class="m-t-20">
            <h5 class="text-uppercase">Teachers<span class="pull-right t_count">{{$teacher_count}}</span></h5>
            </div>
            </div>
    </div>
    </div>
                @php
                     $today_student_count = DB::select("SELECT * FROM users WHERE users.type=2 AND users.date  LIKE '%$todaydate%'");
                     $student_count = count($today_student_count);
                @endphp

    <div class="col-md-6 col-sm-6 col-lg-3">
    <div class="mini-stat clearfix bx-shadow">
            <span class="mini-stat-icon bg-info"><i class="fa fa-users"></i></span>
            <a href="{{URL::to('today-reg_student')}}">
            <div class="mini-stat-info text-right text-muted">
                <span class="s_count counter">{{$student_count}}</span>
                Today Total Student
                </div>
                 </a>
          <div class="tiles-progress">
          <div class="m-t-20">
          <h5 class="text-uppercase">Student<span class="s_count pull-right">{{$student_count}}</span></h5>
          </div>
          </div>
    </div>
    </div>

                @php
                    $today_ans_count = DB::select("SELECT * FROM ans WHERE ans.date LIKE '%$todaydate%'");
                    $ans_count = count($today_ans_count);
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
           <span class="mini-stat-icon bg-info"><i class="fa fa-reply"></i></span>
           <a href="{{URL::to('today-answear')}}">
                     <div class="mini-stat-info text-right text-muted">
                     <span class="a_count counter">{{$ans_count}}</span>
                       Answer
                       </div>
                       </a>
                       <div class="tiles-progress">
             <div class="m-t-20">
              <h5 class="text-uppercase">Answer <span class="a_count pull-right">{{$ans_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>
                       @php
                           $today_ques_count = DB::select("SELECT * FROM post_q WHERE post_q.date LIKE '%$todaydate%'");
                           $ques_count = count($today_ques_count);
                       @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{URL::to('today-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="q_count counter">{{$ques_count}}</span>
                       Question
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Question <span class="q_count pull-right">{{$ques_count}}</span></h5>
      </div>
      </div>                              
      </div>
      </div>
                              @php
                              $pending_count =DB::select("SELECT * FROM `post_q` WHERE status = 0");
                              $pending_count = count($pending_count);
                              @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('pending-ques')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$pending_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Pending <span class="pull-right">{{$pending_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>       
       @php
       $anshero = DB::select("SELECT * FROM users WHERE users.type=3 AND users.date  LIKE '%$todaydate%'");
       $anshero = count($anshero);
       @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-reply"></i></span>
              <a href="{{URL::to('all-answer_hero')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="anshero_count counter">{{$anshero}}</span>
                       Answer Hero
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Answer Hero <span class="anshero_count pull-right">{{$anshero}}</span></h5>
              </div>
              </div>
      </div>
      </div>

      @elseif($teacher == '5')
         @php
       $all_teacher = DB::table('users')->where('isTeacher',1)->get();
      $count_teacher = count($all_teacher);

       $sum_t = $count_teacher+105;
      @endphp
    <div class="row">
          <div class="col-md-6 col-sm-6 col-lg-3">
          <div class="mini-stat clearfix bx-shadow">
            <span class="mini-stat-icon bg-info"><i class="fa fa-users"></i></span>
            <a href="{{route('all-teacher')}}">
            <div class="mini-stat-info text-right text-muted">
            <span class="counter">{{$sum_t}}</span>
                    Teachers
                    </div>
                    </a>
                    <div class="tiles-progress">
            <div class="m-t-20">
            <h5 class="text-uppercase">Total Teachers<span class="pull-right">{{$sum_t}}</span></h5>
            </div>
            </div>
    </div>
    </div>
       @php
       $all_student = DB::table('users')->where('type',1)->get();
       $count_student = count($all_student);
       $sum_stu = $count_student+3883;
       @endphp
    <div class="col-md-6 col-sm-6 col-lg-3">
    <div class="mini-stat clearfix bx-shadow">
            <span class="mini-stat-icon bg-info"><i class="fa fa-users"></i></span>
            <a href="{{route('all-student')}}">
            <div class="mini-stat-info text-right text-muted">
                <span class=" counter">{{$sum_stu}}</span>
                 Total Student
                </div>
                 </a>
          <div class="tiles-progress">
          <div class="m-t-20">
          <h5 class="text-uppercase">Total Student<span class="pull-right">{{$sum_stu}}</span></h5>
          </div>
          </div>
    </div>
    </div>

                @php
                 $all_Volunteers = DB::table('volunteers')->get();
                 $count_Volunteers = count($all_Volunteers);
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
           <span class="mini-stat-icon bg-info"><i class="fa fa-reply"></i></span>
           <a href="{{route('all-volunteers')}}">
                     <div class="mini-stat-info text-right text-muted">
                     <span class="a_count counter">{{$count_Volunteers}}</span>
                        Volunteers
                       </div>
                       </a>
                       <div class="tiles-progress">
             <div class="m-t-20">
              <h5 class="text-uppercase">Volunteers <span class="a_count pull-right">{{$count_Volunteers}}</span></h5>
              </div>
              </div>
      </div>
      </div>
                    @php
                    $all_ans =DB::table('ans')->get();
                    $count_ans = count($all_ans);
                    $sum_ans = $count_ans+27759;
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('all-answer')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$sum_ans}}</span>
                       Answer
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Total Answer <span class="pull-right">{{$sum_ans}}</span></h5>
              </div>
              </div>
      </div>
      </div>
                @php
                $all_quens =DB::table('post_q')->get();
                $count_quens = count($all_quens);
                $sum_all_ques = $count_quens+15581;
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$sum_all_ques}}</span>
                       Question
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Total Question <span class="pull-right">{{$sum_all_ques}}</span></h5>
      </div>
      </div>                              
      </div>
      </div>
      @elseif($teacher == '6')
      <!--  START editor COMPONENT -->
     <form  method="POST">
                  @csrf
                 <div class="row">
                    <div class="col-md-2">
                    <p class="date"></p>
                    <button class="btn btn-primary" type="button" id="decrement"><i class="fa fa-arrow-left"></i></button>
                    <button class="btn btn-primary" type="button" id="increment"><i class="fa fa-arrow-right"></i></button>
                  </div>
                </div>
            </form>

        @php
            ini_set('memory_limit', '-1');
            date_default_timezone_set("Asia/Dhaka");
            $todaydate = date("Y-m-d");
            $today_questions = DB::table('post_q')
            ->where('date', 'like', '%' . $todaydate . '%')
            ->count();
         @endphp
    <div class="row">
          <div class="col-md-6 col-sm-6 col-lg-3">
          <div class="mini-stat clearfix bx-shadow">
            <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
            <a href="{{URL::to('today-reg_teacher')}}">
            <div class="mini-stat-info text-right text-muted">
            <span class="q_count counter">{{$today_questions}}</span>
                    Total Questions
                    </div>
                    </a>
                    <div class="tiles-progress">
            <div class="m-t-20">
            <h5 class="text-uppercase">Questions<span class="pull-right q_count">{{$today_questions}}</span></h5>
            </div>
            </div>
    </div>
    </div>
         @php
            ini_set('memory_limit', '-1');
            date_default_timezone_set("Asia/Dhaka");
            $todaydate = date("Y-m-d");
            $today_answer = DB::table('ans')
            ->where('date', 'like', '%' . $todaydate . '%')
            ->count();
         @endphp
    <div class="row">
          <div class="col-md-6 col-sm-6 col-lg-3">
          <div class="mini-stat clearfix bx-shadow">
            <span class="mini-stat-icon bg-info"><i class="fa fa-reply"></i></span>
            <a href="{{URL::to('today-reg_teacher')}}">
            <div class="mini-stat-info text-right text-muted">
            <span class="a_count counter">{{$today_answer}}</span>
                    Total Answer
                    </div>
                    </a>
                    <div class="tiles-progress">
            <div class="m-t-20">
            <h5 class="text-uppercase">Answer<span class="pull-right a_count">{{$today_answer}}</span></h5>
            </div>
            </div>
    </div>
    </div>
      
      @else
      @endif
      </div> <!-- container -->





      </div>
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


     <script>
         $(document).ready(function (){
             var x = "{{$todaydate}}";
             $('.date').text(x);
         })
         $(document).on('click','#increment',function (){

             var val =  $('.date').text();

             $.ajax({
                 url: "{{route('increment')}}",
                 type: "post",
                 data: {
                     "_token": "{{ csrf_token() }}",
                     "id": val
                 },
                 success: function (data) {
                    $('.date').text(data);

                    $.ajax({
                        url: "{{route('getData')}}",
                            type: "post",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "dates": data
                            },
                            success: function (data) {

                               //$('.t_count').text(data.t_count);
                               $.each( data, function( key, value ) {
                                 $('.'+key).text(value);
                               });
                               // $.each(data, fuction(index, value){
                               //   $('.'+index).text(value);
                               // });

                            }
                    });

                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                     console.log(textStatus, errorThrown);
                 }
             });

         })
         $(document).on('click','#decrement',function (){
             var val =  $('.date').text();

             $.ajax({
                 url: "{{route('decrement')}}",
                 type: "post",
                 data: {
                     "_token": "{{ csrf_token() }}",
                     "id": val
                 },
                 success: function (data) {
                     $('.date').text(data);

                     $.ajax({
                         url: "{{route('getData')}}",
                             type: "post",
                             data: {
                                 "_token": "{{ csrf_token() }}",
                                 "dates": data
                             },
                             success: function (data) {

                                //$('.t_count').text(data.t_count);
                                $.each( data, function( key, value ) {
                                  $('.'+key).text(value);
                                });
                                // $.each(data, fuction(index, value){
                                //   $('.'+index).text(value);
                                // });

                             }
                     });
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                     console.log(textStatus, errorThrown);
                 }
             });
         });
    


      $(document).on('click','#q_timing',function (){
        var id = $("#id").val();
        var time_start = $("#start_time").val();
        var time_end = $("#end_time").val();
        var updated_at = $("#up_time").val();
          $.ajax({
                url: "{{url('ques-timing')}}",
                type: "POST",
                dataType: "json",
                data:{
                     "id":id,
                     "time_start":time_start,
                     "time_end":time_end,
                     "updated_at":updated_at,
                     "_token": "{{ csrf_token() }}"
                     
                  },
                  success:function(response){
                    console.log(response);
                   $('.modal').hide();
                   location.reload();
                  }
               })
             
        });

     </script>

@endsection
