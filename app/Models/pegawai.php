<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class pegawai extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'nuptk',
        'nama_pegawai',
        'jk',
        'nip',
        'ttl',
        'no_hp',
        'tgl_masuk',
        'tgl_keluar',
        'jabatan_id',
        'status_jabatan',
        'golongan_id',
        'mapel_id'
    ];
    protected $casts = [
        'tgl' => 'date',
        'tgl_masuk' => 'date',
        'tgl_keluar' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($pegawai) {
            $retirementAge = 60; // Set the retirement age
            $pegawai->tgl_keluar = Carbon::parse($pegawai->tgl)->addYears($retirementAge);
        });
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

    public function village()
    {
        return $this->belongsTo(village::class, 'village_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
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
}
