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
      $all_student = DB::select("SELECT * FROM users WHERE type = 2");
                  //dd($all_student);
   
      return view('pages.all-student',compact('all_student'));
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
