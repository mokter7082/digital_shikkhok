<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class ScholarshipController extends Controller
{
    public function allScholarship(){
        //    $all_scholarship = DB::select("SELECT scolarship.user_id,COUNT(post_q.quens) quens_ct FROM `scolarship` INNER JOIN post_q ON post_q.user_id = scolarship.user_id GROUP BY scolarship.user_id");
    	
        //  //dd($all_scholarship);
        //         // $q_q = [];
           
        //         foreach ($all_scholarship as $key => $value) {
        //             $q_q[$value->user_id] = $value->quens_ct;
        //         }    
    	return view('pages.all-scholarship');
	}
  public function ansheroScholarship(){
    return view('pages.anshero-scholarship');
  }
  public function anshero_scho_data(Request $request){
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', '0');
    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');



    
    $column_order = array(
        "scolarship.id",
        "scolarship.name",
        "scolarship.mobile",
        "scolarship.ans"); //set column field database for datatable orderable

    $column_search = array(
      "scolarship.id",
      "scolarship.name",
      "scolarship.mobile",
      "scolarship.ans"); //set column field database for datatable searchable

    $order = array("scolarship.id" => 'desc');

    $recordsTotal =  DB::table('scolarship')
                    ->count();  //DEAFAULT COUNT FOR DATATABLE
   
    $list =   DB::table('scolarship')
    ->join('answers','answers.answered_by','=','scolarship.user_id')
    ->join('users','users.id','scolarship.user_id')
    ->select(array('scolarship.*','users.email','scolarship.ans', DB::raw('COUNT(answers.answered_by) as ans_count')))
    // ->select('scolarship.*','users.email','ans.user_id')
    ->groupBy('answers.answered_by');
  
  
       
             

    //echo $list->toSql(); exit;

    if (!empty($search)) {
      $list->where(function($query) use ($search, $column_search) {
        $query->where("scolarship.id", 'LIKE', "%{$search}%");
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
        $row[] = $value->email;
        $row[] = $value->mobile;
        $row[] = $value->ans;
        $row[] = $value->ans_count;
         $row[] = $value->date;
        if($value->status == 'আপনার আবেদনটি নিশ্চিত করা হয়েছে'){
          $row[] = '<button type="submit" class="btn btn-primary btn-sm" id="verified_'.$value->id.'"onclick="verification(' .$value->id. ')">আপনার আবেদনটি নিশ্চিত করা হয়েছে</button>';
        }else{
          $row[] = '<button type="submit" class="btn btn-danger btn-sm" id="verified_'.$value->id.'"onclick="verification(' .$value->id. ')">আপনার আবেদন পর্যালোচনা অধীন</button>';
        }
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
