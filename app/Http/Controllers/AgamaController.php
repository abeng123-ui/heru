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
use App\Models\Agama;

class AgamaController extends Controller
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
        $data = Agama::all();

        return view('agama.index', compact('data'));
    }

    public function agama_create()
    {
        return view('agama.create');
    }

    public function agama_store(Request $request)
    {

        $data = new Agama;
        $data->agama = $request->agama;
        $data->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Agama berhasil disimpan');

        return redirect('agama');
    }

    public function checkagama()
    {
        $cek = Agama::where('agama', Input::get('agama'))->get();
        if(count($cek) > 0)
        {
            return "false";
        }else
        {
            return "true";
        }
    }

    public function agama_edit($id, Request $request)
    {
        $data = Agama::find($id);

        return view('agama.edit', compact('data'));
    }

    public function agama_update($id, Request $request)
    {
        $check = Agama::where('agama', $request->agama)
        ->where('id', '!=',  $id)
        ->first();

        if($check){
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Agama sudah ada !');

            return redirect()->back();
        }

        $ubah = Agama::find($id);
        $ubah->agama = $request->agama;
        $ubah->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('agama');
    }

    public function agama_delete($id, Request $request)
    {

        $hapus = Agama::find($id);
        $hapus->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Agama sudah dihapus !');

        return redirect('agama');
    }

}
