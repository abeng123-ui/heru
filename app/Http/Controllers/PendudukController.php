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
use App\Models\Agama;
use App\Models\Angkel;
use App\Models\Role;
use App\Models\Desa;
use App\User;

class PendudukController extends Controller
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
        $data = Penduduk::whereNull('deleted_at')->get();

        return view('penduduk.index', compact('data'));
    }

    public function penduduk_create()
    {
        $kk = Kk::all();
        $agama = Agama::all();

        return view('penduduk.create', compact('kk', 'agama'));
    }

    public function penduduk_store(Request $request)
    {
        $kk = KK::where('no_kk', $request->no_kk)->first();

        if(!$kk){
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Data KK tidak ditemukan');

            return redirect()->back();
        }

        $data = new Penduduk;
        $data->nama_lengkap = $request->nama_lengkap;
        $data->tgl_lahir = \Carbon\Carbon::parse($request->tgl_lahir)->format('Y-m-d');
        $data->tmp_lahir = $request->tmp_lahir;
        $data->jk = $request->jk;
        $data->gol_darah = $request->gol_darah;
        $data->alamat = $kk->alamat_kkel;
        $data->agama = $request->agama;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data->status_hubungan_keluarga = $request->status_hubungan_keluarga;
        $data->klmp_pekerjaan = $request->klmp_pekerjaan;
        $data->status_perkawinan = $request->status_perkawinan;
        $data->no_telpn = $request->no_telpn;
        $data->kewarganegaraan = 'Indonesia';
        $data->tgl_reg = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data->email = $request->email;
        $data->save();

        // update NIK
        // cek nik
        cek_nik:
        $nik = rand(100000,999999).\Carbon\Carbon::parse($request->tgl_lahir)->format('dmy').rand(1000,9999);
        $cek = Penduduk::where('nik', $nik)->whereNull('deleted_at')->first();
        if($cek) goto cek_nik;

        $penduduk = Penduduk::find($data->id);
        $penduduk->nik = $nik;
        $penduduk->update();

        // create Angkel
        $angkel = new Angkel;
        $angkel->no_kk = $kk->no_kk;
        $angkel->id_penduduk = $data->id;
        $angkel->status = 1;
        $angkel->save();

        // role
        $role = Role::where('role_code', 'user')->first();

        // pengguna
        $user = new User;
        $user->name = $penduduk->nama_lengkap;
        $user->email = $penduduk->email;
        $user->password = bcrypt('12345');
        $user->role_id = isset($role) ? $role->id : 0;
        $user->save();

        // save user id
        $penduduk->user_id = $user->id;
        $penduduk->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Penduduk berhasil disimpan');

        return redirect('penduduk');
    }

    public function penduduk_edit($id, Request $request)
    {
        $data = Penduduk::find($id);
        $kk = Kk::all();
        $agama = Agama::all();

        return view('penduduk.edit', compact('data', 'kk', 'agama'));
    }

    public function penduduk_update($id, Request $request)
    {
        $data = Penduduk::find($id);
        $data->nama_lengkap = $request->nama_lengkap;
        $data->tmp_lahir = $request->tmp_lahir;
        $data->jk = $request->jk;
        $data->gol_darah = $request->gol_darah;
        $data->agama = $request->agama;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data->status_hubungan_keluarga = $request->status_hubungan_keluarga;
        $data->klmp_pekerjaan = $request->klmp_pekerjaan;
        $data->status_perkawinan = $request->status_perkawinan;
        $data->no_telpn = $request->no_telpn;
        $data->kewarganegaraan = 'email';
        $data->email = $request->email;
        $data->update();

        $user = User::find($data->user_id);
        if($user){
            $user->email = $data->email;
            $user->update();
        }else{
            // role
            $role = Role::where('role_code', 'user')->first();

            // pengguna
            $user = new User;
            $user->name = $data->nama_lengkap;
            $user->email = $data->email;
            $user->password = bcrypt('12345');
            $user->role_id = isset($role) ? $role->id : 0;
            $user->save();
        }

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('penduduk');
    }

    public function penduduk_delete($id, Request $request)
    {

        $hapus = Penduduk::find($id);
        $hapus->deleted_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $hapus->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Penduduk sudah dihapus !');

        return redirect('penduduk');
    }

}
