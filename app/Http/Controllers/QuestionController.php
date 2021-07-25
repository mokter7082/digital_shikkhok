<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    public function allQuestion(){
      ini_set('memory_limit', '-1');
      ini_set('max_execution_time', '0');
      

  
       return view('pages.all-question');
    }
    public function allQuesData(Request $request){
    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');

    $column_order = array(
        "questions.id",
        "users.name",
        "users.email",
        "questions.created_at",
        "questions.question",
        "users.mobile",
        "users.institutionname"); //set column field database for datatable orderable

    $column_search = array(
      "questions.id",
      "users.name",
      "users.email",
      "questions.created_at",
      "questions.question",
      "users.mobile",
      "users.institutionname"); //set column field database for datatable searchable

    $order = array("questions.id" => 'desc');

    $recordsTotal =  DB::table('questions')
                    ->count();  //DEAFAULT DOUNT FOR DATATABLE
   
    $list = DB::table('questions')
            ->join('subjects','subjects.id','=','questions.subject_id')
            ->join('users','users.id','=','questions.asked_by')
            ->select('questions.*','users.name','users.mobile','users.institutionname','subjects.name as sname');

    //echo $list->toSql(); exit;

    // if (!empty($EMPLOYEE_ID)) {
    //   $list->where("users.EMPLOYEE_ID", $EMPLOYEE_ID);
    // }

    if (!empty($search)) {
      $list->where(function($query) use ($search, $column_search) {
        $query->where("questions.id", 'LIKE', "%{$search}%");
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
   // dd($list);
    // generate server side datatables
    $data = array();
    //dd($data);
    $sl = $start;
    if (!empty($list)) {
      foreach ($list as $value) {
        $row = array();
        $row[] = ++$sl;
        $row[] = $value->name;
        $row[] = $value->mobile;
        $row[] = $value->institutionname;
        $row[] = $value->question;
        $row[] = $value->created_at;
        $row[] = $value->sname;
        $row[] = '<button type="submit" class="btn btn-danger btn-sm delete" id="q_delete' . $value->id . '" onclick="q_delete(' . $value->id . ')">Delete</button>';
  

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
    public function todayQuestion(){
      date_default_timezone_set("Asia/Dhaka");
      $todaydate = date("Y-m-d");

      $today_qus =  DB::table('questions')
                  ->join('users','users.id','=','questions.asked_by')
                  ->join('subjects','subjects.id','questions.subject_id')
                  ->select('questions.*','users.name','users.mobile','subjects.name as sname','users.institutionname')
                  ->where('questions.status',0)
                  ->where('questions.created_at', 'like', '%'.$todaydate.'%')
                  ->where('questions.status',0)
                  ->get();
                 // dd($today_qus);
       return view('pages.today-question',compact('today_qus'));
    }
    public function customQuestion(){

      return view('pages.custom-questions');
    }
    public function dateCustom(Request $request){
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
        }
      
      $column_order = array(
          "questions.id",
          "users.name",
          "users.mobile",
          "questions.created_at",
          "questions.question"); //set column field database for datatable orderable
  
      $column_search = array(
        "questions.id",
        "users.name",
        "users.mobile",
        "questions.created_at",
        "questions.question"); //set column field database for datatable searchable
  
      $order = array("questions.id" => 'desc');
  
      $recordsTotal =  DB::table('questions')
                      ->count();  //DEAFAULT COUNT FOR DATATABLE
     
      $list =  DB::table('questions')
                 ->join('users','users.id','=','questions.asked_by')
                //  ->join('subjects','subjects.id','=','users.subject_id')
                 ->select('questions.*','users.name','users.mobile','users.institutionname')
                 ->where('questions.created_at','>=',$start_date)
                 ->where('questions.created_at','<=',$end_date);        
  
     // echo $list->toSql(); exit;

      if (!empty($search)) {
        $list->where(function($query) use ($search, $column_search) {
          $query->where("questions.id", 'LIKE', "%{$search}%");
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
          //$row[] = ++$sl;
          $row[] = $value->id;
          $row[] = $value->name;
          $row[] = $value->mobile;
          $row[] = $value->created_at;
          $row[] = $value->question;
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
     public function quesApprove(Request $req){
          $id = $req->input('id');
           DB::table('post_q')
             ->where('id',$id)
             ->update(['status' => '1']);
        return response()->json(['success' => true]);
      
    }
     public function quesDisapprove(Request $req){
          $id = $req->input('id');
           DB::table('post_q')
             ->where('id',$id)
             ->update(['status' => '0']);
        return response()->json(['success' => true]);
      
    }
     public function quesDelete(Request $req){
           $id = $req->input('id');
         DB::table('post_q')
                 ->where('id', $id)
                 ->delete();
         return response()->json('delete success');
      
    }

    //QUETION APPROVAL CONTROL HERE
      public function questionApproval(){
          $que_approval = DB::table('question_approaval')->get();
        //  dd($que_approval);
          return view('pages.question-approaval',compact('que_approval')); 
    }
     public function approvalAnable(Request $req){
          $id = $req->input('id');
           DB::table('question_approaval')
             ->where('id',$id)
             ->update(['is_approval_on' => '1']);
        return response()->json(['success' => true]);
      
    }
      public function approvalDisable(Request $req){
          $id = $req->input('id');
           DB::table('question_approaval')
             ->where('id',$id)
             ->update(['is_approval_on' => '0']);
        return response()->json(['success' => true]);
      
    }
     public function quesAns(){
       return view('pages.all-ques_ans');
    }
    //ANS AND QUESTIONS DATA BY AJAX DATATABLE
    public function quesAnsData(Request $request){
     
    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');

    $column_order = array(
        "questions.id"); //set column field database for datatable orderable

    $column_search = array(
        "questions.question"); //set column field database for datatable searchable

    $order = array("questions.id" => 'desc');

    $recordsTotal =  DB::table('questions')

                    ->count();  //DEAFAULT DOUNT FOR DATATABLE
   
    $list = DB::table('questions')
                    ->join('answers','answers.question_id','=','questions.id')
                    ->select('questions.id','questions.question','answers.answer');


    //echo $list->toSql(); exit;

    // if (!empty($EMPLOYEE_ID)) {
    //   $list->where("users.EMPLOYEE_ID", $EMPLOYEE_ID);
    // }

    if (!empty($search)) {
      $list->where(function($query) use ($search, $column_search) {
        $query->where("questions.id", 'LIKE', "%{$search}%");
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
   // dd($list);
    // generate server side datatables
    $data = array();
    $sl = $start;
    if (!empty($list)) {
      foreach ($list as $value) {
        $row = array();
       
        //$row[] = ++$sl;
        $row[] = $value->id;
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
    public function pendingQues(){
      $pending_ques = DB::table('questions')
                     ->join('subjects','subjects.id','=','questions.subject_id')
                     ->select('questions.*','subjects.name as sname','subjects.id as sid')
                     ->where('questions.status',0)
                     ->get();
                    // dd($pending_ques);
      return view('pages.pending-question',compact('pending_ques'));
    }

    public function todayPending_ques(){
      return "todaypending";
    }

    public function singleAnswered_ques(){
      $single_answered_ques = DB::select('SELECT post_q.id, post_q.quens, ans.ans, count( ans.ans ) AS ct FROM `ans`
      INNER JOIN post_q ON post_q.id = ans.post_id  WHERE ans.ans <> "" GROUP BY ans.post_id,post_q.id,
      post_q.quens,
      ans.ans');
      // echo "<pre>";
      // print_r($single_answered_ques);
      // exit;
 
     return view('pages.single-answered_ques',compact('single_answered_ques'));
    }
    public function multiAnswered_ques(){
      ini_set('memory_limit', '-1');
      ini_set('max_execution_time', '0');
      $single_ans_ques = DB::table('questions')
                        ->join('answers','answers.question_id','=','questions.id')
                        ->select('questions.question as questions','answers.answer')
                        ->get();
                 
        $question_details =[];
        foreach($single_ans_ques as $full_deails) :
             $question_details[$full_deails->questions][] = $full_deails->answer;
        endforeach;

      return view('pages.multi-answered_ques',compact('question_details'));
    }
    public function singleDate(){
      return view('pages.single-date');
    }

    public function singleDatedata (Request $request){
      $post= $request->all();
      //dd($post);
   
      
      $limit = $request->input('length');
      $start = $request->input('start');
      $search = $request->input('search.value');

      $start_date = $request->input('start_date');
      $end_date = $request->input('end_date');

      

         $custom_date = date('Y-m-d');
        // $custom_date = explode('-',$custom_date);
        // $custome_year = $custom_date[0];
        // $custome_month = $custom_date[1];
        // $custome_day = $custom_date[2];
       //  AFTER CUSTOMIZE GET DATA
        //dd($post);
        if($post['start_date']){
        // dd($post);
          $date = date('Y-m-d',strtotime($post['start_date']));
        }else{
         $date = date('Y-m-d');
        // dd($date);
        }

      
      $column_order = array(
          "questions.id",
          "users.name",
          "users.mobile",
          "questions.created_at",
          "questions.question"); //set column field database for datatable orderable
  
      $column_search = array(
        "questions.id",
        "users.name",
        "users.mobile",
        "questions.created_at",
        "questions.question"); //set column field database for datatable searchable
  
      $order = array("questions.id" => 'desc');
  
      $recordsTotal =  DB::table('questions')
                      ->count();  //DEAFAULT COUNT FOR DATATABLE
     
      $list =  DB::table('questions')
                 ->join('users','users.id','=','questions.asked_by')
                 ->select('questions.*','users.name','users.mobile','users.institutionname')
                 ->where('questions.created_at', 'like', '%' . $date . '%');   
  
     // echo $list->toSql(); exit;

      if (!empty($search)) {
        $list->where(function($query) use ($search, $column_search) {
          $query->where("questions.id", 'LIKE', "%{$search}%");
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
          //$row[] = ++$sl;
          $row[] = $value->id;
          $row[] = $value->name;
          $row[] = $value->mobile;
          $row[] = $value->created_at;
          $row[] = $value->question;
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
 
}
