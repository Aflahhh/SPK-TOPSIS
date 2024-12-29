<?php

use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PensiunController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\SubKriteriaController;


// Route::middleware('role')->group(function () {
   
// });

//  diakses oleh pengguna yang belum login
Route::middleware(['guest', 'back'])->group(function () {
    // Route utama
Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/', [UserController::class, 'login']);
});

// diakses oleh pengguna yang telah login
Route::middleware(['auth', 'back'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

// Resource route untuk users
Route::resource('users', UserController::class);

//------------------------------------ MASTER DATA PEGAWAI --------------------------------//
Route::prefix('masterPegawai')->middleware('auth')->group(function () {
    // Data Pegawai
    Route::get('/', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::post('/pegawai', [PegawaiController::class, 'create'])->name('pegawai.tambah');
    Route::get('/addData', [PegawaiController::class, 'addData'])->name('pegawai.addData');
    Route::get('/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/edit/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/hapus/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.hapus');
    Route::get('/profile/{id}', [PegawaiController::class, 'profile'])->name('profile.pegawai'); //tampil halaman profile
});

// Rute Master Data
Route::prefix('masterData')->middleware(['role:admin'])->group(function () {
    // Jabatan
    Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index'); // Tampilkan semua data jabatan
    Route::post('/jabatan', [JabatanController::class, 'create'])->name('jabatan.tambah'); // Simpan data jabatan baru
    Route::put('/jabatan/edit/{id}', [JabatanController::class, 'update'])->name('jabatan.edit'); // Perbarui data jabatan
    Route::delete('/jabatan/hapus/{id}', [JabatanController::class, 'destroy'])->name('jabatan.hapus'); // Hapus data jabatan
    
    // status_jabatan
    Route::get('/status_jabatan', [JabatanController::class, 'indexStatus'])->name('status_jabatan.index');
    // Menyimpan data baru
    Route::post('/status_jabatan', [JabatanController::class, 'storeStatus'])->name('status_jabatan.store');
    // Menampilkan form edit (untuk modal, data dikirim via controller)
    Route::get('/status_jabatan/{id}/edit', [JabatanController::class, 'editStatus'])->name('status_jabatan.edit');
    // Memperbarui data
    Route::put('/status_jabatan/{id}', [JabatanController::class, 'updateStatus'])->name('status_jabatan.update');
    // Menghapus data
    Route::delete('/status_jabatan/{id}', [JabatanController::class, 'destroyStatus'])->name('status_jabatan.destroy');

    // Golongan
    Route::get('/golongan', [GolonganController::class, 'index'])->name('golongan.index'); // Tampilkan semua data golongan
    Route::post('/golongan', [GolonganController::class, 'create'])->name('golongan.tambah'); // Simpan data golongan baru
    Route::put('/golongan/edit/{id}', [GolonganController::class, 'update'])->name('golongan.edit'); // Perbarui data golongan
    Route::delete('/golongan/hapus/{id}', [GolonganController::class, 'destroy'])->name('golongan.hapus'); // Hapus data golongan

    // Mapel
    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel.index'); // Menampilkan data
    Route::post('/mapel', [MapelController::class, 'store'])->name('mapel.tambah'); // Tambah data
    Route::put('/mapel/{id}', [MapelController::class, 'update'])->name('mapel.edit'); // Edit data
    Route::delete('/mapel/{id}', [MapelController::class, 'destroy'])->name('mapel.hapus'); // Hapus data

    // Rute Kriteria
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index'); // Tampilkan semua data kriteria
    Route::post('/kriteria', [KriteriaController::class, 'create'])->name('kriteria.tambah'); // Simpan data kriteria baru
    Route::put('/kriteria/edit/{id}', [KriteriaController::class, 'update'])->name('kriteria.edit'); // Perbarui data kriteria
    Route::delete('/kriteria/hapus/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.hapus'); // Hapus data

    // Rute Sub Kriteria
    Route::get('/subkriteria', [SubKriteriaController::class, 'index'])->name('subkriteria.index'); // Tampilkan semua data subkriteria
    Route::post('/subkriteria', [SubKriteriaController::class, 'create'])->name('subkriteria.tambah'); // Simpan data subkriteria baru
    Route::put('/subkriteria/edit/{id}', [SubKriteriaController::class, 'update'])->name('subkriteria.edit'); // Perbarui data subkriteria
    Route::delete('/subkriteria/hapus/{id}', [SubKriteriaController::class, 'destroy'])->name('subkriteria.hapus'); // Hapus data

});

// Rute Notif Akan Pensiun
Route::get('/notifications', [PegawaiController::class, 'getNotifications'])->name('notifications');

// Rute Pensiun
Route::prefix('pensiun')->group(function () {
    Route::get('/', [PensiunController::class, 'index'])->name('pensiun.index');
    Route::post('/tambah', [PensiunController::class, 'create'])->name('pensiun.tambah');
    Route::put('/edit/{id}', [PensiunController::class, 'update'])->name('pensiun.edit');
    Route::delete('/hapus/{id}', [PensiunController::class, 'destroy'])->name('pensiun.destroy');
});

//------------------------------------ PENILAIAN KINERJA --------------------------------//
// Grup rute dengan prefix "kinerja" dan middleware "auth"
Route::prefix('kinerja')->middleware(['auth'])->group(function () {

    // Rute Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.penilaianPegawai'); // Form penilaian
    Route::get('/penilaian/{id}', [PenilaianController::class, 'edit'])->name('penilaian.edit'); // Edit penilaian
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store'); // Simpan penilaian
    Route::get('/penilaian/get-data', [PegawaiController::class, 'getPegawaiByNip'])->name('penilaian.getData'); // Ambil data pegawai
    Route::post('/penilaian/savePenilaianKinerja', [PenilaianController::class, 'savePenilaianKinerja'])->name('penilaian.simpan'); // Simpan nilai kinerja

    // Rute Peringkat
   Route::get('/peringkat', [PenilaianController::class, 'peringkat'])->name('peringkat'); // Lihat peringkat
   Route::get('/peringkat/{id}', [PenilaianController::class, 'peringkatDetail'])->name('peringkat.detail'); // Detail peringkat
   Route::get('/export-pdf/{pegawaiId}', [PenilaianController::class, 'exportPdf'])->name('export.pdf');
});
   

// Perhitungan Topsis
Route::get('/kinerja/penilaian/calculate-topsis/{nip}', [TopsisController::class, 'calculateTopsis'])->name('penilaian.topsis');
Route::get('/penilaian/hasil/{penilaian_id}', [PenilaianController::class, 'hasil'])->name('penilaian.hasil');


// Route::get('/penilaian/{pegawaiId}', [NilaiController::class, 'showPenilaian'])->name('penilaian.show'); // Menampilkan form penilaian untuk pegawai tertentu
// Route::post('/nilai-alternatif/store', [NilaiController::class, 'store'])->name('nilai-alternatif.store'); // Menyimpan nilai penilaian
// Route::get('/nilai-alternatif/{pegawaiId}', [NilaiController::class, 'showNilai'])->name('nilai-alternatif.show'); // Menampilkan nilai alternatif untuk pegawai tertentu

// // Rute untuk TOPSIS
// Route::get('/topsis/hitung', [TopsisController::class, 'hitungTopsis'])->name('topsis.hitung'); // Menghitung peringkat alternatif menggunakan TOPSIS
// Route::get('/topsis/hasil', [TopsisController::class, 'showHasil'])->name('topsis.hasil'); // Menampilkan hasil perhitungan TOPSIS

// Region
// Route::get('/create/getkab', [PegawaiController::class, 'getkab'])->name('create.getkab');
// Route::get('/create/getkec', [PegawaiController::class, 'getkec'])->name('create.getkec');
// Route::get('/create/getdesa', [PegawaiController::class, 'getdesa'])->name('create.getdesa');

// Sertifikasi
// Route::get('/sertifikasi', [SertifikasiController::class, 'index'])->name('sertifikasi.index'); // Tampilkan semua data sertifikasi
// Route::get('/sertifikasi/addData', [SertifikasiController::class, 'addData'])->name('sertifikasi.addData'); // Tampilkan semua data sertifikasi
// Route::post('/sertifikasi/tambah', [SertifikasiController::class, 'create'])->name('sertifikasi.tambah'); // Simpan data kriteria baru
// Route::get('/sertifikasi/fetch-pegawai', [SertifikasiController::class, 'fetchPegawai'])->name('sertifikasi.fetchPegawai');

