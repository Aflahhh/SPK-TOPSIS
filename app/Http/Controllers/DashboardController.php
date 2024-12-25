<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pegawai;
use App\Models\pensiun;



class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah data pegawai
        $jumlahPegawai = Pegawai::count();

        return view('admin.dashboard.index', compact('jumlahPegawai'));
    }

    public function other()
    {
        return view('admin.dashboard.other');
    }
}
