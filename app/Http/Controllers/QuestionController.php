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
      
      $all_q = DB::table('post_q')
            ->join('subjects','subjects.id','=','post_q.subject_id')
            ->select('post_q.*','subjects.name as sname')
            ->get();

  
       return view('pages.all-question');
    }
    public function allQuesData(Request $request){
    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');

    $column_order = array(
        "post_q.id",
        "post_q.user_name",
        "post_q.user_email",
        "post_q.date",
        "post_q.quens",
        "post_q.subject"); //set column field database for datatable orderable

    $column_search = array(
        "post_q.user_name",
        "post_q.user_email",
        "post_q.date",
        "post_q.quens",
        "post_q.subject"); //set column field database for datatable searchable

    $order = array("post_q.id" => 'desc');

    $recordsTotal =  DB::table('post_q')
                    ->count();  //DEAFAULT DOUNT FOR DATATABLE
   
    $list = DB::table('post_q')
            ->join('subjects','subjects.id','=','post_q.subject_id')
            ->select('post_q.*','subjects.name as sname');

    //echo $list->toSql(); exit;

    // if (!empty($EMPLOYEE_ID)) {
    //   $list->where("users.EMPLOYEE_ID", $EMPLOYEE_ID);
    // }

    if (!empty($search)) {
      $list->where(function($query) use ($search, $column_search) {
        $query->where("post_q.id", 'LIKE', "%{$search}%");
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
        
        $row[] = $value->id;
        $row[] = $value->user_name;
        $row[] = $value->quens;
        $row[] = $value->date;
        $row[] = $value->subject;
       // $row[] = $value->quens;
       // $row[] = $value->sname;
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

      $today_qus =  DB::table('post_q')
                      ->where('date', 'like', '%'.$todaydate.'%')
                      ->where('status',0)
                      ->get();
       return view('pages.today-question',compact('today_qus'));
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
      // $all_qus_ans = DB::table('post_q')
      //              ->join('ans','ans.post_id','=','post_q.id')
      //              ->select('post_q.id','post_q.quens','ans.ans')
      //              ->get();
      //dd($all_qus_ans);
       return view('pages.all-ques_ans');
    }
    //ANS AND QUESTIONS DATA BY AJAX DATATABLE
    public function quesAnsData(Request $request){
     
    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');

    $column_order = array(
        "post_q.id"); //set column field database for datatable orderable

    $column_search = array(
        "post_q.quens"); //set column field database for datatable searchable

    $order = array("post_q.id" => 'desc');

    $recordsTotal =  DB::table('post_q')
                    // ->join('ans','ans.post_id','=','post_q.id')
                    // ->select('post_q.id','post_q.quens','ans.ans')
                    ->count();  //DEAFAULT DOUNT FOR DATATABLE
   
    $list = DB::table('post_q')
                    ->join('ans','ans.post_id','=','post_q.id')
                    ->select('post_q.id','post_q.quens','ans.ans');
            // ->selectRaw("users.`name`,users.`mobile`,users.`institutionname`,(SELECT COUNT(ans.id) FROM ans WHERE ans.user_id = users.id AND ans.`date` BETWEEN '$from_date' AND '$to_date') AS total")
            //->leftJoin('ans', 'ans.user_id', "users.id")
           // ->where('users.isTeacher',1);
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
       
        //$row[] = ++$sl;
        $row[] = $value->id;
        $row[] = $value->quens;
        $row[] = $value->ans;
  

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
      $pending_ques = DB::table('post_q')
                     ->where('status',0)
                     ->orWhere('status',2)
                     ->get();
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
      $single_ans_ques = DB::table('post_q')
                        ->join('ans','ans.post_id','=','post_q.id')
                        ->select('post_q.quens as questions','ans.ans as answer')
                        ->get();
        $question_details =[];
        foreach($single_ans_ques as $full_deails) :
             $question_details[$full_deails->questions][] = $full_deails->answer;
        endforeach;

      return view('pages.multi-answered_ques',compact('question_details'));
    }
 
}
