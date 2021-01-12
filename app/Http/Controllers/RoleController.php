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
use App\Models\Role;

class RoleController extends Controller
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
        $data = Role::all();

        return view('role.index', compact('data'));
    }

    public function role_create()
    {
        return view('role.create');
    }

    public function role_store(Request $request)
    {

        $data = new Role;
        $data->role_code = $request->role_code;
        $data->role_name = $request->role_name;
        $data->route_access_list = json_encode(['routelist' => Input::get('routelist')]);
        $data->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Role berhasil disimpan');

        return redirect('role');
    }

    public function role_edit($id, Request $request)
    {
        $data = Role::find($id);

        return view('role.edit', compact('data'));
    }

    public function role_update($id, Request $request)
    {
        $ubah = Role::find($id);
        $ubah->role_code = $request->role_code;
        $ubah->role_name = $request->role_name;
        $ubah->route_access_list = json_encode(['routelist' => Input::get('routelist')]);
        $ubah->update();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Perubahan berhasil !');

        return redirect('role');
    }

    public function role_delete($id, Request $request)
    {

        $hapus = Role::find($id);
        $hapus->delete();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Role sudah dihapus !');

        return redirect('role');
    }

}
