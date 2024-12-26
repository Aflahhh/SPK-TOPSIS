<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    protected $table = 'mapels';
    protected $primaryKey = 'id';
    protected $fillable = [
        'mapel',
    ];
}
