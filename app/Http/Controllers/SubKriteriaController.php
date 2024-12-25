<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria; // Perbaiki nama model
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $subKriteria = SubKriteria::all(); // Gunakan model dengan benar
        $kriteria = Kriteria::all();
        return view('admin.kinerja.subkriteria.index', compact('subKriteria', 'kriteria'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required',
            'nama_subkriteria' => 'required',
            'bobot' => 'required',
        ]);

        // Ambil kode kriteria berdasarkan ID
        $kriteria = Kriteria::findOrFail($request->kriteria_id);

        SubKriteria::create([ // Gunakan model SubKriteria dengan benar
            'kriteria_id' => $request->kriteria_id,
            'kode_kriteria' => $kriteria->kode_kriteria, // Ambil kode kriteria dari tabel Kriteria
            'nama_subkriteria' => $request->nama_subkriteria,
            'bobot' => $request->bobot,
        ]);

        return redirect()->route('subkriteria.index')->with('success', 'Sub-kriteria berhasil ditambahkan!');
    }
}
