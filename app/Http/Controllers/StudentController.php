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
      $all_student = DB::table('users')
               ->where('type',2)            
                  ->get();
                 // dd($all_student);
   
      return view('pages.all-student',compact('all_student'));
    }
    public function todaySturegister(){
      date_default_timezone_set("Asia/Dhaka");
      $todaydate = date("Y-m-d");
      $today_st_re =  DB::table('users')
            ->where('date', 'like', '%' . $todaydate . '%')
            ->where('type',2)
            ->get();
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
}
