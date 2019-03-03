<?php

namespace App\Http\Controllers\i_admin\inventaris_adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\Petugas;
use App\Ruang;
use App\Jenis;
use Session;

class inventarisController extends Controller
{
    public function index_data_inv()
    {
        $plans = Inventaris::orderBy('nama', 'asc')->get();
        $inventaris = $plans->map(function($i){
            $i->jenis_id = str_replace($i->jenis_id, Jenis::find($i->jenis_id)->nama_jenis, $i->jenis_id);
            $i->ruang_id = str_replace($i->ruang_id, Ruang::find($i->ruang_id)->nama_ruang, $i->ruang_id);
            $i->petugas_id = str_replace($i->petugas_id, Petugas::find($i->petugas_id)->nama_petugas, $i->petugas_id);
            return $i;
        });
        $no = 1;

        return view('users.admin.inventarisir.inventaris', compact('inventaris', 'no'));
    }

    public function create_data_inv(Request $req)
    {
        if ($req -> isMethod('post')) {
            $i = new Inventaris;
            $i -> nama = $req -> input('c_n_barang');
            $i -> kondisi = $req -> input('c_kondisi');
            $i -> keterangan = $req -> input('c_keterangan');
            $i -> jumlah = $req -> input('c_jumlah');
            $i -> kode_inventaris = $req -> input('c_k_inventaris');
            $i -> jenis_id = $req -> input('c_jenis');
            $i -> ruang_id = $req -> input('c_ruang');
            $i -> petugas_id = $req -> input('c_petugas');
            $s = $i->save();
            if ($s) {
                Session::flash('notif_success', 'Data Berhasil Dibuat');
                return redirect('/admin/dataInventaris');
            } else {
                Session::flash('notif_danger', 'Error: [D_Inventaris=Create_Error] Data Tidak Berhasil Dibuat');
                return redirect('/admin/dataInventaris');
            }
        } else {
            $j = Jenis::orderBy('nama_jenis', 'asc')->get();
            $r = Ruang::orderBy('nama_ruang', 'asc')->get();
            $p = Petugas::orderBy('level_id', 'asc')->where('level_id', 1)->get();
            return view('users.admin.inventarisir.d_inventaris.create', compact('j', 'r', 'p'));
        }       
    }

    public function update_data_inv(Request $req, $id)
    {   
        if ($req -> isMethod('patch')) {            
            $i = Inventaris::findOrFail($id);
            $i -> nama = $req -> input('u_n_barang');
            $i -> kondisi = $req -> input('u_kondisi');
            $i -> keterangan = $req -> input('u_keterangan');
            $i -> jumlah = $req -> input('u_jumlah');
            $i -> kode_inventaris = $req -> input('u_k_inventaris');
            $i -> jenis_id = $req -> input('u_jenis');
            $i -> ruang_id = $req -> input('u_ruang');
            $i -> petugas_id = $req -> input('u_petugas');
            $s = $i->save();
            if ($s) {
                Session::flash('notif_success', 'Data Berhasil Diupdate');
                return redirect('/admin/dataInventaris');
            } else {
                Session::flash('notif_danger', 'Error: [D_Inventaris=Update_Error] Data Tidak Berhasil Diupdate');
                return redirect('/admin/dataInventaris');
            }
        } else {
            $i = Inventaris::findOrFail($id);
            $j = str_replace($i->jenis_id, Jenis::find($i->jenis_id)->nama_jenis, $i->jenis_id);
            $r = str_replace($i->ruang_id, Ruang::find($i->ruang_id)->nama_ruang, $i->ruang_id);
            $p = str_replace($i->petugas_id, Petugas::find($i->petugas_id)->nama_petugas, $i->petugas_id);

            $d_j = Jenis::orderBy('nama_jenis', 'asc')->get();
            $d_r = Ruang::orderBy('nama_ruang', 'asc')->get();
            // Entah updatena bisa ku admin hungkul atau sorangan, inget2 weh
            $d_p = Petugas::orderBy('nama_petugas', 'asc')->where('level_id', 1)->get();
            return view('users.admin.inventarisir.d_inventaris.update', compact('i', 'j', 'r', 'p', 'd_j', 'd_r', 'd_p'));
        }
    }

    public function destroy_data_inv(Request $req, $id)
    {
        if ($id != null) {
            $data = Inventaris::findOrFail($id);
            if ($data->delete()) {
                Session::flash('notif_success', 'Data Berhasil Di Hapus');
                return back();
            } else {
                Session::flash('notif_danger', 'Error: [D_Inventaris=Delete_ERROR] Data Tidak Berhasil Dihapus');
                return back();
            }
        }
    }
}
