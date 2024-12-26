<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jabatan',
    ];

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id');
    }
}
