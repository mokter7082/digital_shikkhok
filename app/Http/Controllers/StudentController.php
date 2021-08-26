<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function allStudent(){
  
      return view('pages.all-student');
    }
    public function studentData(Request $request){


    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');

    $column_order = array(
        "users.id",
        "users.name",
        "users.mobile",
        "users.date",
        "users.institutionname"); //set column field database for datatable orderable

    $column_search = array(
        "users.id",
        "users.name",
        "users.mobile",
        "users.date",
      "users.institutionname"); //set column field database for datatable searchable

    $order = array("users.id" => 'asc');

    $recordsTotal = DB::table('users')
            //->where('users.isTeacher',1)
            ->count();
   
    $list = DB::table('users')
    ->where('type',2);
            


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
    //dd($list);
    // generate server side datatables
    $data = array();
  //   $arr =[
  //     1 => "Teacher",
  //     2 => "Student",
  //     3 => "Answer Hero",
  //     4 => "Admin",
  //     5 => "Others",
  //     6 => "Editior",
  // ];
    $sl = $start;
    if (!empty($list)) {
      foreach ($list as $value) {
        $row = array();
       //dd($row);
       // $row[] = ++$sl;
        $row[] = $value->id;
        $row[] = $value->name;
        $row[] = $value->email;
        $row[] = $value->mobile;
        // $row[] = $value->institutionname;
        $row[] = $value->date;
        $button = '<button type="submit" class="btn btn-primary btn-sm " id="refer' . $value->id . '" onclick="refer(' . $value->id . ')">Refar User</button>'.'<br>'.
        '<button type="submit" class="btn btn-danger btn-sm delete" style="margin-top:3px;" id="s_delete' . $value->id . '" onclick="s_delete(' . $value->id . ')">Delete</button>'.'<br>';
  
        if($value->status  == 3 ){
          $button.='<button type="submit" class="btn btn-warning btn-sm block" style="margin-top:3px;" id="s_block' . $value->id . '" onclick="student_block(' . $value->id . ')">Unblock</button>';
        }else{
           $button.='<button type="submit" class="btn btn-danger btn-sm block" style="margin-top:3px;" id="s_block' . $value->id . '" onclick="student_block(' . $value->id . ')">Block</button>';
        }
        $row[] = $button;
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
    public function editStudent($id){
      //return "fghksjfdh";
     $edit_student = DB::table('users')
                     ->where('users.id',$id)
                     ->first();
                    // dd($edit_student);
     return view('pages.edit-student',compact('edit_student'));
   }
   public function updateStudent(Request $request,$id){
    //dd($id);
   $update_data = array();
   $update_data['name'] = $request->name;
   $update_data['email'] = $request->email;
   $update_data['mobile'] = $request->mobile;
   $update_data['institutionname'] = $request->institutionname;
   //dd($update_data);
   $t_update = DB::table('users')->where('id',$id)->update($update_data);
   Session::flash('message', 'Updated');
   return Redirect::back();
    
}
    public function todaySturegister(){
      date_default_timezone_set("Asia/Dhaka");
      $todaydate = date("Y-m-d");
      $today_st_re =  DB::table('users')
            ->where('date', 'like', '%' . $todaydate . '%')
            ->where('type',2)
            ->get();
           // dd($today_st_re);
            return view('pages.today-stu_register',compact('today_st_re'));

    }
    public function studentInactive(Request $req){
        $id = $req->input('id');
         DB::table('users')
             ->where('id',$id)
             ->update(['status' => 'not_verified']);
             echo $id;

      }
      public function studentActive(Request $req){
        $id = $req->input('id');
        DB::table('users')
             ->where('id',$id)
             ->update(['status' => 'verified']);
             echo $id;

      }
      public function studentDelete(Request $request){
            $id = $request->input('id');
            DB::table('users')
                    ->where('id', $id)
                    ->delete();
            return response()->json('delete success');
       }
        public function studentRefar(Request $request){
            $id = $request->input('id');
           $user = DB::table('users')
                    ->where('id', $id)
                    ->first();
            $refarCode = $user->referral_code;
            $refarUsers = DB::table("users")
                   ->where("referred_by",$refarCode)
                   ->get();
            return response()->json($refarUsers);
       }
           public function studentBlock(Request $req){
             $id = $req->input('id');
             //dd($id);
            DB::table('users')
             ->where('id',$id)
             ->update(['status' => '3']);
             return response()->json(['success']);     
      }
          public function studentUnblock(Request $req){
             $id = $req->input('id');
             //dd($id);
            DB::table('users')
             ->where('id',$id)
             ->update(['status' => '1']);

             return response()->json(['success']);     

      }
       public function activeStudent(){
     date_default_timezone_set("Asia/Dhaka");
       $todaydate = date("Y-m-d");
       //dd($todaydate);
    $active_student = DB::select("SELECT users.id,users.name, users.email, users.mobile,users.institutionname,users.type,questions.id,questions.asked_by,questions.created_at 
FROM questions INNER JOIN users ON users.id = questions.asked_by 
WHERE questions.created_at LIKE '%$todaydate%' AND users.type = 2 GROUP BY questions.asked_by");
  //dd($active_student);
    return view('pages.active-student',compact('active_student'));
  }
}
