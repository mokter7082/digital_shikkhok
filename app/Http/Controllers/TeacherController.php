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
     public function teacherView($id){
     $user = DB::table("users")
            ->where("id",$id)
            ->first();
            $refCode = $user->referral_code;
      $referedUsers =  DB::table("users")
            ->where("referred_by",$refCode)
            ->get();
       return view('pages.referal-users',compact('referedUsers'));
    }
    public function addSubject($id){
       $add_subject = DB::table('users')
                       ->join('teacher_subject','teacher_subject.teacher_id','=','users.id')

                       ->select('users.*',DB::raw('group_concat(teacher_subject.subject_id) as s_id'))
                       ->where('users.id',$id)
                       ->groupBy('users.id')
                       ->first();
            // dd($add_subject);
       return view('pages.add-subject',compact('add_subject'));
    }
    public function updateTeacher(Request $request,$id){
         //dd($id);
        $update_data = array();
        $update_data['name'] = $request->name;
        $update_data['email'] = $request->email;
        $update_data['mobile'] = $request->mobile;
        $update_data['institutionname'] = $request->institutionname;
        //dd($update_data);
        $t_update = DB::table('users')->where('id',$id)->update($update_data);
        Session::flash('message', 'Update Success');
        return Redirect::back();
         
    }
    public function insertTeacher(Request $request){
      //$teacher_id = $request->teacher_id;
      $subject_id = $request->subject_id;
      
      $dataInsertArray = [];
      foreach($subject_id as $subject){
        $dataInsertArray[] = array(
          'teacher_id' => ($request->teacher_id),
          'subject_id' => $subject
        );
      }
      //dd($dataInsertArray);
      $insert = DB::table('teacher_subject')->insert($dataInsertArray);
      Session::flash('message','Subject Add success');
      return Redirect::back();
      //return Redirect::to('/edit-teacher/'.$request->teacher_id);    

 }
 public function editTeacher($id){
   //return "fghksjfdh";
  $edit_teacher = DB::table('users')
                  ->where('users.id',$id)
                  ->first();
  return view('pages.edit-teachers',compact('edit_teacher'));
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
    public function teacherBlock(Request $req){
      $id = $req->input('id');
      //dd($id);
     DB::table('users')
      ->where('id',$id)
      ->update(['status' => '3']);
      return response()->json([
        "message"=>"teacher status update 3 success"
        ]);     
}
   public function teacherUnblock(Request $req){
      $id = $req->input('id');
      //dd($id);
     DB::table('users')
      ->where('id',$id)
      ->update(['status' => '1']);

      return response()->json([
        "message"=>"teacher status update 1 success"
        ]);    

  }
  public function activeTeacher(){
     date_default_timezone_set("Asia/Dhaka");
       $todaydate = date("Y-m-d");
       //dd($todaydate);
    $active_teacher = DB::select("SELECT users.id,users.name, users.email, users.mobile,users.institutionname,users.type,answers.id,answers.answered_by,answers.created_at 
FROM answers INNER JOIN users ON users.id = answers.answered_by 
WHERE answers.created_at LIKE '%$todaydate%' AND users.type = 1 GROUP BY answers.answered_by");
  //dd($active_teacher);
    return view('pages.active-teacher',compact('active_teacher'));
  }
}
