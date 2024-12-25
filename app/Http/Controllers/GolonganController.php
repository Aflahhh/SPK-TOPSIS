<?php

namespace App\Http\Controllers;

use App\Models\golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    
    public function index()
    {
        $gol = Golongan::all();        
        return view('admin.golongan.index', compact('gol'));

    }

    public function create(Request $request) {
        $masuk = $request->validate([
            'golongan' => 'required|string',
        ]);           

        $golongan                   = new golongan();
        $golongan->golongan    = $masuk['golongan'];
        $golongan->save();
        
        return redirect()->route('golongan.index')->with('tambah', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id){
        $request -> validate ([
            'golongan'=>'required',
        ], [
            'golongan.required'=>'Nama Golongan Wajib Diisi',
        ]);

        $update = ([
            'golongan' => $request -> golongan,
        ]);

        golongan::find($id)->update($update);
        return redirect()->route('golongan.index')->with('edit', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $golongan = Golongan::findOrFail($id);
        $golongan->delete();
        
        return redirect()->route('golongan.index')->with('hapus', 'Data Berhasil Dihapus');
    }

}
