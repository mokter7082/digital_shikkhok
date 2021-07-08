@extends('welcome')

@section('content')
<div class="content">
   <div class="container">

             @php
                $june_quens =DB::table('post_q')
                            ->where('date','>=','2021-06-01')
                            ->where('date','<=','2021-06-30')
                            ->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$june_quens}}</span>
                       Question
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Total Questions<span class="pull-right">{{$june_quens}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>

              @php
                $physics_question =DB::table('post_q')
                    ->where('subject', 'physics')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$physics_question}}</span>
                       Questions
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Physics Questions <span class="pull-right">{{$physics_question}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>
               @php
                $chemistry_question =DB::table('post_q')
                    ->where('subject', 'chemistry')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$chemistry_question}}</span>
                       Questions
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Chemistry Questions<span class="pull-right">{{$chemistry_question}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>
      @php
                $biology_question =DB::table('post_q')
                    ->where('subject', 'biology')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$biology_question}}</span>
                       Questions
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Biology Questions<span class="pull-right">{{$biology_question}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>


        @php
        $math_question =DB::table('post_q')
                    ->where('subject', 'math')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$math_question}}</span>
                       Questions
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Math Questions<span class="pull-right">{{$math_question}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>
      

      @php
        $higher_math_question =DB::table('post_q')
                    ->where('subject', 'higher_math')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$higher_math_question}}</span>
                       Questions
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Higher Math Questions<span class="pull-right">{{$higher_math_question}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>  

                 @php
                $june_ans =DB::table('ans')
                            ->where('date','>=','2021-06-01')
                            ->where('date','<=','2021-06-30')
                            ->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$june_ans}}</span>
                       Answer
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Total Answer <span class="pull-right">{{$june_ans}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>


      @php
                $physics_ans =DB::table('ans')
                    ->where('subject', 'physics')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$physics_ans}}</span>
                      Answer
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Physics Answer <span class="pull-right">{{$physics_ans}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>

              @php
                $chemistry_ans =DB::table('ans')
                    ->where('subject', 'chemistry')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$chemistry_ans}}</span>
                       Answer
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Chemistry Answer<span class="pull-right">{{$chemistry_ans}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>

            @php
                $biology_ans =DB::table('ans')
                    ->where('subject', 'biology')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$biology_ans}}</span>
                      Answer
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Biology Answer<span class="pull-right">{{$biology_ans}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>
    

      @php
                $math_ans =DB::table('ans')
                    ->where('subject', 'math')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$math_ans}}</span>
                      Answer
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Math Answer<span class="pull-right">{{$math_ans}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>
      

      @php
                $higher_math_ans =DB::table('ans')
                    ->where('subject', 'higher_math')
                    ->where(function($query) {
                      $query->where('date','>=','2021-06-01')
                      ->orWhere('date','<=','2021-06-30');
                     })->count();
                @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$higher_math_ans}}</span>
                      Answer
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Higher Math Answer<span class="pull-right">{{$higher_math_ans}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>


      
      </div> <!-- container -->
      </div>

@endsection
