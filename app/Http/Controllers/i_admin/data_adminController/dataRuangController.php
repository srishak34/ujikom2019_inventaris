<?php

namespace App\Http\Controllers\i_admin\data_adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ruang;
use Session;

class dataRuangController extends Controller
{
	public function index_dataRuang()
	{
		$ruang = Ruang::orderBy('id', 'asc')->get();
		$no = 1;
		return view('users.admin.data.d_ruang', compact('ruang', 'no'));
	}

	public function create_dataRuang(Request $req)
	{

		if ($req -> isMethod('post')) {
			$ruang = new Ruang;
			$ruang-> nama_ruang = $req->input('c_n_ruang');
			$ruang-> kode_ruang = $req->input('c_k_ruang');
			$ruang-> keterangan = $req->input('c_keterangan');			
			if ($ruang->save()) {
				Session::flash('notif_success', 'Data Berhasil Dibuat');
				return redirect('/admin/dataRuang');
			} else {
				Session::flash('notif_danger', 'Error: [D_Ruang=Create_Error] Data Tidak Berhasil Dibuat');
				return redirect('/admin/dataRuang');
			}
		} else {
			return view('users.admin.data.d_ruang.create');
		}
	}

	public function update_dataRuang(Request $req, $id = null)
	{
		if ($req -> isMethod('patch')) {
			$ruang = ruang::findOrFail($id);
			$ruang -> nama_ruang = $req->input('u_n_ruang');
			$ruang -> kode_ruang = $req->input('u_k_ruang');
			$ruang -> keterangan = $req->input('u_keterangan');

			if ($ruang->save()) {
				Session::flash('notif_success', 'Data Berhasil Diupdate');
				return redirect('/admin/dataRuang');
			} else {
				Session::flash('notif_danger', 'Error: [D_Ruang=Update_Error] Data Tidak Berhasil Diupdate');
				return redirect('/admin/dataRuang');
			}
		} else {
			$ruang = ruang::findOrFail($id);
			return view('users.admin.data.d_ruang.update', compact('ruang'));
		}
	}

	public function destroy_dataRuang(Request $req, $id)
	{
		if ($id != null) {
			$data = Ruang::findOrFail($id);
			if ($data->delete()) {
				Session::flash('notif_success', 'Data Berhasil Di Hapus');
				return back();
			} else {
				Session::flash('notif_danger', 'Error: [D_Ruang=Delete_ERROR] Data Tidak Berhasil Dihapus');
				return back();
			}
		}

	}
}
