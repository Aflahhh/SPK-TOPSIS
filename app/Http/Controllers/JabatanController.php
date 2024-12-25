<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jb = Jabatan::all();        
        return view('admin.jabatan.index', compact('jb'));
    }
    
    public function create(Request $request)
    {
        $masuk = $request->validate([
            'nama_jabatan' => 'required|string',
        ]);           

        $jabatan                  = new jabatan();
        $jabatan->nama_jabatan    = $masuk['nama_jabatan'];
        $jabatan->save();
        
        return redirect()->route('jabatan.index')->with('tambah', 'Data Berhasil Ditambahkan');

    }

    public function update(Request $request, $id){
        $request -> validate ([
            'nama_jabatan'=>'required',
        ], [
            'nama_jabatan.required'=>'Nama Jabatan Wajib Diisi',
        ]);

        $update = ([
            'nama_jabatan' => $request -> nama_jabatan,
        ]);

        jabatan::find($id)->update($update);
        return redirect()->route('jabatan.index')->with('edit', 'Data Berhasil Diubah');
    }

    public function destroy($id) 
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();
    
        return redirect()->route('jabatan.index')->with('hapus', 'Data Berhasil Dihapus');
    }

}
