<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use URL;
use App\Http\Middleware\DashboardMiddleware;

class SuperadminController extends Controller
{

    public function Login(Request $request){
        
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '0');
       $mobile = $request->mobile;
       $password = $request->password;
    
        // $logcheck = DB::table('users')
        //             ->where('email',$email)
        //             ->where('pass',$password)
        //             ->first();

        $result = DB::table('users')
                 ->where('mobile',$mobile)
                 ->where('pass',$password)
                 ->first();

                 //dd($result);
          if($result){
               Session::put('user_id',$result->id);
               Session::put('email',$result->email);
               Session::put('type',$result->type);
               Session::put('name',$result->name);
              // Session::put('institutionname',$result->institutionname);
               return redirect()->route('dashboard');
           }else {
                 return Redirect::back()->withErrors(['Please enter your valid number and password !']);
            }

    }
    public function Logout(){
        Session::flush();
       return Redirect::to('/');
    }
    public function adminDashboard(){
        return view('pages.home');
    }
}
