<?php

namespace App\Http\Controllers\i_admin\data_adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jenis;
use Session;
use App\Inventaris;

class dataJenisController extends Controller
{
    public function index_dataJenis()
	{
		$jenis = Jenis::orderBy('id', 'asc')->get();
		$no = 1;
		return view('users.admin.data.d_jenis', compact('jenis', 'no'));
	}

	public function create_dataJenis(Request $req)
	{

		if ($req -> isMethod('post')) {
			$jenis = new jenis;
			$jenis-> nama_jenis = $req->input('c_n_jenis');
			$jenis-> kode_jenis = $req->input('c_k_jenis');
			$jenis-> keterangan = $req->input('c_keterangan');
			if ($jenis->save()) {
				Session::flash('notif_success', 'Data Berhasil Dibuat');
				return redirect('/admin/dataJenis');
			} else {
				Session::flash('notif_danger', 'Error: [D_Jenis=Create_Error] Data Tidak Berhasil Dibuat');
				return redirect('/admin/dataJenis');
			}
		} else {
			return view('users.admin.data.d_jenis.create');
		}
	}

	public function update_dataJenis(Request $req, $id = null)
	{
		if ($req -> isMethod('patch')) {
			$jenis = Jenis::findOrFail($id);
			$jenis -> nama_jenis = $req->input('u_n_jenis');
			$jenis -> kode_jenis = $req->input('u_k_jenis');
			$jenis -> keterangan = $req->input('u_keterangan');

			if ($jenis->save()) {
				Session::flash('notif_success', 'Data Berhasil Diupdate');
				return redirect('/admin/dataJenis');
			} else {
				Session::flash('notif_danger', 'Error: [D_Jenis=Update_Error] Data Tidak Berhasil Diupdate');
				return redirect('/admin/dataJenis');
			}
		} else {
			$jenis = Jenis::findOrFail($id);
			return view('users.admin.data.d_jenis.update', compact('jenis'));
		}
	}

	public function destroy_dataJenis(Request $req, $id)
	{
		if ($id != null) {
			$data = Jenis::findOrFail($id);
			if ($data->delete()) {
				Session::flash('notif_success', 'Data Berhasil Di Hapus');
				return back();
			} else {
				Session::flash('notif_danger', 'Error: [D_Jenis=Delete_ERROR] Data Tidak Berhasil Dihapus');
				return back();
			}
		}

	}
}
