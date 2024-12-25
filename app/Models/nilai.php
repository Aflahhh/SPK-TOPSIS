<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['penilaian_id','kriteria_id', 'subkriteria_id', 'nilai'];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class,'penilaian_id');
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(kriteria::class, 'kriteria_id');
    }
}

