<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas;
use App\Level;
use Auth;
use Session;

class loginController extends Controller
{
	public function login(Request $req) {
		// dd(Auth::guard());
		if ($req -> isMethod('post')) {
			$data = $req->input();
			if ($data['l_username'] == null || $data['l_pass'] == null) {
				return redirect()->back()->with('notif_danger','Mohon Diisi!!!');
			}
			if (Auth::guard('petugas')->attempt(['username' => $data['l_username'], 'password'=> $data['l_pass']])) {
				if (Auth::guard()->check()) {
					if (Auth::user()->level_id == 1) {
						return redirect('/admin');
					} elseif (Auth::user()->level_id == 2) {
						return redirect('/operator'); 
					} else {
						return redirect('/peminjam');
					}
				} else {
					dd('Error Dina Login Kondisina');
				}
			} else {
				$exist = Petugas::where('username', '=', $req->input('l_username'))->first();
          		if ($exist) {
          			return redirect()->back()->with('notif_danger','Username atau Password Salah');
          		} else {
          			return redirect()->back()->with('notif_danger','Akun Tidak Dikenal');
          		}				
			}
		} else {
			return view('auth.login');
		}
	}

	public function logout()
	{
		Session::flush();
		Auth::logout();
		return redirect('/loginPage')->with('notif_success', 'Logout Berhasil');
	}
}
