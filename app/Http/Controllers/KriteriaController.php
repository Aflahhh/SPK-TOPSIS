<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('admin.kinerja.kriteria.index', compact('kriteria'));
    }

    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' => 'required|',
        ]);

        // Simpan data ke database
        Kriteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'bobot' => $request->bobot,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kriteria.index')->with('tambah', 'Kriteria berhasil ditambahkan!');
    }


    
    // public function edit(Kriteria $kriteria)
    // {
    //     return view('kriteria.edit', compact('kriteria'));
    // }

    // public function update(Request $request, Kriteria $kriteria)
    // {
    //     $request->validate([
    //         'nama_kriteria' => 'required|string|max:255',
    //         'bobot' => 'required|numeric|min:0|max:1',
    //     ]);

    //     $kriteria->update($request->all());
    //     return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diubah!');
    // }

    // public function destroy(Kriteria $kriteria)
    // {
    //     $kriteria->delete();
    //     return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus!');
    // }
}
