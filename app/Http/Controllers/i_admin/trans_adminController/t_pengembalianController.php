<?php

namespace App\Http\Controllers\i_admin\trans_adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DetailP;
use App\inventaris;
use App\Peminjaman;
use App\Pegawai;
use App\Ruang;
use App\Jenis;
use Session;
use DB;

class t_pengembalianController extends Controller
{
    public function index_dataTransaksi()
    {
    	$plans = DB::table('detail_peminjaman')->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')->join('inventaris', 'inventaris.id', '=', 'detail_peminjaman.inventaris_id')->where('peminjaman.status_peminjaman', '=', 'dikembalikan')->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam',  'peminjaman.tgl_kembali')->get();
    	

		$d = $plans->map(function($dt) {
			$dt->inventaris_id = str_replace($dt->inventaris_id, Inventaris::find($dt->inventaris_id)->nama, $dt->inventaris_id);
			$dt->peminjaman_id = str_replace($dt->peminjaman_id, Peminjaman::find($dt->peminjaman_id)->status_peminjaman, $dt->peminjaman_id);
			$dt->pegawai_id = str_replace($dt->pegawai_id, Pegawai::find($dt->pegawai_id)->nama_pegawai, $dt->pegawai_id);
			return $dt;
		});

		$no = 1;
		return view('users.admin.transaksi.t_pengembalian', compact('d', 'no'));
    }

    public function detail_dataTransaksi($id)
	{
		$d = DetailP::findOrFail($id);
		$inv = Inventaris::findOrFail($d->inventaris_id);
		$pn = Peminjaman::findOrFail($d->peminjaman_id);

		$inv->jenis_id = str_replace($inv->jenis_id, Jenis::find($inv->jenis_id)->nama_jenis, $inv->jenis_id);
		$inv->ruang_id = str_replace($inv->ruang_id, Ruang::find($inv->ruang_id)->nama_ruang, $inv->ruang_id);

		$pn->pegawai_id = str_replace($pn->pegawai_id, Pegawai::find($pn->pegawai_id)->nama_pegawai, $pn->pegawai_id);


		return view('users.admin.transaksi.t_pengembalian.detail', compact('d', 'inv', 'pn'));
	}
}
