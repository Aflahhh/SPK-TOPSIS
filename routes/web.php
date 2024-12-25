<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\PensiunController;
use App\Http\Controllers\UserController;


Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::resource('users', UserController::class);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/other-dashboard', [DashboardController::class, 'other'])->name('other-dashboard');
});
//------------------------------------ DASHBOARD --------------------------------//
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

//------------------------------------ MASTER DATA --------------------------------//
// Jabatan
Route::get('/master/jabatan', [JabatanController::class, 'index'])->name('jabatan.index'); // Tampilkan semua data jabatan
Route::post('/master/jabatan', [JabatanController::class, 'create'])->name('jabatan.tambah'); // Simpan data jabatan baru
Route::put('/master/jabatan/edit/{id}', [JabatanController::class, 'update'])->name('jabatan.edit'); // Perbarui data jabatan
Route::delete('/master/jabatan/hapus/{id}', [JabatanController::class, 'destroy'])->name('jabatan.hapus'); // Hapus data jabatan

// Golongan
Route::get('/master/golongan', [GolonganController::class, 'index'])->name('golongan.index'); // Tampilkan semua data golongan
Route::post('/master/golongan', [GolonganController::class, 'create'])->name('golongan.tambah'); // Simpan data golongan baru
Route::put('/master/golongan/edit/{id}', [GolonganController::class, 'update'])->name('golongan.edit'); // Perbarui data golongan
Route::delete('/master/golongan/hapus/{id}', [GolonganController::class, 'destroy'])->name('golongan.hapus'); // Hapus data jabatan


// Mapel
Route::get('/master/mapel', [MapelController::class, 'index'])->name('mapel.index'); // Tampilkan semua data mapel
Route::post('/master/mapel', [MapelController::class, 'create'])->name('mapel.tambah'); // Simpan data mapel baru
Route::put('/master/mapel/edit/{id}', [MapelController::class, 'update'])->name('mapel.edit'); // Perbarui data mapel
Route::delete('/master/mapel/hapus/{id}', [MapelController::class, 'destroy'])->name('mapel.hapus'); // Hapus data jabatan




//------------------------------------ DATA PEGAWAI --------------------------------//
// Data Pegawai
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::post('/pegawai', [PegawaiController::class, 'create'])->name('pegawai.tambah');
Route::get('/pegawai/addData', [PegawaiController::class, 'addData'])->name('pegawai.addData');
Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::put('/pegawai/edit/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/hapus/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.hapus');
Route::get('/pegawai/profile/{id}', [PegawaiController::class, 'profile'])->name('profile.pegawai'); //tampil halaman profile

// Region
Route::get('/create/getkab', [PegawaiController::class, 'getkab'])->name('create.getkab');
Route::get('/create/getkec', [PegawaiController::class, 'getkec'])->name('create.getkec');
Route::get('/create/getdesa', [PegawaiController::class, 'getdesa'])->name('create.getdesa');

// Sertifikasi
Route::get('/sertifikasi', [SertifikasiController::class, 'index'])->name('sertifikasi.index'); // Tampilkan semua data sertifikasi
Route::get('/sertifikasi/addData', [SertifikasiController::class, 'addData'])->name('sertifikasi.addData'); // Tampilkan semua data sertifikasi
Route::post('/sertifikasi/tambah', [SertifikasiController::class, 'create'])->name('sertifikasi.tambah'); // Simpan data kriteria baru
Route::get('/sertifikasi/fetch-pegawai', [SertifikasiController::class, 'fetchPegawai'])->name('sertifikasi.fetchPegawai');



//------------------------------------ DATA PENSIUN --------------------------------//
// Pensiun
Route::get('/pensiun', [PensiunController::class, 'index'])->name('pensiun.index');
Route::post('/pensiun/tambah', [PensiunController::class, 'create'])->name('pensiun.tambah');
Route::put('/pensiun/edit/{id}', [PensiunController::class, 'update'])->name('pensiun.edit');
Route::delete('/pensiun/hapus/{id}', [PensiunController::class, 'destroy'])->name('pensiun.hapus');




//------------------------------------ PENILAIAN KINERJA --------------------------------//
// Kriteria
Route::get('/kinerja/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index'); // Tampilkan semua data kriteria
Route::post('/kinerja/kriteria', [KriteriaController::class, 'create'])->name('kriteria.tambah'); // Simpan data kriteria baru
Route::put('/kinerja/kriteria/edit/{id}', [KriteriaController::class, 'update'])->name('kriteria.edit'); // Perbarui data kriteria
Route::delete('/kinerja/kriteria/hapus/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.hapus'); // Hapus data

// Sub Kriteria
Route::get('/kinerja/subkriteria', [SubKriteriaController::class, 'index'])->name('subkriteria.index'); // Tampilkan semua data subkriteria
Route::post('/kinerja/subkriteria', [SubKriteriaController::class, 'create'])->name('subkriteria.tambah'); // Simpan data subkriteria baru
Route::put('/kinerja/subkriteria/edit/{id}', [SubKriteriaController::class, 'update'])->name('subkriteria.edit'); // Perbarui data subkriteria
Route::delete('/kinerja/subkriteria/hapus/{id}', [SubKriteriaController::class, 'destroy'])->name('subkriteria.hapus'); // Hapus data


// Penilaian Kinerja
Route::get('/kinerja/penilaian', [PenilaianController::class, 'penilaianPegawai'])->name('penilaian.penilaianPegawai'); // Menampilkan form penilaian untuk pegawai tertentu
Route::post('/kinerja/penilaian', [PenilaianController::class, 'create'])->name('penilaian.create'); // Menyimpan nilai penilaian
Route::get('/kinerja/penilaian/get-data', [PegawaiController::class, 'getPegawaiByNip'])->name('penilaian.getData');
Route::post('/kinerja/penilaian/savePenilaianKinerja', [PenilaianController::class, 'savePenilaianKinerja'])->name('penilaian.simpan'); // Menyimpan nilai penilaian

// Perhitungan Topsis
Route::get('/kinerja/penilaian/calculate-topsis/{nip}', [TopsisController::class, 'calculateTopsis'])->name('penilaian.topsis');
Route::get('/penilaian/hasil/{penilaian_id}', [PenilaianController::class, 'hasil'])->name('penilaian.hasil');
// Route::get('/penilaian/{pegawaiId}', [NilaiController::class, 'showPenilaian'])->name('penilaian.show'); // Menampilkan form penilaian untuk pegawai tertentu
// Route::post('/nilai-alternatif/store', [NilaiController::class, 'store'])->name('nilai-alternatif.store'); // Menyimpan nilai penilaian
// Route::get('/nilai-alternatif/{pegawaiId}', [NilaiController::class, 'showNilai'])->name('nilai-alternatif.show'); // Menampilkan nilai alternatif untuk pegawai tertentu

// // Rute untuk TOPSIS
// Route::get('/topsis/hitung', [TopsisController::class, 'hitungTopsis'])->name('topsis.hitung'); // Menghitung peringkat alternatif menggunakan TOPSIS
// Route::get('/topsis/hasil', [TopsisController::class, 'showHasil'])->name('topsis.hasil'); // Menampilkan hasil perhitungan TOPSIS
