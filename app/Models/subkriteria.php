<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subkriteria extends Model
{

    protected $fillable = [
        'kriteria_id',
        'kode_kriteria',
        'nama_subkriteria',
        'bobot',
    ];

    public function Kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    


}
