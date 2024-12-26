<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pegawai;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use App\Models\KriteriaPegawai;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenilaianController extends Controller
{
    public function index()
{
    // Ambil data penilaian dengan relasi pegawai dan subkriteria
    $pegawais = Pegawai::get();

    // Ambil data subkriteria untuk modal tambah
    $kriterias = Kriteria::all();

    // Return view dengan data penilaian dan subkriteria
    return view('admin.kinerja.penilaian.index', compact('pegawais', 'kriterias'));
}


    public function edit(Request $request, $id)
    {
        $pegawai = Pegawai::where('id', $id)->first();
        $kriterias = Kriteria::with('subkriteria')->get();
        $pegawai_id = $id;

        return view('admin.kinerja.penilaian.edit', compact('pegawai', 'kriterias', 'pegawai_id'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nilai' => 'required|array',
    ]);

    foreach ($validated['nilai'] as $subkriteria_id => $bobot) {
        KriteriaPegawai::updateOrCreate(
            [
                'pegawai_id' => $request->pegawai_id,
                'subkriteria_id' => $subkriteria_id,
            ],
            [
                'bobot' => $bobot,
            ]
        );
    }

    return redirect('/kinerja/penilaian')->with('success', 'Penilaian berhasil disimpan.');
}

public function peringkat(Request $request)
{
    // Ambil semua data pegawai
    $pegawais = Pegawai::all();

    // Urutkan pegawai berdasarkan skor (desc)
    $pegawais = $pegawais->sortByDesc(function ($pegawai) {
        return $pegawai->getSkor();
    });

    // Ambil data kriteria untuk modal tambah
    $kriterias = Kriteria::all();

    // Return view dengan data pegawai yang sudah diurutkan
    return view('admin.kinerja.penilaian.peringkat', compact('pegawais', 'kriterias'));
}

   public function peringkatDetail(Request $request, $id)
    {
        $pegawai = Pegawai::where('id', $id)->first();
        $kriterias = Kriteria::with('subkriteria')->get();
        $pegawai_id = $id;

        return view('admin.kinerja.penilaian.show', compact('pegawai', 'kriterias', 'pegawai_id'));
    }



    public function getPegawaiByNip(Request $request)
    {
        $nip = $request->query('nip');
        $pegawai = Pegawai::where('nip', $nip)->first();

        if ($pegawai) {
            return response()->json(['nama_pegawai' => $pegawai->nama_pegawai]);
        } else {
            return response()->json([], 404);
        }
    }
}
