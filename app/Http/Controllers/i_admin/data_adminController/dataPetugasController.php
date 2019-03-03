<?php

namespace App\Http\Controllers\i_admin\data_adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Petugas;
use App\Level;
use App\Pegawai;
use Session;
use Hash;

class dataPetugasController extends Controller
{
    public function index_dataPetugas()
    {
    	$petugas = Petugas::orderBy('id', 'asc')->get();
		$plans = $petugas->map(function($plan){
			$plan->level_id = str_replace($plan->level_id, Level::find($plan->level_id)->level, $plan->level_id);
			return $plan;
		});
		$no = 1;
		return view('users.admin.data.d_petugas', compact('plans', 'no'));
    }

    public function create_dataPetugas(Request $req)
	{
		$this -> validate($req, [
			'username' => 'unique:petugas'
		]);

		if ($req -> isMethod('post')) {
			$username = $req->input('c_username');
			$unique = Petugas::where('username', $username)->first();
			if ($unique !== null) {
				Session::flash('notif_danger', 'Username Telah Digunakan!');
				return back(); 
			}
			$petugas = new Petugas;
			$pegawai = new Pegawai;
			$petugas->username = $req->input('c_username');
			if ($req->input('c_pass') != null) {
				if ($req->input('c_pass') == $req->input('c_k_pass')) {
					$password = Hash::make($req->input('c_pass'));
				} else {
					Session::flash('notif_danger', 'Konfirmasi Password Tidak Sama!');
					return back();
				}            
			} else {
				Session::flash('notif_danger', 'Password Kosong!');
				return back();
			}
			$petugas->password = $password;
			$petugas->nama_petugas = $req->input('c_n_petugas');
			$pegawai->nama_pegawai = $req->input('c_n_petugas');
			$petugas->level_id = $req->input('c_level');
			if ($petugas->save() && $pegawai->save()) {
				Session::flash('notif_success', 'Data Berhasil Dibuat');
				return redirect('/admin/dataPetugas');
			} else {
				Session::flash('notif_danger', 'Error: [D_Petugas=Create_Error] Data Tidak Berhasil Dibuat');
				return redirect('/admin/dataPetugas');
			}
		} else {
			$level = Level::orderBy('id')->get();
			return view('users.admin.data.d_petugas.create', compact('level'));
		}
	}

	public function update_dataPetugas(Request $req, $id = null)
	{
		if ($req -> isMethod('patch')) {
			$petugas = Petugas::findOrFail($id);
			$username = $req->input('u_username');
			$unique = Petugas::where('username', $username)->first();
			if ($unique !== null) {
				if ($username === strtolower($unique->username) ) {
					if ($id == $unique->id) {
						$petugas->username = $username;
					} else {
						Session::flash('notif_danger', 'Username Telah Digunakan');
						return back();
					}
				}
			} else {
				$petugas->username = $username;
			}
			if ($req->input('u_pass') != null) {				
				$password = Hash::make($req->input('u_pass'));
				$petugas->password = $password;            
			} else {
				Session::flash('notif_danger', 'Password Kosong Tidak Sama!');
				return back();
			}
			$petugas->nama_petugas = $req->input('u_n_petugas');
			$petugas->level_id = $req->input('u_level');

			if ($petugas->save()) {
				Session::flash('notif_success', 'Data Berhasil Diupdate');
				return redirect('/admin/dataPetugas');
			} else {
				Session::flash('notif_danger', 'Error: [D_Petugas=Update_Error] Data Tidak Berhasil Diupdate');
				return redirect('/admin/dataPetugas');
			}
		} else {
			$petugas = Petugas::findOrFail($id);
			$level = Level::orderBy('id', 'asc')->get();

			$n_p = str_replace($petugas->level_id, Level::find($petugas->level_id)->level, $petugas->level_id);
			return view('users.admin.data.d_petugas.update', compact('petugas', 'level', 'n_p'));
		}
	}

	public function destroy_dataPetugas(Request $req, $id)
	{
		if ($id != null) {
			$data = Petugas::findOrFail($id);
			if ($data->delete()) {
				Session::flash('notif_success', 'Data Berhasil Di Hapus');
				return back();
			} else {
				Session::flash('notif_danger', 'Error: [D_Petugas=Delete_ERROR] Data Tidak Berhasil Dihapus');
				return back();
			}
		}
	}
}
