@extends('welcome')

@section('content')
<div class="content">
   <div class="container">

             @php
                $june_quens =DB::table('questions')
                            ->where('created_at','>=','2021-06-01')
                            ->where('created_at','<=','2021-06-30')
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

              <?php
                $physcis = DB::select('SELECT * FROM questions WHERE created_at BETWEEN "2021-06-01" AND "2021-06-30" AND subject_id = 7');    
                $physcis_question = count($physcis);
                    ?>
      <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="fa fa-question"></i></span>
                  <a href="{{route('all-question')}}">
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{$physcis_question}}</span>
                       Questions
                      </div>
                  </a>
                  <div class="tiles-progress">
                  <div class="m-t-20">
                  <h5 class="text-uppercase">Physics Questions <span class="pull-right">{{$physcis_question}}</span></h5>
            </div>
            </div>                              
      </div>
      </div>
               @php
               $chemistry = DB::select('SELECT * FROM questions WHERE created_at BETWEEN "2021-06-01" AND "2021-06-30" AND subject_id = 8');
                $chemistry_question = count($chemistry);
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
              $biology = DB::select('SELECT * FROM questions WHERE created_at BETWEEN "2021-06-01" AND "2021-06-30" AND subject_id = 9');
                $biology_question = count($biology);
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
        $math = DB::select('SELECT * FROM questions WHERE created_at BETWEEN "2021-06-01" AND "2021-06-30" AND subject_id = 5');
        $math_question = count($math);
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
      $higher_math = DB::select('SELECT * FROM questions WHERE created_at BETWEEN "2021-06-01" AND "2021-06-30" AND subject_id = 10');
        $higher_math_question = count($higher_math);
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
                $june_ans =DB::table('answers')
                            ->where('created_at','>=','2021-06-01')
                            ->where('created_at','<=','2021-06-30')
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


             <?php  
             
                 $physics_ans =DB::table('answers')
                            ->join('questions','questions.id','=','answers.question_id')
                            ->join('subjects','subjects.id','questions.subject_id')
                            ->select('answers.*','questions.subject_id')
                            ->where('subject_id', '7')
                            ->where('answers.created_at','>=','2021-06-01')
                            ->where('answers.created_at','>=','2021-06-30')
                            ->count();

                     ?>

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
                $chemistry_ans =DB::table('answers')
                            ->join('questions','questions.id','=','answers.question_id')
                            ->join('subjects','subjects.id','questions.subject_id')
                            ->select('answers.*','questions.subject_id')
                            ->where('subject_id', '8')
                            ->where('answers.created_at','>=','2021-06-01')
                            ->where('answers.created_at','>=','2021-06-30')
                            ->count();
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
                $biology_ans =DB::table('answers')
                            ->join('questions','questions.id','=','answers.question_id')
                            ->join('subjects','subjects.id','questions.subject_id')
                            ->select('answers.*','questions.subject_id')
                            ->where('subject_id', '9')
                            ->where('answers.created_at','>=','2021-06-01')
                            ->where('answers.created_at','>=','2021-06-30')
                            ->count();
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
                $math_ans =DB::table('answers')
                            ->join('questions','questions.id','=','answers.question_id')
                            ->join('subjects','subjects.id','questions.subject_id')
                            ->select('answers.*','questions.subject_id')
                            ->where('subject_id', '5')
                            ->where('answers.created_at','>=','2021-06-01')
                            ->where('answers.created_at','>=','2021-06-30')
                            ->count();
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
                $higher_math_ans =DB::table('answers')
                            ->join('questions','questions.id','=','answers.question_id')
                            ->join('subjects','subjects.id','questions.subject_id')
                            ->select('answers.*','questions.subject_id')
                            ->where('subject_id', '10')
                            ->where('answers.created_at','>=','2021-06-01')
                            ->where('answers.created_at','>=','2021-06-30')
                            ->count();
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
