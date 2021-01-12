<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Carbon\Carbon;

class HomeController extends Controller
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
        $jumlah_penduduk = \App\Models\Penduduk::whereNull('deleted_at')->get()->count();
        $jumlah_kk = \App\Models\Kk::select('no_kk')->groupBy('no_kk')->get()->count();

        $usia_produktif_atas = Carbon::now()->subYear(64)->format('Y-m-d H:i:s');
        $usia_produktif_bawah = Carbon::now()->subYear(15)->format('Y-m-d H:i:s');

        $usia_produktif = \App\Models\Penduduk::where('tgl_lahir', '>=', $usia_produktif_atas)
        ->where('tgl_lahir', '<=', $usia_produktif_bawah)
        ->whereNull('deleted_at')
        ->get()->count();

        $warga_baru_this_month = \App\Models\Penduduk::whereMonth('created_at', Carbon::now()->month)
        ->whereNull('deleted_at')
        ->get()->count();

        return view('index', compact('jumlah_penduduk', 'jumlah_kk', 'usia_produktif', 'warga_baru_this_month'));
    }
}
