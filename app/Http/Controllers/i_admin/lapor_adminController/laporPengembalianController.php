<?php

namespace App\Http\Controllers\i_admin\lapor_adminController;

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
use PDF;
use App;

class laporPengembalianController extends Controller
{
	public function index_dataTransaksi()
	{
		$plans = DB::table('detail_peminjaman')
		->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
		->join('inventaris', 'inventaris.id', '=', 'detail_peminjaman.inventaris_id')
		->where('peminjaman.status_peminjaman', '=', 'dikembalikan')
		->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam',  'peminjaman.tgl_kembali')
		->get();
		

		$d = $plans->map(function($dt) {
			$dt->inventaris_id = str_replace($dt->inventaris_id, Inventaris::find($dt->inventaris_id)->nama, $dt->inventaris_id);
			$dt->peminjaman_id = str_replace($dt->peminjaman_id, Peminjaman::find($dt->peminjaman_id)->status_peminjaman, $dt->peminjaman_id);
			$dt->pegawai_id = str_replace($dt->pegawai_id, Pegawai::find($dt->pegawai_id)->nama_pegawai, $dt->pegawai_id);
			return $dt;
		});

		$no = 1;
		return view('users.admin.laporan.l_pengembalian', compact('d', 'no'));
	}

	public function export_pdf(Request $req)
	{		
		if ($req->isMethod('post')) {
			$path = $req->input('path');
			$s = $req->input('search');
			$no = 1;

			$inv = Inventaris::where('nama', 'like', '%'.$s.'%')->first();
			$p = Pegawai::where('nama_pegawai', 'like', '%'.$s.'%')->first();
			
			if ($p) {
				$id_p = $p->id;
			}

			$pn = Peminjaman::where('tgl_pinjam', 'like', '%'.$s.'%')
			->orWhere('tgl_kembali', 'like', '%'.$s.'%')
			->orWhere('status_peminjaman', 'like', '%'.$s.'%')
			->orWhere('pegawai_id', 'like', '%'.(isset($id_p) ? $id_p : 0).'%')
			->get();

			if (count($pn)) {
				$query = $pn->map(function($dt){
					$plans = DB::table('detail_peminjaman')
					->join('peminjaman', function($join) use ($dt) {
						$join->on('peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
						->where('detail_peminjaman.peminjaman_id', '=', $dt->id);
					})
					->join('inventaris', 'inventaris.id', '=', 'detail_peminjaman.inventaris_id')
					->where('peminjaman.status_peminjaman', '=', 'dikembalikan')
					->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali')
					->get();
					return $plans;
				});

				$search = $query->map(function($dtd) {
					$ucup = $dtd->map(function($dt){
						$dt->inventaris_id = str_replace($dt->inventaris_id, Inventaris::find($dt->inventaris_id)->nama, $dt->inventaris_id);
						$dt->peminjaman_id = str_replace($dt->peminjaman_id, Peminjaman::find($dt->peminjaman_id)->status_peminjaman, $dt->peminjaman_id);
						$dt->pegawai_id = str_replace($dt->pegawai_id, Pegawai::find($dt->pegawai_id)->nama_pegawai, $dt->pegawai_id);
						return $dt;
					});
					return $ucup;
				});

				return view('users.admin.laporan.temp.l_pengembalian_template', compact('path', 'search', 'no'));
			} elseif ($inv) {

				$plans = DB::table('detail_peminjaman')
				->join('inventaris', function($join) use ($inv) {
					$join->on('inventaris.id', '=', 'detail_peminjaman.inventaris_id')
					->where('detail_peminjaman.inventaris_id', '=', $inv->id);
				})
				->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
				->where('peminjaman.status_peminjaman', '=', 'dikembalikan')
				->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali')
				->get();
				
				$search = $plans->map(function($dt) {
					$dt->inventaris_id = str_replace($dt->inventaris_id, Inventaris::find($dt->inventaris_id)->nama, $dt->inventaris_id);
					$dt->peminjaman_id = str_replace($dt->peminjaman_id, Peminjaman::find($dt->peminjaman_id)->status_peminjaman, $dt->peminjaman_id);
					$dt->pegawai_id = str_replace($dt->pegawai_id, Pegawai::find($dt->pegawai_id)->nama_pegawai, $dt->pegawai_id);
					return $dt;
				});
				
				return view('users.admin.laporan.temp.l_pengembalian_template', compact('path', 'search', 'no'));
			}
		} else {
		$plans = DB::table('detail_peminjaman')
		->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
		->join('inventaris', 'inventaris.id', '=', 'detail_peminjaman.inventaris_id')
		->where('peminjaman.status_peminjaman', '=', 'dikembalikan')
		->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam',  'peminjaman.tgl_kembali')
		->get();


		$d = $plans->map(function($dt) {
			$dt->inventaris_id = str_replace($dt->inventaris_id, Inventaris::find($dt->inventaris_id)->nama, $dt->inventaris_id);
			$dt->peminjaman_id = str_replace($dt->peminjaman_id, Peminjaman::find($dt->peminjaman_id)->status_peminjaman, $dt->peminjaman_id);
			$dt->pegawai_id = str_replace($dt->pegawai_id, Pegawai::find($dt->pegawai_id)->nama_pegawai, $dt->pegawai_id);
			return $dt;
		});

		$no = 1;
		return view('users.admin.laporan.temp.l_pengembalian_template', compact('d', 'no'));
		}
		
	}
}
