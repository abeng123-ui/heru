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
use App\Models\Desa;

class DesaController extends Controller
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
        $data = Desa::orderBy('id', 'desc')->first();

        return view('desa.index', compact('data'));
    }

    public function desa_create()
    {
        return view('desa.create');
    }

    public function desa_store(Request $request)
    {

        $data = new Desa;
        $data->desa = $request->desa;
        $data->kecamatan = $request->kecamatan;
        $data->kabupaten = $request->kabupaten;
        $data->provinsi = $request->provinsi;
        $data->kepala_desa = $request->kepala_desa;
        $data->nama_camat = $request->nama_camat;
        $data->nik_camat = $request->nik_camat;
        $data->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Desa berhasil disimpan');

        return redirect('desa');
    }

    public function desa_edit($id, Request $request)
    {
        $data = Desa::find($id);

        return view('desa.edit', compact('data'));
    }

    public function desa_update($id, Request $request)
    {
        $ubah = Desa::find($id);
        $ubah->desa = $request->desa;
        $ubah->kecamatan = $request->kecamatan;
        $ubah->kabupaten = $request->kabupaten;
        $ubah->provinsi = $request->provinsi;
        $ubah->kepala_desa = $request->kepala_desa;
        $ubah->nama_camat = $request->nama_camat;
        $ubah->nik_camat = $request->nik_camat;
        $ubah->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('desa');
    }

    public function desa_delete($id, Request $request)
    {

        $hapus = Desa::find($id);
        $hapus->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Desa sudah dihapus !');

        return redirect('desa');
    }

}
