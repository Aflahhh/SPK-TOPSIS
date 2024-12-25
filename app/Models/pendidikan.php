<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class pendidikan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'pegawai_id',
        'pendidikan_masuk',
        'pendidikan_keluar',
        'nama_sekolah',
        'pendidikan_jurusan',
    ];
}
