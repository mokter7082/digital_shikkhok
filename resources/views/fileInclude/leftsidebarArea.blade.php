<div class="left side-menu">
<div class="sidebar-inner slimscrollleft">
<div class="sidebar-inner slimscrollleft">
    <div class="user-details">
        <div class="pull-left">
            <img src="{{url('images/users/download.jpg')}}" alt="" class="thumb-md img-circle">
        </div>
        @php
          $name =Session::get('name');
          $teacher = Session::get('type')
        @endphp
        <div class="user-info">
            <div class="dropdown">
                <a href="{{URL::to('/dashboard')}}" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{$name}}</a>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                    <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                    <li><a href="{{url::to('logout')}}"><i class="md md-settings-power"></i> Logout</a></li>
                </ul>
            </div>
                @if($teacher == '1')
                <p class="text-muted m-0">Teacher</p>
                @elseif($teacher == '3')
                <p class="text-muted m-0">Answer Hero</p>
                @elseif($teacher == '4')
                <p class="text-muted m-0">Administrator</p>
                @elseif($teacher == '5')
                @elseif($teacher == '6')
                <p class="text-muted m-0">Editor</p>
                @else
                @endif
        </div>
    </div>
    <!--- Divider -->
    <div id="sidebar-menu">
        <ul>
            <li>
                <a href="{{URL::to('/dashboard')}}" class="waves-effect active"><i class="md md-home"></i><span> Dashboard </span></a>
            </li>
             @php
               $teacher = Session::get('type')
             @endphp
              @if($teacher == '1')
             <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-question"></i> <span>Question</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                   <!--  <li><a href="{{route('all-question')}}">All Question</a></li> -->
                    <li><a href="{{route('today-question')}}">Today Question</a></li>
                    <li><a href="{{route('pending-ques')}}">Pending Question</a></li>
                </ul>
            </li>
             <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-reply"></i> <span>Subject wise Ques</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('pending-dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('bangla')}}">Bangla</a></li>  
                    <li><a href="{{route('english')}}">English</a></li> 
                    <li><a href="{{route('math')}}">Math</a></li> 
                    <li><a href="{{route('chemistry')}}">Chemistry</a></li> 
                    <li><a href="{{route('physics')}}">Physics</a></li> 
                    <li><a href="{{route('higher_math')}}">Higher Math</a></li> 
                    <li><a href="{{route('accounting')}}">Accounting</a></li> 
                    <li><a href="{{route('biology')}}">Biology</a></li> 
                    <li><a href="{{route('geography')}}">Geography</a></li> 
                    <li><a href="{{route('ict')}}">Ict</a></li> 
                    <li><a href="{{route('agriculture')}}">Agriculture</a></li> 
                    <li><a href="{{route('islam')}}">islam</a></li>         
                </ul>
            </li>
                 @elseif($teacher == '3')
            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-question"></i> <span>Question</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                   <!--  <li><a href="{{route('all-question')}}">All Question</a></li> -->
                    <li><a href="{{route('today-question')}}">Today Question</a></li>
                    <li><a href="{{route('pending-ques')}}">Pending Question</a></li>
                </ul>
            </li>
             <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-reply"></i> <span>Subject wise Ques</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('pending-dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('bangla')}}">Bangla</a></li>  
                    <li><a href="{{route('english')}}">English</a></li> 
                    <li><a href="{{route('math')}}">Math</a></li> 
                    <li><a href="{{route('chemistry')}}">Chemistry</a></li> 
                    <li><a href="{{route('physics')}}">Physics</a></li> 
                    <li><a href="{{route('higher_math')}}">Higher Math</a></li> 
                    <li><a href="{{route('accounting')}}">Accounting</a></li> 
                    <li><a href="{{route('biology')}}">Biology</a></li> 
                    <li><a href="{{route('geography')}}">Geography</a></li> 
                    <li><a href="{{route('ict')}}">Ict</a></li> 
                    <li><a href="{{route('agriculture')}}">Agriculture</a></li> 
                    <li><a href="{{route('islam')}}">islam</a></li>         
                </ul>
            </li>

           <!--  ADMIN COMPONENT -->
                @elseif($teacher == '4')
                    
            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-user"></i><span>Teacher</span><span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('all-teacher')}}">All Teaches</a></li>
                    <li><a href="{{route('today-reg_teacher')}}">Today Register Teacher</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-user"></i><span>Student</span><span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('all-student')}}">All Student</a></li>
                    <li><a href="{{route('today-reg_student')}}">Today Register Student</a></li>
                   
                </ul>
            </li>
              <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Scholarship</span><span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('all-scholarship')}}">All Scholarship</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-question"></i> <span>Question</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('all-question')}}">All Question</a></li>
                    <li><a href="{{route('today-question')}}">Today Question</a></li>
                    <li><a href="{{route('multi-answered_ques')}}">Multi Answred Ques</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-reply"></i> <span>Answer</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('all-answer')}}">All Answer</a></li>
                    <li><a href="{{route('today-answear')}}">Today Answer</a></li>
                    <li><a href="{{route('last_week-answer')}}">Last Week Answer</a></li>
                    <li><a href="{{route('daily-answer')}}">Daily Answer</a></li>
                    <li><a href="{{route('monthly-answer')}}">Monthly Answer</a></li>
                </ul>
            </li>
              <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-reply"></i> <span>Answer Hero</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('all-answer_hero')}}">All Answer Hero</a></li>
                </ul>
            </li>
              <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-reply"></i> <span>Ques & Ans</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('ques-ans')}}">List</a></li>          
                </ul>
            </li>
            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-reply"></i> <span>Subject wise Ques</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('pending-dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('bangla')}}">Bangla</a></li>  
                    <li><a href="{{route('english')}}">English</a></li> 
                    <li><a href="{{route('math')}}">Math</a></li> 
                    <li><a href="{{route('chemistry')}}">Chemistry</a></li> 
                    <li><a href="{{route('physics')}}">Physics</a></li> 
                    <li><a href="{{route('higher_math')}}">Higher Math</a></li> 
                    <li><a href="{{route('accounting')}}">Accounting</a></li> 
                    <li><a href="{{route('biology')}}">Biology</a></li> 
                    <li><a href="{{route('geography')}}">Geography</a></li> 
                    <li><a href="{{route('ict')}}">Ict</a></li> 
                    <li><a href="{{route('agriculture')}}">Agriculture</a></li> 
                    <li><a href="{{route('islam')}}">Islam</a></li>         
                </ul>
            </li>
            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-reply"></i> <span>Leader board</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('le_all-teacher')}}">Teacher</a></li>
                    <li><a href="{{route('le_all-student')}}">Student</a></li>
                    <li><a href="{{route('le_all-anshero')}}">Answer Hero</a></li>
                </ul>
            </li>
            @elseif($teacher == '5')
               <!-- THIS CONTENT FOR TYPE 5 -->
            @elseif($teacher == '6')
            <!-- TYPE 6 IS EDITOR CONTENT -->
              <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-question"></i> <span>Question</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                 <ul class="list-unstyled">
                    <li><a href="{{route('all-question')}}">All Question</a></li>
                    <li><a href="{{route('today-question')}}">Today Question</a></li>
                    <li><a href="{{route('multi-answered_ques')}}">Multi Answred Ques</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-reply"></i> <span>Answer</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('all-answer')}}">All Answer</a></li>
                    <li><a href="{{route('today-answear')}}">Today Answer</a></li>
                    <li><a href="{{route('last_week-answer')}}">Last Week Answer</a></li>
                    <li><a href="{{route('daily-answer')}}">Daily Answer</a></li>
                    <li><a href="{{route('monthly-answer')}}">Monthly Answer</a></li>
                </ul>
            </li>
            @else
            @endif
        </ul>

        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>
</div>
</div>
</div>
         
