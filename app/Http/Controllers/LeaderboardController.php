<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function Le_allteacher(){

        $point = DB::select("SELECT
        user_id,
          SUM(point) as tot_point
      FROM
          points 
      WHERE
      
           point <> '0.00'
          GROUP BY
           user_id");
      $data_point_arr = [];
      foreach($point as $key => $val){
          $user_id=$val->user_id;
         $data_point_arr[$user_id]['user_id']=$val->user_id;
         $data_point_arr[$user_id]['tot_point']=$val->tot_point;
        
        
      }
      
      
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

 $data_answer_arr = [];
 foreach($all_teacher as $key => $val){
     $user_id=$val->id;
     $answer_point=$val->total_point;
     $points_point=isset($data_point_arr[$user_id])?$data_point_arr[$user_id]['tot_point']:0;
    $data_answer_arr[$user_id]['total_point']= $answer_point+$points_point;
    $data_answer_arr[$user_id]['anscount']=$val->anscount;
    $data_answer_arr[$user_id]['id']=$val->id;
    $data_answer_arr[$user_id]['name']=$val->name;
    $data_answer_arr[$user_id]['email']=$val->email;
    $data_answer_arr[$user_id]['mobile']=$val->mobile;
    $data_answer_arr[$user_id]['type']=$val->type;
    $data_answer_arr[$user_id]['created_at']=$val->created_at;
   
 }

  
    
   //dd($data_answer_arr);
          // dd($all_teacher);
      return view('pages/leaderboard.all-teachers',compact('data_answer_arr'));
    }
    public function Le_allstudent(){
        $point = DB::select("SELECT
        user_id,
          SUM(point) as tot_point
      FROM
         `points` 
      WHERE
      
           point <> '0.00'
          GROUP BY
           user_id");
      $data_point_arr = [];
      foreach($point as $key => $val){
          $user_id=$val->user_id;
         $data_point_arr[$user_id]['user_id']=$val->user_id;
         $data_point_arr[$user_id]['tot_point']=$val->tot_point;
        
        
      }
      
      
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
   
  WHERE
      users.type = 2
  GROUP BY
    questions.asked_by 
  ORDER BY
      total_point DESC,
      quescount DESC");

 $data_answer_arr = [];
 foreach($all_student as $key => $val){
     $user_id=$val->id;
     $answer_point=$val->total_point;
     $points_point=isset($data_point_arr[$user_id])?$data_point_arr[$user_id]['tot_point']:0;
    $data_answer_arr[$user_id]['total_point']= $answer_point+$points_point;
    $data_answer_arr[$user_id]['quescount']=$val->quescount;
    $data_answer_arr[$user_id]['id']=$val->id;
    $data_answer_arr[$user_id]['name']=$val->name;
    $data_answer_arr[$user_id]['email']=$val->email;
    $data_answer_arr[$user_id]['mobile']=$val->mobile;
    $data_answer_arr[$user_id]['type']=$val->type;
    $data_answer_arr[$user_id]['created_at']=$val->created_at;
   
 }
return view('pages/leaderboard.all-students',compact('data_answer_arr'));
    }
    public function Le_anshero(){
        $point = DB::select("SELECT
        user_id,
          SUM(point) as tot_point
      FROM
         `points` 
      WHERE
      
           point <> '0.00'
          GROUP BY
           user_id");
      $data_point_arr = [];
      foreach($point as $key => $val){
          $user_id=$val->user_id;
         $data_point_arr[$user_id]['user_id']=$val->user_id;
         $data_point_arr[$user_id]['tot_point']=$val->tot_point;
        
        
      }
      
      
      $all_anshero = DB::select("SELECT
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

 $data_answer_arr = [];
 foreach($all_anshero as $key => $val){
     $user_id=$val->id;
     $answer_point=$val->total_point;
     $points_point=isset($data_point_arr[$user_id])?$data_point_arr[$user_id]['tot_point']:0;
    $data_answer_arr[$user_id]['total_point']= $answer_point+$points_point;
    $data_answer_arr[$user_id]['anscount']=$val->anscount;
    $data_answer_arr[$user_id]['id']=$val->id;
    $data_answer_arr[$user_id]['name']=$val->name;
    $data_answer_arr[$user_id]['email']=$val->email;
    $data_answer_arr[$user_id]['mobile']=$val->mobile;
    $data_answer_arr[$user_id]['type']=$val->type;
    $data_answer_arr[$user_id]['created_at']=$val->created_at;
   
 }
return view('pages/leaderboard.all-answer_hero',compact('data_answer_arr'));
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
     public function removePoint(Request $request){
        // dd($request->all());
         $points = $request->point;
         $ready_point = '-'.$points;
         
    //     $user_id = $request->user_id;
    //     $point = $request->point;
    //      //dd($request->all());
    //      DB::table('points')
    //      ->where('user_id',$user_id)
    //      ->update(['point' => DB::raw('point -'.$point)]);
    //      return response([
    //        'messege' => "successful insert"
    //    ]);
     $point_data = array();
            $point_data['user_id'] = $request->user_id;
            $point_data['point'] = $ready_point;
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
