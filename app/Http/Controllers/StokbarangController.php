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
use App\Models\Stokbarang;
use App\Models\Pemasukan;

class StokbarangController extends Controller
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
        $data = Stokbarang::all();

        return view('stok_barang.index', compact('data'));
    }

    public function stok_barang_create()
    {
        $jenisbarang = \App\Models\Jenisbarang::all();
        return view('stok_barang.create', compact('jenisbarang'));
    }

    public function stok_barang_store(Request $request)
    {
        $max = Stokbarang::max('id');

        $data = new Stokbarang;
        $data->kode_brg  = $max+1;
        $data->id_jenis  = $request->id_jenis;
        $data->nama_brg  = $request->nama_brg;
        $data->satuan    = $request->satuan;
        $data->stok      = $request->jumlah;
        $data->keluar    = 0;
        $data->sisa      = $request->jumlah;
        $data->tgl_masuk = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data->pj        = \Auth::user()->name;
        $data->save();

        $role = \App\Models\Role::find(\Auth::user()->role_id);
        $role_name = isset($role->role_name) ? $role->role_name : '-';

        $pemasukan = new Pemasukan;
        $pemasukan->unit        = $role_name;
        $pemasukan->kode_brg    = $data->kode_brg;
        $pemasukan->jumlah      = $data->stok;
        $pemasukan->tgl_masuk   = $data->tgl_masuk;
        $pemasukan->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Stok barang berhasil disimpan');

        return redirect('stok_barang');
    }

    public function checkstok_barang()
    {
        $cek = Stokbarang::where('nama_brg', Input::get('nama_brg'))->get();
        if(count($cek) > 0)
        {
            return "false";
        }else
        {
            return "true";
        }
    }

    public function stok_barang_edit($id, Request $request)
    {
        $data = Stokbarang::find($id);

        return view('stok_barang.edit', compact('data'));
    }

    public function stok_barang_update($id, Request $request)
    {
        $check = Stokbarang::where('stok_barang', $request->stok_barang)
        ->where('id', '!=',  $id)
        ->first();

        if($check){
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Stok barang sudah ada !');

            return redirect()->back();
        }

        $ubah = Stokbarang::find($id);
        $ubah->stok_barang = $request->stok_barang;
        $ubah->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('stok_barang');
    }

    public function stok_barang_delete($id, Request $request)
    {

        $hapus = Stokbarang::find($id);
        $hapus->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Stok barang sudah dihapus !');

        return redirect('stok_barang');
    }

}
