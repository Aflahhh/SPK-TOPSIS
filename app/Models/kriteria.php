<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'atribut',
        'bobot',
    ];
    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class); // One Kriteria has many SubKriteria
    }
    

}
