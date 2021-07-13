@extends('welcome')

@section('content')
<div class="content">
   <div class="container">


                  @php
                  $pending_count = DB::table('questions')
                                ->where('status',0)
                                ->count();
                  
                  @endphp

      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
              <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
              <a href="{{URL::to('pending-ques')}}">
                      <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$pending_count}}</span>
                      Total Pending 
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
                    $bangla_count = DB::table('questions')
                                ->where('subject_id', '1')
                                ->where(function($query) {
                                $query->where('status', '0')
                                ->orWhere('status', '0');
                                })->count();
                    
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
                    $english_count = DB::table('questions')
                                        ->where('subject_id', '3')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
                    
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
                    $math_count = DB::table('questions')
                                        ->where('subject_id', '5')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
                   
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
                    $chemistry_count = DB::table('questions')
                                        ->where('subject_id', '8')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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
                    $physics_count = DB::table('questions')
                                        ->where('subject_id', '7')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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
                    $higher_math_count = DB::table('questions')
                                        ->where('subject_id', '10')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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
                    $accounting_count = DB::table('questions')
                                        ->where('subject_id', '12')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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
                    $biology_count =DB::table('questions')
                                        ->where('subject_id', '9')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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
                    $geography_count = DB::table('questions')
                                        ->where('subject_id', '14')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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
                    $ict_count =DB::table('questions')
                                        ->where('subject_id', '11')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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
                    $agriculture_count = DB::table('questions')
                                        ->where('subject_id', '13')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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
                    $islam_count =DB::table('questions')
                                        ->where('subject_id', '6')
                                        ->where(function($query) {
                                        $query->where('status', '0')
                                        ->orWhere('status', '0');
                                        })->count();
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

      </div> <!-- container -->
      </div>
@endsection
