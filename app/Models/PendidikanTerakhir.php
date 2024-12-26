<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanTerakhir extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'pendidikan_terakhir';

    // Mencegah mass assignment untuk kolom tertentu
    protected $guarded = ['id'];
}
