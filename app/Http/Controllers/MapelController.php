<?php

namespace App\Http\Controllers;

use App\Models\mapel;
use Illuminate\Http\Request;

class mapelController extends Controller
{
    public function index()
    {
        $mapel = mapel::all();        
        return view('admin.mapel.index', compact('mapel'));
    }
    
    public function create(Request $request)
    {
        $masuk = $request->validate([
            'mapel' => 'required|string',
        ]);           

        $mapel                  = new mapel();
        $mapel->mapel    = $masuk['mapel'];
        $mapel->save();
        
        return redirect()->route('mapel.index')->with('tambah', 'Data Berhasil Ditambahkan');

    }

    public function update(Request $request, $id){
        $request -> validate ([
            'mapel'=>'required',
        ], [
            'mapel.required'=>'Nama mapel Wajib Diisi',
        ]);

        $update = ([
            'mapel' => $request -> mapel,
        ]);

        mapel::find($id)->update($update);
        return redirect()->route('mapel.index')->with('edit', 'Data Berhasil Diubah');
    }

    public function destroy($id) 
    {
        $mapel = mapel::findOrFail($id);
        $mapel->delete();
    
        return redirect()->route('mapel.index')->with('hapus', 'Data Berhasil Dihapus');
    }

}
