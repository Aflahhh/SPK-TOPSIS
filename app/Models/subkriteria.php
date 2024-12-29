<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{

    protected $fillable = [
        'kriteria_id',
        'kode_kriteria',
        'nama_subkriteria',
        'bobot',
    ];

    public function Kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function getBobot($pegawai_id){
        $id = $this->id;
        $cari = KriteriaPegawai::where('pegawai_id', $pegawai_id)->where('subkriteria_id', $id)->first();
        if($cari){
            return $cari->bobot;
        }else{
            return 0;
        }
    }

    


}
