<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dummy;

class CrudController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);
    }
    
    public function index(){
        $dummy = Dummy::orderBy('id', 'desc')->get();
        return view('dashboard.crud', compact('dummy') );
        return view('dashboard.index', compact('dummy') );
    }

    public function store(Request $request){

        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
        ],[
            'nip.required' => 'nip tidak boleh kosong',
            'nama.required' => 'nama tidak boleh kosong',
        ]);
        
        $data = new Dummy;
        $data->nip = $request->nip;
        $data->nama = $request->nama;
        $data->save();

        $notification = array(
            'status' => 'success',
            'title' => 'Proses berhasil',
            'message' => 'Data berhasil ditambahkan'
        );

        return Redirect()->back()->with($notification);

    }

    public function update(Request $request){
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
        ],[
            'nip.required' => 'nip tidak boleh kosong',
            'nama.required' => 'nama tidak boleh kosong',
        ]);
        $data = Dummy::find($request->id);
        $data->nip = $request->nip;
        $data->nama = $request->nama;
        $data->save();

        $notification = array(
            'status' => 'success',
            'title' => 'Proses berhasil',
            'message' => 'Data berhasil diperbaharui'
        );

        return Redirect()->back()->with($notification);

    }

    public function destroy(Request $request){
        $data = Dummy::find($request->id);
        $data->delete();

        $notification = array(
            'status' => 'success',
            'title' => 'Proses berhasil',
            'message' => 'Data berhasil dihapus'
        );
        return Redirect()->back()->with($notification);
    }
}
