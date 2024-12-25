<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pekerjaan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pegawai_id',
        'pekerjaan_masuk',
        'pekerjaan_keluar',
        'nama_perusahaan',
        'posisi',
    ];
    
    
}
