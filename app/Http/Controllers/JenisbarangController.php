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
use App\Models\Jenisbarang;

class JenisbarangController extends Controller
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
        $data = Jenisbarang::all();

        return view('jenis_barang.index', compact('data'));
    }

    public function jenis_barang_create()
    {
        return view('jenis_barang.create');
    }

    public function jenis_barang_store(Request $request)
    {

        $data = new Jenisbarang;
        $data->jenis_brg  = $request->jenis_brg;
        $data->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Jenis barang berhasil disimpan');

        return redirect('jenis_barang');
    }

    public function check_jenis_barang()
    {
        $cek = Jenisbarang::where('jenis_brg', Input::get('jenis_brg'))->get();
        if(count($cek) > 0)
        {
            return "false";
        }else
        {
            return "true";
        }
    }

    public function jenis_barang_edit($id, Request $request)
    {
        $data = Jenisbarang::find($id);

        return view('jenis_barang.edit', compact('data'));
    }

    public function jenis_barang_update($id, Request $request)
    {
        $ubah = Jenisbarang::find($id);
        $ubah->jenis_brg = $request->jenis_brg;
        $ubah->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('jenis_barang');
    }

    public function jenis_barang_delete($id, Request $request)
    {

        $hapus = Jenisbarang::find($id);
        $hapus->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Jenis barang sudah dihapus !');

        return redirect('jenis_barang');
    }

}
