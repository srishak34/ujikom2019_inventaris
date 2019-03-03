<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class CheckingLevelAccess
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
        if (Auth::guard()->check()) {
            if ($request->is('admin') || $request->is('admin/*')) {
                if (Auth::user()->level_id == 1) {
                    return $next($request);
                } else {
                    return back();
                }
            } elseif ($request->is('operator') || $request->is('operator/*')) {
                if (Auth::user()->level_id == 2) {
                    return $next($request);
                } else {
                    return back();
                }
            } elseif ($request->is('peminjam') || $request->is('peminjam/*')) {
                if (Auth::user()->level_id == 3) {
                    return $next($request);
                } else {
                    return back();
                }
            }            
        } else {
            Session::flash('notif_danger', 'Login Terlebih Dahulu!!!');
            return redirect('/loginPage');
        }
    }
}
