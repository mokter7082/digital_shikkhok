<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class ScholarshipController extends Controller
{
    public function allScholarship(){
           $all_scholarship = DB::select("SELECT scolarship.user_id,COUNT(post_q.quens) quens_ct FROM `scolarship` INNER JOIN post_q ON post_q.user_id = scolarship.user_id GROUP BY scolarship.user_id");
    	
         //dd($all_scholarship);
                // $q_q = [];
           
                foreach ($all_scholarship as $key => $value) {
                    $q_q[$value->user_id] = $value->quens_ct;
                }
              //  dd($q_q);

              
    	return view('pages.all-scholarship',compact('q_q'));
	}
	 public function scholarshipVerified(Request $req){
        $id = $req->input('id');
        DB::table('scolarship')
             ->where('id',$id)
             ->update(['status' => 'আপনার আবেদনটি নিশ্চিত করা হয়েছে']);
        return response()->json(['success' => true]);

      }
       public function scholarshipNotverified(Request $req){
        $id = $req->input('id');
        DB::table('scolarship')
             ->where('id',$id)
             ->update(['status' => 'আপনার আবেদন পর্যালোচনা অধীন']);
        return response()->json(['success' => true]);

      }
}
