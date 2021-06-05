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
       $a_count = DB::table('ans')
                       ->where('date', 'like', '%' . $date . '%')
                       ->count();
       $output['a_count'] = $a_count;
       $q_count = DB::table('post_q')
                       ->where('date', 'like', '%' . $date . '%')
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
