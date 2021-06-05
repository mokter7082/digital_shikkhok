<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class volunteerController extends Controller
{
    public function allVolunteers(){
    	$all_volunteer = DB::table('volunteers')->get();
    	return view('pages.all-volunteers',compact('all_volunteer'));
    }
}
