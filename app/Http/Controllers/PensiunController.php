<?php

namespace App\Http\Controllers;

use App\Models\Pensiun;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PensiunController extends Controller
{
    public function index()
    {
        $pensiun = Pensiun::with('pegawai', 'jabatan', 'golongan')->get();
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $pegawai = Pegawai::all();

        return view('admin.pensiun.index', compact('pensiun', 'jabatan', 'golongan', 'pegawai'));
    }

    public function fetchPegawai($nip)
    {
        $pegawai = Pegawai::where('nip', $nip)->first();

        if ($pegawai) {
            return response()->json([
                'success' => true,
                'nama_pegawai' => $pegawai->nama_pegawai,
                'jabatan' => $pegawai->jabatan ? $pegawai->jabatan->nama_jabatan : null,
                'golongan' => $pegawai->golongan ? $pegawai->golongan->golongan : null,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Pegawai tidak ditemukan']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'pegawai_id' => [
                'required',
                Rule::exists('pegawai', 'id'), // Validasi bahwa pegawai_id ada di tabel Pegawai
            ],
            'jabatan_id' => 'required|exists:jabatan,id',
            'golongan_id' => 'required|exists:golongan,id',
            'tgl_pengajuan' => 'required|date',
            'tgl_pensiun' => 'required|date|after_or_equal:tgl_pengajuan',
        ]);

        Pensiun::create([
            'pegawai_id' => $request->pegawai_id,
            'jabatan_id' => $request->jabatan_id,
            'golongan_id' => $request->golongan_id,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'tgl_pensiun' => $request->tgl_pensiun,
        ]);

        return redirect()->route('pensiun.index')->with('success', 'Data Pensiun berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => [
                'required',
                Rule::exists('pegawai', 'id'),
            ],
            'jabatan_id' => 'required|exists:jabatan,id',
            'golongan_id' => 'required|exists:golongan,id',
            'tgl_pengajuan' => 'required|date',
            'tgl_pensiun' => 'required|date|after_or_equal:tgl_pengajuan',
        ]);

        $pensiun = Pensiun::findOrFail($id);

        $pensiun->update([
            'pegawai_id' => $request->pegawai_id,
            'jabatan_id' => $request->jabatan_id,
            'golongan_id' => $request->golongan_id,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'tgl_pensiun' => $request->tgl_pensiun,
        ]);

        return redirect()->route('pensiun.index')->with('success', 'Data Pensiun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pensiun = Pensiun::findOrFail($id);
        $pensiun->delete();

        return redirect()->route('pensiun.index')->with('success', 'Data Pensiun berhasil dihapus.');
    }
}
