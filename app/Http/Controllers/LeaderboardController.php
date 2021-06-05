<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function Le_allteacher(){
      $all_teacher = DB::table('users')
                     ->where('type',1)
                     ->orderBy('points','desc')
                     ->get();
      return view('pages/leaderboard.all-teacher',compact('all_teacher'));
    }
    public function Le_allstudent(){
        $all_student = DB::table('users')
        ->where('type',2)
        ->orderBy('points','desc')
        ->get();
return view('pages/leaderboard.all-student',compact('all_student'));
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
}
