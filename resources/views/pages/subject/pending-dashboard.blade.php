@extends('welcome')

@section('content')
<div class="content">
   <div class="container">
   @php
   date_default_timezone_set("Asia/Dhaka");
       $todaydate = date("Y-m-d");
       $today_teacher_count = DB::select("SELECT * FROM users WHERE users.type=1 AND users.date  LIKE '%$todaydate%'");
       $teacher_count = count($today_teacher_count);
   @endphp

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
             $teacher = Session::get('type')  
             @endphp
             @if($teacher == '1') 
                <?php
                    $user_id = Session::get('user_id');
                    $today_ans_count = $teacher_ans =  DB::table('ans')
                                                   ->where('user_id',$user_id)->get();
                    $ans_count = count($today_ans_count);
                ?>
   <!-- STAET TEACHERS COMPONENT -->
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
                      Total Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Total Pending <span class="pull-right">{{$pending_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>


                    @php
                    $bangla_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'bangla' AND (`status` = 0 OR `status` = 2)");
                    $bangla_count = count($bangla_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('bangla')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$bangla_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Bangla <span class="pull-right">{{$bangla_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>


                    @php
                    $english_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'english' AND (`status` = 0 OR `status` = 2)");
                    $english_count = count($english_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('english')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$english_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">English <span class="pull-right">{{$english_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>
      
                    @php
                    $math_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'math' AND (`status` = 0 OR `status` = 2)");
                    $math_count = count($math_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('math')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$math_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Math <span class="pull-right">{{$math_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $chemistry_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'chemistry' AND (`status` = 0 OR `status` = 2)");
                    $chemistry_count = count($chemistry_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('chemistry')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$chemistry_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Chemistry <span class="pull-right">{{$chemistry_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $physics_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'physics' AND (`status` = 0 OR `status` = 2)");
                    $physics_count = count($physics_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('physics')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$physics_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Physics <span class="pull-right">{{$physics_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>



                   @php
                    $higher_math_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'higher_math' AND (`status` = 0 OR `status` = 2)");
                    $higher_math_count = count($higher_math_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('higher_math')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$higher_math_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Higher Math <span class="pull-right">{{$higher_math_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>


                    @php
                    $accounting_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'accounting' AND (`status` = 0 OR `status` = 2)");
                    $accounting_count = count($accounting_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('accounting')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$accounting_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Accounting <span class="pull-right">{{$accounting_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>
     

                    @php
                    $biology_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'biology' AND (`status` = 0 OR `status` = 2)");
                    $biology_count = count($biology_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('biology')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$biology_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Biology <span class="pull-right">{{$biology_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $geography_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'geography' AND (`status` = 0 OR `status` = 2)");
                    $geography_count = count($geography_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('geography')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$geography_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Geography <span class="pull-right">{{$geography_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $ict_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'ict' AND (`status` = 0 OR `status` = 2)");
                    $ict_count = count($ict_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('ict')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$ict_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Ict <span class="pull-right">{{$ict_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $agriculture_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'agriculture' AND (`status` = 0 OR `status` = 2)");
                    $agriculture_count = count($agriculture_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('agriculture')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$agriculture_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Agriculture <span class="pull-right">{{$agriculture_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>


                    @php
                    $islam_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'islam' AND (`status` = 0 OR `status` = 2)");
                    $islam_count = count($islam_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('islam')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$islam_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Islam <span class="pull-right">{{$islam_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

   <!--  END TEACHER COMPONENT  -->                  
             @else
   <!--  START ADMIN COMPONENT -->

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
                      Total Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Total Pending <span class="pull-right">{{$pending_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>


                    @php
                    $bangla_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'bangla' AND (`status` = 0 OR `status` = 2)");
                    $bangla_count = count($bangla_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('bangla')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$bangla_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Bangla <span class="pull-right">{{$bangla_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>


                    @php
                    $english_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'english' AND (`status` = 0 OR `status` = 2)");
                    $english_count = count($english_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('english')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$english_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">English <span class="pull-right">{{$english_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>
      
                    @php
                    $math_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'math' AND (`status` = 0 OR `status` = 2)");
                    $math_count = count($math_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('math')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$math_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Math <span class="pull-right">{{$math_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $chemistry_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'chemistry' AND (`status` = 0 OR `status` = 2)");
                    $chemistry_count = count($chemistry_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('chemistry')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$chemistry_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Chemistry <span class="pull-right">{{$chemistry_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $physics_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'physics' AND (`status` = 0 OR `status` = 2)");
                    $physics_count = count($physics_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('physics')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$physics_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Physics <span class="pull-right">{{$physics_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>



                   @php
                    $higher_math_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'higher_math' AND (`status` = 0 OR `status` = 2)");
                    $higher_math_count = count($higher_math_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('higher_math')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$higher_math_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Higher Math <span class="pull-right">{{$higher_math_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>


                    @php
                    $accounting_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'accounting' AND (`status` = 0 OR `status` = 2)");
                    $accounting_count = count($accounting_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('accounting')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$accounting_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Accounting <span class="pull-right">{{$accounting_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>
     

                    @php
                    $biology_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'biology' AND (`status` = 0 OR `status` = 2)");
                    $biology_count = count($biology_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('biology')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$biology_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Biology <span class="pull-right">{{$biology_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $geography_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'geography' AND (`status` = 0 OR `status` = 2)");
                    $geography_count = count($geography_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('geography')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$geography_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Geography <span class="pull-right">{{$geography_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                     @php
                    $ict_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'ict' AND (`status` = 0 OR `status` = 2)");
                    $ict_count = count($ict_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('ict')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$ict_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Ict <span class="pull-right">{{$ict_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>

                    @php
                    $agriculture_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'agriculture' AND (`status` = 0 OR `status` = 2)");
                    $agriculture_count = count($agriculture_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('agriculture')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$agriculture_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Agriculture <span class="pull-right">{{$agriculture_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>


       @php
                    $islam_pending_count =DB::select("SELECT * FROM `post_q` WHERE `subject` = 'islam' AND (`status` = 0 OR `status` = 2)");
                    $islam_count = count($islam_pending_count);
                    @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('islam')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$islam_count}}</span>
                       Pending Question
                      </div>
                      </a>
                      <div class="tiles-progress">
              <div class="m-t-20">
              <h5 class="text-uppercase">Islam <span class="pull-right">{{$islam_count}}</span></h5>
              </div>
              </div>
      </div>
      </div>



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


     </script>

@endsection
