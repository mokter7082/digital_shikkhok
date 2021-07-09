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
    	$bangla_sub = DB::table('questions')
                    ->where('subject_id', '1')
                    ->where(function($query) {
                      $query->where('status', '0')
                      ->orWhere('status', '2');
                     })->get();
                   //  dd($bangla_sub);
    	return view('pages/subject.bangla',compact('bangla_sub'));
    }
     public function English(){
    	$english_sub = DB::table('questions')
                    ->where('subject_id', '3')
                    ->where(function($query) {
                      $query->where('status', '0')
                      ->orWhere('status', '2');
                     })->get();
    	return view('pages/subject.english',compact('english_sub'));
    }
     public function Math(){
    	$math_sub = DB::table('questions')
                    ->where('subject_id', '5')
                    ->where(function($query) {
                      $query->where('status', '0')
                      ->orWhere('status', '2');
                     })->get();
    	return view('pages/subject.math',compact('math_sub'));
    }
     public function Chemistry(){
    	$chemistry_sub = DB::table('questions')
                        ->where('subject_id', '8')
                        ->where(function($query) {
                         $query->where('status', '0')
                        ->orWhere('status', '2');
                        })->get();
    	return view('pages/subject.chemistry',compact('chemistry_sub'));
    }
     public function Physics(){
    	$physics_sub = DB::table('questions')
                        ->where('subject_id', '7')
                        ->where(function($query) {
                         $query->where('status', '0')
                        ->orWhere('status', '2');
                        })->get();
    	return view('pages/subject.physics',compact('physics_sub'));
    }
     public function Higher_math(){
    	$higher_math_sub = DB::table('questions')
                         ->where('subject_id', '10')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.higher_math',compact('higher_math_sub'));
    }
     public function Accounting(){
    	$accounting_sub = DB::table('questions')
                         ->where('subject_id', '12')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.accounting',compact('accounting_sub'));
    }
     public function Biology(){
    	$biology_sub = DB::table('questions')
                         ->where('subject_id', '9')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->paginate(500);
    	return view('pages/subject.biology',compact('biology_sub'));
    }
     public function Geography(){
    	$geography_sub = DB::table('questions')
                         ->where('subject_id', '14')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.geography',compact('geography_sub'));
    }
     public function Ict(){
    	$ict_sub = DB::table('questions')
                         ->where('subject_id', '11')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.ict',compact('ict_sub'));
    }
     public function Agriculture(){
    	$agriculture_sub = DB::table('questions')
                         ->where('subject_id', '13')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
                 return view('pages/subject.agriculture',compact('agriculture_sub'));
    }
     public function Islam(){
    	$islam_sub = DB::table('questions')
                         ->where('subject_id', '6')
                         ->where(function($query) {
                         $query->where('status', '0')
                         ->orWhere('status', '2');
                         })->get();
    	return view('pages/subject.islam',compact('islam_sub'));
    }
}
