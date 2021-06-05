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
Route::get('/edit-teacher/{id}',[TeacherController::class,'editTeacher'])->name('edit-teacher');
Route::post('/update-teacher/{id}',[TeacherController::class,'updateTeacher'])->name('update-teacher');
Route::get('/today-reg_teacher',[TeacherController::class,'todayRegteacher'])->name('today-reg_teacher');
Route::get('/teacher-delete',[TeacherController::class,'teacherDelete'])->name('teacher-delete');
Route::get('/answer-hero',[TeacherController::class,'answerHero'])->name('answer-hero');
//student route
 Route::get('/all-student',[StudentController::class,'allStudent'])->name('all-student');
Route::get('/today-reg_student',[StudentController::class,'todaySturegister'])->name('today-reg_student');
Route::get('/student-inactive',[StudentController::class,'studentInactive'])->name('student-inactive');
Route::get('/student-active',[StudentController::class,'studentActive'])->name('student-active');
Route::get('/student-delete',[StudentController::class,'studentDelete'])->name('student-delete');
Route::get('/student-block',[StudentController::class,'studentBlock'])->name('student-block');
Route::get('/student-unblock',[StudentController::class,'studentUnblock'])->name('student-unblock');


//question routes
Route::get('/all-question',[QuestionController::class,'allQuestion'])->name('all-question');
Route::post('/all_ques_data',[QuestionController::class,'allQuesData'])->name('all_ques_data');
Route::get('/today-question',[QuestionController::class,'todayQuestion'])->name('today-question');
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



//answer routes

Route::get('/all-answer',[AnswearController::class,'allAnswer'])->name('all-answer');
Route::post('/all_answer_data',[AnswearController::class,'allanswerDataFetch'])->name('all_answer_data');
Route::get('/today-answear',[AnswearController::class,'todayAnswear'])->name('today-answear');
Route::get('/ans-delete',[AnswearController::class,'ansDelete'])->name('ans-delete');
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

//Leader Board routes
Route::get('/le_all-teacher',[LeaderboardController::class,'Le_allteacher'])->name('le_all-teacher');
Route::get('/le_all-student',[LeaderboardController::class,'Le_allstudent'])->name('le_all-student');
Route::get('/le_all-anshero',[LeaderboardController::class,'Le_anshero'])->name('le_all-anshero');
Route::get('/t_point-update',[LeaderboardController::class,'te_pointUpdate'])->name('t_point-update');
Route::get('/s_point-update',[LeaderboardController::class,'stu_pointUpdate'])->name('s_point-update');
Route::get('/ans_point-update',[LeaderboardController::class,'ans_pointUpdate'])->name('ans_point-update');



//date increment decrement
Route::post('increment',[HomeController::class,'increment'])->name('increment');
Route::post('decrement',[HomeController::class,'decrement'])->name('decrement');
Route::post('/getData',[HomeController::class,'GetData'])->name('getData');


Route::post('/weekly-data',[HomeController::class,'weeklyData'])->name('weekly-data');


//Scholarship route
Route::get('/all-scholarship',[ScholarshipController::class,'allScholarship'])->name('all-scholarship');
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




});
