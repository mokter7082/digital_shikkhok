<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class TeacherController extends Controller
{
    public function allTeacher(){
      
 $te_ans_count = DB::select("SELECT users.id,COUNT(ans.ans) ans_ct FROM `users` INNER JOIN ans ON ans.user_id = users.id GROUP BY users.id");
 //dd($te_ans_count);
  $a_q = [];
           
                foreach ($te_ans_count as $key => $value) {
                    $a_q[$value->id] = $value->ans_ct;
                }
                //dd($a_q);
      return view('pages.all-teacher',compact('a_q'));
    }
    public function teacherInactive(Request $req){
        $id = $req->input('id');
         DB::table('users')
             ->where('id',$id)
             ->update(['status' => '1']);
             return response()->json([
                              "messege"=>"successfully status Change 1",
                            ]);
         //     Session::flash('not_verified_message','This teacher is not verified');

            //return redirect::to('all-teacher');
      }
      public function teacherActive(Request $req){
        $id = $req->input('id');
        //dd($id);
        DB::table('users')
             ->where('id',$id)
             ->update(['status' => '0']);
             return response()->json([
                              "messege"=>"successfully status Change 0",
                       ]);
      }
    public function todayRegteacher(){
      date_default_timezone_set("Asia/Dhaka");
      $todaydate = date("Y-m-d");
      $today_register =  DB::table('users')
            ->where('date', 'like', '%' . $todaydate . '%')
            ->where('type',1)
            ->get();
            //     echo "<pre>";
            //      print_r($today_register);
            //     echo "</pre>";
          return view('pages.today-register',compact('today_register'));
    }
    public function lastWeekregister(){
      date_default_timezone_set("Asia/Dhaka");
      DB::table('users')
        ->select('*')
        ->whereIn('id', function($query)
        {
            $query->select('pid')
            ->from('prdrop');
        })
        ->get();
    }
    public function teacherReject($t_c_id){
      // return $id;
      // exit;
          DB::table('users')
           ->where('id',$t_c_id)
           //->update(['status' => 1]);
           ->update(['status'=> 0]);
          return redirect::to('today-register');
    }
    public function teacherDelete(Request $request){
         $id = $request->input('id');
         DB::table('users')
                 ->where('id', $id)
                 ->delete();
         return response()->json('delete success');
    }
    public function editTeacher($id){
       $edit_teacher = DB::table('users')
                       // ->join('institutes','institutes.user_id','=','users.id')
                       // ->join('teachers','teachers.institute_id','=','institutes.id')
                       // ->select('users.*','institutes.institute_name')
                       ->where('users.id',$id)
                       ->first();
             //dd($edit_teacher);
       return view('pages.edit-teacher',compact('edit_teacher'));
    }
    public function updateTeacher(Request $request,$id){
         //dd($id);
        $update_data = array();
        $update_data['name'] = $request->name;
        $update_data['email'] = $request->email;
        $update_data['mobile'] = $request->mobile;
        //dd($update_data);
        $t_update = DB::table('users')->where('id',$id)->update($update_data);
        if($t_update){
          return Redirect::to('all-teacher');
        }else{
          echo 'wrong';
        }
    }
    public function quesTiming(Request $request){
     // dd($request->all());
        $id = $request->id;
        $u_data = array();
        $u_data['time_start'] = $request->time_start;
        $u_data['time_end'] = $request->time_end;
        $u_data['updated_at'] = $request->updated_at;
         DB::table('questioning_time')
               ->where('id',$id)
               ->update($u_data);
      return response()->json('success');
    }

    public function answerHero(Request $req){
              $id = $req->input('id');
             DB::table('users')
             ->where('id',$id)
             ->update(['type' => '3']);
             return response()->json([
              "messege"=>"Answer hero Mission success",
             ],200);
    }
}
