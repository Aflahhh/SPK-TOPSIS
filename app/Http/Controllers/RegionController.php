<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(){
        $provinces = Province::all();

        return view('admin.pegawai.tambah', compact('provinces'));
    }

    
    

}
