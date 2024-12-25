<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    protected $fillable = [
        'mapel',
    ];

    public function penilaian() {
        return $this->hasMany(Penilaian::class, 'id');
    }

}
