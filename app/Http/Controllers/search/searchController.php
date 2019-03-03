<?php

namespace App\Http\Controllers\search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DetailP;
use App\Inventaris;
use App\Peminjaman;
use App\Pegawai;
use App\Petugas;
use App\Level;
use App\Jenis;
use App\Ruang;
use Session;
use DateTime;
use DB;
use Auth;

class searchController extends Controller
{
	public function search(Request $req)
	{
		$path = $req->input('path');
		// dd($path);
		$s = $req->input('search');
		if ($path == 'admin/dataInventaris') {
			$title = 'Inventaris';

			$j = Jenis::where('nama_jenis', 'like', '%'.$s.'%')->first();
			$r = Ruang::where('nama_ruang', 'like', '%'.$s.'%')->first();
			$p = Petugas::where('nama_petugas', 'like', '%'.$s.'%')->first();
			
			if ($j) {
				$id_j = $j->id;
			} elseif ($r) {
				$id_r = $r->id;
			} elseif ($p) {
				$id_p = $p->id;
			}

			$plans = Inventaris::where('nama', 'like', '%'.$s.'%')
			->orWhere('kondisi', 'like', '%'.$s.'%')
			->orWhere('keterangan', 'like', '%'.$s.'%')
			->orWhere('jumlah', 'like', '%'.$s.'%')
			->orWhere('kode_inventaris', 'like', '%'.$s.'%')
			->orWhere('created_at', 'like', '%'.$s.'%')
			->orWhere('updated_at', 'like', '%'.$s.'%')
			->orWhere('jenis_id', 'like', '%'.(isset($id_j) ? $id_j : 0).'%')
			->orWhere('ruang_id', 'like', '%'.(isset($id_r) ? $id_r : 0).'%')
			->orWhere('petugas_id', 'like', '%'.(isset($id_p) ? $id_p : 0).'%')
			->get();

			$search = $plans->map(function($i){
				$i->jenis_id = str_replace($i->jenis_id, Jenis::find($i->jenis_id)->nama_jenis, $i->jenis_id);
				$i->ruang_id = str_replace($i->ruang_id, Ruang::find($i->ruang_id)->nama_ruang, $i->ruang_id);
				$i->petugas_id = str_replace($i->petugas_id, Petugas::find($i->petugas_id)->nama_petugas, $i->petugas_id);
				return $i;
			});

			$no = 1;
			return view('search.search', compact('path', 's', 'search', 'title', 'no'));

		} elseif ($path == 'admin/dataPetugas') {
			$title = 'Data Petugas';

			$l = Level::where('level', 'like', '%'.$s.'%')->first();
			if ($l) {
				$id_l = $l->id;
			}

			$plans = Petugas::where('username', 'like', '%'.$s.'%')
			->orWhere('nama_petugas', 'like', '%'.$s.'%')
			->orWhere('level_id', 'like', '%'.$s.'%')			
			->orWhere('created_at', 'like', '%'.$s.'%')
			->orWhere('updated_at', 'like', '%'.$s.'%')
			->orWhere('level_id', 'like', '%'.(isset($id_l) ? $id_l : 0).'%')			
			->get();

			$search = $plans->map(function($plan){
				$plan->level_id = str_replace($plan->level_id, Level::find($plan->level_id)->level, $plan->level_id);
				return $plan;
			});

			$no = 1;
			return view('search.search', compact('path', 's', 'search', 'title', 'no'));
		} elseif ($path == 'admin/dataPegawai') {
			$title = 'Data Pegawai';

			$search = Pegawai::where('nama_pegawai', 'like', '%'.$s.'%')
			->orWhere('nip', 'like', '%'.$s.'%')
			->orWhere('alamat', 'like', '%'.$s.'%')			
			->orWhere('created_at', 'like', '%'.$s.'%')
			->orWhere('updated_at', 'like', '%'.$s.'%')
			->get();

			$no = 1;
			return view('search.search', compact('path', 's', 'search', 'title', 'no'));
		} elseif ($path == 'admin/dataRuang') {
			$title = 'Data Ruang';

			$search = Ruang::where('nama_ruang', 'like', '%'.$s.'%')
			->orWhere('kode_ruang', 'like', '%'.$s.'%')
			->orWhere('keterangan', 'like', '%'.$s.'%')			
			->orWhere('created_at', 'like', '%'.$s.'%')
			->orWhere('updated_at', 'like', '%'.$s.'%')
			->get();

			$no = 1;
			return view('search.search', compact('path', 's', 'search', 'title', 'no'));
		} elseif ($path == 'admin/dataJenis') {
			$title = 'Data Jenis';

			$search = Jenis::where('nama_jenis', 'like', '%'.$s.'%')
			->orWhere('kode_jenis', 'like', '%'.$s.'%')
			->orWhere('keterangan', 'like', '%'.$s.'%')			
			->orWhere('created_at', 'like', '%'.$s.'%')
			->orWhere('updated_at', 'like', '%'.$s.'%')
			->get();

			$no = 1;
			return view('search.search', compact('path', 's', 'search', 'title', 'no'));

		} elseif ($path == 'admin/trans_peminjaman' || $path == 'admin/laporan_peminjaman' || $path == 'operator') {
			if ($path == 'admin/laporan_peminjaman') {
				$title = 'Laporan Transaksi Peminjaman';
			} else {
				$title = 'Transaksi Peminjaman';
			}
			
			$no = 1;

			$inv = Inventaris::where('nama', 'like', '%'.$s.'%')->first();
			$p = Pegawai::where('nama_pegawai', 'like', '%'.$s.'%')->first();
			if ($path == 'admin/laporan_peminjaman') {
				$params = ['dipinjam'];
			} else {
				$params = ['dipinjam', 'pending'];
			}
			if ($p) {
				$id_p = $p->id;
			}

			$pn = Peminjaman::where('tgl_pinjam', 'like', '%'.$s.'%')
			->orWhere('tgl_kembali', 'like', '%'.$s.'%')
			->orWhere('status_peminjaman', 'like', '%'.$s.'%')
			->orWhere('pegawai_id', 'like', '%'.(isset($id_p) ? $id_p : 0).'%')
			->get();

			if (count($pn)) {
				$query = $pn->map(function($dt) use ($params){
					$plans = DB::table('detail_peminjaman')
					->join('peminjaman', function($join) use ($dt, $params) {
						$join->on('peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
						->where('detail_peminjaman.peminjaman_id', '=', $dt->id);
					})
					->join('inventaris', 'inventaris.id', '=', 'detail_peminjaman.inventaris_id')
					->whereIn('peminjaman.status_peminjaman', $params)
					->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam')
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

				return view('search.search', compact('path', 's', 'search', 'title', 'no'));
			} elseif ($inv) {

				$plans = DB::table('detail_peminjaman')
				->join('inventaris', function($join) use ($inv) {
					$join->on('inventaris.id', '=', 'detail_peminjaman.inventaris_id')
					->where('detail_peminjaman.inventaris_id', '=', $inv->id);
				})
				->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
				->whereIn('peminjaman.status_peminjaman', $params)
				->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam')
				->get();
				
				$search = $plans->map(function($dt) {
					$dt->inventaris_id = str_replace($dt->inventaris_id, Inventaris::find($dt->inventaris_id)->nama, $dt->inventaris_id);
					$dt->peminjaman_id = str_replace($dt->peminjaman_id, Peminjaman::find($dt->peminjaman_id)->status_peminjaman, $dt->peminjaman_id);
					$dt->pegawai_id = str_replace($dt->pegawai_id, Pegawai::find($dt->pegawai_id)->nama_pegawai, $dt->pegawai_id);
					return $dt;
				});
				
				return view('search.search', compact('path', 's', 'search', 'title', 'no'));
			}

			return view('search.search', compact('path', 's', 'search', 'title', 'no'));

		} elseif ($path == 'admin/trans_pengembalian' || $path == 'admin/laporan_pengembalian' || $path == 'operator/trans_pengembalian') {
			if ($path == 'admin/laporan_pengembalian') {
				$title = 'Laporan Transaksi Pengembalian';
			} else {
				$title = 'Transaksi Pengembalian';
			}
			
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

				return view('search.search', compact('path', 's', 'search', 'title', 'no'));
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
				
				return view('search.search', compact('path', 's', 'search', 'title', 'no'));
			}

			return view('search.search', compact('path', 's', 'search', 'title', 'no'));
		} elseif ($path == 'peminjam') {
			$title = 'Transaksi Peminjaman';
			$no = 1;

			$inv = Inventaris::where('nama', 'like', '%'.$s.'%')->first();
			$p = Pegawai::where('nama_pegawai', 'like', '%'.$s.'%')->first();
			$user_p = Pegawai::where('nama_pegawai', '=', Auth::user()->nama_petugas)->first();
			
			$id_p = ($p != null ? $p->id : 0);
			$id_user = ($user_p != null ? $user_p->id : 0);

			$pn = Peminjaman::where('tgl_pinjam', 'like', '%'.$s.'%')
			->orWhere('tgl_kembali', 'like', '%'.$s.'%')
			->orWhere('status_peminjaman', 'like', '%'.$s.'%')
			->orWhere('pegawai_id', 'like', '%'.$id_p.'%')
			->get();

			if (count($pn)) {
				$query = $pn->map(function($dt) use ($id_user) {
					$plans = DB::table('detail_peminjaman')
					->join('peminjaman', function($join) use ($dt, $id_user) {
						$join->on('peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
						->where('detail_peminjaman.peminjaman_id', '=', $dt->id);
					})
					->join('inventaris', 'inventaris.id', '=', 'detail_peminjaman.inventaris_id')
					->where('peminjaman.pegawai_id', '=', $id_user)
					->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam')
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

				return view('search.search', compact('path', 's', 'search', 'title', 'no'));
			} elseif ($inv) {

				$plans = DB::table('detail_peminjaman')
				->join('inventaris', function($join) use ($inv, $id_user) {
					$join->on('inventaris.id', '=', 'detail_peminjaman.inventaris_id')
					->where('detail_peminjaman.inventaris_id', '=', $inv->id);
				})
				->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
				->where('peminjaman.pegawai_id', '=', $id_user)
				->whereIn('peminjaman.status_peminjaman', ['dipinjam', 'pending'])
				->select('detail_peminjaman.*', 'peminjaman.pegawai_id', 'peminjaman.tgl_pinjam')
				->get();
				
				$search = $plans->map(function($dt) {
					$dt->inventaris_id = str_replace($dt->inventaris_id, Inventaris::find($dt->inventaris_id)->nama, $dt->inventaris_id);
					$dt->peminjaman_id = str_replace($dt->peminjaman_id, Peminjaman::find($dt->peminjaman_id)->status_peminjaman, $dt->peminjaman_id);
					$dt->pegawai_id = str_replace($dt->pegawai_id, Pegawai::find($dt->pegawai_id)->nama_pegawai, $dt->pegawai_id);
					return $dt;
				});
				
				return view('search.search', compact('path', 's', 'search', 'title', 'no'));
			}

			return view('search.search', compact('path', 's', 'search', 'title', 'no'));
		}
	}
}
