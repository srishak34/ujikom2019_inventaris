<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class CheckingLoginAccess
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
			$level = Auth::user()->level_id;
			switch ($level) {
				case 1:
				return redirect('/admin');
				break;

				case 2:
				return redirect('/operator');
				break;

				default:
				return redirect('/peminjam');
				break;
			}
		} else {
			return $next($request);
		}
	}
}
