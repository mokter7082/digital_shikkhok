<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function adminLogin(){
        return view('pages.login');
    }
    public function increment(Request $request){

       $date = date('Y-m-d', strtotime($request->id . ' +1 day'));
      return response()->json($date);

   }
   public function decrement(Request $request){

       $date = date('Y-m-d', strtotime($request->id . ' -1 day'));
       return response()->json($date);

   }
   public function GetData(Request $request){
       $date = $request->dates;
       $output = [];
       $t_count = DB::table('users')
                       ->where('type',1)
                       ->where('date', 'like', '%' . $date . '%')
                       ->count();
       $output['t_count'] = $t_count;
       $a_count = DB::table('answers')
                       ->where('created_at', 'like', '%' . $date . '%')
                       ->count();
       $output['a_count'] = $a_count;
       $q_count = DB::table('questions')
                       ->where('created_at', 'like', '%' . $date . '%')
                       ->count();
       $output['q_count'] = $q_count;
       $s_count = DB::table('users')
                       ->where('type',1)
                       ->where('date', 'like', '%' . $date . '%')
                       ->count();
       $output['s_count'] = $s_count;
       $anshero_count = DB::table('users')
                       ->where('type',3)
                       ->where('date', 'like', '%' . $date . '%')
                       ->count();
       $output['anshero_count'] = $anshero_count;
       $active_t = DB::table('answers')
                     ->join('users','users.id','=','answers.answered_by')
                     ->where('users.type',1)
                     ->where('answers.created_at', 'like', '%' . $date . '%')
                     ->groupBy('answers.answered_by')
                     ->get();
                  $active_teachers = count($active_t);
       $output['active_teachers'] = $active_teachers;
       $active_h = DB::table('answers')
                       ->join('users','users.id','=','answers.answered_by')
                        ->where('users.type',3)
                        ->where('answers.created_at', 'like', '%' . $date . '%')
                        ->groupBy('answers.answered_by')
                        ->get();
               $active_hero = count($active_h);
      $output['active_hero'] = $active_hero;
       $active_s = DB::table('questions')
                       ->join('users','users.id','=','questions.asked_by')
                        ->where('users.type',2)
                        ->where('questions.created_at', 'like', '%' . $date . '%')
                        ->groupBy('questions.asked_by')
                        ->get();
               $active_student = count($active_s);
      $output['active_student'] = $active_student;
       return response()->json($output);

   }
  public function WeeklyIncrement(Request $request){

     $date = date('Y-m-d', strtotime($request->id . ' +6 day'));
      return response()->json($date);

   }
  public function WeeklyDecrement(Request $request){

     $date = date('Y-m-d', strtotime($request->id . ' -6 day'));
     return response()->json($date);
   }
   public function weeklyData(Request $request){
      $date = $request->dates;
      $ans_output = [];
        $ans_count = DB::table('users')
                       ->where('isTeacher',1)
                       ->where('date', 'like', '%' . $date . '%')
                       ->count();
       $ans_count['ans_count'] = $ans_count;
       return response()->json($ans_output);
   }
}
