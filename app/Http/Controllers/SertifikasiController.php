<?php

namespace App\Http\Controllers;

use App\Models\sertifikasi;
use App\Models\pegawai;
use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    public function index()
    {
        $sertifikasi = Sertifikasi::all();        
        return view('admin.sertifikasi.index', compact('sertifikasi'));
    }

    public function addData()
    {
        $sertifikasi = Sertifikasi::all();        
        return view('admin.sertifikasi.tambah', compact('sertifikasi'));
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'nip' => 'required|exists:pegawai,nip', // Validasi NIP harus ada di tabel pegawai
            'nama_sertifikasi' => 'required|string|max:255',
            'tgl_sertifikasi' => 'required|date',
        ]);

        // Ambil data pegawai berdasarkan NIP
        $pegawai = Pegawai::where('nip', $request->nip)->first();

        // Simpan data sertifikasi
        Sertifikasi::create([
            'nip' => $request->nip,
            'nama_pegawai' => $pegawai->nama,
            'jabatan' => $pegawai->jabatan,
            'nama_sertifikasi' => $request->nama_sertifikasi,
            'tgl_sertifikasi' => $request->tgl_sertifikasi,
        ]);
        
        return redirect()->route('sertifikasi.index')->with('tambah', 'Data Berhasil Ditambahkan');

    }
    
    
    
    public function fetchPegawai(Request $request)
    {
        // Log NIP yang diterima
        \Log::info("NIP yang diterima: " . $request->get('nip'));
    
        $nip = $request->get('nip');
        $pegawai = Pegawai::where('nip', $nip)->first();
    
        if ($pegawai) {
            // Log data pegawai ditemukan
            \Log::info("Data ditemukan: " . json_encode($pegawai));
    
            return response()->json([
                'nama' => $pegawai->nama,
                'jabatan' => $pegawai->jabatan,
            ]);
        } else {
            // Log data pegawai tidak ditemukan
            \Log::info("Data tidak ditemukan untuk NIP: " . $nip);
    
            return response()->json([
                'nama' => null,
                'jabatan' => null,
            ]);
        }
    }
     


}
