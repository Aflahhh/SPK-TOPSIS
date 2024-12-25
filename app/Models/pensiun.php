<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pensiun extends Model
{
    protected $fillable = [
        'nama_pegawai',
        'jabatan_id',
        'golongan_id',
        'tgl_pengajuan',
        'tgl_pensiun',
    ];
}
