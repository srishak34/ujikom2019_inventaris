<?php

namespace App\Http\Controllers\i_admin\data_adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;
use Session;

class dataPegawaiController extends Controller
{
	public function index_dataPegawai()
	{
		$pegawai = Pegawai::orderBy('id', 'asc')->get();
		$no = 1;
		return view('users.admin.data.d_pegawai', compact('pegawai', 'no'));
	}

	public function create_dataPegawai(Request $req)
	{

		if ($req -> isMethod('post')) {
			$pegawai = new Pegawai;
			$pegawai->nama_pegawai = $req->input('c_n_pegawai');
			
			$unique = Pegawai::where('nip', $req->input('c_nip'))->first();
			if ($unique != null) {
				Session::flash('notif_danger', 'NIP Telah Digunakan!');
				return back();
			} else {
				$pegawai->nip = $req->input('c_nip');
			}			
			$pegawai->alamat = $req->input('c_alamat');
			if ($pegawai->save()) {
				Session::flash('notif_success', 'Data Berhasil Dibuat');
				return redirect('/admin/dataPegawai');
			} else {
				Session::flash('notif_danger', 'Error: [D_Pegawai=Create_Error] Data Tidak Berhasil Dibuat');
				return redirect('/admin/dataPegawai');
			}
		} else {
			return view('users.admin.data.d_pegawai.create');
		}
	}

	public function update_dataPegawai(Request $req, $id = null)
	{
		if ($req -> isMethod('patch')) {
			$pegawai = Pegawai::findOrFail($id);
			$nip = $req->input('u_nip');
			$unique = Pegawai::where('nip', $nip)->first();
			if ($unique !== null) {
				if ($nip === strtolower($unique->nip) ) {
					if ($id == $unique->id) {
						$pegawai->nip = $nip;
					} else {
						Session::flash('notif_danger', 'NIP Telah Digunakan!');
						return back();
					}
				}
			} else {
				$pegawai->nip = $nip;
			}

			$pegawai->nama_pegawai = $req->input('u_n_pegawai');
			$pegawai->alamat = $req->input('u_alamat');

			if ($pegawai->save()) {
				Session::flash('notif_success', 'Data Berhasil Diupdate');
				return redirect('/admin/dataPegawai');
			} else {
				Session::flash('notif_danger', 'Error: [D_Pegawai=Update_Error] Data Tidak Berhasil Diupdate');
				return redirect('/admin/dataPegawai');
			}
		} else {
			$pegawai = Pegawai::findOrFail($id);
			return view('users.admin.data.d_pegawai.update', compact('pegawai'));
		}
	}

	public function destroy_dataPegawai(Request $req, $id)
	{
		if ($id != null) {
			$data = Pegawai::findOrFail($id);
			if ($data->delete()) {
				Session::flash('notif_success', 'Data Berhasil Di Hapus');
				return back();
			} else {
				Session::flash('notif_danger', 'Error: [D_Pegawai=Delete_ERROR] Data Tidak Berhasil Dihapus');
				return back();
			}
		}

	}
}
