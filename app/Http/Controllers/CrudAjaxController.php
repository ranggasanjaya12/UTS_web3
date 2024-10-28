<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\Dummy;

use Illuminate\Http\Request;
use DataTables;

class CrudAjaxController extends Controller
{
    public function index(){
        $data = Mahasiswa::orderBy('id', 'desc')->get();  
        $dummies = Dummy::all(); // Fetch Dummy data
        
        if(request()->ajax()){
            return datatables()->of($data)
            ->addColumn('Aksi', function($data){
                $button = "
                <button type='button' id='".$data->id."' class='update btn btn-warning'  >
                    <i class='fas fa-edit'></i>
                </button>";
                $button .= "
                <button type='button' id='".$data->id."' class='destroy btn btn-danger'>
                    <i class='fas fa-times'></i>
                </button>";
                return $button;
            })
            ->rawColumns(['Aksi'])
            ->make(true);
        }    
        return view('dashboard.crudAjax', compact('data', 'dummies')); // Pass $dummies to the view
    }

    public function store(Request $request){
        $request->validate([
            'nim' => 'required', 
            'nama' => 'required',
            'dosen'=>'required',
        ],[
            'nim.required' => 'nim tidak boleh kosong',
            'nama.required' => 'nama tidak boleh kosong',
            'dosen.required' => 'dosen tidak boleh kosong',
        ]);

        // $notification = array(
        //     'status' => 'success',
        //     'title' => 'Proses berhasil',
        //     'message' => 'Data berhasil ditambahkan'
        // );

        $data = new Mahasiswa;
        $data->nim = $request->nim;
        $data->nama = $request->nama;
        $data->dosen = $request->dosen;
        $data->save();

    }

    public function show(Request $request){
        $id = $request->id;
        $data = Mahasiswa::find($id);
        return response()->json(['data' => $data]);
    }

    public function update(Request $request){
        $id = $request->id;
        $update = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'dosen' => $request ->dosen,
        ];

        $data = Mahasiswa::find($id);
        $data->update($update);
        $data->save();

        return response()->json(['data' => $data]);
        
 
    }

    public function destroy(Request $request){
        $id = $request->id;
        $data = Mahasiswa::find($id);
        $data->delete();

        return response()->json(['data' => $data]);
    }


    public function getData()
    {
        $mahasiswa = Mahasiswa::with('dosen')->get(); // Ambil data mahasiswa dan relasi dosen
        return datatables()::of($mahasiswa)
            ->addIndexColumn() // Tambahkan nomor urut otomatis
            ->make(true);
            return view('dashboard.index', compact('data', 'dummies'));  // Konversi ke JSON
    }
    

}
