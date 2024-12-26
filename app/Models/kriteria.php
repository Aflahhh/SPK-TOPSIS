<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    protected $guarded = [
        'id',
    ];
    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class); // One Kriteria has many SubKriteria
    }

    
    

}
