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
use App\Models\Kk;
use App\Models\Penduduk;
use App\Models\Angkel;
use App\User;
use App\Models\Desa;

class KkController extends Controller
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
        $data = Kk::with('angkel')->orderBy('id', 'desc')->get();

        return view('kk.index', compact('data'));
    }

    public function kk_create()
    {
        return view('kk.create');
    }

    public function kk_store(Request $request)
    {
        $data = new Kk;
        $data->nama_kepala_keluarga = $request->nama_kepala_keluarga;
        $data->alamat_kkel = $request->alamat_kkel;
        $data->rt = $request->rt;
        $data->rw = $request->rw;
        $data->kodepos = $request->kodepos;
        $data->save();

        // Update No KK
        cari_no_kk:

        $no_kk = rand(100000,999999).\Carbon\Carbon::now()->format("dmy").rand(1000,9999);
        $cekNoKK = Kk::where('no_kk', $no_kk)->first();

        if($cekNoKK) goto cari_no_kk;

        $data = KK::find($data->id);
        $data->no_kk = $no_kk;
        $data->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Kk berhasil disimpan');

        return redirect('kk');
    }

    public function kk_edit($id, Request $request)
    {
        $data = Kk::find($id);

        return view('kk.edit', compact('data'));
    }

    public function kk_update($id, Request $request)
    {
        $data = Kk::find($id);
        $data->nama_kepala_keluarga = $request->nama_kepala_keluarga;
        $data->alamat_kkel = $request->alamat_kkel;
        $data->rt = $request->rt;
        $data->rw = $request->rw;
        $data->kodepos = $request->kodepos;
        $data->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('kk');
    }

    public function kk_delete($id, Request $request)
    {
        $hapus_kk = Kk::find($id);
        $angkel_all = Angkel::where('no_kk', $hapus_kk->no_kk)->get();
        foreach ($angkel_all as $angkel) {
            $penduduk = Penduduk::find($angkel->id_penduduk);

            $user = User::find($penduduk->user_id);
            if($user){
                $user->delete();
            }

            $penduduk->deleted_at = \Carbon\Carbon::now();
            $penduduk->update();
        }

        $angkel_all = Angkel::whereIn('no_kk', [$hapus_kk->no_kk])->delete();

        $hapus_kk->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Kk sudah dihapus !');

        return redirect('kk');
    }

    public function kk_user(Request $request)
    {
        $data = [];
        $kk = [];
        $desa = Desa::orderBy('id', 'desc')->first();

        $user = \Auth::user();

        $penduduk = Penduduk::where('user_id', $user->id)->first();

        if($penduduk){
            $angkel =Angkel::where('id_penduduk', $penduduk->id)->first();
            if($angkel){
                $data = Angkel::with('penduduk.data_agama')->where('no_kk', $angkel->no_kk)->get();
            }

            $kk = Kk::where('no_kk', $angkel->no_kk)->first();
        }

        return view('kk_user.index', compact('data', 'kk', 'desa'));
    }

}
