<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    protected $fillable = [
        'pegawai_id',
        'mapel_id',
        'jml_tm',
        'subkriteria_id',
        'nilai',    
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id');
    }


}
