<?php

namespace App\Http\Controllers\i_peminjam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DetailP;
use App\inventaris;
use App\Peminjaman;
use App\Pegawai;
use App\Petugas;
use App\Jenis;
use App\Ruang;
use Session;
use DateTime;
use DB;
use Auth;

class peminjamController extends Controller
{
	public function index_peminjamTransaksi() {
		$p = Pegawai::where('nama_pegawai', '=', Auth::user()->nama_petugas)->first();

		$plans = DB::table('detail_peminjaman')->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')->join('inventaris', 'inventaris.id', '=', 'detail_peminjaman.inventaris_id')->where('peminjaman.pegawai_id', '=', $p->id)->whereIn('peminjaman.status_peminjaman', ['dipinjam', 'Pending'])->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam')->get();

		$d = $plans->map(function($dt) {
			$dt->inventaris_id = str_replace($dt->inventaris_id, Inventaris::find($dt->inventaris_id)->nama, $dt->inventaris_id);
			$dt->peminjaman_id = str_replace($dt->peminjaman_id, Peminjaman::find($dt->peminjaman_id)->status_peminjaman, $dt->peminjaman_id);
			$dt->pegawai_id = str_replace($dt->pegawai_id, Pegawai::find($dt->pegawai_id)->nama_pegawai, $dt->pegawai_id);
			return $dt;
		});

		$no = 1;
		return view('users.peminjam.peminjam', compact('d', 'no'));
	}

	public function create_peminjamTransaksi(Request $req)
	{
		if ($req -> isMethod('post')) {
			$date = new DateTime;
			$d = new DetailP;
			$pn = new Peminjaman;
			$i = new Inventaris;

			#### QUERY KE INVENTARIS ####
			$i_find = Inventaris::findOrFail($req->input('c_n_inventaris'));
			$i_find -> jumlah = $i_find -> jumlah - $req->input('c_jumlah');
			if ($i_find->jumlah <= -1) {
				Session::flash('notif_danger', 'Nilai Jumlah yang Dipinjam Melebihi Stock Inventaris yang Dipilih!!!');
				return back();
			} else {
				#### QUERY KE PEMINJAMAN ####
				$pn -> tgl_pinjam = $date->format('Y-m-d');
				$pn -> status_peminjaman = $req->input('c_status');
				$pn -> pegawai_id = $req->input('c_pegawai');
				if ($pn -> save()) {
					#### QUERY KE DETAIL ####
					$d -> inventaris_id = $req->input('c_n_inventaris');
					$d -> peminjaman_id = $pn->id;
					$d -> jumlah = $req->input('c_jumlah');                    
					if ($d->save()) {
						Session::flash('notif_success', 'Data Berhasil Dibuat');
						return redirect('/peminjam');
					} else {
						Session::flash('notif_danger', 'Error: [D_Peminjaman_INVENTARIS_QUERY=Create_Error] Data Tidak Berhasil Dibuat');
						return redirect('/peminjam');
					}
				} else {
					Session::flash('notif_danger', 'Error: [D_Peminjaman_DETAIL.P_QUERY=Create_Error] Data Tidak Berhasil Dibuat');
					return redirect('/peminjam');
				}           
			}
		} else {

			$p = Pegawai::where('nama_pegawai', '=', Auth::user()->nama_petugas)->first();
			$i = Inventaris::get();
			return view('users.peminjam.t_peminjaman.create', compact('p', 'i'));
		}
	}

	public function detail_peminjamTransaksi(Request $req, $id)
	{
		$d = DetailP::findOrFail($id);
		$inv = Inventaris::findOrFail($d->inventaris_id);
		$pn = Peminjaman::findOrFail($d->peminjaman_id);

		$inv->jenis_id = str_replace($inv->jenis_id, Jenis::find($inv->jenis_id)->nama_jenis, $inv->jenis_id);
		$inv->ruang_id = str_replace($inv->ruang_id, Ruang::find($inv->ruang_id)->nama_ruang, $inv->ruang_id);

		$pn->pegawai_id = str_replace($pn->pegawai_id, Pegawai::find($pn->pegawai_id)->nama_pegawai, $pn->pegawai_id);


		return view('users.peminjam.t_peminjaman.detail', compact('d', 'inv', 'pn'));
	}
}
