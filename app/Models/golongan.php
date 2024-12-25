<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class golongan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'golongan',
    ];

    public function pegawai(){
        return $this->hasOne(Pegawai::class, 'id');
    }
    
}
