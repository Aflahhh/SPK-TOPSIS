<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $subKriteria = SubKriteria::with('kriteria')->get(); // Eager load relasi
        $kriteria = Kriteria::all(); // Untuk dropdown pilihan kriteria
        return view('admin.kinerja.subkriteria.index', compact('subKriteria', 'kriteria'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id', // Validasi foreign key
            'nama_subkriteria' => 'required|string|max:255',
            'fungsi' => 'required|in:cost,benefit', // Validasi enum
        ]);

        SubKriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'nama_subkriteria' => $request->nama_subkriteria,
            'fungsi' => $request->fungsi,
        ]);

        return redirect()->route('subkriteria.index')->with('success', 'Sub-kriteria berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama_subkriteria' => 'required|string|max:255',
            'fungsi' => 'required|in:cost,benefit',
        ]);

        $subKriteria = SubKriteria::findOrFail($id);
        $subKriteria->update([
            'kriteria_id' => $request->kriteria_id,
            'nama_subkriteria' => $request->nama_subkriteria,
            'fungsi' => $request->fungsi,
        ]);
        

        return redirect()->route('subkriteria.index')->with('success', 'Sub-kriteria berhasil diubah!');
    }

    public function destroy($id)
    {
        $subKriteria = SubKriteria::findOrFail($id);
        $subKriteria->delete();

        return redirect()->route('subkriteria.index')->with('success', 'Sub-kriteria berhasil dihapus!');
    }
}
