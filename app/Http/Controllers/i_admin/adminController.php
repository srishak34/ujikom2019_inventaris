<?php

namespace App\Http\Controllers\i_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\Petugas;
use App\Ruang;
use App\Jenis;
use App\Peminjaman;
use App\Pegawai;
use Session;

class adminController extends Controller
{
    public function index_i()
    {
        $inv = count(Inventaris::select('id')->get());
        $d_petugas = count(Petugas::select('id')->get());
        $d_pegawai = count(Pegawai::select('id')->get());
        $d_ruang = count(Ruang::select('id')->get());
        $d_jenis = count(Jenis::select('id')->get());
        $t_pm = count(Peminjaman::where('status_peminjaman', '=', 'dipinjam')->select('id')->get());
        $t_pd = count(Peminjaman::where('status_peminjaman', '=', 'pending')->select('id')->get());
        $t_pg = count(Peminjaman::where('status_peminjaman', '=', 'dikembalikan')->select('id')->get());
        
        return view('users.admin.dashboard.dashboard', compact('inv', 'd_petugas', 'd_pegawai', 'd_ruang', 'd_jenis', 't_pm', 't_pd', 't_pg'));
    }
}
