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
            'nama_kriteria' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Kriteria::create([
            'nama_kriteria' => $request->nama_kriteria,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
        ]);

        // Cari data kriteria berdasarkan ID dan update
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update([
            'nama_kriteria' => $request->nama_kriteria,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diubah!');
    }

    public function destroy($id)
    {
        // Cari data kriteria berdasarkan ID dan hapus
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus!');
    }
}
