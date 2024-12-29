<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;


class pegawai extends Model
{
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    public static function boot()
    {
        parent::boot();       
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function statusJabatan()
    {
        return $this->belongsTo(StatusJabatan::class, 'status_jabatan_id');
    }


    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function pendidikan()
    {
        return $this->hasMany(Pendidikan::class, 'pegawai_id');
    }

    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'pegawai_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id');
    }
    
    public function getSkor()
{
    // Ambil semua data KriteriaPegawai untuk pegawai tertentu
    $data = KriteriaPegawai::where('pegawai_id', $this->id)->get();

    if ($data->isEmpty()) {
        return 0; // Jika tidak ada data, skor adalah 0
    }

    // Ambil data subkriteria dan bobot
    $subkriteria = Subkriteria::all()->keyBy('id');
    
    // Normalisasi bobot
    $totalBobot = $subkriteria->sum('bobot') ?: 1.0; // Jika total 0, anggap 1 untuk mencegah pembagian nol
    $bobot = $subkriteria->mapWithKeys(fn($item) => [
        $item->id => ($item->bobot ?? 1.0) / $totalBobot
    ])->toArray();

    // Hitung skor WP
    $skor = 1.0; // Inisialisasi untuk perkalian

    foreach ($data as $item) {
        $subkriteria_id = $item->subkriteria_id;
        $nilai = $item->bobot; // Nilai kriteria (x_ij)

        // Kalikan nilai dengan bobot pangkat kriteria
        if (isset($bobot[$subkriteria_id])) {
            $skor *= pow($nilai, $bobot[$subkriteria_id]);
        }
    }

    // Opsional: Skala atau log untuk mencegah hasil besar
    $skor = log($skor + 1); // Tambah 1 untuk mencegah log(0)

    return number_format($skor, 2, '.', ','); // Format hingga 2 desimal
}



}
