<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mapel; // Pastikan model Mapel sudah ada

class MapelController extends Controller
{
    /**
     * Menampilkan semua data mapel.
     */
    public function index()
    {
        $mapels = mapel::all(); // Mengambil semua data mapel
        return view('admin.mapel.index', compact('mapels')); // Mengirim data ke view
    }

    /**
     * Menyimpan data mapel baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'mapel' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        mapel::create([
            'mapel' => $request->mapel,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('mapel.index')->with('added', 'Data berhasil ditambahkan!');
    }

    /**
     * Memperbarui data mapel berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'mapel' => 'required|string|max:255',
        ]);

        // Cari data berdasarkan ID
        $mapel = mapel::findOrFail($id);

        // Update data
        $mapel->update([
            'mapel' => $request->mapel,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('mapel.index')->with('updated', 'Data berhasil diupdate!');
    }

    /**
     * Menghapus data mapel berdasarkan ID.
     */
    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $mapel = mapel::findOrFail($id);

        // Hapus data
        $mapel->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('mapel.index')->with('deleted', 'Data berhasil dihapus!');
    }
}
