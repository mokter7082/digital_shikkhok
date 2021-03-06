<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswearController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Middleware\DashboardMiddleware;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\volunteerController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\AnnouncementController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//SUPER ADMIN CONTROL HERE
Route::get('/',[Homecontroller::class,'adminLogin']);
Route::post('/login',[SuperadminController::class,'Login'])->name('login');
Route::get('/logout',[SuperadminController::class,'Logout'])->name('logout');


Route::middleware([DashboardMiddleware::class])->group(function(){
 Route::get('/dashboard',[SuperadminController::class,'adminDashboard'])->name('dashboard');
 Route::post('/ques-timing',[TeacherController::class,'quesTiming'])->name('ques-timing');


 
//teacher route
Route::get('/all-teacher',[TeacherController::class,'allTeacher'])->name('all-teacher');
Route::get('/teacher-inactive',[TeacherController::class,'teacherInactive'])->name('teacher-inactive');
Route::get('/teacher-active',[TeacherController::class,'teacherActive'])->name('teacher-active');
Route::get('/add-subject/{id}',[TeacherController::class,'addSubject'])->name('add-subject');
Route::get('/edit-teacher/{id}',[TeacherController::class,'editTeacher'])->name('edit-teacher');
 Route::post('/update-teacher/{id}',[TeacherController::class,'updateTeacher'])->name('update-teacher');
Route::post('/insert-teacher',[TeacherController::class,'insertTeacher'])->name('insert-teacher');
Route::get('/today-reg_teacher',[TeacherController::class,'todayRegteacher'])->name('today-reg_teacher');
Route::get('/teacher-delete',[TeacherController::class,'teacherDelete'])->name('teacher-delete');
Route::get('/teacher-view/{id}',[TeacherController::class,'teacherView'])->name('teacher-view');
Route::get('/answer-hero',[TeacherController::class,'answerHero'])->name('answer-hero');
Route::get('/teacher-block',[TeacherController::class,'teacherBlock'])->name('teacher-block');
Route::get('/teacher-unblock',[TeacherController::class,'teacherUnblock'])->name('teacher-unblock');
Route::get('/active-teacher',[TeacherController::class,'activeTeacher'])->name('active-teacher');
   //student route
Route::get('/all-student',[StudentController::class,'allStudent'])->name('all-student');
Route::post('/studentData',[StudentController::class,'studentData'])->name('studentData');
Route::post('/edit-student',[StudentController::class,'editStudent'])->name('edit-student');
Route::post('/update-student',[StudentController::class,'updateStudent'])->name('update-student');
//Route::get('/all_stu_data',[StudentController::class,'allstuData'])->name('all_stu_data');
Route::get('/today-reg_student',[StudentController::class,'todaySturegister'])->name('today-reg_student');
Route::get('/student-inactive',[StudentController::class,'studentInactive'])->name('student-inactive');
Route::get('/student-active',[StudentController::class,'studentActive'])->name('student-active');
Route::get('/student-delete',[StudentController::class,'studentDelete'])->name('student-delete');
Route::get('/student-refar',[StudentController::class,'studentRefar'])->name('student-refar');
Route::get('/student-block',[StudentController::class,'studentBlock'])->name('student-block');
Route::get('/student-unblock',[StudentController::class,'studentUnblock'])->name('student-unblock');
Route::get('/active-student',[StudentController::class,'activeStudent'])->name('active-student');


//question routes
Route::get('/all-question',[QuestionController::class,'allQuestion'])->name('all-question');
Route::post('/all_ques_data',[QuestionController::class,'allQuesData'])->name('all_ques_data');
Route::get('/today-question',[QuestionController::class,'todayQuestion'])->name('today-question');
Route::get('/custom-question',[QuestionController::class,'customQuestion'])->name('custom-question');
Route::post('/date-custom_ques',[QuestionController::class,'dateCustom'])->name('date-custom_ques');
Route::get('/ques-approve',[QuestionController::class,'quesApprove'])->name('ques-approve');
Route::get('/ques-disapprove',[QuestionController::class,'quesDisapprove'])->name('ques-disapprove');
Route::get('/ques-delete',[QuestionController::class,'quesDelete'])->name('ques-delete');
Route::get('/approval-anable',[QuestionController::class,'approvalAnable'])->name('approval-anable');
Route::get('/approval-disable',[QuestionController::class,'approvalDisable'])->name('approval-disable');
Route::get('/ques-ans',[QuestionController::class,'quesAns'])->name('ques-ans');
Route::post('/ques_and_ans_data',[QuestionController::class,'quesAnsData'])->name('ques_and_ans_data');
Route::get('/pending-ques',[QuestionController::class,'pendingQues'])->name('pending-ques');
Route::get('/today_pen-ques',[QuestionController::class,'todayPending_ques'])->name('today_pen-ques');
Route::get('/single-answered_ques',[QuestionController::class,'singleAnswered_ques'])->name('single-answered_ques');
Route::get('/multi-answered_ques',[QuestionController::class,'multiAnswered_ques'])->name('multi-answered_ques');
Route::get('/single-date',[QuestionController::class,'singleDate'])->name('single-date');
Route::post('/single_date_data',[QuestionController::class,'singleDatedata'])->name('single_date_data');



//answer routes

Route::get('/all-answer',[AnswearController::class,'allAnswer'])->name('all-answer');
Route::post('/all_answer_data',[AnswearController::class,'allanswerDataFetch'])->name('all_answer_data');
Route::get('/today-answear',[AnswearController::class,'todayAnswear'])->name('today-answear');
Route::get('/custom-answear',[AnswearController::class,'customAnswear'])->name('custom-answear');
Route::post('/date-custom_answer',[AnswearController::class,'dateCustom_answer'])->name('date-custom_answer');
Route::get('/ans-delete',[AnswearController::class,'ansDelete'])->name('ans-delete');
Route::get('/answer-delete',[AnswearController::class,'answerDelete'])->name('answer-delete');
Route::post('/a_insert',[AnswearController::class,'Ainsert'])->name('a_insert');
Route::get('/answering/{id}',[AnswearController::class,'Answering'])->name('answering');
Route::post('weekly-decrement',[AnswearController::class,'weeklyDecrement'])->name('weekly-decrement');
Route::post('weekly-increment',[AnswearController::class,'weeklyIncrement'])->name('weekly-increment');
Route::post('/get_l_Data',[AnswearController::class,'getldata'])->name('get_l_Data');
Route::post('/get_Data',[AnswearController::class,'getData'])->name('get_Data');
Route::get('/last_week-answer',[AnswearController::class,'lastweekAnswer'])->name('last_week-answer');
Route::post('/ajax_data',[AnswearController::class,'ajaxList'])->name('ajax_data');
Route::get('/daily-answer',[AnswearController::class,'dailyAnswer'])->name('daily-answer');
Route::post('daily-decrement',[AnswearController::class,'dailyDecrement'])->name('daily-decrement');
Route::post('daily-increment',[AnswearController::class,'dailyIncrement'])->name('daily-increment');
Route::post('daily_answer_data',[AnswearController::class,'dailyAnswerData'])->name('daily_answer_data');
Route::get('/monthly-answer',[AnswearController::class,'monthlyAnswer'])->name('monthly-answer');
Route::post('monthly-decrement',[AnswearController::class,'monthlyDecrement'])->name('monthly-decrement');
Route::post('monthly_answer_data',[AnswearController::class,'monthlyAnswerData'])->name('monthly_answer_data');
Route::post('save',[AnswearController::class,'Save'])->name('save');
Route::get('/all-answer_hero',[AnswearController::class,'allAnswer_hero'])->name('all-answer_hero');
Route::get('/today-answer_hero',[AnswearController::class,'todayAnswer_hero'])->name('today-answer_hero');
Route::get('/datewise-answer',[AnswearController::class,'datewiseAnswer'])->name('datewise-answer');
Route::post('/answer-search',[AnswearController::class,'answerSearch'])->name('answer-search');
Route::post('/answer-update',[AnswearController::class,'answerUpdate'])->name('answer-update');
Route::get('/anshero-block',[AnswearController::class,'ansheroBlock'])->name('anshero-block');
Route::get('/anshero-unblock',[AnswearController::class,'ansheroUnblock'])->name('anshero-unblock');
Route::get('/active-anshero',[AnswearController::class,'activeAnshero'])->name('active-anshero');
//Flags
Route::get('/flags-answer',[AnswearController::class,'flagsAnswer'])->name('flags-answer');
Route::get('/flags-delete',[AnswearController::class,'flagsDelete'])->name('flags-delete');
Route::get('/flags-block',[AnswearController::class,'flagsBlock'])->name('flags-block');
Route::get('/flags-unblock',[AnswearController::class,'flagsUnblock'])->name('flags-unblock');
Route::get('/flags-resolve',[AnswearController::class,'flagsResolve'])->name('flags-resolve');
Route::post('/flags-insert',[AnswearController::class,'flagsInsert'])->name('flags-insert');

//Leader Board routes
Route::get('/le_all-teacher',[LeaderboardController::class,'Le_allteacher'])->name('le_all-teacher');
Route::get('/le_all-student',[LeaderboardController::class,'Le_allstudent'])->name('le_all-student');
Route::get('/le_all-anshero',[LeaderboardController::class,'Le_anshero'])->name('le_all-anshero');
Route::get('/all-user_point',[LeaderboardController::class,'allUsersPoint'])->name('all-user_point');
Route::post('/point-insert',[LeaderboardController::class,'pointInsert'])->name('point-insert');
Route::post('/remove-point',[LeaderboardController::class,'removePoint'])->name('remove-point');
Route::get('/june-data',[LeaderboardController::class,'juneData'])->name('june-data');



//date increment decrement
Route::post('increment',[HomeController::class,'increment'])->name('increment');
Route::post('decrement',[HomeController::class,'decrement'])->name('decrement');
Route::post('/getData',[HomeController::class,'GetData'])->name('getData');


Route::post('/weekly-data',[HomeController::class,'weeklyData'])->name('weekly-data');


//Scholarship route
Route::get('/all-scholarship',[ScholarshipController::class,'allScholarship'])->name('all-scholarship');
Route::get('/anshero-scholarship',[ScholarshipController::class,'ansheroScholarship'])->name('anshero-scholarship');
Route::post('/anshero_acholarship_data',[ScholarshipController::class,'anshero_scho_data'])->name('anshero_acholarship_data');
Route::get('/scholarship-verified',[ScholarshipController::class,'scholarshipVerified'])->name('scholarship-verified');
Route::get('/scholarship-not_verified',[ScholarshipController::class,'scholarshipNotverified'])->name('scholarship-not_verified');
//subject controller controll 
Route::get('pending-dashboard',[SubjectController::class,'pendingDashboard'])->name('pending-dashboard');
Route::get('bangla',[SubjectController::class,'Bangla'])->name('bangla');
Route::get('english',[SubjectController::class,'English'])->name('english');
Route::get('math',[SubjectController::class,'Math'])->name('math');
Route::get('chemistry',[SubjectController::class,'Chemistry'])->name('chemistry');
Route::get('physics',[SubjectController::class,'Physics'])->name('physics');
Route::get('higher_math',[SubjectController::class,'Higher_math'])->name('higher_math');
Route::get('accounting',[SubjectController::class,'Accounting'])->name('accounting');
Route::get('biology',[SubjectController::class,'Biology'])->name('biology');
Route::get('geography',[SubjectController::class,'Geography'])->name('geography');
Route::get('ict',[SubjectController::class,'Ict'])->name('ict');
Route::get('agriculture',[SubjectController::class,'Agriculture'])->name('agriculture');
Route::get('islam',[SubjectController::class,'Islam'])->name('islam');
//volunteers
Route::get('all-volunteers',[volunteerController::class,'allVolunteers'])->name('all-volunteers');
//Announcement 
Route::get('/announcement',[AnnouncementController::class,'AnnounceMent'])->name('announcement');




});
