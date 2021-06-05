<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Session;
class DashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

          public function handle($request, Closure $next)
                {
                   // echo Session::get('username');
                    if (Session::has('email')) {
                        return $next($request);
                    }
                    return response()->json('ERROR 404');

                }
    
  }
