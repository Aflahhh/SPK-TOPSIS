<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Penilaian;
use App\Models\Pegawai;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Mapel;
use App\Models\Nilai;

use Illuminate\Http\Request;

class PenilaianController extends Controller
{   
    public function penilaianPegawai(Request $request)
    {
        // Ambil data terkait penilaian dan pegawai
        $penilaian  = Penilaian::all();
        $pegawai    = Pegawai::all();
        $kriteria   = Kriteria::all();
        $subkriteria = SubKriteria::all();
        $mapel      = Mapel::all();
        $nilai      = Nilai::all();

        // Ambil data berdasarkan NIP jika ada
        $nip = $request->query('nip');
        $nama_pegawai = '';

        if ($nip) {
            $pegawaiData = Pegawai::where('nip', $nip)->first();
            if ($pegawaiData) {
                $nama_pegawai = $pegawaiData->nama_pegawai;
            }
        }

        return view('admin.kinerja.penilaian.tambah', compact('penilaian', 'pegawai', 'kriteria', 'subkriteria', 'nama_pegawai', 'mapel', 'nilai'));
    }


    public function create(Request $request)
    {
        // Menyimpan data penilaian
        $penilaian = Penilaian::create([
            'pegawai_id' => $request->nip,
            'mapel_id' => $request->mapel,
            'jml_tm' => $request->jml_tm,
        ]);

        // Menyimpan hasil penilaian ke tabel hasil_penilaians
        foreach ($request->nilai as $subkriteria_id => $nilai) {
            Nilai::create([
                'penilaian_id' => $penilaian->id,
                'kriteria_id' => $request->kriteria_id[$subkriteria_id],
                'subkriteria_id' => $subkriteria_id,
                'nilai' => $nilai
            ]);
        }

        // Perhitungan TOPSIS
        $hasil = $this->topsis($penilaian->id);
        return view('penilaian.topsis', compact('hasil'));
    }

    public function topsis($penilaian_id)
    {
        // Ambil data hasil penilaian
        $hasilPenilaians = Nilai::where('penilaian_id', $penilaian_id)
                                        ->get()
                                        ->groupBy('kriteria_id');

        // Matriks keputusan
        $matriksKeputusan = [];
        foreach ($hasilPenilaians as $kriteria_id => $nilai) {
            foreach ($nilai as $subkriteria) {
                $matriksKeputusan[$kriteria_id][$subkriteria->subkriteria_id] = $subkriteria->nilai;
            }
        }

        // Perhitungan normalisasi matriks keputusan
        $normalisasi = $this->normalisasi($matriksKeputusan);

        // Perhitungan solusi ideal positif dan negatif
        $solusiIdeal = $this->solusiIdeal($normalisasi);

        // Perhitungan jarak ke solusi ideal positif dan negatif
        $jarakPositif = $this->jarakPositif($normalisasi, $solusiIdeal['positif']);
        $jarakNegatif = $this->jarakNegatif($normalisasi, $solusiIdeal['negatif']);

        // Perhitungan nilai preferensi
        $nilaiPreferensi = $this->nilaiPreferensi($jarakPositif, $jarakNegatif);

        return $nilaiPreferensi;
    }

    public function normalisasi($matriks)
    {
        $normalisasi = [];
        foreach ($matriks as $kriteria_id => $nilai) {
            foreach ($nilai as $subkriteria_id => $nilaiSub) {
                $normalisasi[$kriteria_id][$subkriteria_id] = $nilaiSub / sqrt(array_sum(array_map(fn($n) => pow($n, 2), $nilai)));
            }
        }
        return $normalisasi;
    }

    public function solusiIdeal($normalisasi)
    {
        $positif = [];
        $negatif = [];
        foreach ($normalisasi as $kriteria => $nilai) {
            $positif[$kriteria] = max($nilai);
            $negatif[$kriteria] = min($nilai);
        }
        return ['positif' => $positif, 'negatif' => $negatif];
    }

    public function jarakPositif($normalisasi, $solusiPositif)
    {
        $jarak = [];
        foreach ($normalisasi as $kriteria => $nilai) {
            $jarak[$kriteria] = sqrt(array_sum(array_map(fn($n, $pos) => pow($n - $pos, 2), $nilai, $solusiPositif)));
        }
        return $jarak;
    }

