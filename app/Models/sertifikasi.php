<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikasi extends Model
{
    use HasFactory;

    protected $table = 'sertifikasi'; // Nama tabel di database

    protected $fillable = [
        'nip',
        'nama_pegawai',
        'jabatan',
        'nama_sertifikasi',
        'tgl_sertifikasi',
    ];
}
