<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusJabatan extends Model
{
    /** @use HasFactory<\Database\Factories\StatusJabatanFactory> */
    use HasFactory;

    protected $fillable = ['status_jabatan']; // Kolom yang bisa diisi
}
