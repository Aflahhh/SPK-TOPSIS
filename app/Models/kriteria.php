<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KriteriaPegawai;

class kriteria extends Model
{
    protected $guarded = [
        'id',
    ];

    // hapus sub kriteria beradasarkan kriteria_id
    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class, 'kriteria_id');
    } 


    public function getTotal($pegawai_id)
    {
        $kriteria_id = $this->id;
        // Ambil semua subkriteria berdasarkan kriteria yang diberikan
        $subkriteria = Subkriteria::where('kriteria_id', $kriteria_id)->get()->keyBy('id');
    
        if ($subkriteria->isEmpty()) {
            return 0; // Jika tidak ada subkriteria, kembalikan 0
        }
    
        // Normalisasi bobot untuk subkriteria di bawah kriteria yang diberikan
        $totalBobot = $subkriteria->sum('bobot') ?: 1.0; // Pastikan total bobot tidak 0
        $bobot = $subkriteria->mapWithKeys(fn($item) => [
            $item->id => ($item->bobot ?? 1.0) / $totalBobot
        ])->toArray();
    
        // Ambil data KriteriaPegawai untuk pegawai dan kriteria tertentu
        $data = KriteriaPegawai::where('pegawai_id', $pegawai_id)
            ->whereIn('subkriteria_id', array_keys($bobot))
            ->get();
    
        if ($data->isEmpty()) {
            return 0; // Jika tidak ada data, kembalikan 0
        }
    
        // Hitung total nilai WP
        $total = 1.0; // Inisialisasi total sebagai 1 untuk perkalian
    
        foreach ($data as $item) {
            $subkriteria_id = $item->subkriteria_id;
            $nilai = $item->bobot; // Nilai kriteria (x_ij)
    
            // Kalikan nilai dengan bobot pangkat kriteria
            if (isset($bobot[$subkriteria_id])) {
                $fungsi = $subkriteria[$subkriteria_id]->fungsi;
    
                // Pangkat positif untuk benefit, negatif untuk cost
                $pangkat = $fungsi === 'benefit' ? $bobot[$subkriteria_id] : -$bobot[$subkriteria_id];
                $total *= pow($nilai, $pangkat);
            }
        }
    
        // Opsional: Log skala untuk mencegah hasil yang terlalu besar
        $total = log($total + 1); // Tambah 1 untuk mencegah log(0)
    
        return number_format($total, 2, '.', ','); // Format hingga 2 desimal
    }



    
    

}
