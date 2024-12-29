<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusJabatan extends Model
{
    /** @use HasFactory<\Database\Factories\StatusJabatanFactory> */
    use HasFactory;

    protected $fillable = ['status_jabatan']; // Kolom yang bisa diisi

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'status_jabatan_id');
    }
}
