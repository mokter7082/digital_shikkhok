<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AnswearController extends Controller
{
  public function allAnswer(){
     return view('pages.all-answear');
  }
  //ALL ANSWER DATA FETCH BY AJAX DATATABLE
   public function allanswerDataFetch(Request $request){


    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');

    $column_order = array(
        "answers.id",
        "users.name",
        "users.mobile",
        "answers.answer",
        "subjects.name",
        "answers.created_at",
        "users.institutionname"); //set column field database for datatable orderable

    $column_search = array(
      "answers.id",
      "users.name",
      "users.mobile",
      "answers.answer",
      "subjects.name",
      "answers.created_at",
      "users.institutionname"); //set column field database for datatable searchable

    $order = array("answers.id" => 'asc');

    $recordsTotal = DB::table('answers')
            //->where('users.isTeacher',1)
            ->count();
   
    $list = DB::table('answers')
            ->join('users','users.id','answers.answered_by')
            ->join('questions','questions.id','=','answers.question_id')
            ->join('subjects','subjects.id','=','questions.subject_id')
            ->select('answers.*','users.name','users.mobile','users.institutionname','subjects.name as sname','users.type',);


    //echo $list->toSql(); exit;

    // if (!empty($EMPLOYEE_ID)) {
    //   $list->where("users.EMPLOYEE_ID", $EMPLOYEE_ID);
    // }

    if (!empty($search)) {
      $list->where(function($query) use ($search, $column_search) {
        $query->where("answers.id", 'LIKE', "%{$search}%");
        foreach ($column_search as $item) {
          $query->orWhere($item, 'LIKE', "%{$search}%");
        }
      });
    }

    $recordsFiltered = $list->count();

    $list->offset($start);
    $list->limit($limit);

    if (!empty($request->input('order.0.column'))) { // here order processing
      $list->orderBy($column_order[$request->input('order.0.column')], $request->input('order.0.dir'));
    } else {
      $list->orderBy(key($order), $order[key($order)]);
    }

    //echo $list->toSql(); exit;

    $list = $list->get();
  //  dd($list);
    // generate server side datatables
    $data = array();
    $arr =[
      1 => "Teacher",
      2 => "Student",
      3 => "Answer Hero",
      4 => "Admin",
      5 => "Others",
      6 => "Editior",
  ];
    $sl = $start;
    if (!empty($list)) {
      foreach ($list as $value) {
        $row = array();
       
       // $row[] = ++$sl;
        $row[] = $value->question_id;
        $row[] = $value->name;
        $row[] = $value->mobile;
        $row[] = $value->answer;
        $row[] = $value->sname;
        $row[] = $value->created_at;
        $row[] = $arr[$value->type];
        $row[] = $value->institutionname;
        $row[] = '<button type="submit" class="btn btn-danger btn-sm delete" id="a_delete' . $value->id . '" onclick="a_delete(' . $value->id . ')">Delete</button>';
        //$row[] = 0;

        $data[] = $row;
      }
    }

    //print_r($data); exit;

    $output = array(
        "draw" => intval($request->input('draw')),
        "recordsTotal" => intval($recordsTotal),
        "recordsFiltered" => intval($recordsFiltered),
        "data" => $data
    );

    // output to json format
    return response()->json($output);
  }

  //END ALL ANSWER DATA FATCH BY AJAX
  public function todayAnswear(){
    date_default_timezone_set("Asia/Dhaka");
    $todaydate = date("Y-m-d");
    $today_ans =  DB::table('answers')
                  ->join('users','users.id','answers.answered_by')
                  ->select('answers.*','users.name','users.type','users.institutionname')
                  ->where('answers.created_at', 'like', '%' . $todaydate. '%')
                  ->get();
                 // dd($today_ans);
     return view('pages.today-answear',compact('today_ans'));
 }
public function customAnswear(){

return view('pages.custom-answer');
}
public function dateCustom_answer(Request $request){
     $post= $request->all();
   
      
      $limit = $request->input('length');
      $start = $request->input('start');
      $search = $request->input('search.value');

      $start_date = $request->input('start_date');
      $end_date = $request->input('end_date');

      

        $custom_date = date('Y-m-d');
        $custom_date = explode('-',$custom_date);
        $custome_year = $custom_date[0];
        $custome_month = $custom_date[1];
        $custome_day = $custom_date[2];
       //  AFTER CUSTOMIZE GET DATA
        //dd($post);
        if($post['start_date'] && $post['end_date']){
          //dd($post);
          $start_date = date('Y-m-d',strtotime($post['start_date']));
          $end_date = date('Y-m-d',strtotime($post['end_date']));
        }else{
          $start_date = $custome_year.'-'.$custome_month.'-'.'01';
          $end_date = $custome_year.'-'.$custome_month.'-'.date('t');
          //dd($start_date);
        }
      
      $column_order = array(
          "questions.id",
          "users.name",
          "users.mobile",
          "answers.created_at",
          "answers.answer",
          "questions.question"); //set column field database for datatable orderable
  
      $column_search = array(
        "questions.id",
        "users.name",
        "users.mobile",
        "answers.created_at",
        "answers.answer",
        "questions.question"); //set column field database for datatable searchable
  
      $order = array("answers.id" => 'desc');
  
      $recordsTotal =  DB::table('answers')
                      ->count();  //DEAFAULT COUNT FOR DATATABLE
     
      $list =  DB::table('answers')
                 ->join('users','users.id','=','answers.answered_by')
                 ->join('questions','questions.id','=','answers.question_id')
                 ->select('answers.answer','answers.created_at','users.name','users.mobile','questions.id','questions.question')
                 ->where('answers.created_at','>=',$start_date)
                 ->where('answers.created_at','<=',$end_date);        
  
      //echo $list->toSql(); exit;

      if (!empty($search)) {
        $list->where(function($query) use ($search, $column_search) {
          $query->where("answers.id", 'LIKE', "%{$search}%");
          foreach ($column_search as $item) {
            $query->orWhere($item, 'LIKE', "%{$search}%");
          }
        });
      }
  
      $recordsFiltered = $list->count();
  
      $list->limit($limit);

      $list->offset($start);
      
  
      if (!empty($request->input('order.0.column'))) { // here order processing
        $list->orderBy($column_order[$request->input('order.0.column')], $request->input('order.0.dir'));
      } else {
        $list->orderBy(key($order), $order[key($order)]);
      }
  
      //echo $list->toSql(); exit;
  
      $list = $list->get();
      //dd($list);
      // generate server side datatables
      $data = array();
      //dd($data);
      $sl = $start;
      if (!empty($list)) {
        foreach ($list as $value) {
          $row = array();
         // $row[] = ++$sl;
         $row[] = $value->id;
          $row[] = $value->name;
          $row[] = $value->mobile;
          $row[] = $value->created_at;
          $row[] = $value->question;
          $row[] = $value->answer;
          $data[] = $row;
        }
      }
  
      //print_r($data); exit;
  
      $output = array(
          "draw" => intval($request->input('draw')),
          "recordsTotal" => intval($recordsTotal),
          "recordsFiltered" => intval($recordsFiltered),
          "data" => $data
      );
  
      // output to json format
      return response()->json($output);
 
}
  public function ansDelete(Request $req){
           $id = $req->input('id');
         DB::table('ans')
                 ->where('id', $id)
                 ->delete();
         return response()->json('delete success');
      
    }
    public function answerDelete(Request $req){
      $id = $req->input('id');
    DB::table('answers')
            ->where('id', $id)
            ->delete();
    return response()->json('delete success');
 
}

    public function Answering($id){
         $id;
         DB::table('post_q')
         ->where('id',$id)
         ->update(['status' => '2']);
            return response()->json('someone answering success');
 }
    public function Ainsert(Request $request){

     
      $sub_id = $request->subject;
      $post_id = $request->id;
      $user_id = $request->user_id;
       //**************** */

      
    //**************end */
       $image  = $request->file('image');
      //dd($data);
      if($image){
        $point_count = DB::table('answers')
        ->select(DB::raw('count(question_id) as count '))
       ->where('question_id',$request->id)
       ->first();
      // dd($point_count);
        $teacher = Session::get('type');
       if($teacher == 0){
         $answer_points = 5;
       }elseif($teacher == 3){
         if($point_count->count == 0){
                   if($sub_id == 5){
                     $answer_points = 5.0;
                   }elseif($sub_id == 7){
                     $answer_points = 8.0;
                   }elseif($sub_id == 8){
                     $answer_points = 8.0;
                   }elseif($sub_id == 9){
                     $answer_points = 5.0;
                   }elseif($sub_id == 10){
                     $answer_points = 6.0;
                   }else{
                     $answer_points = 3.0;
                   }
                   
         }else{
           if($sub_id == 5){
             $answer_points = 2.5;
           }elseif($sub_id == 7){
             $answer_points = 4.0;
           }elseif($sub_id == 8){
             $answer_points = 4.0;
           }elseif($sub_id == 9){
             $answer_points = 2.5;
           }elseif($sub_id == 10){
             $answer_points = 3.0;
           }else{
             $answer_points = .5;
           } 
         }      
         
        }else{
          $answercount = DB::select("SELECT answers.question_id,questions.id, questions.question, count( answers.answer ) AS ct 
          FROM `answers` LEFT JOIN questions ON questions.id = answers.question_id  WHERE answers.question_id = $request->id GROUP BY  answers.question_id,questions.id, questions.question");
  
            if($answercount == NULL){
              $answer_points='3';
              }else{
              $answer_points='1';     
            }
        }
         ///End Ansheor and teacher ar special point///
    
         $answer_data = array();
         $answer_data['question_id'] = $request->id;
         $answer_data['answered_by'] = $user_id;
         $answer_data['answer'] = $request->ans;
         $answer_data['points'] = $answer_points;
         $answer_data['flags'] = '0';
         $answer_data['quality'] = '0';
        $image_name = Str::random(20);
        $ext = strtolower($image->getClientOriginalExtension());
        $image_fullname = $image_name.'.'.$ext;
        $upload_path ='sub_images';
        $image_url = $upload_path.$image_fullname;
        $success = $image->move($upload_path,$image_fullname);
        if($success){
            $answer_data['file_url']=$image_fullname;
         $insert = DB::table('answers')->insert($answer_data);
         
      }else{
          //ELSE IS BLANK
      }


   }else{

    ///Ansheor and teacher ar special point///
    $point_count = DB::table('answers')
    ->select(DB::raw('count(question_id) as count '))
   ->where('question_id',$request->id)
   ->first();
  // dd($point_count);
    $teacher = Session::get('type');
   if($teacher == 0){
     $answer_points = 5;
   }elseif($teacher == 3){
     if($point_count->count == 0){
               if($sub_id == 5){
                 $answer_points = 5.0;
               }elseif($sub_id == 7){
                 $answer_points = 8.0;
               }elseif($sub_id == 8){
                 $answer_points = 8.0;
               }elseif($sub_id == 9){
                 $answer_points = 5.0;
               }elseif($sub_id == 10){
                 $answer_points = 6.0;
               }else{
                 $answer_points = 3.0;
               }
               
     }else{
       if($sub_id == 5){
         $answer_points = 2.5;
       }elseif($sub_id == 7){
         $answer_points = 4.0;
       }elseif($sub_id == 8){
         $answer_points = 4.0;
       }elseif($sub_id == 9){
         $answer_points = 2.5;
       }elseif($sub_id == 10){
         $answer_points = 3.0;
       }else{
         $answer_points = .5;
       } 
     }
                
     $answer_data = array();
     $answer_data['question_id'] = $request->id;
     $answer_data['answered_by'] = $user_id;
     $answer_data['answer'] = $request->ans;
     $answer_data['file_url'] = '0';
     $answer_data['points'] = $answer_points;
     $answer_data['flags'] = '0';
     $answer_data['quality'] = '0';
     $insert = DB::table('answers')->insert($answer_data);
     ///End Ansheor and teacher ar special point///
   }else{
    $answercount = DB::select("SELECT answers.question_id,questions.id, questions.question, count( answers.answer ) AS ct 
    FROM `answers` LEFT JOIN questions ON questions.id = answers.question_id  WHERE answers.question_id = $request->id GROUP BY  answers.question_id,questions.id, questions.question");
     //dd($answercount);
    if($answercount == NULL){
      $point='3';
      }else{
      $point='1';     
    }
 $answer_data = array();
 $answer_data['question_id'] = $request->id;
 $answer_data['answered_by'] = $user_id;
 $answer_data['answer'] = $request->ans;
 $answer_data['file_url'] = '0';
 $answer_data['points'] = $point;
 $answer_data['flags'] = '0';
 $answer_data['quality'] = '0';
$insert = DB::table('answers')->insert($answer_data);
 }
//00000000000/
   

   


   }
   DB::table('questions')
   ->where('id',$post_id)
   ->update(['status' => '1']);
     //*********New Points Add Area *********/
    //  $point_count = DB::select("SELECT points.user_id
    //  FROM `points`  WHERE points.user_id = $user_id");
    //  //dd($point_count);
    //  if($point_count == NULL){

    //   $teacher = Session::get('type');
    //   if($teacher == 1) {
    //     $answer_points = 5;
    //   }elseif($teacher == 3){
    //           if($sub_id == 5){
    //             $answer_points = 2.5;
    //           }elseif($sub_id == 7){
    //             $answer_points = 4.0;
    //           }elseif($sub_id == 8){
    //             $answer_points = 4.0;
    //           }elseif($sub_id == 9){
    //             $answer_points = 2.5;
    //           }elseif($sub_id == 10){
    //             $answer_points = 3.0;
    //           }else{
    //             $answer_points = .5;
    //           }       
    //   }
    //       $new_points = array();
    //       $new_points['user_id'] = $user_id;
    //       $new_points['point'] = $answer_points;
    //       $new_points['type'] = 0;
    //       $new_points['user_type'] = $teacher;
    //       DB::table('points')->insert($new_points);
    //  }else{
    //    DB::table('points')
    //    ->where('user_id',$user_id)
    //    ->update(['point' =>'point+0.4']);
    //  }
    
//*********New End Area *********/
// $point_count = DB::select("SELECT answers.question_id, count( answers.question_id ) AS ct
//    FROM `answers`  WHERE answers.question_id = $request->id");

  //  $ccc = $point_count[0]['ct'];
  //  dd($ccc);


  
          
    return response()->json([
      'data' => $insert,
      
    ]);    
   }

 public function lastweekAnswer(){

       
      return view('pages.last_week-answer');
 }
 public function weeklyDecrement(Request $request){
   $date = date('Y-m-d', strtotime($request->id . ' -7 day'));
   return response()->json($date);
 }
 public function getldata (Request $request){
     $date_1 = $request->dates;
     $date_minus = date('Y-m-d', strtotime($date_1 . ' -1 day'));
     $date_2 = date('Y-m-d', strtotime($date_minus . ' -6 day'));

        $all_teacher = DB::select("SELECT users.`name`,users.`mobile`,users.`institutionname`,COUNT( CASE WHEN ( ans.date >= '$date_2' AND ans.date <= '$date_minus' ) THEN 1 END ) AS total 
      FROM `users` LEFT JOIN ans ON users.id = ans.user_id WHERE
  users.isTeacher = 1 GROUP BY users.id,users.`name`,users.`mobile`,users.`institutionname`");
        $html = '';
        foreach($all_teacher as $teacher){
          $html .= '<tr><td>'.$teacher->name.'</td><td>'.$teacher->mobile.'</td><td>'.$teacher->institutionname.'</td><td>'.$teacher->total.'</td></tr>';
        }
        
      
       return response()->json($html);
 }
  public function weeklyIncrement(Request $request){
   $date = date('Y-m-d', strtotime($request->id . ' +7 day'));
   return response()->json($date);
 }
  public function getData (Request $request){
     $date_1 = $request->dates;
     $date_plus = date('Y-m-d', strtotime($date_1 . ' -1 day'));
     $date_2 = date('Y-m-d', strtotime($date_plus . ' -6 day'));
       /*
       $a_count = DB::select("SELECT COUNT( CASE WHEN ( ans.date >= '2021-04-24' AND ans.date <= '2021-04-30' ) THEN 1 END ) AS total FROM `users` LEFT JOIN ans ON users.id = ans.user_id WHERE users.isTeacher = 1 GROUP BY users.id"); */
        $all_teacher = DB::select("SELECT users.`name`,users.`mobile`,users.`institutionname`,COUNT( CASE WHEN ( ans.date >= '$date_2' AND ans.date <= '$date_plus' ) THEN 1 END ) AS total 
      FROM `users` LEFT JOIN ans ON users.id = ans.user_id WHERE
  users.isTeacher = 1 GROUP BY users.id,users.`name`,users.`mobile`,users.`institutionname`");
        $html = '';
        foreach($all_teacher as $teacher){
          $html .= '<tr><td>'.$teacher->name.'</td><td>'.$teacher->mobile.'</td><td>'.$teacher->institutionname.'</td><td>'.$teacher->total.'</td></tr>';
        }
        
      
       return response()->json($html);
 }

 public function ajaxList(Request $request)
  {
    $post_data = json_decode($request->getContent(), true);
    // debug($post_data);

    /* $validator = Validator::make($post_data, [
      'CREATED_BY' => 'required'
      ]);

      if ($validator->fails()) {
      return sendError('Validation Error.', $validator->errors());
      } */

    $input_date = $request->input('dates');

    date_default_timezone_set("Asia/Dhaka");
    /*$todaydate = date("Y-m-d");
    $date_1 = date('Y-m-d', strtotime($todaydate . ' -1 day'));
    $date_2 = date('Y-m-d', strtotime($date_1 . ' -6 day'));*/

    $date = date("Y-m-d");
    if (!empty($input_date)) {
      $date = $input_date;
    }

    $to_date = date('Y-m-d', strtotime($date . ' -1 day'));
    $from_date = date('Y-m-d', strtotime($to_date . ' -6 day'));

    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');

    $column_order = array(
        "users.id",
        "users.name",
        "users.mobile",
        "institutes.institute_name"); //set column field database for datatable orderable

    $column_search = array(
        "users.name",
        "users.mobile",
        "institutes.institute_name"); //set column field database for datatable searchable

    $order = array("users.id" => 'desc');

    $recordsTotal = DB::table('users')
            ->where('users.type',1)
            ->count();
   
    $list = DB::table('users')
            ->selectRaw("users.`name`,users.`mobile`,users.`type`,users.`institutionname`,(SELECT COUNT(answers.id) FROM answers WHERE answers.answered_by = users.id AND answers.`created_at` BETWEEN '$from_date' AND '$to_date') AS total")
            //  ->join('institutes','institutes.user_id','=','users.id')
             //->join('teachers','teachers.institute_id','=','institutes.id')
            ->where('users.type',1)
            ->orderBy('total', 'DESC');
                    // ->get();
                      
          //  dd($list);
            //->groupByRaw('users.id,users.`name`,users.`mobile`,users.`institutionname');
    /* new code  

      $qu1 = DB::table('users')
             ->join('institutes','institutes.user_id','=','users.id')
             ->join('teachers','teachers.institute_id','=','institutes.id')
             ->select('users.id as user_id','users.name','users.email','institutes.institute_name')
             ->where('users.type',1)
             ->get();
      
      $qu2 = DB::select("SELECT
            user_id,
            COUNT( ans.id ) as total
          FROM
            ans 
          WHERE
            ans.`date` BETWEEN '2021-05-21' 
            AND '2021-05-27' 
          GROUP BY
            user_id");

      $by_users_ans_arr=[];
      foreach($qu2 as $val){
        $by_users_ans_arr[$val->user_id]=$val->total;

      }

      $final_arr=[];
     foreach($qu1 as $k=>$value){
        $final_arr[$k]['user_id']=$value->user_id;
        $final_arr[$k]['name']=$value->name;
        $final_arr[$k]['mobile']=$value->email;
        $final_arr[$k]['institute_name']=$value->institute_name;
        $final_arr[$k]['total']=isset($by_users_ans_arr[$value->user_id])?$by_users_ans_arr[$value->user_id]:0;

      }
        dd($final_arr);
     // $list=(object)$final_arr;  */ 



    //**********//
     //END NEW CODE   
   //**********//
    // echo $list->toSql(); exit;

    // if (!empty($EMPLOYEE_ID)) {
    //   $list->where("users.EMPLOYEE_ID", $EMPLOYEE_ID);
    // }

    if (!empty($search)) {
      $list->where(function($query) use ($search, $column_search) {
        $query->where("users.id", 'LIKE', "%{$search}%");
        foreach ($column_search as $item) {
          $query->orWhere($item, 'LIKE', "%{$search}%");
        }
      });
    }

    //$recordsFiltered = $list->count();
     $recordsFiltered = $list->count();

    $list->offset($start);
    $list->limit($limit);

    if (!empty($request->input('order.0.column'))) { // here order processing
      $list->orderBy($column_order[$request->input('order.0.column')], $request->input('order.0.dir'));
    } else {
      $list->orderBy(key($order), $order[key($order)]);
    }
    
    //echo $list->toSql(); exit;

    $list = $list->get();

    // generate server side datatables
    $data = array();
    $arr =[
      1 => "Teacher",
      2 => "Student",
      3 => "Answer Hero",
      4 => "Admin",
      5 => "Others",
      6 => "Editior",
  ];
    //dd($data);
    $sl = $start;
    if (!empty($list)) {
      foreach ($list as $value) {
        $row = array();
      // dd($row);
        $row[] = ++$sl;
        $row[] = $value->name;
        $row[] = $value->mobile;
        $row[] = $arr[$value->type];
        $row[] = $value->institutionname;
        $row[] = $value->total;
        //$row[] = 0;

        $data[] = $row;
      }
    }

    //print_r($data); exit;

    $output = array(
        "draw" => intval($request->input('draw')),
        "recordsTotal" => intval($recordsTotal),
        "recordsFiltered" => intval($recordsFiltered),
        "data" => $data
    );

    // output to json format
    return response()->json($output);
  }

  public function dailyAnswer(){
    return view('pages.daily-answer');
  }
  public function dailyIncrement(Request $request){
   $date = date('Y-m-d', strtotime($request->id . ' +1 day'));
   return response()->json($date);
 }
  public function dailyDecrement(Request $request){
   $date = date('Y-m-d', strtotime($request->id . ' -1 day'));
   return response()->json($date);
 }



 public function dailyAnswerData(Request $request)
  {
    $post_data = json_decode($request->getContent(), true);
    $input_date = $request->input('todaydate');
    //dd($input_date);

    date_default_timezone_set("Asia/Dhaka");

    $date = date("Y-m-d");
    if (!empty($input_date)) {
      $date = $input_date;
    }

    $corr_date = $date;
    //$from_date = date('Y-m-d', strtotime($to_date . ' -6 day'));

    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');

    $column_order = array(
        "users.id",
        "users.name",
        "users.mobile",
        "institutes.institute_name"); //set column field database for datatable orderable

    $column_search = array(
        "users.name",
        "users.mobile",
        "institutes.institute_name"); //set column field database for datatable searchable

    $order = array("users.id" => 'desc');

    $recordsTotal = DB::table('users')
            ->where('users.type',1)
            ->count();
   
    $list = DB::table('users')
            ->selectRaw("users.`name`,users.`mobile`,users.`institutionname`,(SELECT COUNT( answers.id ) FROM answers WHERE answers.answered_by = users.id AND answers.`created_at` LIKE '%$corr_date%') AS total")
            // ->join('institutes','institutes.user_id','=','users.id')
            // ->join('teachers','teachers.institute_id','=','institutes.id')
            ->where('users.type',1)
            ->orderBy('total','DESC');
            //->groupByRaw('users.id,users.`name`,users.`mobile`,users.`institutionname');

     //echo $list->toSql(); exit;

    // if (!empty($EMPLOYEE_ID)) {
    //   $list->where("users.EMPLOYEE_ID", $EMPLOYEE_ID);
    // }

    if (!empty($search)) {
      $list->where(function($query) use ($search, $column_search) {
        $query->where("users.id", 'LIKE', "%{$search}%");
        foreach ($column_search as $item) {
          $query->orWhere($item, 'LIKE', "%{$search}%");
        }
      });
    }

    $recordsFiltered = $list->count();

    $list->offset($start);
    $list->limit($limit);

    if (!empty($request->input('order.0.column'))) { // here order processing
      $list->orderBy($column_order[$request->input('order.0.column')], $request->input('order.0.dir'));
    } else {
      $list->orderBy(key($order), $order[key($order)]);
    }

    //echo $list->toSql(); exit;

    $list = $list->get();

    // generate server side datatables
    $data = array();
    $sl = $start;
    if (!empty($list)) {
      foreach ($list as $value) {
        $row = array();
       
        $row[] = ++$sl;
        $row[] = $value->name;
        $row[] = $value->mobile;
        $row[] = $value->institutionname;
        $row[] = $value->total;
        //$row[] = 0;

        $data[] = $row;
      }
    }

    //print_r($data); exit;

    $output = array(
        "draw" => intval($request->input('draw')),
        "recordsTotal" => intval($recordsTotal),
        "recordsFiltered" => intval($recordsFiltered),
        "data" => $data
    );

    return response()->json($output);
  }

  public function monthlyAnswer(){
       $custom_date = date('Y-m-d');
       $custom_date = explode('-',$custom_date);
       $custome_year = $custom_date[0];
       $custome_month = $custom_date[1];
       $custome_day = $custom_date[2];
        //  AFTER CUSTOMIZE GET DATA
       $start_date = $custome_year.'-'.$custome_month.'-'.'01';
       $end_date = $custome_year.'-'.$custome_month.'-'.date('t');
        
     $monthly = DB::select("SELECT users.`name`, users.`mobile`, users.`institutionname`, users.`type`, COUNT( ans.id ) AS total 
   FROM
     `users` LEFT JOIN ans ON users.id = ans.user_id  WHERE (users.type = 1 OR users.type = 3) AND ans.date BETWEEN '$start_date' AND '$end_date'
   GROUP BY users.id, users.`name`, users.`mobile`, users.`institutionname`, users.`type` 
   ORDER BY `total` DESC");
     //dd($monthly);
       return view('pages.monthly-answer',compact('monthly'));
  }

  public function Save(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;
    $monthly = DB::select("SELECT users.`name`, users.`mobile`, users.`institutionname`, users.`type`, COUNT( ans.id ) AS total 
    FROM
      `users` LEFT JOIN ans ON users.id = ans.user_id  WHERE (users.type = 1 OR users.type = 3) AND ans.date BETWEEN '$start_date' AND '$end_date'
    GROUP BY users.id, users.`name`, users.`mobile`, users.`institutionname`, users.`type` 
    ORDER BY `total` DESC");
       return view('pages.monthly-answer',compact('monthly'));

  }
  public function allAnswer_hero(){
    $all_ans_hero = DB::table('users')
                  ->where('type',3)
                  ->get();
    //dd($all_ans_hero);
    return view('pages.all-answear_hero',compact('all_ans_hero'));
  }
  public function todayAnswer_hero(){
    date_default_timezone_set("Asia/Dhaka");
    $todaydate = date("Y-m-d");
    $today_regi_anshero =  DB::table('users')
          ->where('date', 'like', '%' . $todaydate . '%')
          ->where('type',3)
          ->get();
          //dd($today_regi_anshero);
    return view('pages.today-answear_hero',compact('today_regi_anshero'));
  }
  public function datewiseAnswer(){
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', '0');
    $custom_date = date('Y-m-d');
    $custom_date = explode('-',$custom_date);
    $custom_year = $custom_date[0];
    $custom_month = $custom_date[1];
    $custom_date = $custom_date[2];

    $start_date = $custom_year.'-'.$custom_month.'-'.'01';
    $end_date = $custom_year.'-'.$custom_month.'-'.date('t');

    $datewise_ans = DB::table('answers')
                 ->join('users','users.id','=','answers.answered_by')
                 ->select('answers.*','users.name','users.mobile','users.type','users.institutionname')
                 ->where('answers.created_at','>=',$start_date)
                 ->where('answers.created_at','<=',$end_date) 
                 ->get();
    // echo "<pre>";
    // print_r($datewise_ans);
    // exit;
    return view('pages.datewise-answer',compact('datewise_ans'));
  }
  public function answerSearch(Request $request){
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', '0');
      $s_date = $request->start_date;
      $e_date = $request->end_date;
     
      $datewise_ans = DB::table('answers')
      ->join('users','users.id','=','answers.answered_by')
      ->select('answers.*','users.name','users.mobile','users.type','users.institutionname')
      ->where('answers.created_at','>=',$s_date)
      ->where('answers.created_at','<=',$e_date) 
      ->get();
  // dd($datewise_ans);
    return view('pages.datewise-answer',compact('datewise_ans'));
  }
  public function answerUpdate(Request $request){
   // dd($request->all());
      $id = $request->id;
      $ans =$request->ans;
      //dd($id);
      $up = DB::table('ans')
      ->where('id', $id)->update(array('ans' => $ans)); 
        return response()->json([
          "mas"=>"success",
          "status"=>200
        ]);
  }
  public function ansheroBlock(Request $req){
    $id = $req->input('id');
    //dd($id);
   DB::table('users')
    ->where('id',$id)
    ->update(['status' => '3']);
    return response()->json([
      "message"=>"teacher status update 3 success"
      ]);     
}
 public function ansheroUnblock(Request $req){
    $id = $req->input('id');
    //dd($id);
   DB::table('users')
    ->where('id',$id)
    ->update(['status' => '1']);

    return response()->json([
      "message"=>"teacher status update 1 success"
      ]);    
}
public function flagsAnswer(){
  $flags_answer = DB::select('SELECT
  users.id,
	users.name,
	users.email,
	users.mobile,
  users.institutionname,
  users.status,
  answers.id AS ans_id,
	answers.answer,
	answers.flags,
	questions.question,
	questions.asked_by

FROM
	answers
	INNER JOIN questions ON questions.id = answers.question_id
 INNER JOIN users ON users.id = answers.answered_by	
WHERE
	answers.flags >0');
  //dd($flags_answer);

    return view('pages.flags_answer',compact('flags_answer'));
  }
  public function flagsDelete(Request $req){
    $id = $req->input('id');
   // dd($id);
   DB::table('answers')
          ->where('id', $id)
          ->delete();
  return response()->json('delete success');

}
public function flagsBlock(Request $req){
  $id = $req->input('id');
  //dd($id);
 DB::table('users')
  ->where('id',$id)
  ->update(['status' => '3']);
  return response()->json(['success']);     
}
public function flagsUnblock(Request $req){
  $id = $req->input('id');
  //dd($id);
 DB::table('users')
  ->where('id',$id)
  ->update(['status' => '1']);
  return response()->json(['success']);     
}
public function flagsResolve(Request $request){
  //dd($request->all());
  $id = $request->input('id');
  //dd($id);
 DB::table('answers')
  ->where('id',$id)
  ->update(['flags' => '0']);
  return response()->json(['success']);
}

//FLAGS INSERT
    public function flagsInsert(Request $request){
      $sub_id = $request->subject;
      $post_id = $request->id;
      $user_id = $request->user_id;
      $ans_id = $request->ans_id;
    //dd($ans_id);

      $check_point = DB::table('answers')
                    ->where('id',$ans_id)
                    ->first();
       $point = $check_point->points;

       $image  = $request->file('image');
      //dd($data);
      if($image){
    
         $answer_data = array();
         $answer_data['question_id'] = $request->id;
         $answer_data['answered_by'] = $user_id;
         $answer_data['answer'] = $request->ans;
         $answer_data['points'] = $point;
         $answer_data['flags'] = '0';
         $answer_data['quality'] = '0';
        $image_name = Str::random(20);
        $ext = strtolower($image->getClientOriginalExtension());
        $image_fullname = $image_name.'.'.$ext;
        $upload_path ='sub_images';
        $image_url = $upload_path.$image_fullname;
        $success = $image->move($upload_path,$image_fullname);
        if($success){
            $answer_data['file_url']=$image_fullname;
            dd($answer_data);
         $insert = DB::table('answers')->insert($answer_data);
         
      }else{
          //ELSE IS BLANK
      }


   }else{
  
     $answer_data = array();
     $answer_data['question_id'] = $request->id;
     $answer_data['answered_by'] = $user_id;
     $answer_data['answer'] = $request->ans;
     $answer_data['file_url'] = '0';
     $answer_data['points'] = $point;
     $answer_data['flags'] = '0';
     $answer_data['quality'] = '0';
     //dd($answer_data);
     $insert = DB::table('answers')->insert($answer_data);
   

   }
   DB::table('answers')
   ->where('id',$ans_id)
   ->delete();
     //*********New Points Add Area *********/
    //  $point_count = DB::select("SELECT points.user_id
    //  FROM `points`  WHERE points.user_id = $user_id");
    //  //dd($point_count);
    //  if($point_count == NULL){

    //   $teacher = Session::get('type');
    //   if($teacher == 1) {
    //     $answer_points = 5;
    //   }elseif($teacher == 3){
    //           if($sub_id == 5){
    //             $answer_points = 2.5;
    //           }elseif($sub_id == 7){
    //             $answer_points = 4.0;
    //           }elseif($sub_id == 8){
    //             $answer_points = 4.0;
    //           }elseif($sub_id == 9){
    //             $answer_points = 2.5;
    //           }elseif($sub_id == 10){
    //             $answer_points = 3.0;
    //           }else{
    //             $answer_points = .5;
    //           }       
    //   }
    //       $new_points = array();
    //       $new_points['user_id'] = $user_id;
    //       $new_points['point'] = $answer_points;
    //       $new_points['type'] = 0;
    //       $new_points['user_type'] = $teacher;
    //       DB::table('points')->insert($new_points);
    //  }else{
    //    DB::table('points')
    //    ->where('user_id',$user_id)
    //    ->update(['point' =>'point+0.4']);
    //  }
    
//*********New End Area *********/
// $point_count = DB::select("SELECT answers.question_id, count( answers.question_id ) AS ct
//    FROM `answers`  WHERE answers.question_id = $request->id");

  //  $ccc = $point_count[0]['ct'];
  //  dd($ccc);
          
    return response()->json([
      'data' => $insert,
      
    ]);    
   }
 

}