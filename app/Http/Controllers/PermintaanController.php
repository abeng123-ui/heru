<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Redirect;
use DB;
use Hash;
use Response;
use Session;
use App\Models\Permintaan;

class PermintaanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Permintaan::with('stokbarang')
        ->where('status', 0)
        ->orderBy('id', 'desc')
        ->get();

        return view('permintaan.index', compact('data'));
    }

    public function permintaan_create()
    {
        $stokbarang = \App\Models\Stokbarang::where('sisa', '>', 0)->get();
        $jenisbarang = \App\Models\Jenisbarang::whereHas('stokbarang', function($q){
            $q->where('sisa', '>', 0);
        })
        ->get();

        $unit = \App\Models\Role::find(\Auth::user()->role_id)->role_name;

        return view('permintaan.create', compact('stokbarang', 'jenisbarang', 'unit'));
    }

    public function permintaan_store(Request $request)
    {
        if($request->sisa < $request->jumlah){
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Jumlah permintaan melebihi stok !');

            return redirect()->back();
        }

        $data = new Permintaan;
        $data->unit     = $request->unit;
        $data->kode_brg = $request->kode_brg;
        $data->id_jenis = $request->id_jenis;
        $data->jumlah   = $request->jumlah;
        $data->nama_pemohon     = \Auth::user()->name;
        $data->status   = 0;
        $data->tgl_permintaan   = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Permintaan berhasil disimpan');

        return redirect('permintaan');
    }

    public function permintaan_edit($id, Request $request)
    {
        $data = Permintaan::find($id);

        $stokbarang = \App\Models\Stokbarang::where('kode_brg', $data->kode_brg)->first();
        $jenisbarang = \App\Models\Jenisbarang::find($data->id_jenis);

        $role = App\Models\Role::find(\Auth::user()->role_id);
        $unit = $role->role_name;

        return view('permintaan.edit', compact('data', 'stokbarang', 'jenisbarang', 'unit'));
    }

    public function permintaan_update($id, Request $request)
    {
        if($request->sisa < $request->jumlah){
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Jumlah permintaan melebihi stok !');

            return redirect()->back();
        }

        $ubah = Permintaan::find($id);
        $ubah->kode_brg         = $request->kode_brg;
        $ubah->id_jenis         = $request->id_jenis;
        $ubah->jumlah           = $request->jumlah;
        $ubah->nama_pemohon     = \Auth::user()->name;
        $ubah->status           = 0;
        $ubah->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('permintaan');
    }

    public function permintaan_delete($id, Request $request)
    {
        $hapus = Permintaan::find($id);
        $hapus->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Permintaan sudah dihapus !');

        return redirect('permintaan');
    }

    public function permintaan_setuju($id, Request $request)
    {

        $data = Permintaan::find($id);
        $data->status = 1;
        $data->save();

        $stokbarang = \App\Models\Stokbarang::where('kode_brg', $data->kode_brg)->first();
        if($stokbarang){
            $stokbarang->sisa   = $stokbarang->sisa - $data->jumlah;
            $stokbarang->keluar = $stokbarang->keluar + $data->jumlah;
            $stokbarang->save();

            $role = \App\Models\Role::find(\Auth::user()->role_id);
            $role_name = isset($role->role_name) ? $role->role_name : '-';

            $pengeluaran = new \App\Models\Pengeluaran;
            $pengeluaran->unit        = $data->unit;
            $pengeluaran->kode_brg    = $data->kode_brg;
            $pengeluaran->jumlah      = $data->jumlah;
            $pengeluaran->tgl_keluar  = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $pengeluaran->save();

            // Flash Message / Alert
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Permintaan sudah disetujui !');
        }else{
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Permintaan gagal disetujui !');
        }


        return redirect('permintaan');
    }

    public function permintaan_tidak($id, Request $request)
    {

        $data = Permintaan::find($id);
        $data->status = 2;
        $data->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Permintaan sudah ditolak !');

        return redirect('permintaan');
    }

    public function index_keluar()
    {
        $data = Permintaan::with('stokbarang')
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->get();

        return view('pengeluaran.index', compact('data'));
    }

}
