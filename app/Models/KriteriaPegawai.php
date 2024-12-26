<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPegawai extends Model
{
    /** @use HasFactory<\Database\Factories\KriteriaPegawaiFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];
}
