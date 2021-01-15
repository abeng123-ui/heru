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
use App\Models\Role;
use DOMDocument;
use Illuminate\Support\Facades\Storage;
use PDF;

class PermintaanJurusanController extends Controller
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
        ->orderBy('id', 'desc')
        ->get();

        return view('permintaan_jurusan.index', compact('data'));
    }

    public function permintaan_create()
    {
        $stokbarang = \App\Models\Stokbarang::where('sisa', '>', 0)->get();
        $jenisbarang = \App\Models\Jenisbarang::whereHas('stokbarang', function($q){
            $q->where('sisa', '>', 0);
        })
        ->get();

        $role = \App\Models\Role::find(\Auth::user()->role_id);
        $unit = $role->role_name;

        return view('permintaan_jurusan.create', compact('stokbarang', 'jenisbarang', 'unit'));
    }

    public function permintaan_store(Request $request)
    {
        if($request->sisa < $request->jumlah || $request->jumlah == 0){
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            if($request->jumlah == 0){
                $request->session()->flash('message.content', 'Jumlah permintaan melebihi stok !');
            }

            return redirect()->back();
        }

        $data = new Permintaan;
        $data->unit = $request->unit;
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

        return redirect('permintaan/jurusan');
    }

    public function permintaan_edit($id, Request $request)
    {
        $data = Permintaan::find($id);

        $stokbarang = \App\Models\Stokbarang::where('kode_brg', $data->kode_brg)->first();
        $jenisbarang = \App\Models\Jenisbarang::find($data->id_jenis);

        $role = App\Models\Role::find(\Auth::user()->role_id);
        $unit = $role->role_name;

        return view('permintaan_jurusan.edit', compact('data', 'stokbarang', 'jenisbarang', 'unit'));
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

        return redirect('permintaan/jurusan');
    }

    public function permintaan_delete($id, Request $request)
    {

        $hapus = Permintaan::find($id);
        $hapus->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Permintaan sudah dihapus !');

        return redirect('permintaan/jurusan');
    }

    public function permintaan_cetak_bpp(){
        $data = Permintaan::select('tgl_permintaan')
        ->where('status', 1)
        ->groupBy('tgl_permintaan')
        ->orderBy('tgl_permintaan', 'desc')
        ->get();

        return view('permintaan_jurusan.cetak_bpp', compact('data'));
    }

    public function permintaan_download(Request $request)
    {
        $normalTimeLimit = ini_get('max_execution_time');
        ini_set('max_execution_time', 120);
        ini_set('xdebug.max_nesting_level', 120);

        // EXPORT PDF
        $permintaan = Permintaan::with('stokbarang')
        ->where('tgl_permintaan', $request->tgl_permintaan)
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->get();

        $all = [];
        foreach ($permintaan as $key) {
            $ini= $key;
            $ini['stokbarang'] = $key->stokbarang;

            array_push($all, $ini);
        }

        $data['permintaan']           = $all;
        $data['tgl_permintaan'] = $request->tgl_permintaan;
        $data['pemohon'] = \Auth::user()->name;
        $data['level'] = \App\Models\Role::find(\Auth::user()->role_id)->role_code;

        $fileName = "Bukti_Permintaan_Tanggal_".$request->tgl_permintaan.'.pdf';

        $pdf = PDF::loadView('permintaan_jurusan.template_pdf', $data)->setPaper('a4', 'potrait');

        return $pdf->download($fileName);
    }

    public function template_pdf(){
        $data['data']           = Permintaan::all();
        $data['tgl_permintaan'] = '2020-01-14';

        return view('permintaan_jurusan.template_pdf', compact('data'));
    }

}
