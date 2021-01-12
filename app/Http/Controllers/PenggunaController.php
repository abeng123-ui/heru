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
use App\User;
use App\Models\Role;

class PenggunaController extends Controller
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
        $data = User::with('role')->get();

        return view('pengguna.index', compact('data'));
    }

    public function pengguna_create()
    {
        $data_role = Role::all();
        return view('pengguna.create', compact('data_role'));
    }

    public function pengguna_store(Request $request)
    {
        if($request->password != $request->password_confirm){
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Password dan Password Konfirmasi harus sama !');

            return redirect()->back();
        }

        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role_id = $request->role_id;
        $data->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Pengguna berhasil disimpan');

        return redirect('pengguna');
    }

    public function checkpengguna()
    {
        $cek = User::where('email', Input::get('email'))->get();
        if(count($cek) > 0)
        {
            return "false";
        }else
        {
            return "true";
        }
    }

    public function pengguna_edit($id, Request $request)
    {
        $data_role = Role::all();
        $data = User::find($id);

        return view('pengguna.edit', compact('data', 'data_role'));
    }

    public function pengguna_update($id, Request $request)
    {
        $check = User::where('email', $request->email)
        ->where('id', '!=',  $id)
        ->first();

        if($check){
            // Flash Message / Alert
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Email sudah ada !');

            return redirect()->back();
        }

        $ubah = User::find($id);
        $ubah->name = $request->name;
        $ubah->email = $request->email;
        if(isset($request->password) && $request->password != ''){
            $ubah->password = bcrypt($request->password);
        }
        $ubah->role_id = $request->role_id;
        $ubah->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('pengguna');
    }

    public function pengguna_delete($id, Request $request)
    {
        $hapus = User::find($id);
        $hapus->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Pengguna sudah dihapus !');

        return redirect('pengguna');
    }

}
