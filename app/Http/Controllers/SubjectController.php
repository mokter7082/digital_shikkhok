<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class SubjectController extends Controller
{
    public function pendingDashboard(){
        return view('pages/subject.pending-dashboard');
    }
    public function Bangla(){
    	$bangla_sub = DB::table('post_q')
                    ->where('subject_id', '1')
                    ->where(function($query) {
                      $query->where('status', '0')
                      ->orWhere('status', '2');
                     })->get();
    	return view('pages/subject.bangla',compact('bangla_sub'));
    }
     public function English(){
    	$english_sub = DB::table('post_q')
                    ->where('subject', 'english')
                    ->where(function($query) {
                      $query->where('status', '0')
                      ->orWhere('status', '2');
                     })->get();
    	return view('pages/subject.english',compact('english_sub'));
    }
     public function Math(){
    	$math_sub = DB::table('post_q')
                    ->where('subject', 'math')
                    ->where(function($query) {
                      $query->where('status', '0')
                      ->orWhere('status', '2');
                     })->get();
    	return view('pages/subject.math',compact('math_sub'));
    }
     public function Chemistry(){
    	$chemistry_sub = DB::table('post_q')
                        ->where('subject', 'chemistry')
                        ->where(function($query) {
                         $query->where('status', '0')
                        ->orWhere('status', '2');
                        })->get();
    	return view('pages/subject.chemistry',compact('chemistry_sub'));
    }
     public function Physics(){
    	$physics_sub = DB::table('post_q')
                        ->where('subject', 'physics')
                        ->where(function($query) {
                         $query->where('status', '0')
                        ->orWhere('status', '2');
                        })->get();
    	return view('pages/subject.physics',compact('physics_sub'));
    }
     public function Higher_math(){
    	$higher_math_sub = DB::table('post_q')
                         ->where('subject', 'higher_math')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.higher_math',compact('higher_math_sub'));
    }
     public function Accounting(){
    	$accounting_sub = DB::table('post_q')
                         ->where('subject', 'accounting')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.accounting',compact('accounting_sub'));
    }
     public function Biology(){
    	$biology_sub = DB::table('post_q')
                         ->where('subject', 'biology')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->paginate(500);
    	return view('pages/subject.biology',compact('biology_sub'));
    }
     public function Geography(){
    	$geography_sub = DB::table('post_q')
                         ->where('subject', 'geography')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.geography',compact('geography_sub'));
    }
     public function Ict(){
    	$ict_sub = DB::table('post_q')
                         ->where('subject', 'ict')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.ict',compact('ict_sub'));
    }
     public function Agriculture(){
    	$agriculture_sub = DB::table('post_q')
                         ->where('subject', 'agriculture')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
                 return view('pages/subject.agriculture',compact('agriculture_sub'));
    }
     public function Islam(){
    	$islam_sub = DB::table('post_q')
                         ->where('subject', 'islam')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.islam',compact('islam_sub'));
    }
}
