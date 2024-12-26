<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use Illuminate\Http\Request;
use App\Models\StatusJabatan;

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required',
        ], [
            'nama_jabatan.required' => 'Nama Jabatan Wajib Diisi',
        ]);

        $update = ([
            'nama_jabatan' => $request->nama_jabatan,
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


    // Menampilkan semua data
    public function indexStatus()
    {
        $status_jabatans = StatusJabatan::all(); // Ambil semua data
        return view('admin.statusJabatan.index', compact('status_jabatans'));
    }

    // Menampilkan form tambah data
    public function createStatus()
    {
        return view('status_jabatan.create');
    }

    // Menyimpan data baru
    public function storeStatus(Request $request)
    {
        $request->validate([
            'status_jabatan' => 'required|string|max:255',
        ]);

        StatusJabatan::create([
            'status_jabatan' => $request->status_jabatan,
        ]);

        return redirect()->route('status_jabatan.index')->with('success', 'Status Jabatan berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function editStatus($id)
    {
        $status_jabatan = StatusJabatan::findOrFail($id);
        return view('status_jabatan.edit', compact('status_jabatan'));
    }

    // Memperbarui data
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_jabatan' => 'required|string|max:255',
        ]);

        $status_jabatan = StatusJabatan::findOrFail($id);
        $status_jabatan->update([
            'status_jabatan' => $request->status_jabatan,
        ]);

        return redirect()->route('status_jabatan.index')->with('success', 'Status Jabatan berhasil diperbarui.');
    }

    // Menghapus data
    public function destroyStatus($id)
    {
        $status_jabatan = StatusJabatan::findOrFail($id);
        $status_jabatan->delete();

        return redirect()->route('status_jabatan.index')->with('success', 'Status Jabatan berhasil dihapus.');
    }
}
