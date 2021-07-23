<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function Le_allteacher(){
      $all_teacher = DB::select("SELECT
      SUM( answers.points ) AS total_point,
      COUNT( answers.question_id ) AS anscount,
      users.`id`,
      users.`name`,
      users.`email`,
      users.mobile,
      users.type,
      answers.created_at 
  FROM
      answers
      JOIN users ON users.id = answers.answered_by 
  WHERE
      users.type = 1 
  GROUP BY
      answers.answered_by 
  ORDER BY
      total_point DESC,
      anscount DESC");
          // dd($all_teacher);
      return view('pages/leaderboard.all-teachers',compact('all_teacher'));
    }
    public function Le_allstudent(){
        $all_student = DB::select("SELECT
        SUM( questions.points ) AS total_point,
        COUNT( questions.asked_by ) AS quescount,
        users.`id`,
        users.`name`,
        users.`email`,
        users.mobile,
        users.type,
        questions.created_at 
    FROM
        questions
        JOIN users ON users.id = questions.asked_by 
    GROUP BY
        questions.asked_by 
    ORDER BY
        total_point DESC,
        quescount DESC");
       // dd($all_student);
return view('pages/leaderboard.all-students',compact('all_student'));
    }
    public function Le_anshero(){
        $all_anshero =   $all_teacher = DB::select("SELECT
        SUM( answers.points ) AS total_point,
        COUNT( answers.question_id ) AS anscount,
        users.`id`,
        users.`name`,
        users.`email`,
        users.mobile,
        users.type,
        answers.created_at 
    FROM
        answers
        JOIN users ON users.id = answers.answered_by 
    WHERE
        users.type = 3
    GROUP BY
        answers.answered_by 
    ORDER BY
        total_point DESC,
        anscount DESC");
       // dd($all_anshero);
return view('pages/leaderboard.all-answer_hero',compact('all_anshero'));
    }
    //techer point update

         //Sutdent point update
         public function pointInsert(Request $request){
            // dd($request->all());
            $point_data = array();
            $point_data['user_id'] = $request->user_id;
            $point_data['point'] = $request->point;
            $point_data['type'] = $request->type;
            $point_data['user_type'] = $request->user_type;
            $point_data['created_at'] = $request->date;
            DB::table('points')->insert($point_data);
            return response([
                'messege' => "successful insert"
            ]);
        }
        public function juneData(){
         
               
            return view('pages/leaderboard.june-data');
        }
}
