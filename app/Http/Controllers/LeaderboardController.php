<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function Le_allteacher(){
      $all_teacher = DB::table('answers')
                    ->select(array('answers.id','answers.points','users.name','users.email','users.mobile',  DB::raw('COUNT(answers.points) as countpoint')))
                    ->join('users', 'users.id', '=', 'answers.answered_by')
                    ->groupBy('answers.answered_by')
                    ->orderBy('countpoint','desc')
                    ->get();
          // dd($all_teacher);
      return view('pages/leaderboard.all-teachers',compact('all_teacher'));
    }
    public function Le_allstudent(){
        $all_student = DB::table('questions')
        ->select(array('questions.id','questions.asked_by','users.name','users.email','users.mobile',  DB::raw('COUNT(questions.points) as countpoint')))
        ->join('users', 'users.id', '=', 'questions.asked_by')
        ->groupBy('questions.asked_by')
        ->orderBy('countpoint','desc')
        ->get();
       // dd($all_student);
return view('pages/leaderboard.all-students',compact('all_student'));
    }
    public function Le_anshero(){
        $all_anshero = DB::table('users')
        ->where('type',3)
        ->orderBy('points','desc')
        ->get();
return view('pages/leaderboard.all-answer_hero',compact('all_anshero'));
    }
    //techer point update
    public function te_pointUpdate(Request $request){
        $id = $request->input('id');

        //dd($id);
       // $p_update = array();
        $p_update = $request->point;
        //dd($p_update);
        $point_update = DB::table('answers')
                        ->where('id',$id )
                        ->update(['points' => $p_update]);
        return response()->json([
            'mes'=>'success',
            'data' =>$point_update,
        ]);
    }
      //Answer Hero point update
      public function stu_pointUpdate(Request $request){
        $id = $request->input('id');
        $p_update = array();
        $p_update['points'] = $request->point;
        $point_update = DB::table('users')
                        ->where('id',$id )
                        ->update($p_update);
        return response()->json([
            'mes'=>'success',
            'data' =>$point_update,
        ]);
    }
         //Sutdent point update
         public function ans_pointUpdate(Request $request){
            $id = $request->input('id');
            $p_update = array();
            $p_update['points'] = $request->point;
            $point_update = DB::table('users')
                            ->where('id',$id )
                            ->update($p_update);
            return response()->json([
                'mes'=>'success',
                'data' =>$point_update,
            ]);
        }
        public function juneData(){
         
               
            return view('pages/leaderboard.june-data');
        }
}