    public function jarakNegatif($normalisasi, $solusiNegatif)
    {
        $jarak = [];
        foreach ($normalisasi as $kriteria => $nilai) {
            $jarak[$kriteria] = sqrt(array_sum(array_map(fn($n, $neg) => pow($n - $neg, 2), $nilai, $solusiNegatif)));
        }
        return $jarak;
    }

    public function nilaiPreferensi($jarakPositif, $jarakNegatif)
    {
        $nilaiPreferensi = [];
        foreach ($jarakPositif as $kriteria => $nilai) {
            $nilaiPreferensi[$kriteria] = $jarakNegatif[$kriteria] / ($jarakNegatif[$kriteria] + $nilai);
        }
        return $nilaiPreferensi;
    }

    public function hasil($penilaian_id)
    {
        // Ambil hasil perhitungan TOPSIS
        $hasil = $this->topsis($penilaian_id);

        // Tampilkan hasil di view
        return view('penilaian.hasil', compact('hasil'));
    }



    // public function create(Request $request)
    // {
    //     // Validasi input
    //     $validated = $request->validate([
    //         'nip' => 'required',
    //         'mapel' => 'required|exists:mapels,id',
    //         'jml_tm' => 'required|integer',
    //         'nilai' => 'required|array',  // Memastikan nilai adalah array
    //         'kriteria_id' => 'required|array',  // Memastikan kriteria_id adalah array
    //     ]);
    
    //     // Dapatkan data pegawai berdasarkan NIP
    //     $pegawai = Pegawai::where('nip', $validated['nip'])->firstOrFail();
    
    //     // Simpan data ke tabel penilaians
    //     $penilaian = Penilaian::create([
    //         'pegawai_id' => $pegawai->id,
    //         'mapel_id' => $validated['mapel'],
    //         'jml_tm' => $validated['jml_tm'],
    //     ]);
    
    //     $inputNilai = $validated['nilai'];  // Nilai subkriteria
    //     $inputKriteria = $validated['kriteria_id'];  // ID kriteria
    
    //     // Loop untuk menyimpan data berdasarkan subkriteria dan kriteria
    //     foreach ($inputNilai as $subkriteriaId => $nilai) {
    //         // Pastikan kriteriaId ada untuk subkriteria yang diberikan
    //         if (isset($inputKriteria[$subkriteriaId])) {
    //             $kriteriaId = $inputKriteria[$subkriteriaId];
    
    //             // Simpan data ke tabel nilai (atau tabel terkait)
    //             DB::table('nilais')->insert([  // Menggunakan nama tabel yang sesuai
    //                 'penilaian_id' => $penilaian->id,  // ID penilaian yang baru saja disimpan
    //                 'kriteria_id' => $kriteriaId,  // ID kriteria terkait
    //                 'subkriteria_id' => $subkriteriaId, // ID subkriteria
    //                 'nilai' => $nilai, // Nilai yang dipilih
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         } else {
    //             // Tangani jika kriteria_id tidak ditemukan untuk subkriteria
    //             return redirect()->back()->withErrors("Kriteria untuk subkriteria ID $subkriteriaId tidak ditemukan.");
    //         }
    //     }
    
    //     // Redirect dengan pesan sukses
    //     return redirect()->route('penilaian.tambah')->with('success', 'Penilaian berhasil disimpan!');
    // }
    




    // Menyimpan penilaian kinerja
    private function savePenilaianKinerja(Request $request, $penilaianId)
    {
        // Pastikan nilai ada dan kemudian simpan penilaian
        if ($request->has('nilai')) {
            foreach ($request->input('nilai') as $subkriteriaId => $nilai) {
                $penilaianKinerja = new Penilaian();
                $penilaianKinerja->penilaian_id = $penilaianId;  // Relasi ke penilaian
                $penilaianKinerja->subkriteria_id = $subkriteriaId;  // Relasi ke subkriteria
                $penilaianKinerja->nilai = $nilai;  // Nilai nilai
                $penilaianKinerja->save();  // Simpan penilaian
            }
        }
    }
}
